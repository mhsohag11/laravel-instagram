<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * Normally in user model all database field are fillable for checking field value when submitting on add
     * but here jused used an array instead of fillable functionality.
     * @var array
     */
    protected $guarded = [];

    /**
     * Checking profile image had or not . If not a default image will show on profile page
     * @return string
     */
    public function profileImage()
    {
        $imagePath = ($this->image)? '/storage/'.$this->image  : '/images/user-profile-image.jpg';
        return $imagePath;
    }

    /**
     * This column belongs to with an user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * This column store all followers information who one followed
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followers()
    {
        return $this->belongsToMany(User::class);
    }
}
