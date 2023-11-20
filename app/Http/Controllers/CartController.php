<?php

namespace App\Http\Controllers;
use App\Models\products;
use App\Models\Orders;
use App\Models\Detail_Orders;
use Illuminate\Http\Request;
use Session;

class CartController extends Controller
{
    public function removecart($id){
        Detail_Orders::where(['id'=>$id])->delete();
        $orders=Orders::where(['id_user'=>session('user_id'),
                                'Status'=>'-1'])->withCount('items')->get();
        foreach( $orders as $order){}      
        Session::put('cart',$order->items_count);
        if($order->items_count==0){
            $orders=Orders::where(['id_user'=>session('user_id'),
                                    'Status'=>'-1'])->delete();
        }  
        $quantity=Detail_Orders::where(['id_order'=>$order->id])->sum('quantity');
        return response($quantity);
      
    }
    public function add($id){
        $orders=Orders::where(['id_user'=>session('user_id'),
                                'Status'=>'-1'])->get();
        // $products=products::where(['id'=>$id])->get();
        foreach( $orders as $order){}      
        // foreach( $products as $product){}
        if(session('user')){
            if($orders->toArray()==null){
                $neworder = Orders::create(['id_user'=>session('user_id'),
                'Status'=>'-1']);
                $newitems = Detail_Orders::create(['id_product' => $id, 'id_order' => $neworder->id, 'quantity' => 1]);
                $item_quantity = Detail_Orders::where(['id_order'=>$neworder->id])->sum('quantity');
            }else{
                $item = Detail_Orders::where(['id_product' => $id, 'id_order' => $order->id])->get();

                if($item ->toArray()==null){
                    $newitems = Detail_Orders::create(['id_product' => $id, 'id_order' => $order->id, 'quantity' => 1]);
                    $item_quantity = Detail_Orders::where(['id_order'=>$order->id])->sum('quantity');
                }else{
                    foreach( $item as $items){}
                    $i = $items->quantity + 1;
                    $newitems = Detail_Orders::where(['id_product' => $id, 'id_order' => $order->id])->update(['quantity' => $i]) ;
                    $item_quantity = Detail_Orders::where(['id_order'=>$order->id])->sum('quantity');
                }
                
            }
        }
        Session::put('cart',$item_quantity);
        return response($item_quantity);
    }
    public function sub($id){
        $orders=Orders::where(['id_user'=>session('user_id'),
                                'Status'=>'-1'])->get();;
        foreach( $orders as $order){}      
            $item = Detail_Orders::where(['id_product' => $id, 'id_order' => $order->id])->get();
                foreach( $item as $items){}
                    $i = $items->quantity - 1;
                    if($i==0){
                        $item_quantity = CartController::removecart($items->id);
                    }else{
                        $newitems = Detail_Orders::where(['id_product' => $id, 'id_order' => $order->id])->update(['quantity' => $i]);
                    }
            $item_quantity = Detail_Orders::where(['id_order'=>$order->id])->sum('quantity');
        Session::put('cart',$item_quantity);
        return response($item_quantity);
    }
    public function detail_order($id){
        $orders =  Orders::where(['id'=> $id,'id_user'=>session('user_id')])->get();
        if( $orders->toArray()==null){
            return redirect('/');
        }
        $detail_orders = Detail_Orders::where(['id_order'=> $id])->get();
        return view('client.detail_cart',compact('orders','detail_orders'));
    }

    public function showcart(){
        $orders=Orders::where(['id_user'=>session('user_id'),
                                'Status'=>'-1'])->get();
        foreach($orders as $order){}
        $output="";
        if($orders->toArray()!=null){
            $detail_orders=Detail_Orders::where(['id_order'=>$order->id])->get();
        $i=0;
        $total = 0;
        foreach($detail_orders as $detail_orders){   
            $id=$detail_orders->id;
            $id_order=$detail_orders->id_order;
            $id_product=$detail_orders->products['id'];
            $products = Detail_Orders::where(['id_order'=>$id_order, 'id_product'=>$id_product])->get();
            $poster = $detail_orders->products['poster'];
            $name = $detail_orders->products['name'];
            $price = $detail_orders->products['price'];
            $quantity = $detail_orders->quantity;
            if($quantity < 10){ $quantity = "0".$quantity;}
            $total = $total + $price*$quantity;
            if($i<=9){
                $output .= "<div class='dropdown-item d-flex align-items-center'>
                                <div class='dropdown-list-image mr-3'>
                                    <img  src='backend/img/$poster'
                                        alt='...'>
                                </div>
                                <div class='row font-weight-bold'>
                                    <div class='col-10' >
                                        <a href='detail-$id_product' style='text-decoration: none;' > 
                                        <div class='text-truncate'>$name</div>                                
                                        </a>
                                        <div class='row'>
                                            <div class='small col-4 text-gray-500'>$price</div>
                                            <div class = 'col-2'> 
                                                <i class='fa fa-minus' aria-hidden='true' onclick='subCart($id_product)'></i>  
                                            </div>
                                            <input type='text' class='col-3 form-control' placeholder='$quantity' id='usr'disabled style='height: 20px;'>
                                            <div class = 'col-2'> 
                                                <i class='fa fa-plus' aria-hidden='true' onclick='addCart($id_product)'></i>  
                                            </div>
                                        </div>
                                           
                                    </div>
                                    <a class='col-2' onclick='removeitem($id ,this)'><i class=' fa fa-times' aria-hidden='true' ></i></a>
                                </div>
                            </div>";
                // } 
            $i++;
            }           
        }
        }
        
            if($output==""){
                $output = "<div class='dropdown-item d-flex align-items-center'>
                                    <div class='col-12' style='height: 300px' >
                                        
                                            Không có sản phẩm trong giỏ
                                        
                                    </div>
                            </div>";
            }else{
                $output .= "<div class='dropdown-item align-items-center'>
                    <div class='row font-weight-bold'>                     
                            <div class='col-8'>Tổng tiền:</div>
                            <div class='col-4'>$$total</div>       
                    </div>
                </div>
                <a class='dropdown-item text-center small text-gray-1000' href='/views_detail_cart=$id_order'>Xem chi tiết giỏ hàng</a>
                <a class='dropdown-item text-center text-white' href='/views_detail_cart=$id_order' style='background-color: #4e73df;'>Mua ngay</a>
                ";
            }
            return response($output);
        // return dd($product->products['poster']);
    }
    public function getorder(){
        $orders=Orders::where(['id_user'=>session('user_id'),
                                'Status'=>'-1'])->get();
        foreach($orders as $order){}
        $output="";
        if($orders->toArray()!=null){
            $products=Detail_Orders::where(['id_order'=>$order->id])->get();
        $i=0;
        $total = 0;
        foreach($products as $product){
            $id=$product->id;
            $id_order=$product->id_order;
            $id_product=$product->products['id'];
            $poster = $product->products['poster'];
            $name = $product->products['name'];
            $price = $product->products['price'];
            $quantity = $product->quantity;
            if($quantity < 10){ $quantity = "0".$quantity;}
            $total = $total + $price*$product->quantity;
            $output.= "<div class='card mb-4 py-3 border-bottom-primary' style='padding-top: 0rem!important; padding-bottom: 0rem!important;' >
                            <div class='row' style='position: relative'>                               
                                <div class='col-3' >
                                    <img src='backend/img/$poster' style='margin-left:10px' width='100%' height='100%' alt=''>
                                </div> 
                                <div class='col-8'>
                                    <a>$name</a>
                                    <p>$price</p>
                                    <div class= 'row'>
                                            <div class = 'col-1'> 
                                                <i class='fa fa-minus' aria-hidden='true' onclick='subCart($id_product)'></i>  
                                            </div>
                                            <input type='text' class='form-control' placeholder='$quantity' id='usr'disabled style='height: 20px; margin-left: 10px; width: 45px;'>
                                            <div class = 'col-1'> 
                                                <i class='fa fa-plus' aria-hidden='true' onclick='addCart($id_product)'></i>  
                                            </div>
                                    </div>
                                            
                                </div>
                                <div class='col-1' onclick='removeitem($id,this)'>
                                    <i class='fa fa-times' aria-hidden='true' ></i>
                                </div>
                            </div>
                        </div>";
                   
        }
            $output.="<h2 class= 'row'>Tổng tiền: &nbsp;<p id='pric'>$total</p>$</h2>";
        }
            return response($output);
    }
}