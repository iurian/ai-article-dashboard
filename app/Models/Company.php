<?php

namespace App\Models;;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
  protected $fillable = ['logo', 'name', 'status'];

  // A company can have many articles
  public function articles()
  {
    return $this->hasMany(Article::class);
  }
}
