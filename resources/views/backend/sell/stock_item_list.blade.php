<tr>
    <td>
        <span class="form-control">{{ $stock->product->name }}</span>
        <input type="hidden" name="product[id][]" value="{{ $stock->id }}">
        <input type="hidden" name="product[name][]" value="{{ $stock->product->name }}">
    </td>

    <td> <input type="number" class="form-control available" name="product[available][]" value="{{$stock->available}}" readonly /> </td>

    <td> <input type="number" class="form-control quentity" name="product[quentity][]" value="1" /> </td>

    <td> <input type="number" class="form-control mrp" name="product[mrp][]" value="{{ number_format($stock->mrp) }}" /> </td>

    <td> <input type="number" class="form-control total-amt" name="product[total_amt][]" value="{{ number_format($stock->mrp) }}" readonly /> </td>

    <td> <button type="button" class="btn btn-outline btn-danger" onclick="removeItem(this)"><i class="bi bi-trash"></i></button></td>
    
</tr>
