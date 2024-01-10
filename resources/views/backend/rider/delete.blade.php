<x-delete-confirm  :route="route('admin.riders.destroy',$rider)">
    <h5 class="text-center">Are you sure!! you want to delete <span class="text-danger">{{$rider->user->name}} </span> ?</h5>
</x-delete-confirm>