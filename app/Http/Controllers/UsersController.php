<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UsersService;

class UsersController extends Controller
{
    private $usersService;
    public function __construct(UsersService $service)
    {
        $this->usersService = $service;
    }

    public function changeUserName(Request $request)
    {

        $user = Auth::user();
        $name = $request->name;
        $this->usersService->handleChangeUserName($name, $user);
    }
}
