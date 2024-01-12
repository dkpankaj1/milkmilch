<x-delete-confirm  :route="route('admin.currencies.destroy',$currency)">
    <h5 class="text-center">Are you sure!! you want to delete <span class="text-danger">{{$currency->name}} </span> ?</h5>
</x-delete-confirm>