<?php

declare(strict_types=1);

namespace App\Entity;

class Product
{
    public int $id;

    public string $name;

    public int $quantity = 0;

    public bool $enabled = false;
}