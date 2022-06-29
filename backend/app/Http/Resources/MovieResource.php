<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
      'episode' => $this->episode,
      'total_episodes' => $this->total_episodes,
      'status' => $this->status,
      'type' => $this->type,
      'rating' => $this->rating,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
      'is_favorite' => (bool)$this->is_favorite,
      // 'image' => $this->image->url ? asset($this->image->url) : null,
      'image' => $this->image->url ?: null,
      'categories' => $this->categories->pluck('name'),
    ];
  }
}
