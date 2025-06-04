<?php
declare(strict_types=1);

namespace Werkl\OpenBlogware\Controller\Admin;

use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route(defaults: ['_routeScope' => ['api']])]
class DuplicateBlogEntryController extends AbstractController
{
    private EntityRepository $blogRepository;

    public function __construct(EntityRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    #[Route(path: '/api/_action/werkl-blog/duplicate/{id}', name: 'api.action.werkl_blog.duplicate', methods: ['POST'])]
    public function duplicate(string $id, Request $request, Context $context): JsonResponse
    {
        $criteria = new Criteria([$id]);
        $criteria->addAssociations(['translations', 'blogCategories', 'tags']);

        $source = $this->blogRepository->search($criteria, $context)->first();
        if (!$source) {
            return new JsonResponse(['success' => false], 404);
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
            $title = $request->request->get('title', $translation->getTitle() . ' Copy');
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

        return new JsonResponse(['success' => true, 'id' => $newId]);
    }
}
