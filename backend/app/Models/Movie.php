<?php

namespace App\Models;

use App\Enums\MovieStatusEnum;
use App\Enums\MovieTypeEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Movie extends Model
{
  use HasFactory;

  protected $fillable = [
    'title',
    'description',
    'episode',
    'total_episodes',
    'status',
    'type',
    'rating',
    'is_favorite',
  ];

  protected $casts = [
    'status' => MovieStatusEnum::class,
    'type' => MovieTypeEnum::class
  ];

  public function getRouteKeyName()
  {
    return 'slug';
  }

  public function categories()
  {
    return $this->belongsToMany(Category::class);
  }

  public function image()
  {
    return $this->hasOne(Image::class);
  }

  public function title(): Attribute
  {
    return new Attribute(
      set: fn ($value) => [
        'title' => $value,
        'slug' => Str::slug($value),
      ],
    );
  }
}
