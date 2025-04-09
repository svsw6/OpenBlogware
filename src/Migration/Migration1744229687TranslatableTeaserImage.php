<?php
declare(strict_types=1);

namespace Werkl\OpenBlogware\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Defaults;
use Shopware\Core\Framework\Migration\MigrationStep;
use Shopware\Core\Framework\Uuid\Uuid;

class Migration1744229687TranslatableTeaserImage extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1744229687;
    }

    public function update(Connection $connection): void
    {
        $this->addColumnToTranslationTable($connection);
        $this->migrateMediaIdToTranslationTable($connection);
        $this->removeColumnFromTable($connection);
    }

    private function addColumnToTranslationTable(Connection $connection): void
    {
        $connection->executeStatement('
            ALTER TABLE `werkl_blog_entries_translation`
            ADD COLUMN `media_id` BINARY(16) DEFAULT NULL AFTER `language_id`;
        ');
    }

    private function migrateMediaIdToTranslationTable(Connection $connection): void
    {
        $connection->executeStatement('
            UPDATE `werkl_blog_entries_translation`
            SET `media_id` = (
                SELECT `media_id`
                FROM `werkl_blog_entries`
                WHERE `werkl_blog_entries`.`id` = `werkl_blog_entries_translation`.`werkl_blog_entries_id`
            )
            WHERE `werkl_blog_entries_translation`.`language_id` = :languageId;
        ', [
            'languageId' => Uuid::fromHexToBytes(Defaults::LANGUAGE_SYSTEM),
        ]);
    }

    private function removeColumnFromTable(Connection $connection): void
    {
        $connection->executeStatement('
            ALTER TABLE `werkl_blog_entries`
            DROP COLUMN `media_id`;
        ');
    }
}
