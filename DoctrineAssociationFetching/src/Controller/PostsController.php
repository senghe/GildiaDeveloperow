<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\BlogPost;
use App\Entity\Comment;
use App\Entity\Tag;
use App\Repository\BlogPostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

final class PostsController
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {

    }

    public function __invoke(): Response
    {
        /** @var BlogPostRepository $repository */
        $repository = $this->entityManager->getRepository(BlogPost::class);

//        $allPosts = $repository->findWithAllWithLeftJoins();
//        var_dump(count($allPosts));

//        $allPosts = $repository->findWithAllWithInnerJoins();
//        var_dump(count($allPosts));

//        $allPosts = $repository->findWithEagerBlog();
//        /** @var BlogPost $post */
//        foreach ($allPosts as $post) {
//            var_dump($post->getBlog()->getName());
//        }

//        $allPosts = $repository->findWithEagerAuthor();
//        /** @var BlogPost $post */
//        foreach ($allPosts as $post) {
//            var_dump($post->getAuthor()->getName());
//        }

//        $allPosts = $repository->findWithSelectedComments();
//        /** @var BlogPost $post */
//        foreach ($allPosts as $post) {
//            /** @var Comment $comment */
//            foreach ($post->getComments() as $comment) {
//                var_dump($comment->getContent());
//            }
//        }

//        $allPosts = $repository->findWithEagerTags();
//        /** @var BlogPost $post */
//        foreach ($allPosts as $post) {
//            /** @var Tag $tag */
//            foreach ($post->getTags() as $tag) {
//                var_dump($tag->getName());
//            }
//        }

        return new Response("Response");
    }
}
