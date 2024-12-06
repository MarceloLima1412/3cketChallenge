<?php

namespace App\Services\Image;

use App\Exceptions\ImageProcessingException;
use App\Repository\Image\ImageRepositoryInterface;
use App\Services\Category\CategoryServiceInterface;
use Exception;
use Illuminate\Support\Collection;

class ImageService implements ImageServiceInterface
{
    /**
     * @var CategoryServiceInterface
     */
    private $categoryService;

    /**
     * @var ImageRepositoryInterface
     */
    private $imageRepository;

    /**
     * ImageService constructor
     * @param CategoryServiceInterface $categoryService
     * @param ImageRepositoryInterface $imageRepository
     */
    public function __construct(
        CategoryServiceInterface $categoryService,
        ImageRepositoryInterface $imageRepository
    )
    {
        $this->categoryService = $categoryService;
        $this->imageRepository = $imageRepository;
    }

    /**
     * Create handler
     * @param $image
     * @param string $category
     * @param int $userId
     * @return void
     * @throws Exception
     */
    public function create($image, string $category, int $userId)
    {
        $path = $this->processImage(
            $image
        );

        $categoryId = $this->categoryService->createOrGetCategoryId(
            $category,
            $userId
        );

        $this->imageRepository->create(
            $path,
            $categoryId,
            $userId
        );
    }

    /**
     * Get all images
     * @param int $userId
     * @return Collection
     */
    public function getAllImages(int $userId): Collection
    {
        return $this->imageRepository->allByUserId(
            $userId
        );
    }

    /**
     * Process image handler
     * @param $imageFile
     * @return string
     * @throws ImageProcessingException
     * @throws Exception
     */
    private function processImage($imageFile): string
    {
        $maxSize        = 200 * 1024;
        $quality        = 90;

        $path       = uniqid() . '.' . $imageFile->getClientOriginalExtension();
        $directory  = public_path('storage/images');

        if (!file_exists($directory)) {
            mkdir($directory, 0775, true);
        }

        $imageInfo = getimagesize($imageFile);
        if ($imageInfo[2] === IMAGETYPE_PNG) {
            $extension = 'png';
            $image = imagecreatefrompng($imageFile);
        } elseif ($imageInfo[2] === IMAGETYPE_JPEG) {
            $extension = 'jpg';
            $image = imagecreatefromjpeg($imageFile);
        } else {
            throw new Exception("The image format is not supported. Only PNG and JPEG are accepted.");
        }

        do {
            ob_start();

            if ($extension == 'png') {
                $pngQuality = max(0, min(9, $quality / 10));
                imagepng($image, null, $pngQuality);
            } else {
                $jpegQuality = max(0, min(100, $quality));
                imagejpeg($image, null, $jpegQuality);
            }

            $compressedImage = ob_get_clean();

            $fileSize = strlen($compressedImage);

            $quality -= 5;
        } while ($fileSize > $maxSize && $quality > 0);

        if ($fileSize > $maxSize) {
            throw new ImageProcessingException();
        }

        file_put_contents(public_path('storage/images/' . $path), $compressedImage);

        imagedestroy($image);
        return $path;
    }
}
