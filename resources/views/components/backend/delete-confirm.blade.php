@props(['route'])
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Confirm Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
    </div>
    <form action="{{$route}}" method="post">
        <div class="modal-body">
            @csrf
            @method('DELETE')
            {{$slot}}
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger">Yes, Delete</button>
        </div>
    </form>
</div><!-- /.modal-content -->


