<?php

namespace App\Services\Category;


use App\Repository\Category\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class CategoryService
 * @package App\Services\Category
 */
class CategoryService implements CategoryServiceInterface
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;

    /**
     * CategoryService constructor
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Create or get category id handler
     * @param string $categoryName
     * @param int $userId
     * @return int
     */
    public function createOrGetCategoryId(string $categoryName, int $userId): int
    {
        $category = $this->categoryRepository->getByName(
            $categoryName,
            $userId
        );

        if (!$category) {
            $category = $this->categoryRepository->create(
                $categoryName,
                $userId
            );
        }

        return $category->id ?? 0;
    }

    /**
     * Get all category names handler
     * @param int $userId
     * @return array
     */
    public function getAllCategoryNames(int $userId): array
    {
        $categories = $this->categoryRepository->allByUserId(
            $userId
        );

        return $categories->pluck('name')->toArray();
    }

    /**
     * Get all categories handler
     * @param int $userId
     * @return Collection
     */
    public function getAllCategory(int $userId): Collection
    {
        return $this->categoryRepository->allByUserId(
            $userId
        );
    }
}
