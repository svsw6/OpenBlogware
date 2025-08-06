<?php
declare(strict_types=1);

namespace Werkl\OpenBlogware\Content\Blog\BlogEntryTranslation;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @extends EntityCollection<BlogEntryTranslationEntity>
 */
class BlogEntryTranslationCollection extends EntityCollection
{
    protected function getExpectedClass(): string
    {
        return BlogEntryTranslationEntity::class;
    }
}
