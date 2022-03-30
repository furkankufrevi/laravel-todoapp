@extends('layouts.app')
@section('title', 'ToDoApp')
@section('description', 'ToDoApp Index Page.')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h2>ToDoList Edit</h2>
            </div>
            <div class="col-md-2 text-end">
                <a class="btn btn-primary" id="showhidebtn" onclick="return showForm();">Add</a>
            </div>
            <div class="col-md-12">
                <table class="table text-white table-responsive">
                    <thead>
                    <tr  class="bg-dark">
                        <th scope="col">#</th>
                        <th scope="col">ToDo</th>
                        <th scope="col">Due Date</th>
                        <th scope="col">Earnings</th>
                        <th scope="col">Is It Done?</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Action</th>
                    </tr>
                    <tr class="bg-secondary" id="Form" style="display: none;">
                        <th scope="row"></th>
                        <form action="" onsubmit="return addList();">
                            @csrf
                            <td>
                                <div class="form-group">
                                    <textarea class="form-control" id="todo" rows="1"></textarea>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="date" id="due_date" class="form-control">
                                </div>
                            </td>
                            <td>
                                <div class="input-group flex-nowrap">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="addon-wrapping">$</span>
                                    </div>
                                    <input type="number" class="form-control" aria-describedby="addon-wrapping" id="earnings">
                                </div>
                            </td>
                            <td>
                                No
                            </td>
                            <td>
                                Will Generated
                            </td>
                            <td>
                                <button class="btn btn-success" type="submit">Save</button>
                            </td>
                        </form>
                    </tr>

                    <tr class="bg-secondary" id="editForm">

                    </tr>

                    </thead>
                    <tbody id="todolist">
                        @include('partials.todolist')
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        //Formu Gösterip Gizleme Fonksiyonu
        function showForm(){
            //Gözükmüyorsa göster
            if(!$('#Form').is(':visible'))
            {
                $("#Form").show();
                $('#showhidebtn').text('Cancel');
                //Eğer gözüküyorsa gizle
            }else{
                $("#Form").hide();
                $('#showhidebtn').text('Add');
            }
            return false;
        }

        function addList(n){
            var formData = new FormData();
            formData.append('_token', $("input[name=_token]").val());

            //Eğer id gönderildiyse güncelleme.
            if (n>0){
                formData.append('todo', $("#todo_edit").val());
                formData.append('due_date', $("#due_date_edit").val());
                formData.append('earnings', $("#earnings_edit").val());
                formData.append('id', n);
                //Eğer id yoksa yeni ekleme.
            }else{
                formData.append('todo', $("#todo").val());
                formData.append('due_date', $("#due_date").val());
                formData.append('earnings', $("#earnings").val());
                formData.append('id', 0);
            }
            //Ajax.
            $.ajax({
                url: '/listing-operations/add',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (data)
                {
                    //Başarılı Mesajı
                    toastr.success(data.message)
                    //id ile datayı güncelledik.
                    $("#todolist").html(data.html);
                    //Formları gizledik.
                    $("#editForm").hide();
                    $("#Form").hide();
                },
                error: function (data){
                    var err = data.responseJSON.errors;
                    $.each(err, function(index, value) {
                        toastr.error(value)
                    });

                }

            });
            return false;
        }
        function removeList(n){
            var formData = new FormData();
            formData.append('_token', $("input[name=_token]").val());
            formData.append('id', n);
            $.ajax({
                url: '/listing-operations/remove',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (data)
                {
                    toastr.success('Listing Deleted Succesfully')
                    $("#todolist").html(data.html);
                },
            });
            return false;
        }

        function checkList(n){
            var formData = new FormData();
            formData.append('_token', $("input[name=_token]").val());
            formData.append('id', n);
            $.ajax({
                url: '/listing-operations/check',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (data)
                {
                    toastr.success(data.responsestatus)
                    $("#todolist").html(data.html);
                },
            });
            return false;
        }

        function editList(n){
            var formData = new FormData();
            formData.append('_token', $("input[name=_token]").val());
            formData.append('id', n);
            $.ajax({
                url: '/listing-operations/show-edit-form',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (data)
                {
                    toastr.success('You can edit the entry on the top of the table.')
                    $("#editForm").html(data.html);
                    $("#editForm").show();
                },
            });
            return false;
        }
    </script>

@endsection
