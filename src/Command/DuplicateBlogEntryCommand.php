<?php
declare(strict_types=1);

namespace Werkl\OpenBlogware\Command;

use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\Uuid\Uuid;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DuplicateBlogEntryCommand extends Command
{
    protected static $defaultName = 'werkl-blog:duplicate';

    private EntityRepository $blogRepository;

    public function __construct(EntityRepository $blogRepository)
    {
        parent::__construct();
        $this->blogRepository = $blogRepository;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('sourceId', InputArgument::REQUIRED, 'ID of the blog entry to duplicate')
            ->addOption('title', null, InputOption::VALUE_OPTIONAL, 'Override title of the duplicated entry');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $context = Context::createDefaultContext();
        $sourceId = (string) $input->getArgument('sourceId');

        $criteria = new Criteria([$sourceId]);
        $criteria->addAssociations(['translations', 'blogCategories', 'tags']);

        $source = $this->blogRepository->search($criteria, $context)->first();
        if (!$source) {
            $output->writeln('<error>Blog entry not found</error>');
            return self::FAILURE;
        }

        $newId = Uuid::randomHex();
        $data = [
            'id' => $newId,
            'authorId' => $source->getAuthorId(),
            'active' => $source->getActive(),
            'detailTeaserImage' => $source->getDetailTeaserImage(),
            'mediaId' => $source->getMediaId(),
            'publishedAt' => new \DateTime(),
            'cmsPageId' => $source->getCmsPageId(),
            'translations' => [],
        ];

        foreach ($source->getTranslations() as $translation) {
            $title = $input->getOption('title') ?? $translation->getTitle() . ' Copy';
            $data['translations'][] = [
                'languageId' => $translation->getLanguageId(),
                'title' => $title,
                'slug' => $translation->getSlug() . '-copy',
                'teaser' => $translation->getTeaser(),
                'metaTitle' => $translation->getMetaTitle(),
                'metaDescription' => $translation->getMetaDescription(),
                'content' => $translation->getContent(),
                'mediaId' => $translation->getMediaId(),
            ];
        }

        if ($source->getBlogCategories()) {
            $data['blogCategories'] = array_map(static function ($cat) {
                return ['id' => $cat->getId()];
            }, $source->getBlogCategories()->getElements());
        }

        if ($source->getTags()) {
            $data['tags'] = array_map(static function ($tag) {
                return ['id' => $tag->getId()];
            }, $source->getTags()->getElements());
        }

        $this->blogRepository->create([$data], $context);

        $output->writeln('<info>Duplicated blog entry with ID ' . $newId . '</info>');
        return self::SUCCESS;
    }
}
