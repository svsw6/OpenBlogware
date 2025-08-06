<?php
declare(strict_types=1);

namespace Werkl\OpenBlogware\Content\Blog;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @extends EntityCollection<BlogEntryEntity>
 */
class BlogEntryCollection extends EntityCollection
{
    protected function getExpectedClass(): string
    {
        return BlogEntryEntity::class;
    }
}
