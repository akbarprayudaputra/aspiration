<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspiration extends Model
{
  /** @use HasFactory<\Database\Factories\AspirationFactory> */
  use HasFactory;

  protected $fillable = [
    'title',
    'content',
    'is_anonymous',
    'category_id',
    'user_id',
    'status',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  public function responses()
  {
    return $this->hasMany(Response::class);
  }
}
