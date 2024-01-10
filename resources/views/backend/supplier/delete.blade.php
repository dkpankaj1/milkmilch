<x-delete-confirm  :route="route('admin.suppliers.destroy',$supplier)">
    <h5 class="text-center">Are you sure!! you want to delete <span class="text-danger">{{$supplier->user->name}} </span> ?</h5>
</x-delete-confirm>