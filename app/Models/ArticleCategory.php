<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function subCategories()
    {
        return $this->hasMany(ArticleSubCategory::class, 'article_category_id', 'id');
    }
}
