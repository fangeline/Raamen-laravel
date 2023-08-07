<?php

namespace App\Http\Controllers;

use App\Models\Meat;
use App\Models\Ramen;
use Illuminate\Http\Request;

class RamenController extends Controller
{
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

        return view('staff.ramen.index', ['ramen'=>$data, 'keyword'=>$key]);
    }

    public function editRamen(Request $request, $id)
    {
        $meat = Meat::all();
        $ramen = Ramen::findOrFail($id);
        $meatName = Meat::findOrFail($ramen->meat_id);

        return view('staff.ramen.edit', [
            'meat'=>$meat,
            'ramen'=>$ramen,
            'meatName'=>$meatName
        ]);
    }

    public function createRamen(Request $request)
    {
        $data = Meat::all();
        return view('staff.ramen.add', ['meat'=>$data]);
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

        return redirect()->route('showRamen')->with('success_message', 'Success!');
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

        return redirect()->route('showRamen')->with('success_message', 'Update success!');
    }

    public function deleteRamen(Request $request, $id)
    {
        $data = Ramen::findOrFail($id);

        $data->destroy($id);
        return redirect()->route('showRamen')->with('success_message', 'Delete success!');
    }
}
