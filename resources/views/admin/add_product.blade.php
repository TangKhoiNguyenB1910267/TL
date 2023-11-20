<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Thêm sản phẩm</title>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <link href="{{('../frontend/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Custom styles for this template-->
    <link href="{{('../frontend/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </head>
  <body class="bg-gradient-primary">
    <div class="container">
        @if (session('success'))
            <div class="alert alert-dismissible alert-success fale show" style="margin-top:30px;" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                <h4 class="alert-headling">Success!</h4>
                <p class="mb-0">New product was added successfully!</p>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div><a href="/admin/products-show"><i class="fa fa-arrow-left"></i></a></div>
                            <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Thêm sản phẩm mới!</h1>
                            </div>
                        <form class="" method="POST" action="add_product_after" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input name="product-name" type="text" class="form-control" placeholder="Product-name...">
                                @if($errors->has('product-name'))
                                <span class="text-danger">{{ $errors->first('product-name') }} </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input name="price" type="text" class="form-control" placeholder="Price...">
                                @if($errors->has('price'))
                                <span class="text-danger">{{ $errors->first('price') }} </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input name="quantity" type="text" class="form-control" placeholder="quantity...">
                                @if($errors->has('quantity'))
                                <span class="text-danger">{{ $errors->first('quantity') }} </span>
                                @endif
                            </div>
                                <div class="form-group" >
                                <select name="firm" class="form-select" aria-label="Default select example">
                                    <option value="">choose a firm: </option>
                                    @foreach ($firms as $firm )
                                     <option value="{{$firm->id}}">{{$firm->name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('firm'))
                                <span class="text-danger">{{ $errors->first('firm') }} </span>
                                @endif
                            </div>
                            <div class="form-group">                             
                                <label  class="form-label" for="customFile">poster:</label>
                                <input name="poster" accept="image/*" type="file" class="form-control" id="customFile"/>
                                @if($errors->has('poster'))
                                <span class="text-danger">{{ $errors->first('porter') }} </span>
                                @endif
                            </div>
                            <div class="form-group">                             
                                <label  class="form-label" for="customFile">image:</label>
                                <input name="image[]" accept="image/*" type="file" class="form-control" id="customFile" multiple />
                                @if($errors->has('image'))
                                <span class="text-danger">{{ $errors->first('image') }} </span>
                                @endif
                            </div>
                            <h6>Description:</h6>                
                            <textarea name="Description" id="summernote"></textarea> 
                            @if($errors->has('Description'))
                            <span class="text-danger">{{ $errors->first('Description') }} </span>
                            @endif
                            <hr>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            add new products
                        </button>
                        </form>
                        </div>      
                   </div>
                </div>
            </div>
        </div>
    </div>
   
    <script>
      $('#summernote').summernote({
        placeholder: 'Thêm thông tin...',
        tabsize: 2,
        height: 120,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['codeview','help']]
        ]
      });

    </script>
  </body>
        <script src="{{('../frontend/vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{('../frontend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{('../frontend/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{('../frontend/js/sb-admin-2.min.js')}}"></script>
</html>