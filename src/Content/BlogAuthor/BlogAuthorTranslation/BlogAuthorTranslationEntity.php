<?php
declare(strict_types=1);

namespace Werkl\OpenBlogware\Content\BlogAuthor\BlogAuthorTranslation;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCustomFieldsTrait;
use Shopware\Core\Framework\DataAbstractionLayer\TranslationEntity;
use Werkl\OpenBlogware\Content\BlogAuthor\BlogAuthorEntity;

class BlogAuthorTranslationEntity extends TranslationEntity
{
    use EntityCustomFieldsTrait;

    protected string $werklBlogAuthorId;

    protected ?BlogAuthorEntity $werklBlogAuthor = null;

    protected ?string $description = null;

    public function getWerklBlogAuthorId(): string
    {
        return $this->werklBlogAuthorId;
    }

    public function setWerklBlogAuthorId(string $werklBlogAuthorId): void
    {
        $this->werklBlogAuthorId = $werklBlogAuthorId;
    }

    public function getWerklBlogAuthor(): ?BlogAuthorEntity
    {
        return $this->werklBlogAuthor;
    }

    public function setWerklBlogAuthor(BlogAuthorEntity $werklBlogAuthor): void
    {
        $this->werklBlogAuthor = $werklBlogAuthor;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}
