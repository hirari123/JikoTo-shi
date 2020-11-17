<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

// タグモデル
class Tag extends Model
{
  protected $fillable = [
    'name',
];

  public function getHashtagAttribute(): string
      {
          return '#' . $this->name;
      }

  // タグモデルに記事モデルへのリレーションを追加する
  public function articles(): BelongsToMany
      {
          return $this->belongsToMany('App\Article')->withTimestamps();
      }
  
}
