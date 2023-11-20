@include('inc.nav')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Sản Phẩm</h1>
    <p class="mb-4">Mội chi tiết vui lòng liên hệ với Facebook <a target="_blank"
            href="https://www.facebook.com/profile.php?id=100007844027831">Khôi Nguyên</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh Sách Sản Phẩm</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Poster</th>
                            <th>Price</th>
                            <th>amount</th>
                            <th>Firm</th>
                            <th>Date added</th>
                            <th>Method</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Poster</th>
                            <th>Price</th>
                            <th>amount</th>
                            <th>Firm</th>
                            <th>Date added</th>
                            <th>Method</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @php $i=1; @endphp
                        @forelse ($products as $product)
                        <tr>
                            <td> {{$product->name}}</td>
                            <td> 
                            <img src="../backend/img/{{$product->poster}}" alt="" width="100px" height="100px" >
                            </td>
                            <td> {{$product->price}}$</td>
                            <td>{{$product->quantity}}</td>
                            <td>{{$product->firm['name']}}</td>
                            <td> {{$product->created_at}}</td>
                            <td width="250px">
                            <button  class="btn btn-warning btn-icon-split" data-toggle="modal" data-target="#myModal{{$product->id}}">
                                <span class="icon text-white-50">
                                        <i class="fas fa-exclamation-triangle"></i>
                                </span>
                                <span class="text">Edit</span>
                            </button>    
                            <button  class="btn btn-danger btn-icon-split" data-toggle="modal" data-target="#Remove{{$product->id}}">
                                <span class="icon text-white-50">
                                    <i class="fas fa-trash"></i>
                                </span>
                                <span class="text">Remove</span>
                            </button>
                            </td>
                        </tr>
                        <div class="modal" id="myModal{{$product->id}}">
                                <div class="modal-dialog">
                                  <div class="modal-content">                                 
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                      <h4 class="modal-title">Edit product</h4>
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <div class="">
                                            @include('product.form_edit')
                                        </div>
                                        <script>
                                            $('#summernote{{$product->id}}').summernote({
                                              placeholder: 'Hello stand alone ui',
                                              tabsize: 2,
                                            //   value: $('#summernote{{$product->id}}').val(),
                                              height: 120,
                                              toolbar: [
                                                ['style', ['style']],
                                                ['font', ['bold', 'underline', 'clear']],
                                                ['color', ['color']],
                                                ['para', ['ul', 'ol', 'paragraph']],
                                                ['table', ['table']],
                                                ['insert', ['link', 'picture', 'video']],
                                                ['view', ['fullscreen', 'codeview', 'help']]
                                              ]
                                            });
                                          </script>
                                    </div>  
                                    <!-- Modal footer -->
                           
                                  </div>
                                </div>
                            </div>
                            <div class="modal" id="Remove{{$product->id}}">
                                <div class="modal-dialog">
                                  <div class="modal-content">                                 
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                      <h4 class="modal-title">Remove product</h4>
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <h6>Bạn có chắc muốn xóa sản phẩm {{$product->name}} không?</h6>
                                    </div>  
                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button class="btn btn-info" data-dismiss="modal" >Không</button>
                                        <a class="btn btn-danger" href="delete/{{{$product->id}}}" >Xóa</a>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            
                        @empty
                            <tr>
                                <td colspan="5" class="text-center"></td>
                            </tr>                           
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
  
    </div>
</div> 
</div>
@include('inc.footer')