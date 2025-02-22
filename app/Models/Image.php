<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function author(){
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }

    public function imageCategory(){
        return $this->belongsTo(ImageCategory::class, 'image_category_id', 'id');
    }

    public function imageSubCategory(){
        return $this->belongsTo(ImageSubCategory::class, 'image_sub_category_id', 'id');
    }

    public function publisher(){
        return $this->belongsTo(Publisher::class, 'publisher_id', 'id');
    }

    public function imageType(){
        return $this->belongsTo(ImageType::class, 'image_type_id', 'id');
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
