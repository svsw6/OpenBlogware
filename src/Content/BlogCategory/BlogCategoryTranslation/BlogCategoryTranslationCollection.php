<?php
declare(strict_types=1);

namespace Werkl\OpenBlogware\Content\BlogCategory\BlogCategoryTranslation;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @extends EntityCollection<BlogCategoryTranslationEntity>
 */
class BlogCategoryTranslationCollection extends EntityCollection
{
    public function getApiAlias(): string
    {
        return 'werkl_blog_category_translation_collection';
    }

    protected function getExpectedClass(): string
    {
        return BlogCategoryTranslationEntity::class;
    }
}
