@include('inc.nav')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Nhà Cung Cấp</h1>
    <p class="mb-4">Mội chi tiết vui lòng liên hệ với Facebook <a target="_blank"
            href="https://www.facebook.com/profile.php?id=100007844027831">Khôi Nguyên</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh Mục Nhà Cung Cấp</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>quantity of product</th>
                            <th>Date added</th>
                            <th>Updated date</th>
                            {{-- <th></th> --}}
                            <th>Method</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>quantity of product</th>
                            <th>Date added</th>
                            <th>Updated date</th>
                            {{-- <th></th> --}}
                            <th><button class="btn btn-success"  data-toggle="modal" data-target="#add" >add firm</button></th>
                        </tr>
                    </tfoot>
                    <tbody>
                            @foreach($firms as $firm)
                               <tr>
                                <td>{{$firm->name}}</td>
                                <td>{{$firm->products_count}}</td>
                                <td>{{$firm->created_at}}</td>
                                <td>{{$firm->updated_at}}</td>
                                <td><button class="btn btn-warning" data-toggle="modal" data-target="#edit{{$firm->id}}">edit firm</button></td>
                                </tr>
                                <div class="modal" id="edit{{$firm->id}}">
                                    <div class="modal-dialog">
                                      <div class="modal-content">                                 
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                          <h4 class="modal-title">Edit Firm</h4>
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form action="./firms-show/edit" method="POST">
                                                @csrf
                                                <input name="id" type="hidden" value="{{$firm->id}}">
                                                <label for="inputPassword5" class="form-label">Firm name</label>
                                            <input type="text" name='name' class="form-control">
                                            @if($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>  
                                        <!-- Modal footer -->
                                            <div class="modal-footer">                                           
                                                <button class="btn btn-warning" type="submit">Edit</button>
                                            </div> 
                                            </form>
                                      </div>
                                    </div>
                                </div>                                  
                            @endforeach
                    </tbody>
                </table>
                <div class="modal" id="add">
                    <div class="modal-dialog">
                      <div class="modal-content">                                 
                        <!-- Modal Header -->
                        <div class="modal-header">
                          <h4 class="modal-title">Add Firm</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        
                        <!-- Modal body -->
                        <div class="modal-body">
                            <form action="./firms-show/add" method="POST">
                                @csrf
                                <label for="inputPassword5" class="form-label">Firm name</label>
                            <input type="text" name='name' class="form-control">
                            @if($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>  
                        <!-- Modal footer -->
                            <div class="modal-footer">                                           
                                <button type="submit" class="btn btn-success">Add</a>
                            </div> 
                            </form>
                      </div>
                    </div>
                </div>  
            </div>
        </div>
  
    </div>
</div> 
</div>
@include('inc.footer')