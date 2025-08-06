<?php
declare(strict_types=1);

namespace Werkl\OpenBlogware\Content\BlogAuthor\BlogAuthorTranslation;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @extends EntityCollection<BlogAuthorTranslationEntity>
 */
class BlogAuthorTranslationCollection extends EntityCollection
{
    public function getApiAlias(): string
    {
        return 'werkl_blog_author_translation_collection';
    }

    protected function getExpectedClass(): string
    {
        return BlogAuthorTranslationEntity::class;
    }
}
