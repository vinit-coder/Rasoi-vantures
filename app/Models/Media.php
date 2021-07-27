<?php 
namespace App\Models;

use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;
use App\Models\User;

/**
 * 
 */
class Media extends BaseMedia
{
	 /**
     * Boot events
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($media) {
            if ($user = auth()->getUser()) {
                $media->user_id = $user->id;
            }
        });
    }

    /**
     * User relationship (one-to-one)
     * @return App\User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
	 
}

 ?>