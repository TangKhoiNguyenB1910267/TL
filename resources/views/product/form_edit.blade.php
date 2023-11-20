<form class="" method="POST" action="edit_product" enctype="multipart/form-data">
        @csrf
        <input name="id" type="hidden" value="{{$product->id}}" >
        <div class="form-group">
            <input name="product-name" value='{{$product->name}}' type="text" class="form-control" placeholder="Product-name...">
        </div>
        <div class="form-group">
            <input name="price" value='{{$product->price}}' type="text" class="form-control" placeholder="Price...">
        </div>
            <div class="form-group" >
            <select name="firm" class="form-select" aria-label="Default select example">
                <option value="{{$product->firm['name']}}">{{$product->firm['name']}} </option>
                @foreach ($firms as $firm)
                    <option value="{{$firm->id}}">{{$firm->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">                             
            <label  class="form-label" for="customFile">poster:</label>
            <input name="poster" accept="image/*" type="file" class="form-control" id="customFile"/>
        </div>
        <div class="form-group">                             
            <label  class="form-label" for="customFile">image:</label>
            <input name="image[]" accept="image/*" type="file" class="form-control" id="customFile" multiple />
        </div>
        <h6>Description:</h6>                
        <textarea name="Description" id="summernote{{$product->id}}"></textarea> 
        <hr>
    <button type="submit" class="btn btn-warning btn-user btn-block">
        Edit products
    </button>
</form>