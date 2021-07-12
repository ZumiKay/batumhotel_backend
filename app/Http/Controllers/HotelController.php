<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Models\CreateHotel;
use App\Models\floor;
use FontLib\Table\Type\name;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class HotelController extends Controller
{
    //
    public function AddNewRoom (RoomRequest $request) {

        $images = pathinfo($request -> file('image')->getClientOriginalName() , PATHINFO_FILENAME);
        $images1 = pathinfo($request -> file('image1')->getClientOriginalName() , PATHINFO_FILENAME);
        $images2 = pathinfo($request -> file('image2')->getClientOriginalName() , PATHINFO_FILENAME);
        $images3 = pathinfo($request -> file('image3')->getClientOriginalName() , PATHINFO_FILENAME);
        $imagefile = $request -> file('image')->getClientOriginalExtension();
        $imagefile1 = $request -> file('image1')->getClientOriginalExtension();
        $imagefile2 = $request -> file('image2')->getClientOriginalExtension();
        $imagefile3 = $request -> file('image3')->getClientOriginalExtension();
        $imageStore = $images.'_'.time().'.'.$imagefile;
        $imageStore1 = $images1.'_'.time().'.'.$imagefile1;
        $imageStore2 = $images2.'_'.time().'.'.$imagefile2;
        $imageStore3 = $images3.'_'.time().'.'.$imagefile3;
        $request->file('image')->storeAs('public/images' , $imageStore);
        $request->file('image1')->storeAs('public/images' , $imageStore1);
        $request->file('image2')->storeAs('public/images' , $imageStore2);
        $request->file('image3')->storeAs('public/images' , $imageStore3);

        $Room = CreateHotel::create([
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'featured' => $request->input('featured'),
            'price' => $request->input('price'),
            'Adult' => $request->input('Adult'),
            'Child' => $request->input('Child'),
            'description' => $request->input('description'),
            'preview' => $request->input('preview'),
            'extras' => $request->input('extras'),
            'image' => $imageStore,
            'image1' => $imageStore1,
            'image2' => $imageStore2,
            'image3' => $imageStore3,



        ]);
        return response($Room , Response::HTTP_CREATED);
    }
    public function getRoomData (){
            $room = CreateHotel::get();

            return \response(['Room' => $room]);


    }
    public function getRoomDatabyID(Request $request)
    {
        $id = $request->input('id');
        $RoomDataById = CreateHotel::find($id);

        return \response($RoomDataById);
    }
    public function deleteRoom (Request $request)
    {
        $id = $request->input('id');
        $room = CreateHotel::findOrFail($id);
        $room->delete();


        return \response('Delete Successful');
    }
    public function editRoom (Request $request)
    {

        $id = $request->input('id');
        $userData = ["name" => $request->input('name'),
            "price" => $request->input('price'),
            "Adult" => $request->input('Adult'),
            "Child" => $request->input('Child'),
            "description" => $request->input('description'),
            "extras" => $request->input('extras'),
            'featured' => $request->input('featured'),
            'preview' => $request->input('preview')];

        DB::table("HotelList")
            ->where('id',$id)
            ->update($userData);

    }
    public function getroomsortbyrpice (Request $request)
    {
        $room = DB::table('HotelList')->orderBy('price',$request->input('des'))->get();
        return \response($room);

    }
    public function editamountofroom (Request $request){
        $roomname = $request->input('roomname');
        CreateHotel::where('name',$roomname)->update(array('extras' => $request->input('amounts')));
        return Response::HTTP_ACCEPTED;
    }

    public function createfloor (Request $request)
    {
        $request->validate(['floorname' => 'required']);
        floor::create([
            'floorname' => $request->input('floorname'),
            'roomtype' => $request->input('roomtype')

        ]);
        return Response::HTTP_CREATED;
    }
    public function getfloor ()
    {
        $floor = floor::get();
        return \response($floor);
    }
    public function  deletefloor (Request $request)
    {
        $id = $request->input('id');
        $floor = floor::findOrFail($id);
        $floor->delete();
        return \response('Success');
    }
    public function getpreview (Request $request)
    {
        $id = $request->input('id');
        $preview = CreateHotel::where('id' , $id)->get('preview');
        return \response($preview);
    }
}
