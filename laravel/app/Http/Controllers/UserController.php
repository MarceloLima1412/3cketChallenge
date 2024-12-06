<?php


namespace App\Http\Controllers;

use App\Services\User\UserServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * UserController constructor.
     * @param UserServiceInterface $userService
     */
    public function __construct(
        UserServiceInterface $userService
    )
    {
        $this->userService =  $userService;
    }

    /**
     * Register view
     * @return Application|Factory|View
     */
    public function registerUser()
    {
        return view('create-user');
    }

    /**
     * Store action
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $name = $request->name ?? '';
        $email = $request->email ?? '';
        $password = $request->password ?? '';

        $this->userService->create(
            $name,
            $email,
            $password
        );

        return redirect('/')->with('success', 'User created with success!');
    }

}
