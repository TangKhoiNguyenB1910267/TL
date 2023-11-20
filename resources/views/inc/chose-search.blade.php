<div class="list-group col-2 "  style="width: 100%; position: fixed; z-index: 2;">
    <div class="dropdown dropright"style="position: fixed;">
            <a type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                Thương Hiệu Laptop
            </a>
            <div class="dropdown-menu">
                @foreach ($firms as $firm)
                    <a href="/firm-{{$firm->name}}" class="list-group-item list-group-item-action dropdown-item">{{$firm->name}}</a>
                @endforeach
            </div>
    </div>
    <div class="dropdown dropright" style="position: fixed; margin-top: 50px; width: 186.22px;">
        <a type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="width: 100%; text-align: right;">
               Giá Laptop   
        </a>
        <div class= 'dropdown-menu'>
            <a href="/0&500" class="list-group-item list-group-item-action dropdown-item">500$<</a>
            <a href="/500&1000" class="list-group-item list-group-item-action dropdown-item">500$-1000$</a>
            <a href="/1000&1500" class="list-group-item list-group-item-action dropdown-item">1000$-1500$</a>
            <a href="/1500&2000" class="list-group-item list-group-item-action dropdown-item">1500$-2000$</a>
            <a href="/2000&2500" class="list-group-item list-group-item-action dropdown-item">2000$-2500$</a>
            <a href="/2500&3000" class="list-group-item list-group-item-action dropdown-item">2500$-3000$</a>
            <a href="/3000&3500" class="list-group-item list-group-item-action dropdown-item">3000$-3500$</a>
            <a href="/3500&4000" class="list-group-item list-group-item-action dropdown-item">3500$-4000$</a>
        </div>
    </div>
</div>


    
