<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    protected $guarded = [];



    public function publicationCategory(){
        return $this->belongsTo(PublicationCategory::class, 'publication_category_id', 'id');
    }

    public function publicationSubCategory(){
        return $this->belongsTo(PublicationSubCategory::class, 'publication_sub_category_id', 'id');
    }

    public function author(){
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }

    public function publisher(){
        return $this->belongsTo(Publisher::class, 'publisher_id', 'id');
    }

    public function publicationType(){
        return $this->belongsTo(PublicationType::class, 'publication_type_id', 'id');
    }

    public function language(){
        return $this->belongsTo(Language::class, 'language_id', 'id');
    }

    public function location(){
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }

    public function images(){
        return $this->hasMany(PublicationImage::class, 'publication_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'create_by_user_id', 'id');
    }
}
