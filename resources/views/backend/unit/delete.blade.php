<x-delete-confirm  :route="route('admin.units.destroy',$unit)">
    <h5 class="text-center">Are you sure!! you want to delete <span class="text-danger">{{$unit->name}} </span> ?</h5>
</x-delete-confirm>