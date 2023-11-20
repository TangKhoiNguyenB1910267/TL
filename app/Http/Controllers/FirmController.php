<?php

namespace App\Http\Controllers;
use App\Models\firm;
use Illuminate\Http\Request;

class FirmController extends Controller
{
    public function seclect_all_firm(){
        $firms = firm::withCount('products')->get();
        return $firms;
    }
    public function add_product_index(){
        $firms = FirmController::seclect_all_firm();
        return view('admin.add_product',compact('firms'));
    }
    public function firm_table(){
        $firms = FirmController::seclect_all_firm();
        return view('admin.firm-table',compact('firms'));
    }
    
    public function firm_add(Request $request){
        $request->validate([
            'name' => 'required | unique:firms',
        ]);
        firm::create([
            'name' => $request->name
        ]);
        return back();
    }

    public function firm_edit(Request $request){
        $request->validate([
            'name' => 'unique:firms',
        ]);
        // return dd($request->id);
        firm::where(['id'=>$request->id])->update([
            'name' => $request->name
        ]);
        return back();
    }
}
