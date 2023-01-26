<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait QueryOrder
{
    public function scopeOrder(Builder $builder, Request $request)
    {
        if($request->filled('order')) {
            $order = $request->query('order');

            foreach($order as $item) {
                $column = explode(',', $item)[0];
                $direction = explode(',', $item)[1];
                if (in_array($column, $this->order)) {
                    return $builder->orderBy(Str::snake($column), $direction);
                }
            }
        }
        return $builder;
    }
}