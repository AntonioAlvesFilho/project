<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
					'id' => (integer)$this->id,
					'name' => (string)$this->name,
					'data_nascimento' => (string)$this->data_nascimento,
					'genero' => (string)$this->genero,
					'email' => (string)$this->email,
					'created_at' => (string)$this->created_at,
				];
    }
}
	