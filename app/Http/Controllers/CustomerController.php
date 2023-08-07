<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Header;
use App\Models\Meat;
use App\Models\Ramen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Ramsey\Uuid\v1;

class CustomerController extends Controller
{
    public function customerHome(Request $request)
    {
        $key = $request->keyword;
        $userId = Auth::id();

        if($key == null)
        {
            $ramen = Ramen::all();
            $key = '';
        }
        else
        {
            $ramen = Ramen::where('name', 'LIKE', '%'.$request->keyword.'%')->
            orWhere('broth', 'LIKE', '%'.$request->keyword.'%')->get();
        }

        return view('customer.customerHome', [
            "ramen"=>$ramen,
            "keyword"=>$key,
            "userId"=>$userId
        ]);
    }

    public function custProfile(Request $request)
    {
        $userId = Auth::id();
        $data = User::findOrFail($userId);

        return view('customer.profile', [
            "user"=>$data,
            "userId"=>$userId,
        ]);
    }

    public function custUpdateProfile(Request $request, $id)
    {
        $data = $request->all();
        User::where("id", $id)->update([
            'username'=>$data['username'],
            'email'=>$data['email'],
            'password'=>bcrypt($data['password']),
            'gender'=>$data['gender'],
        ]);

        return redirect()->route('home.member')->with('success_message', 'Profile has been updated!');
    }

    public function showHistory($id)
    {
        $userId = Auth::id();
        $data = Header::where('customer_id', $id)->paginate(6);

        if(Header::where('customer_id', $id)->exists())
        {
            return view('customer.history', [
                'history'=>$data,
                "userId"=>$userId,
            ]);
        }

        return redirect()->route('home.member')->with('error_message', 'There is no order record for this customer ID.');
    }

    public function showDetail($id)
    {
        $userId = Auth::id();
        $data = Detail::where('header_id', $id)->paginate(6);

        return view('customer.details', ["details"=>$data, "userId"=>$userId]);
    }
}
