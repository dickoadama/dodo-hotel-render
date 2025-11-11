<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Hotel;
use App\Models\RoomType;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::with(['hotel', 'roomType'])->get();
        return view('room.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hotels = Hotel::all();
        $roomTypes = RoomType::all();
        return view('room.create', compact('hotels', 'roomTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_number' => 'required|string|max:10',
            'hotel_id' => 'required|exists:hotels,id',
            'room_type_id' => 'required|exists:room_types,id',
            'floor' => 'nullable|string|max:10',
            'description' => 'nullable|string',
            'is_available' => 'required|boolean',
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->except('image');
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('rooms', 'public');
            $data['image_path'] = $imagePath;
        }

        Room::create($data);

        return redirect()->route('rooms.index')
            ->with('success', 'Chambre créée avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        $room->load(['hotel', 'roomType']);
        return view('room.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        $hotels = Hotel::all();
        $roomTypes = RoomType::all();
        return view('room.edit', compact('room', 'hotels', 'roomTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'room_number' => 'required|string|max:10',
            'hotel_id' => 'required|exists:hotels,id',
            'room_type_id' => 'required|exists:room_types,id',
            'floor' => 'nullable|string|max:10',
            'description' => 'nullable|string',
            'is_available' => 'required|boolean',
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->except('image');
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($room->image_path) {
                Storage::disk('public')->delete($room->image_path);
            }
            
            $imagePath = $request->file('image')->store('rooms', 'public');
            $data['image_path'] = $imagePath;
        }

        $room->update($data);

        return redirect()->route('rooms.index')
            ->with('success', 'Chambre mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        // Delete image if exists
        if ($room->image_path) {
            Storage::disk('public')->delete($room->image_path);
        }
        
        $room->delete();

        return redirect()->route('rooms.index')
            ->with('success', 'Chambre supprimée avec succès.');
    }
}