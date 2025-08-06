<?php
declare(strict_types=1);

namespace Werkl\OpenBlogware\Content\BlogCategory;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @extends EntityCollection<BlogCategoryEntity>
 */
class BlogCategoryCollection extends EntityCollection
{
    public function getApiAlias(): string
    {
        return 'werkl_blog_category_collection';
    }

    protected function getExpectedClass(): string
    {
        return BlogCategoryEntity::class;
    }
}
