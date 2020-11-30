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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @author Andrew Brooks
     */
    public function speakers()
    {
        return $this->belongsToMany('App\Models\Speaker');
    }

    /**
     * Add a speaker to the event
     */
    public function addSpeaker(Speaker $speaker)
    {
        $this->speakers()->save($speaker);
    }

    /**
     * Delete a speaker from the event
     */
    public function deleteSpeaker(Speaker $speaker)
    {
        $this->speakers()->detach($speaker);
    }
}
