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

final class FixturesController
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

        $blog = new Blog();
        $blog->setName("The blog");
        $this->entityManager->persist($blog);

        $tagsCount = 10;
        $tags = [];
        for ($i=0; $i<$tagsCount; $i++) {
            $tag = new Tag();
            $tag->setName(sprintf("Tag no %d", $i+1));
            $this->entityManager->persist($tag);

            $tags[] = $tag;
        }

        $postsCount = 50;
        for ($i=0; $i<$postsCount; $i++) {
            $author = new Author();
            $author->setName(sprintf("Author no. %d", $i+1));

            $post = new BlogPost();
            $post->setName(sprintf('Blog post no. %d', $i+1));
            $post->setBlog($blog);
            $post->setAuthor($author);
            $commentsCount = 100;

            foreach ($tags as $tag) {
                $post->addTag($tag);
                $tag->addPost($post);
            }

            for($j=0; $j<$commentsCount; $j++) {
                $comment = new Comment();
                $comment->setContent(sprintf('Content no. %d for post no. %d', $j, $i));
                $comment->setBlogPost($post);
                $post->addComment($comment);

                $this->entityManager->persist($comment);
            }

            $this->entityManager->persist($author);
            $this->entityManager->persist($post);
        }

        $this->entityManager->flush();

        return new Response("Fixtures reloaded.");
    }
}
