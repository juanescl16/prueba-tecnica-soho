<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'question_id',
        'quantity',
    ];

/**
   * Get the site for the question.
   */
  public function question()
  {
    return $this->BelongsTo('App\Models\Question');
  }


}
