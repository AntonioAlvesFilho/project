<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Services\AuthService;
use App\Http\Requests\AuthLoginRequest; 
use App\Http\Requests\AuthRegisterRequest; 
use App\Http\Requests\AuthVerifyRequest; 
use App\Http\Resources\UserResource; 

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(AuthService $authService)
    {
      $this->authService = $authService;
		}

    /**
     * Get a JWT via given credentials.	
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(AuthLoginRequest $request)
    {
			$input = $request->validated();
			$token = $this->authService->login($input['email'], $input['password']);
			return (new UserResource(auth()->user()))->additional($token);
		}


		public function register(AuthRegisterRequest $request) {
			
			$input = $request->validated();
			$user = $this->authService->register($input['name'], $input['email'],$input['data_nascimento'], $input['genero'], $input['password'], 'confirmation_token');
			return new UserResource($user);
		}

		public function VerifyEmail(AuthVerifyRequest $request) {

			$input = $request->validated();
			$user = $this->authService->VerifyEmail($input['token']);

			new UserResource($user);
			
			return redirect('/').with('message', 'Email verificado com sucesso');

		}




















    /**
     * Get the actual authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}