<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        // Fetch input
        $user_input = $request->all();
        // Create user
        $user = User::create([
            'name' => $user_input['name'],
            'phone' => $user_input['phone'],
            'password' => bcrypt($user_input['password'])
        ]);

        // Create Token
        $token = $user->createToken('auth')-> accessToken;

        // Fetch User
        $user_data = User::where('id',$user->id)->first();

        // Return data 
        return response()->json([
            'token' => $token,
            'user' => $user_data
        ]);
    }

    public function login(Request $request) {
        // Fetch Input 
        $input = $request->all();
         // IF Right Values
        if(Auth::attempt(['phone' => $input['phone'],'password' => $input['password']])) {
            // Auth User
            $user = Auth::User();
            $token = $user->createToken('auth')-> accessToken; #Fetch Token

            //return data
            return response()->json([
                'token' => $token,
                'user' => $user
            ],200);
        }

        // if not correct
        return response()->json(['error' => 'Unauthorised'],401);
    }

    // Auth -> Get User
    public function auth() {
        $user = Auth::User();

        return response()->json([
            'user' => $user
        ]);
    }

    public function get_user($id) {
        return response()->json(User::where('id',$id)->first());
    }


    public function update_profile(Request $request){
        /** With Update password */
        $name = $request->name;
        $user_id = $request->user_id;
        $password = bcrypt($request->password);

        User::where('id',$user_id)->update([
            'name' => $name,
            'password' => $password
        ]);
    }

    public function update_password(Request $request) {
        $newPassword = bcrypt($request->newPassword);
        $oldPassword = $request->oldPassword;
        $user = User::where('id',$request->id)->first();
        $itsPassword = Hash::check($oldPassword,$user->password);
        if($itsPassword) {
            User::where('id',$request->id)->update([
            'password' => $newPassword
            ]);

            return response()->json(['message' => 'update success !'],200);
        }else {
            return response()->json(['message' => 'Not the same password'],401);
        }
       
    }
}
