<th scope="row"></th>
<form id="editlist" onsubmit="return addList({{$item->id}});">
    @csrf
    <td>
        <div class="form-group">
            <textarea class="form-control" id="todo_edit" rows="1">{{$item->todo}}</textarea>
        </div>
    </td>
    <td>
        <div class="form-group">
            <input type="date" id="due_date_edit" class="form-control" value="{{$item->due_date}}">
        </div>
    </td>
    <td>
        <div class="input-group flex-nowrap">
            <div class="input-group-prepend">
                <span class="input-group-text" id="addon-wrapping">$</span>
            </div>
            <input type="number" class="form-control" aria-describedby="addon-wrapping" id="earnings_edit" value="{{$item->earnings}}">
        </div>
    </td>
    <td>
        {{$item->done == 1 ? 'Yes' : 'No'}}
    </td>
    <td>
        {{$item->created_at->format('d.m.Y')}}
    </td>
    <td>
        <button class="btn btn-success" type="submit" form="editlist">Save</button>
    </td>
</form>
