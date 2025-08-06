<?php
declare(strict_types=1);

namespace Werkl\OpenBlogware\Content\Blog\DataResolver;

use Shopware\Core\Content\Cms\Aggregate\CmsSlot\CmsSlotEntity;
use Shopware\Core\Content\Cms\DataResolver\CriteriaCollection;
use Shopware\Core\Content\Cms\DataResolver\Element\AbstractCmsElementResolver;
use Shopware\Core\Content\Cms\DataResolver\Element\ElementDataCollection;
use Shopware\Core\Content\Cms\DataResolver\ResolverContext\ResolverContext;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\EntitySearchResult;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Werkl\OpenBlogware\Content\Blog\Events\CategoriesCriteriaEvent;
use Werkl\OpenBlogware\Content\BlogCategory\BlogCategoryDefinition;

class BlogCategoriesCmsElementResolver extends AbstractCmsElementResolver
{
    public function __construct(private readonly EventDispatcherInterface $eventDispatcher)
    {
    }

    public function getType(): string
    {
        return 'blog-categories';
    }

    public function collect(CmsSlotEntity $slot, ResolverContext $resolverContext): ?CriteriaCollection
    {
        $request = $resolverContext->getRequest();
        $context = $resolverContext->getSalesChannelContext();
        $criteria = new Criteria();

        $this->eventDispatcher->dispatch(new CategoriesCriteriaEvent($request, $criteria, $context));

        $criteriaCollection = new CriteriaCollection();
        $criteriaCollection->add(
            BlogCategoryDefinition::ENTITY_NAME . '_' . $slot->getUniqueIdentifier(),
            BlogCategoryDefinition::class,
            $criteria
        );

        return $criteriaCollection;
    }

    public function enrich(CmsSlotEntity $slot, ResolverContext $resolverContext, ElementDataCollection $result): void
    {
        $werklBlog = $result->get(BlogCategoryDefinition::ENTITY_NAME . '_' . $slot->getUniqueIdentifier());

        if (!$werklBlog instanceof EntitySearchResult) {
            return;
        }

        $slot->setData($werklBlog);
    }
}
