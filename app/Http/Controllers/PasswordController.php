<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetRequest;
use App\Models\User;
use Carbon\PHPStan\Macro;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PasswordController extends Controller
{
    public function fogotpassword(Request $request)
        {
            $email = $request->input('email');
            $token = Str::random(12);

            DB::table('password_resets')->insert([
                'email'=>$email,
                'token'=>$token
            ]);
            Mail::send('reset',['token'=>$token],function (Message $message) use($email) {
                $message->subject('Reset your Password');
                $message->to($email);

            });
            return \response([
                'message'=>'Check your email',
            ]);


        }
      public function resetPassword (ResetRequest $request){
         $resetPassword = DB::table('password_resets')
             ->where('token',$request->input('token'))->first();
        if( !$user = User::where('email',$resetPassword->email)->first()){
            throw new NotFoundHttpException('User not Found');
        }
        $user->password = Hash::make($request->input('password'));
        $user->save();
        return \response([
            'message'=>'success'
        ]);


      }
}
