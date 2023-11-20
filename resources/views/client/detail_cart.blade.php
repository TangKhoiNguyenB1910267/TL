@include('inc.nav-index')
                <!-- End of Topbar -->
                <div style="margin-top: 100px">
                    <div class="container" id="df">
                       <!-- Page Heading -->   
                       
                       <p class="mb-4"></p> 
                       
                       <div class="row" style="min-height: 1000px">
                         
                            <div class="col-lg-6">
                            @foreach ($orders as $order)
                                 @if ($order->Status == -1)   
                            <h1 class="h3 mb-1 text-gray-800">Giỏ Hàng</h1>
                                <div id= 'list-product'>
                                </div>      
                            </div>
                            <div class="col-lg-6" >
                                 
                                <div class="col-4" style="position: fixed;">         
                                    <h1 class="h3 mb-1 text-gray-800">Thông Tin Nhận Hàng</h1>
                                    @if (session('wanning'))
                                    <div class="alert alert-info alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            {{session('wanning')}}
                                    </div>
                                    @endif
                                <form action="/views_detail_cart/order" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="sdt">Số điện thoại:</label>
                                        <input type="text" name="sdt" class="form-control" placeholder="098xxxxxxx">
                                        @if($errors->has('sdt'))
                                        <span class="text-danger">Số điện thoại không hợp lệ</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Tên người nhận:</label>
                                        <input type="text" name="name" class="form-control" placeholder="Nguyễn Văn A" value="{{session('user')}}">
                                        @if($errors->has('name'))
                                        <span class="text-danger">Tên người nhận phải có giá trị</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="comment">Tỉnh Thành:</label>
                                        <select class="custom-select" id="province">
                                            <option selected>Chọn</option>
                                        </select>
                                        @if($errors->has('diachi'))
                                        <span class="text-danger">Tỉnh thành phải có giá trị</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="comment">Quận Huyện:</label>
                                        <select class="custom-select" id="district">
                                            <option selected>Chọn</option>
                                        </select>
                                        @if($errors->has('diachi'))
                                        <span class="text-danger">Quận huyện phải có giá trị</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="comment">Phường Xã:</label>
                                        <select class="custom-select" id="ward">
                                            <option selected>Chọn</option>
                                        </select>
                                        @if($errors->has('diachi'))
                                        <span class="text-danger">Phường xã phải có giá trị</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="diachi" id="result" class="form-control">
                                        <input type="hidden" name="price" id="price" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="comment">Số Nhà Tên Đường:</label>
                                        <textarea class="form-control" name="sonha" rows="5" id="comment"></textarea>
                                        @if($errors->has('diachi'))
                                        <span class="text-danger">Số nhà tên đường phải có giá trị</span>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary" onmouseover="getprice()">Đặt hàng</button>
                                    
                                   
                                </form>
                                @endif
                                @if($order->Status == 0)
                                    <h1 class="h3 mb-1 text-gray-800">Thanh Toán</h1>
                                    <form action="/pay_vnpay" method="POST" style="margin-top: 15px;">
                                            @csrf
                                            <input type="hidden" name="id" id="" class="form-control" value="{{$order->id}}">
                                            <input type="hidden" name="price" class="form-control" value="{{$order->price}}">
                                            {{-- <input hidden name="price" id="price"><input> --}}
                                            {{-- <input hidden name="id" value="" ><input> --}}
                                            <button href="/pay_vnpay" type="submit" name="redirect" class="btn btn-outline-primary">Thanh Toán VNPay</button>
                                            <a href="/payment/order={{$order->id}}" class="btn btn-outline-primary">Thanh Toán Trực Tiếp</a>
                                    </form>
                                @endif
                                @if($order->Status == 1)
                                    <h1 class="h3 mb-1 text-gray-800">Đã thanh toán</h1>
                                    <a href="cancel/order={{$order->id}}" class="btn btn-outline-danger">Hủy Đơn Hàng</a>
                                @endif
                                @if($order->Status ==2 )
                                <h1 class="h3 mb-1 text-gray-800">Chờ Giao</h1>
                                <p>Dự kiến giao: {{$order->date_receipt}}</p>
                                @endif
                                @if($order->Status ==3 )
                                <h1 class="h3 mb-1 text-gray-800">Đơn Hàng Đã Hoàn Thành</h1>
                                @endif
                                </div> 
                                {{-- <div></div>   --}}
                            @if($order->Status != -1)    
                            <div class="col-lg-6">
                                <h1 class="h3 mb-1 text-gray-800">Đơn Hàng</h1>
                                @if (session('wanning'))
                                    <div class="alert alert-info alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            {{session('wanning')}}
                                    </div>
                                @endif
                                @foreach ($detail_orders as $detail_order )
                                <div class='card mb-4 py-3 border-bottom-primary' style='padding-top: 0rem!important; padding-bottom: 0rem!important;' >
                                    <div class='row' style='position: relative'>                               
                                        <div class='col-3' >
                                            <img src='backend/img/{{$detail_order->products['poster']}}' style='margin-left:10px' width='100%' height='100%' alt=''>
                                        </div> 
                                        <div class='col-8'>
                                            <a>{{$detail_order->products['name']}} <b style="font-size: 20px">x {{$detail_order->quantity}}</b></a>
                                            <p>{{$detail_order->products['price']}}</p>                                                    
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <h3>Tổng tiền: {{$order->price}}$</h3>
                            </div>
                            
                            </div>
                             @endif
                             
                       </div>
                      @endforeach              
                    </div>         
                <!-- /.container-fluid -->
                </div>           
                <!-- Begin Page Content -->
                
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
            
            </div>
            <!-- End of Content Wrapper -->
            
        </div>
            <!-- End of Page Wrapper -->
            
            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
            </a>
            
            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout">Đăng xuất</a>
                </div>
            </div>
            </div>
            </div>
                </div>
                    
            
            <!-- Bootstrap core JavaScript-->
            <script src="{{('frontend/vendor/jquery/jquery.min.js')}}"></script>
            <script src="{{('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
            
            <!-- Core plugin JavaScript-->
            <script src="{{('frontend/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
            
            <!-- Custom scripts for all pages-->
            <script src="{{('frontend/js/sb-admin-2.min.js')}}"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js" integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="{{('frontend/js/tinhthanh.js')}}"></script>
            <!-- Page level plugins -->
           {{-- <script src="{{('frontend/vendor/chart.js/Chart.min.js')}}"></script> --}}
            
            <!-- Page level custom scripts -->
            {{-- <script src="{{('frontend/js/demo/chart-area-demo.js')}}"></script> --}}
            
            </body>
            
    </html>