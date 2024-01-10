<x-delete-confirm  :route="route('admin.users.destroy',$user->id)">
    <h5 class="text-center">Are you sure!! you want to delete <span class="text-danger">{{$user->name}} </span> ?</h5>
</x-delete-confirm>