<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Tag
{
    protected int $id;

    protected string $name;

    protected Collection $posts;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(BlogPost $post): void
    {
        if ($this->posts->contains($post)) {
            return;
        }

        $this->posts->add($post);
    }
}
