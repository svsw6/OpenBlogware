<?php
declare(strict_types=1);

namespace Werkl\OpenBlogware\Util;

use Doctrine\DBAL\Connection;
use Psr\Container\ContainerInterface;
use Shopware\Core\Framework\Plugin\Context\UpdateContext;
use Werkl\OpenBlogware\Content\Blog\BlogEntryDefinition;
use Werkl\OpenBlogware\Migration\Migration1602739765AddTeaserImageColumnToBlogEntries;
use Werkl\OpenBlogware\Migration\Migration1612160298CreatePubslihedDateColumn;

class Update
{
    public function update(ContainerInterface $container, UpdateContext $updateContext): void
    {
        if (version_compare($updateContext->getCurrentPluginVersion(), '1.1.0', '<')) {
            $this->updateTo110($container);
        }

        if (version_compare($updateContext->getCurrentPluginVersion(), '1.3.0', '<')) {
            $this->updateTo130($container);
        }
    }

    private function updateTo110(ContainerInterface $container): void
    {
        /** @var Connection $connection */
        $connection = $container->get(Connection::class);

        if (!$connection->createSchemaManager()->tablesExist([BlogEntryDefinition::ENTITY_NAME])) {
            $blogEntryMigration = new Migration1602739765AddTeaserImageColumnToBlogEntries();
            $blogEntryMigration->update($connection);
        }
    }

    private function updateTo130(ContainerInterface $container): void
    {
        /** @var Connection $connection */
        $connection = $container->get(Connection::class);

        if (!$connection->createSchemaManager()->tablesExist([BlogEntryDefinition::ENTITY_NAME])) {
            $blogEntryMigration = new Migration1612160298CreatePubslihedDateColumn();
            $blogEntryMigration->update($connection);
        }
    }
}
