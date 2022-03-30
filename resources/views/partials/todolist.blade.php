@foreach($todolist as $entry)
    <tr class="{{$entry->done == 1 ? 'bg-success' : 'bg-primary'}}">
        <th scope="row">{{$loop->iteration}}</th>
        <td >{{$entry->todo}}</td>
        <td>{{$entry->due_date}}</td>
        <td>{{number_format($entry->earnings)}}$</td>
        <td>{{$entry->done == 1 ? 'Yes' : 'No'}}</td>
        <td>{{$entry->created_at}}</td>
        <td>
            <div class="row">
                <div class="col-md-3">
                    <button onclick="return editList({{$entry->id}});" type="button" class="btn btn-primary btn-sm"><i class="far fa-edit"></i></button>
                </div>
                <div class="col-md-3">
                    @if($entry->done == 1)
                        <button onclick="return checkList({{$entry->id}});"  type="button" class="btn btn-danger btn-sm"><i class="fas fa-x"></i></button>
                    @else
                        <button onclick="return checkList({{$entry->id}});"  type="button" class="btn btn-success btn-sm"><i class="fas fa-check"></i></button>
                    @endif

                </div>
                <div class="col-md-3">
                    <button onclick="return removeList({{$entry->id}});" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                </div>
            </div>
        </td>
    </tr>
@endforeach

@if(count($todolist) == 0)
    <tr class="bg-danger">
        <td colspan="7"><h5 class="text-center">No Entries Found</h5></td>
    </tr>
@endif

<tr>
    <td colspan="7">
        {!! $todolist->links() !!}
    </td>
</tr>
