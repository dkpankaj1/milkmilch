<x-delete-confirm  :route="route('admin.milk-purchases.destroy',$milkPurchase)">
    <h5 class="text-center">Are you sure!! you want to delete <span class="text-danger">MP-{{$milkPurchase->id}} </span> ?</h5>
</x-delete-confirm>