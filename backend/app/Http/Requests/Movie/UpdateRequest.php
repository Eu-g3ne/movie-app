<?php

namespace App\Http\Requests\Movie;

use App\Enums\MovieStatusEnum;
use App\Enums\MovieTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'title' => 'sometimes|string|max:255|',
      'description' => 'sometimes|string',
      'episode' => 'sometimes|integer',
      'total_episodes' => 'sometimes|integer',
      'status' => ['sometimes', new Enum(MovieStatusEnum::class)],
      'type' => ['sometimes', new Enum(MovieTypeEnum::class)],
      'rating' => 'sometimes|integer|between:0,10',
      'is_favorite' => 'sometimes|boolean',
      'image.poster' => 'sometimes|file|mimes:jpg,jpeg,png',
      'image.background' => 'sometimes|file|mimes:jpg,jpeg,png',
      'categories' => 'sometimes|array',
      'categoires.*' => 'sometimes|string|max:14',
    ];
  }
}
