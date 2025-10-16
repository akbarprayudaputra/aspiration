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
}
