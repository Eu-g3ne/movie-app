<?php

namespace App\Http\Requests\Movie;

use App\Enums\MovieStatusEnum;
use App\Enums\MovieTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreRequest extends FormRequest
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
      'title' => 'required|string|max:255|',
      'description' => 'required|string',
      'episode' => 'sometimes|integer|lte:total_episodes',
      'total_episodes' => 'sometimes|integer|gte:episode',
      'status' => [new Enum(MovieStatusEnum::class), 'required'],
      'type' => [new Enum(MovieTypeEnum::class), 'required'],
      'rating' => 'sometimes|integer|between:0,10',
      'is_favorite' => 'sometimes|boolean',
      'image.poster' => 'required|file|mimes:jpg,jpeg,png',
      'image.background' => 'required|file|mimes:jpg,jpeg,png',
      'categories' => 'sometimes|array',
      'categoires.*' => 'sometimes|string|max:255',
    ];
  }
}
