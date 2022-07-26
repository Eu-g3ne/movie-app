<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
  use HasFactory;

  protected $fillable = [
    'poster',
    'background'
  ];

  public $timestamps = false;

  public function movie()
  {
    return $this->belongsTo(Movie::class);
  }
}
