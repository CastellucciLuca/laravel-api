<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['author', 'slug', 'title', 'post_date', 'content', 'image','type_id'];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function isImageAUrl(){
    return filter_var($this->image, FILTER_VALIDATE_URL);
}
    public function Technologies(){
    return $this->belongsToMany(Technology::class);
}
}
