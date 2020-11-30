<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
    ];

    /**
     * Returns the path that the speaker is located at.
     * @return string
     * @author Andrew Brooks
     */
    public function path()
    {
        return '/speaker/' . $this->id;
    }

    /**
     * The events that belong to the speaker.
     */
    public function speakers()
    {
        return $this->belongsToMany('App\Models\Event');
    }
}


