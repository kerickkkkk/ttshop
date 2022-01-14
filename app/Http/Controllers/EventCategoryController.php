<?php

namespace App\Http\Controllers;

use App\Models\EventCategory;
use Illuminate\Http\Request;

class EventCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventCategories = EventCategory::all();
        return view('admin.event-category.index', compact('eventCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.event-category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        EventCategory::create([
            'name'=> $request->name
        ]);
        return redirect()->route('event-categories.index');
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
        $eventCategory = EventCategory::find($id);
        return view('admin.event-category.edit', compact('eventCategory'));
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
        EventCategory::find($id)->update([
            'name' => $request->name
        ]);

        return redirect()->route('event-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eventCategory = EventCategory::with('events')->find($id);

        $eventCategoryEventLength = count($eventCategory->events);

        if( $eventCategoryEventLength > 0){
            return response()->json([
                'success' => false,
                'status' => 'error',
                'message' => "分類: {$eventCategory->name} 刪除失敗，尚有 {$eventCategoryEventLength} 個最新消息與此分類關聯"
            ]);
        }
        
        $eventCategory->delete();
        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => "分類: {$eventCategory->name} 刪除成功"
        ]);
    }
}
