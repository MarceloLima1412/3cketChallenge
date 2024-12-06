<?php

namespace App\Repository\Image;

use Illuminate\Support\Collection;

/**
 * Class ImageRepositoryInterface
 * @package App\Repository\Image
 */
interface ImageRepositoryInterface
{
    public function create(string $path, int $categoryId, int $userId): void;
    public function allByUserId(int $userId): Collection;
}
