<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

// 記事モデル
class Article extends Model
{

    protected $fillable = [
        'title',
        'content',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }

    // 記事モデルからユーザーモデルにアクセス可能にする
    public function likes(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'likes')->withTimestamps();
    }

    public function isLikedBy(?User $user):bool
    {
        return $user
            ?(bool)$this->likes->where('id', $user->id)->count()
            :false;
    }

    public function getCountLikesAttribute(): int
    {
        return $this->likes->count();
    }

    // 記事モデルからタグモデルへのリレーションの作成
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

}
