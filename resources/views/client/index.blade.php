@include('inc.nav-index')
                <!-- End of Topbar -->
                <div style="margin-top: 100px">
                    @include('inc.chose-search')
                    <div class="container" id="df">
                      <!-- <a href="https://www.facebook.com/messages/t/108137762135720" style="position: fixed; margin-left: 75%; margin-top: 37%;"> <img class="fb-chat" src="https://shopfront-cdn.tekoapis.com/static/a8e347d31db4d701.png" alt="fb-chat"  style=""></a> -->
                      <!--Start of Fchat.vn--><script type="text/javascript" src="https://cdn.fchat.vn/assets/embed/webchat.js?id=65576ed4b03ec742f0660d18" async="async"></script><!--End of Fchat.vn-->  
                      <!-- Page Heading -->                         
                        <div id="demo" class="carousel slide" data-ride="carousel" >
                            <ul class="carousel-indicators">
                              <li data-target="#demo" data-slide-to="0" class="active"></li>
                              <li data-target="#demo" data-slide-to="1"></li>
                              <li data-target="#demo" data-slide-to="2"></li>
                            </ul>
                            <div class="carousel-inner">
                              <div class="carousel-item active">
                                <img src="https://www.gameaxis.com/wp-content/uploads/2018/04/MSI_GE73RaiderRGB.jpg" alt="MSI_GE73RaiderRGB" width="1100" height="500">
                                <div class="carousel-caption">
                                  <h3>MSI_GE73RaiderRGB</h3>
                                  <p>Up to 8th Gen. Intel® Core™ i7 Processor
                                    <br>
                                    GeForce® GTX 1060 with 6GB GDDR5
                                  </p>
                                </div>   
                              </div>
                              <div class="carousel-item">
                                <img src="https://lh5.googleusercontent.com/YIBKbYsSqerLxIyh70nHCC9dJwJwyFLKc-bLuIaDNdAw30I1A9Bl33B3QfjJ_1gxkR7DX2pSAheid-sW-451TKLPrrSssTKlIQk8-5NqH-EyuVxuvBtWCcYA1SwtSzVJ5uE48IVO" alt="" width="1100" height="500">
                                <div class="carousel-caption">
                                  <h3>Acer Predator Helios 300 gaming</h3>
                                  <p>RTX 3070 GPU, DTS-X Ultra launched: Price in India, features</p>
                                </div>   
                              </div>
                              <div class="carousel-item">
                                <img src="https://gearopen.com/wp-content/uploads/2021/05/Untitled-194.png" alt="New York" width="1100" height="500">
                                <div class="carousel-caption">
                                  <h3>Inside Acer Nitro 5 (AN515-55)</h3>
                                  <p>Intel® Core™ i7-10750H
                                    <br>
                                    GeForce® GTX 1650 Ti with 8GB GDDR4</p>
                                </div>   
                              </div>
                            </div>
                            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                              <span class="carousel-control-prev-icon"></span>
                            </a>
                            <a class="carousel-control-next" href="#demo" data-slide="next">
                              <span class="carousel-control-next-icon"></span>
                            </a>
                        </div>
                        @foreach ($firms as $firm)
                        @if($firm->products->toArray() != null)
                        
                        <h2 style="margin-top: 30px">{{$firm->name}}
                        </h2>
                        <div class="row">
                        @php $i=1; @endphp
                        @foreach ($firm->products as $product)
                        @php $i++; @endphp
                             
                                <div class="card" style="width: 23%; margin:1% 1%;">
                                  
                                   
                                    <img class="card-img-top" src="backend/img/{{$product->poster}}">
                                  <div class="card-body">
                                    <a href="detail-{{$product->id}}" style="color: black; text-decoration: none;">
                                    <h6 class="card-title">{{$product->name}}</h6>
                                    <p style="color: red;" class="card-text"><b>${{$product->price}}</b> </p>
                                    </a>
                                   
                                  </div>
                                  @if(session('user'))
                                    <a  class="btn btn-primary card-footer" onclick="addCart({{$product->id}})" ><i class="fa fa-cart-plus" aria-hidden="true"></i> Thêm vào giỏ hàng</a>
                                  @else
                                  <a  class="btn btn-primary card-footer" href="addcart/c={{$product->id}}" ><i class="fa fa-cart-plus" aria-hidden="true"></i> Thêm vào giỏ hàng</a>
                                  @endif

                                 </div>
                                               
                            
                          @if ($i == 5)
                          @php $i=1; @endphp
                          @break 
                          @endif
                      
                        @endforeach
                        </div>
                         @endif
                        @endforeach 
                    </div>   
                   
                </div>
               
               
                          
                <!-- /.container-fluid -->          
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