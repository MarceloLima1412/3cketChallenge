<?php

namespace App\Repository\Image;

use App\Model\ImageModel;
use App\Repository\Repository;
use Illuminate\Support\Collection;

/**
 * Class ImageRepository
 * @package App\Repository\Image
 */
class ImageRepository extends Repository implements ImageRepositoryInterface
{
    /**
     * @var ImageModel
     */
    protected $model;

    /**
     * ImageRepository constructor.
     * @param ImageModel $model
     */
    public function __construct(ImageModel $model)
    {
        parent::__construct($model);
    }

    /**
     * Create method
     * @param string $path
     * @param int $categoryId
     * @param int $userId
     * @return void
     */
    public function create(string $path, int $categoryId, int $userId): void
    {
        $this->model::create([
            'path'          => $path,
            'category_id'   => $categoryId,
            'user_id'       => $userId
        ]);
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
