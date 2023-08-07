<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    public function staffHome(Request $request)
    {
        $key = $request->keyword;

        if($key == null)
        {
            $user = User::where('role', 1)->paginate(6);
            $key = '';
        }
        else
        {
            $user = User::where('role', 1)->
            where('username', 'LIKE', '%'.$request->keyword.'%')->paginate(6);
        }

        return view('staff.staffHome', ["user"=>$user, "keyword"=>$key]);
    }

    public function staffProfile(Request $request)
    {
        $userId = Auth::id();
        $data = User::findOrFail($userId);

        return view('staff.profile', [
            "user" => $data,
        ]);
    }

    public function staffUpdateProfile(Request $request, $id)
    {
        $data = $request->all();
        User::where("id", $id)->update([
            'username'=>$data['username'],
            'email'=>$data['email'],
            'password'=>bcrypt($data['password']),
            'gender'=>$data['gender'],
        ]);

        return redirect()->route('home.staff');
    }
}
