<?php
declare(strict_types=1);

namespace Werkl\OpenBlogware\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1754398192RenameBlogEntries extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1754398192;
    }

    public function update(Connection $connection): void
    {
        $connection->executeQuery(
            <<<SQL
                    RENAME TABLE `werkl_blog_entries` TO `werkl_blog_entry`
                SQL
        );

        $connection->executeQuery(
            <<<SQL
                    RENAME TABLE `werkl_blog_entries_translation` TO `werkl_blog_entry_translation`
                SQL
        );

        $connection->executeQuery(
            <<<SQL
                    ALTER TABLE `werkl_blog_entry_translation`
                    RENAME COLUMN `werkl_blog_entries_id` TO `werkl_blog_entry_id`
                SQL
        );

        $connection->executeQuery(
            <<<SQL
                    RENAME TABLE `werkl_blog_blog_category` TO `werkl_blog_entry_blog_category`
                SQL
        );

        $connection->executeQuery(
            <<<SQL
                    ALTER TABLE `werkl_blog_entry_blog_category`
                    RENAME COLUMN `werkl_blog_entries_id` TO `werkl_blog_entry_id`
                SQL
        );

        $connection->executeQuery(
            <<<SQL
                    RENAME TABLE `werkl_blog_entries_tag` TO `werkl_blog_entry_tag`
                SQL
        );

        $connection->executeQuery(
            <<<SQL
                    ALTER TABLE `werkl_blog_entry_tag`
                    RENAME COLUMN `werkl_blog_entries_id` TO `werkl_blog_entry_id`
                SQL
        );
    }
}
