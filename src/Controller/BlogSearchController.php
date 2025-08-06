<?php
declare(strict_types=1);

namespace Werkl\OpenBlogware\Controller;

use Shopware\Core\Framework\Adapter\Cache\Event\AddCacheTagEvent;
use Shopware\Core\Framework\Routing\RoutingException;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Storefront\Controller\StorefrontController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Werkl\OpenBlogware\Page\Search\BlogSearchPageLoader;

#[Route(defaults: ['_routeScope' => ['storefront']])]
class BlogSearchController extends StorefrontController
{
    final public const ALL_TAG = 'werkl-blog-search';

    public function __construct(
        private readonly BlogSearchPageLoader $blogSearchPageLoader,
        private readonly EventDispatcherInterface $dispatcher
    ) {
    }

    public static function buildName(string $id): string
    {
        return 'werkl-blog-search-' . $id;
    }

    #[Route(path: '/blog/search', name: 'werkl.frontend.blog.search', methods: ['GET'])]
    public function search(Request $request, SalesChannelContext $context): Response
    {
        $this->dispatcher->dispatch(new AddCacheTagEvent(
            self::buildName($context->getSalesChannelId()),
            self::ALL_TAG
        ));

        try {
            $page = $this->blogSearchPageLoader->load($request, $context);
        } catch (RoutingException) {
            return $this->forwardToRoute('frontend.home.page');
        }

        return $this->renderStorefront('@Storefront/storefront/page/blog-search/index.html.twig', ['page' => $page]);
    }

    /**
     * @throws RoutingException
     */
    #[Route(path: '/widgets/blog-search', name: 'widgets.blog.search.pagelet', methods: ['GET', 'POST'], defaults: ['XmlHttpRequest' => true])]
    public function ajax(Request $request, SalesChannelContext $context): Response
    {
        $this->dispatcher->dispatch(new AddCacheTagEvent(self::buildName($context->getSalesChannelId())));

        $request->request->set('no-aggregations', true);

        $page = $this->blogSearchPageLoader->load($request, $context);

        $response = $this->renderStorefront('@Storefront/storefront/page/blog-search/search-pagelet.html.twig', ['page' => $page]);
        $response->headers->set('x-robots-tag', 'noindex');

        return $response;
    }
}
