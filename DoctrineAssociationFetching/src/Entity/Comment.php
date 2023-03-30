<?php

declare(strict_types=1);

namespace App\Entity;
class Comment
{
    protected int $id;
    protected BlogPost $blogPost;

    protected string $content;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setBlogPost(BlogPost $blogPost): void
    {
        $this->blogPost = $blogPost;
    }

    public function getBlogPost(): BlogPost
    {
        return $this->blogPost;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
