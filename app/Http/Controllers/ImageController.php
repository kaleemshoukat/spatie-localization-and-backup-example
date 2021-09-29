<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\User;
use App\Models\UserImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ImageController extends Controller
{
    public function user(){
        $users=User::paginate(10);
        return view('user', compact('users'));
    }

    public function submitUser(Request $request){
        $request->validate([
           'name'=>'required|string|max:255',
           'email'=>'required|string|max:255|email|unique:users,email',
           'password'=>'required|string|max:15|min:8',
           'profile_image'=>'required|mimes:jpg,png,jpeg',
           'images.*'=>'nullable|mimes:jpg,png,jpeg',
        ]);

        $user=new User();
        $user->name=['en'=>$request->name, 'ur'=>$request->name];   //for both languages
        $user->email=$request->email;       //it will take value of language from url and set it accordingly in db
        $user->password=Hash::make($request->password);
        $user->profile_image=Helper::upload_file($request->profile_image);
        //$user->images=$request->hasfile('images') ? Helper::upload_files($request->images) : null;
        $user->save();

        if ($request->hasfile('images')){
            foreach ($request->images as $image){
                $name=Helper::upload_file($image);

                $user_image=new UserImage();
                $user_image->user_id=$user->id;
                $user_image->name=$name;
                $user_image->save();
            }
        }

        return redirect()->back()->with('success', 'User added!!');
    }




}
