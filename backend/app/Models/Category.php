<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
  ];

  public $timestamps = false;

  public function movies()
  {
    return $this->belongsToMany(Movie::class);
  }

  public function getRouteKeyName()
  {
    return 'name';
  }
}
