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
      'movie.title' => 'required|string|max:255|',
      'movie.episode' => 'sometimes|integer|lte:movie.total_episodes',
      'movie.total_episodes' => 'sometimes|integer|gte:movie.episode',
      'movie.status' => [new Enum(MovieStatusEnum::class), 'required'],
      'movie.type' => [new Enum(MovieTypeEnum::class), 'required'],
      'movie.rating' => 'sometimes|integer|between:0,10',
      'movie.is_favorite' => 'sometimes|boolean',
      'movie.image.url' => 'required|url',
      'movie.categories' => 'sometimes|array',
      'movie.categoires.*' => 'sometimes|string|max:255',
    ];
  }
}
