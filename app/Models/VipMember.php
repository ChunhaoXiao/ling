<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VipMember extends Model
{
    protected $fillable = [
    	'user_id',
    	'start_at',
    	'end_at',
    	'expired',
    ];

    protected $dates = [
    	'start_at',
    	'end_at',
    ];

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    protected static function boot(){
    	parent::boot();
    	static::creating(function($model){
    		$model->start_at = now();
    	});
    }

    public function scopeExpire($query)
    {
        return $query->whereDate('end_at', '<', now())->where('expired', 0);
    }
}
