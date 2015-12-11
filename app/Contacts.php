<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    use SoftDeletes;

    protected $table = 'contacts';
    protected $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'contact_id'];
    protected $dates = ['deleted_at'];
}