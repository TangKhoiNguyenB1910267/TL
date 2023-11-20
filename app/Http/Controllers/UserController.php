<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Orders;
use App\Models\Detail_Orders;
use Illuminate\Support\Facades\DB;
session_start();

class UserController extends Controller
{
    // public function registration()
    // {

    // }
    public function users_show(){
        $users= User::where(['role'=>0])->get();
        return view('admin.users_table',compact('users'));
    }
    public function delete_user($id){
        $users= User::where(['id'=>$id])->delete();
       return back();
    }
    public function validate_registration(Request $request){
        $request->validate([
            'First_Name' => 'required',
            'Last_Name' => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
            're-password' => 'required|same:password|min:6'
        ]);
         $data = $request->all();
        user::create([
            'remember_token' => $data['_token'],
            'name' => $data['Last_Name'].' '.$data['First_Name'],
            'email' =>  $data['email'],
            'password'=> Hash::make($data['password'])
        ]);
        return redirect('login')->with('success','Đăng ký thành công bây giờ bạn có thể đăng nhập');
         //dd($data);
    }

    public function validate_login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
       ]);
       $data = $request->all();
       $credentials=$request->only('email','password');
       if(Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'role' => 0])){
         $users = DB::table('users')->where('email', $data['email'])->first();
         $items = Orders::where(['id_user'=>$users->id,
        'Status'=>'-1'])->withCount('items')->get();
        
        Session::put('user_id',$users->id);
        Session::put('user',$users->name);
        $detail=0;
        foreach($items as $item){}
        if($items->toArray()!=null){
            $detail =  Detail_Orders::where(['id_order'=>$item->id])->sum('quantity');
        }
        Session::put('cart',$detail);
        return redirect('/');
        // return route('admin');
        //  dd($users->name);
       }
        return redirect('login')->with('danger','Đăng nhập thất bại vui lòng đăng nhập lại');
    }

    public function validate_login_admin(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
       ]);
       $data = $request->all();
       $credentials=$request->only('email','password');
       if(Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'role' => 1])){
        $users = DB::table('users')->where('email', $data['email'])->first();
        Session::put('admin',$users->name);
        Session::put('admin_id',$users->id);
        return redirect('/admin/dashboard');
       // return route('admin');
       //  dd($users->name);
      }
        return redirect('login-admin')->with('danger','Đăng nhập thất bại vui lòng đăng nhập lại');
    }


    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Session::put('user',null);
        Session::put('cart',null);
        Session::put('user_id',null);
        return redirect('/');
    }
    public function logout_admin(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Session::put('admin',null);
        Session::put('cart',null);
        Session::put('admin_id',null);
        return redirect('/login-admin');
    }

}