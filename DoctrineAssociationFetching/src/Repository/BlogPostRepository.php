<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Author;
use App\Entity\BlogPost;
use App\Entity\Comment;
use App\Entity\Tag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Persistence\ManagerRegistry;

final class BlogPostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, BlogPost::class);
    }

    public function findWithEagerBlog(): array
    {
        return $this->createQueryBuilder('o')
            ->getQuery()
            ->setFetchMode(BlogPost::class, "blog", ClassMetadata::FETCH_EAGER)
            ->getResult();
    }

    public function findWithEagerAuthor(): array
    {
        return $this->createQueryBuilder('o')
            ->getQuery()
            ->setFetchMode(BlogPost::class, "author", ClassMetadata::FETCH_EAGER)
            ->getResult();
    }

    public function findWithSelectedComments(): array
    {
        return $this->createQueryBuilder('o')
            ->addSelect('comments')
            ->join('o.comments', 'comments')
            ->getQuery()
            ->getResult();
    }

    public function findWithSelectedTags(): array
    {
        return $this->createQueryBuilder('o')
            ->addSelect('tags')
            ->join('o.tags', 'tags')
            ->getQuery()
            ->getResult();
    }
}
