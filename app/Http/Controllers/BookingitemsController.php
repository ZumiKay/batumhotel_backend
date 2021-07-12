<?php

namespace App\Http\Controllers;

use App\Models\bookingitems;
use App\Models\totalprice;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class BookingitemsController extends Controller
{
    public function create_items (Request $request) {


            $items = bookingitems::create([
                'roomname' => $request->input('roomname'),
                'price' => $request->input('price'),
                'Adult' => $request->input('Adult'),
                'Child' => $request->input('Child'),
                'amounts' => $request->input('amounts'),
                'image' => $request->input('image'),
                'user_id' => $request->input('userid'),
                'roomid' => $request->input('roomid')

            ]);
            return $items;

    }
    public function get_items ()
    {
        $items = bookingitems::all();
        return $items;
    }
    public function delete_items (Request $request)
    {
        $id = $request->input('id');
        $items = bookingitems::findOrFail($id);
        $items->delete();
    }
    public function delete_bookingitems ()
    {
       DB::table('bookingitems')->delete();
       return ("Success");

    }
    public function storePrice (Request $request)
    {
        $roomid = totalprice::where('roomid' , $request->input('roomid'))->first();
        if($roomid) {
            $roomid = $request->input('roomid');
            $userdata = ['pricerooms' => $request->input('pricerooms'),'amount' => $request->input('amount'),
                'roomid'=>$request->input('roomid')];

            DB::table('totalprice')->where('roomid',$roomid)->update($userdata);
            return \response('success');

        } else {


            $price = totalprice::Create([
                'pricerooms' => $request->input('pricerooms'),
                'amount' => $request->input('amount'),
                'roomid' => $request->input('roomid')
            ]);
            return \response($price, Response::HTTP_CREATED);
        }

    }
    public function getprices ()
    {
        $price = DB::select('select pricerooms from totalprice');
        return \response($price);
    }
    public function getamountsroom (Request $request){
        $amount = DB::select('select amount from totalprice where roomid=?' , $request->input('roomid'));
        return \response($amount);
    }
    public function getamounts ()
    {
        $amount = DB::select('select amount from totalprice');
        return \response($amount);
    }
    public function deletetotalprices () {
        DB::table('totalprice')->delete();
        return ('Delete Successful');

    }


}
