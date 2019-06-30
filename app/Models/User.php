<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','api_token','open_id','mobile'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function vip()
    {
        return $this->hasOne(VipMember::class, 'user_id')->where('expired', 0);
    }

    public function comments()
    {
        return $this->hasMany(PostComment::class, 'user_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'user_id');
    }

    public function likedPost()
    {
        return $this->hasMany(Like::class, 'user_id')->where('likeable_type', 'App\Models\Post');
        //return $this->hasMany(Like::class, 'user_id')->whereLikeableType(Post::class);
    }

    public function collections()
    {
        return $this->hasMany(Collection::class, 'user_id');
    }

    

    public function updateVip($months)
    {
        if($this->vip()->doesntExist())
        {
            $end = now()->addMonths($months);
            return $this->vip()->create(['end_at' => $end]);
        }
        $end = $this->vip->end_at;
        return $this->vip->update(['end_at' => $end->addMonths($months)]);
    }

    public function saveUser($openid)
    {
        $token = Str::random(60);
        static::updateOrCreate(['open_id' => $openid], ['api_token' => $token]);
        return ['token' => $token];
    }

    public function is_vip()
    {
        return $this->vip()->exists();
    }

    public function collect($post_id)
    {
        if($collect = $this->collections()->where('post_id', $post_id)->first())
        {
            $collect->delete();
            return -1;
        }
        $this->collections()->create(['post_id' => $post_id]);
        return 1;
    }


    public function getLikes()
    {
        return $this->likedPost()->whereHas('post', function($query){
            $query->vip($this->vip()->exists());
        })->with('likeable.cover')->paginate(10);
    }

    public function getCollections()
    {
        return $this->collections()->whereHas('post', function($query){
            $query->vip($this->vip()->exists());
        })->with('post.cover')->paginate(10);
    }

    public function getCommented()
    {
        $posts = $this->comments()->whereHas('post', function($query){
            $query->vip($this->vip()->exists());
        })->select('post_id')->groupBy('post_id')->paginate(10);
        $ids = $posts->pluck('post_id')->toArray();
        return Post::whereIn('id', $ids)->with('cover')->get();
    }

    // public function scopeLikedPost($query)
    // {
    //     return $this->likes()->where('likeable_type', 'App\Models\Post');
    // }

    // public function like($post_id)
    // {
        
    // }
}
