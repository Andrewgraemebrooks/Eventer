<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $data = $this->validateRequest($request);

        $event = new Event();
        $event->fill($data);
        $event->user_id = Auth::id();
        $event->save();

        return redirect('/event/' . $event->id);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Event $event
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Event $event)
    {
        $data = $this->validateRequest($request);

        $event->update($data);

        return redirect('/event/' . $event->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }

    /**
     * Validates the event form fields from the request.
     * @param Request $request
     * @return array
     * @author Andrew Brooks
     */
    protected function validateRequest(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'min:3', 'max:60'],
            'description' => ['required', 'max:60'],
            'date' => ['required', 'date'],
            'time' => ['required', 'date_format:H:i:s'],
            'duration' => ['required', 'integer', 'between:1,1440'],
            'venue' => ['required', 'max:60'],
        ]);
    }
}
