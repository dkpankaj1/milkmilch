<x-delete-confirm  :route="route('admin.customers.destroy',$customer)">
    <h5 class="text-center">Are you sure!! you want to delete <span class="text-danger">{{$customer->user->name}} </span> ?</h5>
</x-delete-confirm>