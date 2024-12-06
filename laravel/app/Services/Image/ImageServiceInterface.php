<?php


namespace App\Services\Image;


use Illuminate\Support\Collection;

interface ImageServiceInterface
{
    public function create($image, string $category, int $userId);
    public function getAllImages(int $userId): Collection;
}
