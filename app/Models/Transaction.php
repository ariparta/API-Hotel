<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use \App\Http\Traits\UsesUuid;
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded = ['created_at', 'updated_at'];

    public function category_payment(){
        return $this->belongsTo('App\Models\CategoryPayment');
    }

    public function room(){
        return $this->belongsTo('App\Models\Room');
    }

    public function customer(){
        return $this->belongsTo('App\Models\Customer');
    }

    public function admin(){
        return $this->belongsTo('App\Models\Admin');
    }
}
