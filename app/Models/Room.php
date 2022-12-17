<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use \App\Http\Traits\UsesUuid;
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded = ['created_at', 'updated_at'];

    public function category_room(){
        return $this->belongsTo('App\Models\CategoryRoom');
    }
    
    public function room_rating(){
        return $this->hasMany('App\Models\RoomRating');
    }
}
