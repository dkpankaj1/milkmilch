<x-delete-confirm  :route="route('admin.sells.destroy',$sell)">
    <h5 class="text-center">Are you sure!! you want to delete <span class="text-danger">S-{{$sell->id}} </span> ?</h5>
</x-delete-confirm>