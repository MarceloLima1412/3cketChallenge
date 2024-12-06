<?php

namespace App\Http\Controllers;

use App\Services\Category\CategoryServiceInterface;
use App\Services\Image\ImageServiceInterface;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

/**
 * Class ImageController
 * @package App\Http\Controllers
 */
class ImageController extends Controller
{
    /**
     * @var ImageServiceInterface
     */
    private $imageService;

    /**
     * @var CategoryServiceInterface
     */
    private $categoryService;

    /**
     * ImageController constructor.
     * @param CategoryServiceInterface $categoryService
     * @param ImageServiceInterface $imageService
     */
    public function __construct(
        CategoryServiceInterface $categoryService,
        ImageServiceInterface $imageService
    )
    {
        $this->categoryService  = $categoryService;
        $this->imageService     = $imageService;
    }

    /**
     * Images gallery view
     * @param Request $request
     * @return Application|Factory|View
     */
    public function showImages(Request $request)
    {
        $userId = Auth::id() ?? 0;

        $categories = $this->categoryService->getAllCategory($userId);
        $images = $this->imageService->getAllImages($userId);

        $selectedCategory = null;

        if ($request->has('category_id') && $request->category_id != null) {
            $images = $images->where('category_id', $request->category_id);
            $selectedCategory = $categories->find($request->category_id);
        }

        return view('welcome', compact('categories', 'images', 'selectedCategory'));
    }

    /**
     * Store image view
     * @return Application|Factory|View
     */
    public function showStoreImage()
    {
        $userId = Auth::id() ?? 0;

        $categories = $this->categoryService->getAllCategoryNames($userId);

        return view('store-image', compact('categories'));
    }

    /**
     * Store action
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'image'     => 'required|file|mimes:jpg,png|max:2048',
            'category'  => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $image      = $request->file('image');
        $category   = strtolower($request->category ?? '');
        $userId     = Auth::id() ?? 0;

        try {
            $this->imageService->create(
                $image,
                $category,
                $userId
            );

            return redirect('/')->with('success', 'Image created with success!');
        } catch (Exception $message) {
            return redirect()->back()->withErrors(['error' => $message->getMessage()]);
        }
    }
}
