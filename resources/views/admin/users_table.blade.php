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
                            <th>Code</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Date added</th>
                            <th>Method</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Date added</th>
                            <th>Method</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <th>{{$user->id}}</th>
                            <th>{{$user->name}}</th>
                            <th>{{$user->email}}</th>
                            <th>{{$user->created_at}}</th>
                            <th><button class="btn btn-danger" data-toggle="modal" data-target="#myModa{{$user->id}}">Delete</button></th>
                        </tr>
                        <div class="modal" id="myModa{{$user->id}}">
                            <div class="modal-dialog">
                              <div class="modal-content">
                          
                                <!-- Modal Header -->
                                <div class="modal-header">
                                  <h4 class="modal-title">Modal Heading</h4>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                          
                                <!-- Modal body -->
                                <div class="modal-body">
                                 Bạn có chăc chắn xóa user {{$user->name}}
                                </div>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                  <a href="./delete_user/{{$user->id}}" type="button" class="btn btn-primary">Xác nhận</a>
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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

@include('inc.footer')