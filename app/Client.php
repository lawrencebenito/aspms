<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'client';
    protected $primaryKey = 'id';
    public $timestamps = false;
    // protected $appends = ['full_name'];

    // /**
    //  * Get the user's full name.
    //  *
    //  * @return string
    //  */
    // public function getFullNameAttribute()
    // {
    //     return "{$this->first_name} {$this->last_name}";
    // }
}
