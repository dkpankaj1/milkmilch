<ul class="item_search_list border">
    @foreach($products as $key => $product )
    <li class="px-3" onclick="addItem({{$product->id}})"> {{$product->code}} &nbsp;/&nbsp; {{$product->name}}</li>
    @endforeach
</ul>