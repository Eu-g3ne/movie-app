<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class MovieResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
   */
  public static $wrap = '';
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'slug' => $this->slug,
      'title' => $this->title,
      'description' => $this->description,
      'episode' => (int)$this->episode,
      'total_episodes' => (int)$this->total_episodes,
      'status' => $this->status,
      'type' => $this->type,
      'rating' => (int)$this->rating,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
      'is_favorite' => (bool)$this->is_favorite,
      'image' => [
        // 'poster' => $this->image->poster ?: null,
        // 'background' => $this->image->background ?: null,
        'poster' => getenv('FILESYSTEM_DISK') === 'local' ? $this->image->poster : Storage::temporaryUrl($this->image->poster, now()->addMinutes(10)),
        'background' => getenv('FILESYSTEM_DISK') === 'local' ? $this->image->background : Storage::temporaryUrl($this->image->background, now()->addMinutes(10)),
      ],
      'categories' => $this->categories->pluck('name'),
    ];
  }
}
