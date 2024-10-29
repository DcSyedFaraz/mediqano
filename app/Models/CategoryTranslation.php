<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    protected $guarded = [];
    public function product()
    {
        return $this->belongsTo(Product::class, 'article_number', 'article_number');
    }
}
