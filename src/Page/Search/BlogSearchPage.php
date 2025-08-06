<?php
declare(strict_types=1);

namespace Werkl\OpenBlogware\Page\Search;

use Shopware\Core\Framework\DataAbstractionLayer\Search\EntitySearchResult;
use Shopware\Storefront\Page\Page;
use Werkl\OpenBlogware\Content\Blog\BlogEntryCollection;

class BlogSearchPage extends Page
{
    protected string $searchTerm;

    /**
     * @var EntitySearchResult<BlogEntryCollection>
     */
    protected EntitySearchResult $listing;

    public function getSearchTerm(): string
    {
        return $this->searchTerm;
    }

    public function setSearchTerm(string $searchTerm): void
    {
        $this->searchTerm = $searchTerm;
    }

    /**
     * @return EntitySearchResult<BlogEntryCollection>
     */
    public function getListing(): EntitySearchResult
    {
        return $this->listing;
    }

    /**
     * @param EntitySearchResult<BlogEntryCollection> $listing
     */
    public function setListing(EntitySearchResult $listing): void
    {
        $this->listing = $listing;
    }
}
