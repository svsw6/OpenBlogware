<?php
declare(strict_types=1);

namespace Werkl\OpenBlogware\Content\Blog;

use Shopware\Core\Content\Seo\SeoUrlRoute\SeoUrlMapping;
use Shopware\Core\Content\Seo\SeoUrlRoute\SeoUrlRouteConfig;
use Shopware\Core\Content\Seo\SeoUrlRoute\SeoUrlRouteInterface;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\System\SalesChannel\SalesChannelEntity;

class BlogSeoUrlRoute implements SeoUrlRouteInterface
{
    public const ROUTE_NAME = 'werkl.frontend.blog.detail';
    public const DEFAULT_TEMPLATE = 'blog/{{ entry.blogCategories.first.translated.name|lower }}/{{ entry.translated.title|lower }}';

    public function __construct(private readonly BlogEntryDefinition $blogEntryDefinition)
    {
    }

    public function getConfig(): SeoUrlRouteConfig
    {
        return new SeoUrlRouteConfig(
            $this->blogEntryDefinition,
            self::ROUTE_NAME,
            self::DEFAULT_TEMPLATE,
            true
        );
    }

    public function prepareCriteria(Criteria $criteria, SalesChannelEntity $salesChannel): void
    {
        $criteria->addAssociations([
            'blogCategories',
            'blogAuthor',
            'tags',
        ]);
    }

    public function getMapping(Entity $entry, ?SalesChannelEntity $salesChannel): SeoUrlMapping
    {
        if (!$entry instanceof BlogEntryEntity) {
            throw new \InvalidArgumentException('Expected BlogEntryEntity');
        }

        return new SeoUrlMapping(
            $entry,
            ['articleId' => $entry->getId()],
            [
                'entry' => $entry,
            ]
        );
    }
}
