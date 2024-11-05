<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    public function getImageUrlAttribute()
    {
        return $this->image ? asset("product_picutres/{$this->image}") : null;
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function translations()
    {
        return $this->hasMany(ProductTranslation::class, 'article_number', 'article_number');
    }
    public function categoryTranslations()
    {
        return $this->hasMany(CategoryTranslation::class, 'article_number', 'article_number');
    }
    public function updateDate()
    {
        return $this->hasOne(UpdateDate::class, 'article_number', 'article_number');
    }
    public function seo_field()
    {
        return $this->hasOne(SeoField::class, 'article_number', 'article_number');
    }
}
