<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\products;
use App\Models\Orders;
use App\Models\Detail_Orders;
class PaymentController extends Controller
{   
    //
    public function Payment(Request $req){
       $data = $req->all(); 
       $detail_orders = Detail_Orders::where(['id_order'=>$data['id']])->get();
       foreach($detail_orders as $detail_order){
            if($detail_order->quantity > $detail_order->products['quantity']){
            return back()->with('wanning',"Số lượng sản phẩm".$detail_order->products['name']." hiện tại không đủ");
            } 
            // Orders::where(['id'=>$data['id']])->update(['Status'=>1]);
            // return redirect('/views_detail_cart='.$data['id'].'');
        }
        
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost:8000/payment/order=".$data['id'];
        $vnp_TmnCode = "AW2JVD21";//Mã website tại VNPAY 
        $vnp_HashSecret = "GRKNRVQLDOOVINUVKAPPIIYRLZDBVZUA"; //Chuỗi bí mật

        $vnp_TxnRef = $data['id']; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh Toán Đơn Hàng';
        $vnp_OrderType = 'billpayment';
        $i = $data['price'] * 25000;
        $vnp_Amount = $i * 100;
        $vnp_Locale = 'VN';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        
    
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) { 
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
       
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
             
            if (isset($_POST['redirect'])) {    
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
        } 
        
   public function direct_payment($id){
       $detail_orders = Detail_Orders::where(['id_order'=>$id])->get();
       foreach($detail_orders as $detail_order){
            if($detail_order->quantity > $detail_order->products['quantity']){
               Orders::where(['id'=>$id])->update(['Status'=>-1]);
               return back()->with('wanning',"Số lượng sản phẩm".$detail_order->products['name']." hiện tại không đủ");
            } 
            foreach($detail_orders as $detail_order){
                    $quantity = $detail_order->products['quantity'] - $detail_order->quantity;
                    products::where(['id'=>$detail_order->id_product])->update(['quantity'=>$quantity]);
            }
            Orders::where(['id'=>$id])->update(['Status'=>1]);
            return redirect('/views_detail_cart='.$id.'');
       }
   }
}
