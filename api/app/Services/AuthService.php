<?php

namespace App\Services;

use App\Events\UserRegistered;
use App\Models\User;
use Illuminate\Support\Str;
use App\Exceptions\LoginInvalidException;
use App\Exceptions\EmailAlreadyInUseException;
use App\Exceptions\VerifyEmailTokenInvalidException;

class AuthService
{
	public function login(string $email, string $password) {

		$login = [
			'email' => $email,
			'password' => $password
		];

		if (!$token = auth()->attempt($login)) {
			throw new LoginInvalidException();
		}
		
		return [
			'access_token' => $token,
			'token_type' => 'Bearer',
		];
	}

	public function register(string $name, string $email, string $data_nascimento, string $genero, string $password) {
		

		$user = User::where('email', $email)->exists();
		if (!empty($user)) {
			throw new EmailAlreadyInUseException();
		}
		
		$userPassword = bcrypt($password ?? Str::random(10));

	
		$user = User::Create([
			'name' => $name,
			'email' => $email,
			'data_nascimento' => $data_nascimento,
			'genero' => $genero,
			'password' => $userPassword,
			'confirmation_token' => Str::random(30)
		]);

		event(new UserRegistered($user));

		return $user;
	}

	public function VerifyEmail(String $token) {
		$user = User::where('confirmation_token', $token)->first();
		if (empty($user)) {
			throw new VerifyEmailTokenInvalidException();
		}
		
		$user->confirmation_token = 'already_verified';
		$user->email_verified_at = now();
		$user->save();

		return $user;


	}


}