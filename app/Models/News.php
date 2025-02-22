<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function author(){
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }

    public function newsCategory(){
        return $this->belongsTo(NewsCategory::class, 'news_category_id', 'id');
    }

    public function newsSubCategory(){
        return $this->belongsTo(NewsSubCategory::class, 'news_sub_category_id', 'id');
    }

    public function publisher(){
        return $this->belongsTo(Publisher::class, 'publisher_id', 'id');
    }

    public function newsType(){
        return $this->belongsTo(NewsType::class, 'news_type_id', 'id');
    }

    public function language(){
        return $this->belongsTo(Language::class, 'language_id', 'id');
    }
    public function location(){
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'create_by_user_id', 'id');
    }
}
