<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Services\UserService;

class MeController extends Controller
{

	public function __construct(UserService $userService) {
		$this->userService = $userService;

		$this->middleware('auth:api');

	}
	public function idx()
	{
		return new UserResource(auth()->user());
	}

	public function update()
	{
		
	return $this->userService->update();
	}
} 
