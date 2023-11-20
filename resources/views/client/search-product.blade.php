@include('inc.nav-index')
                <!-- End of Topbar -->
                <div style="margin-top: 100px">
                    @include('inc.chose-search')
                    <div class="container" id="df">
                        <!-- Page Heading -->                         
                        <h2 style="margin-top: 30px">{{$name}}
                        </h2>
                        <div class="row" style="text-align: center">
                        @foreach ($products as $product)
                        {{-- {{$products->product}}                           --}}
                        @endforeach 
                        @forelse ($product->products as $pro)
                            <div class="card" style="width: 23%; margin:1% 1%;">
                                
                            <img class="card-img-top" src="backend/img/{{$pro->poster}}">
                            <div class="card-body">
                            <a href="detail-{{$product->id}}" style="color: black; text-decoration: none;">
                              <h6 class="card-title">{{$pro->name}}</h6>
                              <p style="color: red;" class="card-text"><b>${{$pro->price}}</b> </p></a>
                             
                              
                            
                            </div>
                            @if(session('user'))
                            <a class="btn btn-primary card-footer" onclick="addCart({{$pro->id}})"><i class="fa fa-cart-plus" aria-hidden="true"></i> Thêm vào giỏ hàng</a>
                            @else
                            <a class="btn btn-primary card-footer" href="addcart/c={{$pro->id}}"><i class="fa fa-cart-plus" aria-hidden="true"></i> Thêm vào giỏ hàng</a>
                            @endif                            
                            </div>
                         
                        
                          @empty
                          <h2 style="margin: 10% 35%">Không có sản phẩm tồn tại</h2> 
                       
                        @endforelse 
                    </div>
                
                <!-- /.container-fluid -->
                </div>
                <!-- Begin Page Content -->
                
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
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
            
            <!-- Page level plugins -->
           {{-- <script src="{{('frontend/vendor/chart.js/Chart.min.js')}}"></script> --}}
            
            <!-- Page level custom scripts -->
            {{-- <script src="{{('frontend/js/demo/chart-area-demo.js')}}"></script> --}}

            </body>
            
    </html>