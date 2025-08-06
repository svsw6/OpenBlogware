<?php
declare(strict_types=1);

namespace Werkl\OpenBlogware\Controller\StoreApi;

use Shopware\Core\System\SalesChannel\StoreApiResponse;
use Werkl\OpenBlogware\Content\Blog\BlogEntryCollection;

/**
 * @extends StoreApiResponse<BlogEntryCollection>
 */
class BlogControllerResponse extends StoreApiResponse
{
    public function getBlogEntries(): BlogEntryCollection
    {
        return $this->object;
    }
}
