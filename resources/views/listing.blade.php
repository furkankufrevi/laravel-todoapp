@extends('layouts.app')
@section('title', 'ToDoApp')
@section('description', 'ToDoApp Index Page.')

@section('content')
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <h2>ToDoList</h2>
                </div>
                <div class="col-md-2 text-end">
                    <a class="btn btn-primary" href="{{route('listing.edit')}}">Edit</a>
                </div>
                <div class="col-md-12" id="todolist">
                    <table class="table text-white table-responsive">
                        <thead>
                        <tr  class="bg-dark">
                            <th scope="col">#</th>
                            <th scope="col">ToDo</th>
                            <th scope="col">Due Date</th>
                            <th scope="col">Earnings</th>
                            <th scope="col">Is It Done?</th>
                            <th scope="col">Created At</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($todolist as $entry)
                            <tr class="{{$entry->done == 1 ? 'bg-success' : 'bg-primary'}}">
                                <th scope="row">{{$loop->iteration}}</th>
                                <td >{{$entry->todo}}</td>
                                <td>{{$entry->due_date}}</td>
                                <td>{{number_format($entry->earnings)}}$</td>
                                <td>{{$entry->done == 1 ? 'Yes' : 'No'}}</td>
                                <td>{{$entry->created_at}}</td>
                            </tr>
                        @endforeach

                        @if(count($todolist) == 0)
                            <tr class="bg-danger">
                                <td colspan="6"><h5 class="text-center">No Entries Found</h5></td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection
