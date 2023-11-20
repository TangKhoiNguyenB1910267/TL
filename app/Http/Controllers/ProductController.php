<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\products;
use App\Models\Orders;
use App\Models\images;
use App\Models\firm;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Files;
use Illuminate\Support\Arr;
class ProductController extends Controller
{
    public function thongke(){
        $firms =  firm::withCount('products')->get();
        foreach($firms as $firm){
        }
        return response($firms);
    }
    public function search($name){
        $products = products::where('name','Like','%'.$name.'%')->get();
        $output = "";
        if ($name !== "") {
        foreach($products as $product) {
            if ($output=== "") {
                $output = "<li class='list-group-item'><a href='detail-$product->id' 
                style='text-decoration: none; color: black;'><div class='row'>
                <img class='col-4' src='backend/img/$product->poster' 
                height='90px' width='90px'><p class='col-8' style='font-size: 12px' >
                $product->name</p></div></a></li>";
            } else {
                $output .= "<li class='list-group-item'>
                <a href='detail-$product->id' 
                style='text-decoration: none; color: black;'>
                <div class='row'><img class='col-4' src='backend/img/$product->poster' 
                height='90px' width='90px'><p class='col-8' style='font-size: 12px' >
                $product->name</p></div></a></li>";
            }            
        } 
    }
       if($output===""){
        $output = "<li class='list-group-item'>Không tìm thấy kết quả</li>";
       }
    return response($output);
        // Output "no suggestion" if no hint was found or output correct values       
    }
    public function detail($id){ 
        $orders = "";
        if(session('user')){
            $orders = Orders::where(['id_user'=>Session('user_id'),'Status'=>-1])->get();
        }
        $products = products::where(['id'=>$id])->get();
        $images = images::where(['id_product'=> $id])->get();
        return view('client.detail-product',compact('products','images','orders'));
        // return view('detail-product');
    }
    public function delete_product($id)
    {
        $products = products::where(['id'=>$id])->get();
        $images = images::where(['id_product'=> $id])->get();
        foreach($products as $product){
            unlink('backend/img/'.$product->poster);
            
        }
        foreach($images as $image){
                // return dd($image->image);
            unlink('backend/img/'.$image->image);
        }
        images::where(['id_product'=>$id])->delete();
        products::where(['id'=>$id])->delete();
        return back();
        
    }
    public function edit_product(Request $request){
        $data = $request->all();
        if($request->name != null){
            products::where(['id'=>$data['id']])->update([
                'name' => $data['product-name']
            ]);
        }
        if($request->price != null){
            products::where(['id'=>$data['id']])->update([
                'price' => $data['price']
            ]);
        }
        if($request->firm != null){
            products::where(['id'=>$data['id']])->update([
                'id_firm' => $data['firm']
            ]);
        }
        if($request->has('poster')){
            $products=products::all()->where(['id'=>$data['id']]);
            foreach($products as $product){
                // return dd($product->poster);
                unlink('backend/img/'.$product->poster);
            }
            
            $upload_path = 'backend/img';
            $image_full_name = rand(1,1000).'-image-'.time().rand(1,1000).'.'.$request->file('poster')->extension();
            $request->file('poster')->move($upload_path,$image_full_name);
            products::where(['id'=>$data['id']])->update([
                'poster'=>  $image_full_name
            ]);
        }
        if($request->has('image')){   
            $imgs = images::where(['id_product'=> $data['id']])->get();
            images::where(['id_product'=>$data['id']])->delete();
            foreach($imgs as $img){
                // return dd( $img->image);
                unlink('backend/img/'.$img->image);
            }
            foreach ($request->file('image') as $image){
                $upload_path = 'backend/img';
                $image_full_name = $data['id'].'-image-'.time().rand(1,1000).'.'.$image->extension();
                $image->move($upload_path,$image_full_name);
                 images::create([
                    'id_product' =>$data['id'],
                    'image' => $image_full_name
                 ]);
                // dd($request->all());
            }
        }
        if($request->Description != null){
            products::where(['id'=>$data['id']])->update([
                'Description' => $data['Description']
            ]);
        }
         return back()->with('success', 'Edit product success');
    }
    public function show_product(){
        // $products = DB::table('products','image')
        // ->select('name', 'price','created_at','image')
        // ->where('images.id_product','=','product.id')
        // ->get();
        $firms = firm::all();
        $products = products::all();  
        //  return dd($products->image);
        return view('admin.showall_product',compact('products','firms'));
    }
    public function add_product(Request $request){
        //   $image = $request->file('image');
        // //   $path = $image->getClientOriginalName();
        //   dd($image);

           $request->validate([
            'product-name'    => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'firm'    => 'required',
            'image' => 'required',
            'poster' =>'required',
            'Description' => 'required'
       ]);  
       $data = $request->all();
       if($request->has('poster')){
        $upload_path = 'backend/img';
        $image_full_name = rand(1,1000).'-image-'.time().rand(1,1000).'.'.$request->file('poster')->extension();
        $request->file('poster')->move($upload_path,$image_full_name);
       }
       $new_product = products::create([
        'name' => $data['product-name'],
        'price' => $data['price'],
        'quantity' => $data['quantity'],
        'Description' =>  $data['Description'],
        'id_firm'=> $data['firm'],
        'poster' => $image_full_name
       ]);
       
    //    $image = array();
       if($request->has('image')){
        foreach ($request->file('image') as $image){
            $upload_path = 'backend/img';
            $image_full_name = $new_product->id.'-image-'.time().rand(1,1000).'.'.$image->extension();
            $image->move($upload_path,$image_full_name);
             images::create([
                'id_product' =>$new_product->id,
                'image' => $image_full_name
            ]);
            // dd($request->all());
        }
      }
      return back()->with('success', 'Added a new product success');
    } 
}
