<?php
declare(strict_types=1);

namespace Werkl\OpenBlogware\Page\Blog;

use Shopware\Core\Content\Cms\CmsPageEntity;
use Shopware\Storefront\Page\Page;
use Werkl\OpenBlogware\Content\Blog\BlogEntryEntity;

class BlogPage extends Page
{
    protected ?BlogEntryEntity $blogEntry = null;

    protected ?CmsPageEntity $cmsPage = null;

    public function getBlogEntry(): ?BlogEntryEntity
    {
        return $this->blogEntry;
    }

    public function setBlogEntry(BlogEntryEntity $blogEntry): void
    {
        $this->blogEntry = $blogEntry;
    }

    public function getCmsPage(): ?CmsPageEntity
    {
        return $this->cmsPage;
    }

    public function setCmsPage(CmsPageEntity $cmsPage): void
    {
        $this->cmsPage = $cmsPage;
    }
}
