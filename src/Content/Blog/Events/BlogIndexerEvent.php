<?php
declare(strict_types=1);

namespace Werkl\OpenBlogware\Content\Blog\Events;

use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\Event\NestedEvent;

class BlogIndexerEvent extends NestedEvent
{
    /**
     * @param list<string> $ids
     * @param array<string> $skip
     */
    public function __construct(
        protected array $ids,
        protected Context $context,
        private readonly array $skip = []
    ) {
    }

    /**
     * @return list<string>
     */
    public function getIds(): array
    {
        return $this->ids;
    }

    public function getContext(): Context
    {
        return $this->context;
    }

    /**
     * @return array<string>
     */
    public function getSkip(): array
    {
        return $this->skip;
    }
}
