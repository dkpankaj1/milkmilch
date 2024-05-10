<x-delete-confirm  :route="route('admin.batches.destroy',$batch)">
    <h5 class="text-center">Are you sure!! you want to delete <span class="text-danger">{{$batch->batch_code}} </span> ?</h5>
</x-delete-confirm>