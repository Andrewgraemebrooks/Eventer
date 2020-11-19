<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'date',
        'time',
        'duration',
        'venue',
    ];

    /**
     * Returns the path that the event is located at.
     * @return string
     * @author Andrew Brooks
     */
    public function path()
    {
        return '/event/' . $this->id;
    }

    /**
     * The speakers that belong to the event.
     */
    public function speakers()
    {
        return $this->belongsToMany('App\Models\Speaker');
    }
}
