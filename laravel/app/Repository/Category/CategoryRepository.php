<?php

namespace App\Repository\Category;

use App\Model\CategoryModel;
use App\Repository\Repository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class CategoryRepository
 * @package App\Repository\Category
 */
class CategoryRepository extends Repository implements CategoryRepositoryInterface
{
    /**
     * @var CategoryModel
     */
    protected $model;

    /**
     * ImageRepository constructor.
     * @param CategoryModel $model
     */
    public function __construct(CategoryModel $model)
    {
        parent::__construct($model);
    }

    /**
     * Create method
     * @param string $name
     * @param int $userId
     * @return CategoryModel
     */
    public function create(string $name, int $userId): CategoryModel
    {
        return $this->model::create([
            'name'      => $name,
            'user_id'   => $userId
        ]);
    }

    /**
     * Get by name method
     * @param string $name
     * @param int $userId
     * @return CategoryModel|null
     */
    public function getByName(string $name, int $userId): ?CategoryModel
    {
        return $this->model::where('name', $name)
            ->where('user_id', $userId)
            ->first();
    }

    /**
     * All by user id method
     * @param int $userId
     * @return Collection
     */
    public function allByUserId(int $userId): Collection
    {
        return $this->model::where('user_id', $userId)
            ->get();
    }
}
