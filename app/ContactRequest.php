<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    protected $table = 'requests';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'requester_id', 'state', 'request_text'];

    public function user()
    {
        return $this->belongsTo('User');
    }
}
