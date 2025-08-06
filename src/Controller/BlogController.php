<?php
declare(strict_types=1);

namespace Werkl\OpenBlogware\Controller;

use Shopware\Core\Framework\Adapter\Cache\Event\AddCacheTagEvent;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Storefront\Controller\StorefrontController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Werkl\OpenBlogware\Page\Blog\BlogPageLoader;

#[Route(defaults: ['_routeScope' => ['storefront']])]
class BlogController extends StorefrontController
{
    public function __construct(
        private readonly BlogPageLoader $blogPageLoader,
        private readonly EventDispatcherInterface $dispatcher
    ) {
    }

    public static function buildName(string $id): string
    {
        return 'werkl-blog-detail-' . $id;
    }

    #[Route(path: '/werkl_blog/{articleId}', name: 'werkl.frontend.blog.detail', methods: ['GET'])]
    public function detailAction(string $articleId, Request $request, SalesChannelContext $context): Response
    {
        $this->dispatcher->dispatch(new AddCacheTagEvent(self::buildName($articleId)));

        $page = $this->blogPageLoader->load($request, $context);

        return $this->renderStorefront('@Storefront/storefront/page/content/index.html.twig', ['page' => $page]);
    }
}
