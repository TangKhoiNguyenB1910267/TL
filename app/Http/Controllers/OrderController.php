<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Orders;
use App\Models\products;
use App\Models\Detail_Orders;
use Session;
class OrderController extends Controller
{
    //
    public function order_now(Request $req){
        $req->validate([
            'sdt' => 'required|min:10|max:10',
            'name' => 'required',
            'diachi' => 'required',
            'sonha' => 'required'
        ]); 
        $data = $req->all();
        $orders = Orders::Where(['id_user' => session('user_id'),'Status'=> -1])->get();
        foreach($orders as $order){}
        $detail_orders = Detail_Orders::Where(['id_order' => $order->id])->get();
        foreach($detail_orders as $detail_order){
           
            if($detail_order->quantity > $detail_order->products['quantity']){
                return back()->with('wanning', "Số lượng sản phẩm".$detail_order->products['name']." hiện tại không đủ");
            }
        }
        // foreach($detail_orders as $detail_order){
        //     $quantity = $detail_order->products['quantity'] - $detail_order->quantity;
        //     products::where(['id'=>$detail_order->id_product])->update(['quantity'=>$quantity]);
        // }
        Orders::where(['id_user' => session('user_id'),'Status' => -1])->update(['Status'=>0, 'price' => $data['price']]);
        $orders= Orders::where(['id_user' => session('user_id'),'Status' => 0])->get();
        foreach($orders as $order){}
        Address::create(['id_user' => session('user_id'), 
                        'id_order' => $order->id, 
                        'name' => $data['name'],
                        'phone_number'=> $data['sdt'], 
                        'address' => $data['sonha'].'/ '.$data['diachi']]);
        session::put('cart','0'); 
    return back()->with('success','Đặt hàng thành công');
    // return dd($req->all());
    }
    public function buy_now($id){
        $orders = Orders::where(['id_user' => session('user_id'),'Status' => -1])->get();
        if($orders->toArray()==null){
             $new_orders=Orders::create(['id_user' => session('user_id'),'Status' => -1]);
             Detail_Orders::create(['id_order'=>$new_orders->id,'id_product'=>$id,'quantity'=>1]);
             session::put('cart','1'); 
             return redirect('views_detail_cart='.$new_orders->id.'');
        }      
    }
    public function orders_show(){
        $orders= Orders::whereRaw('Status > -1')->get();
        return view('admin.order_table',compact('orders'));
    }

    public function approve(Request $req){
        $data = $req->all();
        Orders::where(['id'=>$data['id']])->update(['Status'=>2,'date_receipt'=>$data['ngaygiao']]);
        return back();
    }

    public function chitiet($id){
        $details= Detail_Orders::where(['id_order'=>$id])->get();
        foreach($details as $detail){
            $detail->products;
        }
        return response()->json($details);
    }

    public function cancel($id){
        $detail_orders =  Detail_Orders::where(['id_order'=>$id])->get();
        foreach($detail_orders as $detail_order){
           $quantity = $detail_order->quantity + $detail_order->products['quantity'];
           products::where(['id' => $detail_order->id_product])->update(['quantity'=>$quantity]);
        }
        Detail_Orders::where(['id_order'=>$id])->delete();
        Orders::where(['id'=>$id])->delete();
        Address::where(['id_order'=>$id])->delete();
        return redirect('/');
    }

    public function hoanthanh($id){
        Orders::where(['id'=>$id])->update(['Status'=>3]);
        return back();
    }
}
