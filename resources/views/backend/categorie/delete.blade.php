<x-delete-confirm  :route="route('admin.categories.destroy',$category)">
    <h5 class="text-center">Are you sure!! you want to delete <span class="text-danger">{{$category->name}} </span> ?</h5>
</x-delete-confirm>