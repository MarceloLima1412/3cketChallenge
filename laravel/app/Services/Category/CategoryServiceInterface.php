<?php

namespace App\Services\Category;

use Illuminate\Database\Eloquent\Collection;

interface CategoryServiceInterface
{
    public function createOrGetCategoryId(string $categoryName, int $userId): int;
    public function getAllCategoryNames(int $userId): array;
    public function getAllCategory(int $userId): Collection;
}
