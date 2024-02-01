<x-delete-confirm  :route="route('admin.milks.destroy',$milk)">
    <h5 class="text-center">Are you sure!! you want to delete <span class="text-danger">{{$milk->name}} </span> ?</h5>
</x-delete-confirm>