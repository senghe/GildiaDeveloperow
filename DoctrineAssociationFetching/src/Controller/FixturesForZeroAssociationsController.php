<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Blog;
use App\Entity\BlogPost;
use App\Entity\Comment;
use App\Entity\Tag;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

final class FixturesForZeroAssociationsController
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {

    }

    public function __invoke(): Response
    {
        $blogPosts = $this->entityManager
            ->getRepository(BlogPost::class)
            ->findAll();

        foreach ($blogPosts as $blogPost) {
            $this->entityManager->remove($blogPost);
        }

        $blogs = $this->entityManager
            ->getRepository(Blog::class)
            ->findAll();

        foreach ($blogs as $blog) {
            $this->entityManager->remove($blog);
        }

        $this->entityManager->flush();

        $postsCount = 50;
        for ($i=0; $i<$postsCount; $i++) {

            $post = new BlogPost();
            $post->setName(sprintf('Blog post no. %d', $i+1));

            $this->entityManager->persist($post);
        }

        $this->entityManager->flush();

        return new Response("Fixtures reloaded.");
    }
}
