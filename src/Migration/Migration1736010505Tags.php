<?php
declare(strict_types=1);

namespace Werkl\OpenBlogware\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1736010505Tags extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1736010505;
    }

    public function update(Connection $connection): void
    {
        $connection->executeStatement('
            CREATE TABLE IF NOT EXISTS `werkl_blog_entries_tag` (
                `werkl_blog_entries_id` BINARY(16) NOT NULL,
                `tag_id` BINARY(16) NOT NULL,
                PRIMARY KEY (`werkl_blog_entries_id`,`tag_id`),
                KEY `fk.werkl_blog_entries_tag.werkl_blog_entries_id` (`werkl_blog_entries_id`),
                KEY `fk.werkl_blog_entries_tag.tag_id` (`tag_id`),
                CONSTRAINT `fk.werkl_blog_entries_tag.werkl_blog_entries_id` FOREIGN KEY (`werkl_blog_entries_id`) REFERENCES `werkl_blog_entries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT `fk.werkl_blog_entries_tag.tag_id` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');
    }

    public function updateDestructive(Connection $connection): void
    {
        // implement update destructive
    }
}
