<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=['title','category_id'];

    protected $appends=['category_name','images_path'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function getCategoryNameAttribute()
    {
        return $this->category->title;
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function getImagesPathAttribute()
    {
        return $this->images()->pluck('image')->toArray();
    }
}
