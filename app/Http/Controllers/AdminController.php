<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Header;
use App\Models\Meat;
use App\Models\Ramen;
use App\Models\User;
use PDF;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function adminHome(Request $request)
    {
        $key = $request->keyword;

        if($key == null)
        {
            $user = User::where('role', 0)->paginate(6);
            $key = '';
        }
        else
        {
            $user = User::where('role', 0)->
            where('username', 'LIKE', '%'.$request->keyword.'%')->paginate(6);
        }

        return view('admin.adminHome', ['user'=>$user, 'keyword'=>$key]);
    }

    public function customerData(Request $request)
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

        return view('admin.custData', ['user'=>$user, 'keyword'=>$key]);
    }

    public function profile(Request $request)
    {
        $userId = Auth::id();
        $data = User::findOrFail($userId);

        return view('admin.profile', [
            "user" => $data,
        ]);
    }

    public function addProfile(Request $request)
    {
        $data = $request->all();

        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);

        if($data['password'] != $data['confirmPass'])
        {
            return redirect()->route('register.admin')->with('error_message', 'Please confirm your password.');
        }
        else if(!Str::endsWith($data['email'], '.com'))
        {
            return redirect()->route('register.admin')->with('error_message', 'Please enter the correct e-mail address.');
        }
        else if(Str::length($data['username']) < 5 || Str::length($data['username']) > 15)
        {
            return redirect()->route('register.admin')->with('error_message', 'Please ensure that your username is between 5-15 characters.');
        }
        else if(User::where('username', $data['username'])->exists())
        {
            return redirect()->route('register.admin')->with('error_message', 'Username already exists.');
        }

        User::create([
            'username'=>$data['username'],
            'email'=>$data['email'],
            'password'=>bcrypt($data['password']),
            'gender'=>$data['gender'],
            'role'=>$data['role'],
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ]);

        return redirect()->route('home.admin')->with('success_message', 'Success registering user!');
    }

    public function deleteStaff($id)
    {
        $staff = User::findOrFail($id);
        $staff->destroy($id);
        return redirect()->route('home.admin')->with('success_message', 'Delete Success!');
    }

    public function updateProfile(Request $request, $id)
    {
        $data = $request->all();
        User::where("id", $id)->update([
            'username'=>$data['username'],
            'email'=>$data['email'],
            'password'=>bcrypt($data['password']),
            'gender'=>$data['gender'],
        ]);

        return redirect()->route('home.admin');
    }

    public function showRamen(Request $request)
    {
        $key = $request->keyword;

        if($key == null)
        {
            $data = Ramen::paginate(6);
            $key = '';
        }
        else
        {
            $data = Ramen::where('name', 'LIKE', '%'.$request->keyword.'%')->
            orWhere('broth', 'LIKE', '%'.$request->keyword.'%')->
            orWhere('price', 'LIKE', '%'.$request->keyword.'%')->paginate(6);
        }

        return view('admin.ramen.index', ['ramen'=>$data, 'keyword'=>$key]);
    }

    public function editRamen(Request $request, $id)
    {
        $meat = Meat::all();
        $ramen = Ramen::findOrFail($id);
        $meatName = Meat::findOrFail($ramen->meat_id);

        return view('admin.ramen.edit', [
            'meat'=>$meat,
            'ramen'=>$ramen,
            'meatName'=>$meatName
        ]);
    }

    public function createRamen(Request $request)
    {
        $data = Meat::all();
        return view('admin.ramen.add', ['meat'=>$data]);
    }

    public function storeRamen(Request $request)
    {
        $ramen = Ramen::all();
        $data = $request->all();

        $request->validate([
            'name'=>'string|max:255',
            'broth'=>'string|max:255',
        ]);

        Ramen::create([
            'meat_id'=>$data['meat_id'],
            'name'=>$data['name'],
            'broth'=>$data['broth'],
            'price'=>$data['price'],
        ]);

        return redirect()->route('showRamen.admin')->with('success_message', 'Success!');
    }

    public function updateRamen(Request $request, $id)
    {
        $data = $request->all();
        Ramen::where("id", $id)->update([
            'name'=>$data['name'],
            'meat_id'=>$data['meat_id'],
            'broth'=>$data['broth'],
            'price'=>$data['price'],
        ]);

        return redirect()->route('showRamen.admin')->with('success_message', 'Update success!');
    }

    public function deleteRamen(Request $request, $id)
    {
        $data = Ramen::findOrFail($id);

        $data->destroy($id);
        return redirect()->route('showRamen.admin')->with('success_message', 'Delete success!');
    }

    public function register()
    {
        return view('admin.register');
    }

    public function showPDF($id)
    {
        $data = Detail::where('header_id', $id)->get();

        $total = 0;
        foreach($data as $item)
        {
            $total += ($item->ramen->price * $item['quantity']);
        }

        $pdf = PDF::loadView('admin.report', ["data"=>$data, "total"=>$total, "header_id"=>$id]);

        return $pdf->stream();
    }
}
