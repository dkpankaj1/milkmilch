<x-delete-confirm  :route="route('admin.transaction.destroy',$transaction)">
    <h5 class="text-center">Are you sure!! you want to delete <span class="text-danger">S-{{$transaction->id}} </span> ?</h5>
</x-delete-confirm>