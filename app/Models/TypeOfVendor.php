<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeOfVendor extends Model{
    use SoftDeletes;
    protected $table = 'type_of_vendors';
    protected $casts = ['created_at' => 'datetime:Y-m-d H:i:s a'];
}
