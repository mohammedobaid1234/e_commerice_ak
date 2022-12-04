<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Translatable;

class Category extends Model{
    use SoftDeletes;
    protected $table = 'categories';
    protected $casts = ['created_at' => 'datetime:Y-m-d H:i:s a'];
    protected $hidden = ['translations', 'image'];
    public $appends = ['image_url'];

    public function getImageUrlAttribute($value){
        if (!$this->image) {
            return asset('assets/images/avatars/avatar6.png');
        }
        if (stripos($this->image, 'http') ===  0) {
            return $this->image;
        }
        return asset('storage/' . $this->image);
    }
    public function type_of_vendor(){
        return $this->belongsTo(TypeOfVendor::class, 'vendor_type');
    }
}
