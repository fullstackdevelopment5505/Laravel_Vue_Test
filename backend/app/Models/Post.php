<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PostResponse;
use App\Models\User;
use App\Traits\QueryOrder;

class Post extends Model
{
    use HasFactory, QueryOrder;
    protected $guarded = [];

    protected $order = [
        'title',
    ];

    public function postResponses() {
        return $this->hasMany(PostResponse::class, 'post_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopeSearchFilter($filter, $request) {
        if ($request->filled('search')) {
          $search = $request->search;
          $filter = $filter->where('title', 'like', '%'.$search.'%')
            ->orWhere('description', 'like', '%'.$search.'%');
        }
        return $filter;
    }
}
