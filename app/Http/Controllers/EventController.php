<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::orderBy('date','desc')->get();
        $eventCategoriesArr = EventCategory::all();
        $eventCategories = [];
        foreach ($eventCategoriesArr as $eventCategory){
            $eventCategories[$eventCategory->id] = $eventCategory->name;
        }
        return view('admin.event.index', compact('events','eventCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $eventCategories = EventCategory::all();
        return view('admin.event.create' , compact('eventCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if( $request->hasFile('image')){
            $imagePath = Storage::put('/public/event', $request->image);
        }

        Event::create([
            'title' => $request->title,
            'date' => $request->date,
            'content' => $request->content,
            'image' => $imagePath,
            'event_category_id' => $request->event_category_id
        ]);

        return redirect()->route('events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        $eventCategories = EventCategory::all();
        
        return view('admin.event.edit', compact('event', 'eventCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $event = Event::find($id);

        if($request->hasFile('image')){
            $imagePath = Storage::put('public/event', $request->image);
        }else{
            $imagePath = $event->image;
        }

        $event->update([
            'title' => $request->title,
            'event_category_id' => $request->event_category_id,
            'date' => $request->date,
            'image' => $imagePath,
            'content' => $request->content
        ]);

        return redirect()->route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        Storage::delete($event->image);
        $event->delete();
        return redirect()->route('events.index');
    }
}
