<tr>
    <td>
         <span class="form-control">{{$product->name}}</span> <input name="product[name][]" class="d-none" value="{{$product->name}}" /> 
         <input type="hidden" name="product[id][]" value="{{$product->id}}">
    </td>
    <td> <input type="number" class="form-control shelf-life" name="product[shelf_life][]" value="{{$product->shelf_life}}"/> </td>
    <td> <input type="number" class="form-control volume" name="product[volume][]" value="{{$product->volume}}"/> </td>
    <td> <input type="number" class="form-control mop" name="product[quentity][]" value="0"/> </td>
    <td> <input type="number" class="form-control mrp" name="product[mrp][]" value="{{$product->mrp}}"/> </td>
    <td> <button type="button" class="btn btn-outline btn-danger" onclick="removeItem(this)"><i class="bi bi-trash"></i></button></td>
</tr>