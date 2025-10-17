<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
  /** @use HasFactory<\Database\Factories\ResponseFactory> */
  use HasFactory;

  protected $fillable = [
    "user_id",
    "aspiration_id",
    "message",
  ];

  public function aspiration()
  {
    return $this->belongsTo(Aspiration::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
