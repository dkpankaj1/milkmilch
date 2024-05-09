<tr id="row_{{$milk->id}}">
    <td>
         <span class="form-control">{{$milk->name}}</span> <input name="product[name][]" class="d-none" value="{{$milk->name}}" /> 
         <input type="hidden" name="product[id][]" value="{{$milk->id}}">
    </td>
    <td> <input type="number" step="any" class="form-control fat-content" name="product[fat_content][]" value="{{$milk->fat_content}}"/> </td>
    <td> <input type="number" step="any" class="form-control shelf-life" name="product[shelf_life][]" value="{{$milk->shelf_life}}"/> </td>
    <td> <input type="number" step="any" class="form-control volume" name="product[volume][]" value="{{$milk->volume}}"/> </td>
    <td> <input type="number" step="any" class="form-control mrp" name="product[mrp][]" value="{{$milk->mrp}}"/> </td>
    <td> <input type="number" step="any" class="form-control mop" name="product[mop][]" value="{{$milk->mop}}"/> </td>
    <td> <input type="number" step="any" class="form-control total-amt" name="product[total_amt][]" value="{{number_format((($milk->volume)/1000) * $milk->mrp,2)}}" readonly /> </td>
    <td> <button type="button" class="btn btn-outline btn-danger" onclick="removeItem(this)"><i class="bi bi-trash"></i></button></td>
</tr>