@include('inc.nav')

<div class="container-fluid">
    <script>
        function chitiet(id){  
        // x.innerHTML = "<div class='spinner-border' style='width: 1rem; height: 1rem;'></div>";
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
                const text = this.responseText;
                const obj = JSON.parse(text); 
                // console.log(obj);
                let name = "<div class='col-6' style='border: 1px solid #e5e7eb;'><p>Tên sản phẩm</p></div>"
                +"<div class='col-3' style='border: 1px solid #e5e7eb;'><p>Số lượng</p></div>"+"<div class='col-3' style='border: 1px solid #e5e7eb;'><p>Giá</p></div>";
                for(let i=0; i<obj.length; i++){
                    let j=i+1;
                    let price = obj[i].products.price * obj[i].quantity;
                    name +="<div class='col-6' style='border: 1px solid #e5e7eb;'><p>"+j+".  "+obj[i].products.name+" </p></div>" 
                    name +="<div class='col-3' style='border: 1px solid #e5e7eb;'><p>"+obj[i].quantity+"<p></div>"
                    name +="<div class='col-3' style='border: 1px solid #e5e7eb;'><p> "+price+"$ <p></div>" 
                }
            document.getElementById("item"+id).innerHTML = name;
        } 
        } 
        xmlhttp.open("GET", "chitiet-order/i="+id, true);
        xmlhttp.send();
        }
    </script>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800" >Đơn Hàng</h1>
    <p class="mb-4">Mội chi tiết vui lòng liên hệ với Facebook <a target="_blank"
            href="https://www.facebook.com/profile.php?id=100007844027831">Khôi Nguyên</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh Mục Đơn Hàng</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Adress</th>
                            <th>Receiver</th>
                            <th>Number Phone</th>
                            <th>Price</th>
                            <th>Status</th>
                            {{-- <th></th> --}}
                            <th>Detail</th>
                            <th>Delyvery date</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Code</th>
                            <th>Adress</th>
                            <th>Receiver</th>
                            <th>Number Phone</th>
                            <th>Price</th>
                            <th>Status</th>
                            {{-- <th></th> --}}
                            <th>Detail</th>
                            <th>Delyvery date</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <th>{{$order->id}}</th> 
                                @foreach ($order->Address as $address)
                                    <th>{{$address->address}}</th>
                                    <th>{{$address->name}}</th>
                                    <th>{{$address->phone_number}}</th>
                                @endforeach
                                
                                <th>{{$order->price}}$</th>
                                @if ($order->Status == 0)
                                    <th>Chưa Chọn Thanh Toán</th>
                                @endif
                                @if ($order->Status == 1)
                                    <th><button class="btn btn-success" data-toggle="modal" data-target="#duyet{{$order->id}}">Chờ duyệt</button></th>
                                @endif
                                @if ($order->Status == 2)
                                    <th><button class="btn btn-outline-primary" data-toggle="modal" data-target="#hoanthanh{{$order->id}}">Hoàn Thành</button></th>
                                    <div class="modal fade" id="hoanthanh{{$order->id}}">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                          
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                              <h4 class="modal-title">Hoàn Thành</h4>
                                              <button type="button" class="close" data-dismiss="modal">×</button>
                                            </div>
                                            
                                            <!-- Modal body -->
                                            
                                            <div class="modal-body">
                                                <div class="col-12" id='item'>
                                                    Bạn có chắc lựa chọn hoàn thành
                                                </div>
                                           </div>
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                              <a class="btn btn-primary" href="./hoanthanh/{{$order->id}}">Xác nhận</a>
                                              <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                                            </div>
                                            
                                          
                                        </div>
                                      </div>   
                                    </div>
                                @endif
                                @if ($order->Status == 3)
                                    <th>Đã Hoàn Thành</th>
                                @endif
                                {{-- onclick="chitiet({{$order->id}})" --}}
                                <th ><button class="btn btn-info"  data-toggle="modal" onclick="chitiet({{$order->id}})" data-target="#detail{{$order->id}}">Chi tiết</button></th>
                                <th>{{$order->date_receipt}}</th>
                            </tr>
                            <div class="modal fade" id="duyet{{$order->id}}">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                  
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                      <h4 class="modal-title">Ngày Giao</h4>
                                      <button type="button" class="close" data-dismiss="modal">×</button>
                                    </div>
                                    
                                    <!-- Modal body -->
                                    <form action="./approve/order" method="POST">
                                        @csrf
                                    <div class="modal-body">                                        
                                            <div class="form-group">
                                              <label >Ngày Giao:</label>
                                              <input hidden name='id' value="{{$order->id}}">
                                              <input class="form-control" name="ngaygiao" placeholder="Ngày Giao">
                                            </div>
                                         </div>
                                   
                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Xác nhận</button>
                                      <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                                    </div>
                                     </form>
                                  </div>
                                </div>
                              </div> 

                              <div class="modal fade" id="detail{{$order->id}}">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                  
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                      <h4 class="modal-title">Đơn hàng</h4>
                                      <button type="button" class="close" data-dismiss="modal">×</button>
                                    </div>
                                    
                                    <!-- Modal body -->
                                    
                                    <div class="modal-body">
                                        <div class="row" id='item{{$order->id}}'>
                                            <div class="col" ></div>
                                            <div class="spinner-border text-primary"></div>
                                            <div class="col" ></div>
                                        </div>
                                      <div>
                                        
                                        </div>
                                    </div>   
                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                      <button type="submit" class="btn btn-primary">Xác nhận</button>
                                      <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                                    </div>
                                 </div>
                                </div>   
                              </div>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
  
    </div>
</div> 
</div>
@include('inc.footer')