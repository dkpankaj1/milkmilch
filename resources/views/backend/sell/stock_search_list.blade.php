<ul class="item_search_list border">
    @foreach($stocks as $key => $item )
    <li class="px-3" onclick="addItem({{$item->id}})">{{$item->id}} {{$item->product->name}} / batch - {{$item->batch->batch_code}} / date - {{ Illuminate\Support\Carbon::parse($item->batch->date)->format('Y-m-d')}}</li>
    @endforeach
</ul>