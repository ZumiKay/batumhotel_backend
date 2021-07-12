<?php

namespace App\Http\Controllers;

use App\Models\payment;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),

        ]);
        return response($user,Response::HTTP_CREATED);

    }
    public function login(Request $request)
    {
        if(!Auth::attempt($request->only('email','password')))
        {
           return \response([
               'error' => 'invalid Credentials'
           ],Response::HTTP_UNAUTHORIZED);

        }
        $user = Auth::user();
        $token = $user->createToken('token')->plainTextToken;
        $cookie = cookie('jwt',$token,60 * 24);
        return \response(
            [
                'jwt'=>$token,
                'user' =>$user
            ]
        )->withCookie($cookie);



    }


    public function user(Request $request)
    {
        $getToken = $request->cookie('jwt');
        $user = $request->user();
        return \response(['jwt'=>$getToken , 'user'=>$user]);
    }
    public function logout()
    {
        $cookie = Cookie::forget('jwt');

        return \response([
            'message'=>'successed'
        ])->withCookie($cookie);
    }
    public function getbookingData (Request $request) {

        $booking = User::find($request ->input('id'))->getBooking;

        return \response($booking);

    }
    public function getcompletedRoomData (Request $request)
    {
        $completed = User::find($request -> input('id'))->getCompletedBooking;
        return \response($completed);
    }
    public function storepayment (Request $request)
    {
        $request->validate([
            'cardnumber' => 'required',
            'cardholder' => 'required',
            'cvv' => 'required',
            'expire'=> 'required'
        ]);
        $userid = payment::where('user_id' , '=' , $request->input('userid'))->first();
        if($userid == null) {
            $payment = payment::updateOrCreate([
                'cardnumber' => $request->input('cardnumber'),
                'cardholder' => $request->input('cardholder'),
                'cvv' => Hash::make($request->input('cvv')),
                'expire' => $request->input('expire'),
                'user_id' => $request->input('userid'),
                'status' => $request->input('status'),
                'cash' => $request->input('cash')
            ]);
            return Response::HTTP_CREATED;
        } else {
            return \response("Credit Card Existed");
        }
    }
    public function chargecash (Request $request) {
        payment::where('user_id' , $request->input('userid'))->update(array('cash' => $request->input('cash') , 'status' => 'charged'));
        return \response('Charged Success');
    }
    public function getcreditcard (Request $request) {
        $status = payment::where('user_id' , $request->input('userid'))->get();
        return \response($status);
    }
}
