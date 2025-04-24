<?php
declare(strict_types=1);

namespace Werkl\OpenBlogware\Controller;

use Shopware\Core\Framework\Adapter\Cache\CacheValueCompressor;
use Shopware\Core\Framework\DataAbstractionLayer\Cache\EntityCacheKeyGenerator;
use Shopware\Core\Framework\Util\Json;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Storefront\Controller\StorefrontController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Shopware\Core\Framework\Event\AddCacheTags;

/**
 * Handle Cache for BlogRssController
 */
#[\Symfony\Component\Routing\Attribute\Route(defaults: ['_routeScope' => ['storefront']])]
class CachedBlogRssController extends StorefrontController
{
    public const RSS_TAG = 'werkl-blog-rss';

    public function __construct(
        private readonly BlogRssController $decorated,
        private readonly CacheInterface $cache,
        private readonly EntityCacheKeyGenerator $generator,
        private readonly EventDispatcherInterface $eventDispatcher
    )
    {
    }

    public static function buildName(string $salesChannelId): string
    {
        return 'werkl-blog-rss-' . $salesChannelId;
    }

    #[\Symfony\Component\Routing\Attribute\Route(path: '/blog/rss', name: 'frontend.werkl_blog.rss', methods: ['GET'])]
    public function rss(Request $request, SalesChannelContext $context): Response
    {
        $key = $this->generateKey($request, $context);

        $value = $this->cache->get($key, function (ItemInterface $item) use ($request, $context) {
            $response = $this->decorated->rss($request, $context);

            $item->tag($this->generateTags($context));

            return CacheValueCompressor::compress($response);
        });

        return CacheValueCompressor::uncompress($value);
    }

    private function generateKey(Request $request, SalesChannelContext $context): string
    {
        $parts = array_merge(
            $request->query->all(),
            $request->request->all(),
            [$this->generator->getSalesChannelContextHash($context)],
        );

        return self::buildName($context->getSalesChannelId()) . '-' . md5(Json::encode($parts));
    }

    /**
     * @return array<string>
     */
    private function generateTags(SalesChannelContext $context): array
    {
        $tags = [self::buildName($context->getSalesChannelId()), self::RSS_TAG];
        
        // Use the event system for collecting cache tags
        $event = new AddCacheTags();
        $name = self::buildName($context->getSalesChannelId());
        
        $this->eventDispatcher->dispatch($event, $name);
        
        if (method_exists($event, 'getTags')) {
            $tags = array_merge($event->getTags(), $tags);
        }

        return array_unique(array_filter($tags));
    }
}
