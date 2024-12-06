<?php


namespace App\Repository\Category;

use App\Model\CategoryModel;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class CategoryRepositoryInterface
 * @package App\Repository\Category
 */
interface CategoryRepositoryInterface
{
    public function create(string $name, int $userId): CategoryModel;
    public function getByName(string $name, int $userId): ?CategoryModel;
    public function allByUserId(int $userId): Collection;
}
