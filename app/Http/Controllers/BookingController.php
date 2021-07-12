<?php

namespace App\Http\Controllers;

use App\Http\Requests\bookingreq;
use App\Models\AmountRoom;
use App\Models\blacklist;
use App\Models\booking;
use App\Models\completedRoom;
use App\Models\Storeamount;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Cashier\Cashier;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Stripe;

class BookingController extends Controller
{
    //
    public function getbooking (bookingreq $request) {
        $userid = booking::where('user_id' , '=' , $request->input('userID'))->first();
        $roomid = booking::where('roomid' , '=' , $request->input('roomid'))->first();

        if($userid == null || $roomid == null) {
            $booking = booking::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'roomname' => $request->input('roomname'),
                'amount' => $request->input('amount'),
                'image' => $request->input('image'),
                'price' => $request->input('price'),
                'totalprice' => $request->input('totalprice'),
                'extras' => $request->input('extras'),
                'guests' => $request->input('guests'),
                'checkin' => $request->input('checkin'),
                'checkout' => $request->input('checkout'),
                'status' => $request->input('status'),
                'user_id' => $request->input('userID'),
                'roomid' => $request->input('roomid')
            ]);
            return response($booking, Response::HTTP_CREATED);
        } else {
            booking::where('roomid' , $request->input('roomid'))->update(array('amount' => $request->input('amount') , 'totalprice' => $request->input('totalprice')));
            return \response('Updated Amount');
        }

    }
    public function updatebookingstatus (Request $request) {
        booking::where('user_id' , $request->input('userid'))->update(array('status' => $request->input('status')));
        return \response('Updated Status');

    }
    public function getbookingDatabyuser (Request $request) {
        $userid = $request->input('userid');
        $bookedroom=booking::where('user_id' , $userid)->get();
        return \response($bookedroom);
    }
    public function getbookingData () {
        $bookingData = booking::all();
        return \response($bookingData);
    }
    public function updateStatus (Request $request)
    {
        $id = $request->input('id');
        booking::where('id', $id)->update(array('status' => $request->input('status')));
        return ('success');
    }
    public function deleteroombyid (Request $request) {
        $roomid = $request->input('roomid');
        booking::where('roomid' , $roomid )->delete();
        return \response('success');
    }
    public function searchreport (Request $request)
    {
        $key = $request->input('key');
        $result = booking::query()->where('name' , $key)->orWhere('roomname' , $key)->orWhere('email' , $key)->get();
        return \response($result);
    }
    public function deleteRoomReport (Request $request)
    {
        $id = $request->input('id');
        booking::where('id',$id)->delete();
        return Response::HTTP_ACCEPTED;
    }
    public function completedRoom (Request $request)
    {
        $completed = completedRoom::updateOrCreate([
            'roomname' => $request->input('roomname'),
            'image' => $request->input('image'),
            'amount' => $request->input('amount'),
            'checkin' => $request->input('checkin'),
            'checkout' => $request->input('checkout'),
            'price' => $request->input('price'),
            'status' => $request->input('status'),
            'user_id' => $request->input('userID')
        ]);
        return \response($completed , Response::HTTP_CREATED);
    }
    public function getstatuscompletedroom (Request $request) {
        $id = $request->input('id');
        $status = booking::where('id' , $id)->get('status');
        return \response($status);
    }
    public function storeBlacklist (Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required | email',
        ]);
        $username = blacklist::where('username' , '=' , $request->input('username'))->first();
        if($username == null) {
            blacklist::create([
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'description' => $request->input('description'),
                'totalprice' => $request->input('totalprice')
            ]);
            return Response::HTTP_CREATED;
        } else {
            return \response('User existed');

        }
    }
    public function getblacklist () {
        $blacklist = blacklist::all();
        return \response($blacklist);
    }
    public function deleteblacklist (Request $request){
        $id = $request->input('id');
        blacklist::where('id',$id)->delete();
        return Response::HTTP_ACCEPTED;
    }
    public function feecheckout (Request $request)
    {
        $stripe = Stripe::setApiKey(env('STRIPE_SECRET'));

        $customer = Customer::create(array(
            'email' => $request->stripeEmail,
            'source' => $request->stripeToken
        ));

        return \response('Payment Successful');
    }
    public function storeamounts (Request $request)
    {
        Storeamount::create([
            'amount' => $request->input('amount'),
            'roomid' => $request->input('roomid'),
            'user_id' => $request->input('userid')
        ]);
        return \response('Create Successfully');
    }
    public function bookedstatus (Request $request) {
        AmountRoom::create([
            'bookstatus' => $request->input('bookstatus'),
            'roomid' => $request->input('roomid'),
            'user_id' => $request->input('userid')
        ]);
        return \response('Success');
    }
    public function getbookedstatus (Request $request) {
        $roomid = $request->input('roomid');
        $userid = $request->input('userid');
        $status = AmountRoom::where(['roomid' => $roomid , 'user_id' => $userid])->get('bookstatus');
        return \response($status);
    }
    public function deletebookedstatus(Request $request)
    {
        $roomid = $request->input('roomid');
        $userid = $request->input('userid');
        AmountRoom::where(['roomid' => $roomid , 'user_id' => $userid])->delete();
        return \response('Deleted BookedStatus');
    }
    public function deltebookedstatusall ()
    {
       DB::table('amountsroom')->delete();
       return \response('Delete SuccessFull');
    }

}
