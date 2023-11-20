@include('inc.nav-index')
                <!-- End of Topbar -->
                <div style="margin-top: 100px">
                    <div class="container" id="df" style="min-height: 1000px">
                       <!-- Page Heading -->
                        <div class="row">  
                            @foreach ($orders as $order)
                                <a href="views_detail_cart={{$order->id}}" style="text-decoration: none;
                                    color: black;" class='col-6 card mb-4 py-3 border-bottom-primary'>
                                    <div class='row' style='position: relative'>                               
                                       <div class="col-1"></div> 
                                        <div class='col-10'>
                                            {{-- <h4>{{$order->id}}</h4> --}}
                                            @foreach ($order->Address as $address)
                                                <h5>{{$address->address}}</h5>
                                            @endforeach
                                            @if($order->Status == 0)
                                                <span class="badge badge-pill badge-warning">Chưa Chọn Phương Thức Thanh Toán</span>
                                            @endif
                                            @if($order->Status == 1)
                                                <span class="badge badge-pill badge-secondary">Chờ Duyệt</span>
                                            @endif
                                            @if($order->Status == 2)
                                                <span class="badge badge-pill badge-info">Chờ Giao</span>
                                            @endif
                                            @if($order->Status == 3)
                                                <span class="badge badge-pill badge-info">Hoàn Thành</span>
                                            @endif
                                            <p>giá: {{$order->price}}</p>                                                    
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div> 
                       
                                    
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