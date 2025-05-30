<?php

namespace App\Models;;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
  protected $fillable = [
    'image',
    'title',
    'link',
    'date',
    'content',
    'status',
    'writer_id',
    'editor_id',
    'company_id'
  ];

  public function writer()
  {
    return $this->belongsTo(User::class, 'writer_id');
  }

  public function editor()
  {
    return $this->belongsTo(User::class, 'editor_id');
  }

  public function company()
  {
    return $this->belongsTo(Company::class);
  }
}
