<ul class="item_search_list border">
    @foreach($milks as $key => $item )
    <li class="px-3" onclick="addItem({{$item->id}})">[ mp-{{$item->id}} ] :: [ {{$item->name}} ]</li>
    @endforeach
</ul>