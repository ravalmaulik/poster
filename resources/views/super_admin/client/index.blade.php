@extends('../../layout.master')
@section('content')
    <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
            <!-- Search for small screen-->
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0">{{$page_title}}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12">
            <div class="container">
                <div class="section section-data-tables">
                    <div class="card">
                        <div class="card-content">
                            <div class="poster_table_container">
                                <table id="MainTable" class="display responsive-table">
                                    <thead>
                                        <th>No</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Mobile Number</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                    @if(count($all_client)>0)
                                        @foreach($all_client as $key => $client)
                                        <tr id="tr_{{$client->id}}">
                                            <td></td>
                                            <td>{{$client->FirstName}}</td>
                                            <td>{{$client->LastName}}</td>
                                            <td>{{$client->Email}}</td>
                                            <td>{{$client->MobileNumber}}</td>
                                            <td>
                                                <button class="mb-6 btn-floating btn-small waves-effect waves-light gradient-45deg-purple-deep-orange" onclick="updated_row('{{$client->id}}')">
                                                    <i class="material-icons">edit</i>    
                                                </button>
                                                <button class="mb-6 btn-floating btn-small waves-effect waves-light gradient-45deg-purple-deep-orange" onclick="delete_row('{{$client->id}}')">
                                                    <i class="material-icons delete-mails">delete</i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    <div style="bottom: 60px; right: 19px;" class="fixed-action-btn direction-top">
        <a class="btn-floating btn-large gradient-45deg-light-blue-cyan gradient-shadow waves-effect waves-light modal-trigger" id="add_btn">
            <i class="material-icons">add</i>
        </a>
    </div>
    <!-- Modal Structure -->
    <div id="add_model" class="modal">
        <form method="POST" id="MainForm" action="{{route('client.add')}}">
            <div class="modal-content">
                <div class="row">
                    <div class="col m6 s12">
                    <h4>Add Client</h4>
                    </div>
                    <div class="col m6 s12">
                        <div class="switch right">
                            <label>
                                Inactive
                                <input type="checkbox" name="IsActive" id="IsActive" checked>
                                <span class="lever"></span>Active
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m6">
                        <input id="FirstName" name="FirstName" type="text" required>
                        <label for="FirstName">Enter First Name</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input id="LastName" name="LastName" type="text" required>
                        <label for="LastName">Enter Last Name</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m6">
                        <input id="Email" name="Email" type="email" required>
                        <label for="Email">Enter Email</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input id="MobileNumber" name="MobileNumber" type="number" required>
                        <label for="MobileNumber">Enter Mobile Number</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m6">
                        <input id="Password" name="Password" type="password" required>
                        <label for="Password">Enter Password</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input id="ConfirmPassword" name="confirm_password" type="password" required>
                        <label for="ConfirmPassword">Confirm Password</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <select multiple name="ClientMenu" id="ClientMenu">
                            <!-- <option value="" disabled selected>Select Menu</option> -->
                            @if($client_menus)
                                @foreach($client_menus as $value)
                                <option value="{{$value->id}}">{{$value->MenuName}}</option>
                                @endforeach
                            @endif
                        </select>
                        <label>Select Menu</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" value="Add" class="btn purple">
            </div>
        </form>
    </div>
    <div id="update_model" class="modal">
        <form method="POST" id="update_MainForm" action="{{route('client.add')}}">
            <div class="modal-content">
                <div class="row">
                    <div class="col m6 s12">
                    <h4>Update Client</h4>
                    <input type="hidden" name="id" id="updatable_id">
                    </div>
                    <div class="col m6 s12">
                        <div class="switch right">
                            <label>
                                Inactive
                                <input type="checkbox" name="IsActive" id="update_IsActive" checked>
                                <span class="lever"></span>Active
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m6">
                        <input id="update_FirstName" name="FirstName" type="text" required>
                        <label for="update_FirstName">Enter First Name</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input id="update_LastName" name="LastName" type="text" required>
                        <label for="update_LastName">Enter Last Name</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m6">
                        <input id="update_Email" name="Email" type="email" required>
                        <label for="update_Email">Enter Email</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input id="update_MobileNumber" name="MobileNumber" type="number" required>
                        <label for="update_MobileNumber">Enter Mobile Number</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <select multiple name="update_ClientMenu" id="update_ClientMenu">
                            <!-- <option value="" disabled selected>Select Menu</option> -->
                            @if($client_menus)
                                @foreach($client_menus as $value)
                                <option value="{{$value->id}}">{{$value->MenuName}}</option>
                                @endforeach
                            @endif
                        </select>
                        <label>Select Menu</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" value="Update" class="btn purple" >
            </div>
        </form>
    </div>

    <div id="user_rights" class="modal">
        <form method="POST" id="user_rights_form" action="{{route('client.add')}}">
            <div class="modal-content">
                <div class="row">
                    <div class="col m6 s12">
                    <h4>Client Menu Access</h4>
                    <input type="hidden" name="id" id="updatable_id">
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <input type="submit" value="Update" class="btn purple" >
            </div>
        </form>
    </div>
@stop

@section('script')
<script type="text/javascript">
    $(function() {
        $('select').formSelect();
        var table = $("#MainTable").DataTable({
            // "responsive":true

        });
        table.on( 'order.dt search.dt', function () {
            table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            });
        }).draw();
        $("#MainForm").validate({
            rules:{
                confirm_password:{
                    equalTo: "#Password"
                }
            },
            submitHandler: function(form) {
                var form_data={
                    FirstName:$("#FirstName").val(),
                    LastName:$("#LastName").val(),
                    Email:$("#Email").val(),
                    MobileNumber:$("#MobileNumber").val(),
                    Password:$("#Password").val(),
                    ClientMenu:$("#ClientMenu").val(),
                    _token:'{{csrf_token()}}'
                }
                if ($("#IsActive").prop('checked')) {
                    form_data.IsActive = 1;
                }else{
                    form_data.IsActive = 0;
                }
                post_request("{{route('client.add')}}",form_data, function(respon) {
                    inserted_id = respon.id;
                    $("#MainForm").trigger("reset");
                    insert_sucessfully_alert();
                    var table = $("#MainTable").DataTable();
                    var count = table.rows().count()+1;
                    var row_node = table.row.add({
                        "0":0,
                        "1":form_data.FirstName,
                        "2":form_data.LastName,
                        "3":form_data.Email,
                        "4":form_data.MobileNumber,
                        "5":'<button class="mb-6 btn-floating btn-small waves-effect waves-light gradient-45deg-purple-deep-orange" onclick="updated_row('+inserted_id+')"><i class="material-icons">edit</i></button> <button class="mb-6 btn-floating btn-small waves-effect waves-light gradient-45deg-purple-deep-orange" onclick="delete_row('+inserted_id+')"><i class="material-icons delete-mails">delete</i></button>',
                    }).draw(false).node();
                    $(row_node).attr('id','tr_'+inserted_id);
                    table.order([0, 'desc']);
                    

                    table.on( 'order.dt search.dt', function () {
                        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                            cell.innerHTML = i+1;
                        });
                    }).draw();
                    $("#add_model").modal('close');
                });
            },
            errorElement: 'div', errorPlacement: function(error, element) {
                var placement=$(element).data('error');
                if (placement) {
                    $(placement).append(error)
                }
                else {
                    error.insertAfter(element);
                }
            }
        });
        $("#update_MainForm").validate({
            submitHandler: function(form) {
                var form_data={
                    id:$("#updatable_id").val(),
                    FirstName:$("#update_FirstName").val(),
                    LastName:$("#update_LastName").val(),
                    Email:$("#update_Email").val(),
                    MobileNumber:$("#update_MobileNumber").val(),
                    update_ClientMenu:$("#update_ClientMenu").val(),
                    _token:'{{csrf_token()}}'
                }
                if ($("#update_IsActive").prop('checked')) {
                    form_data.IsActive = 1;
                }else{
                    form_data.IsActive = 0;
                }
                post_request("{{route('client.update')}}",form_data, function(respon) {
                    updated_id = respon.id;
                    $("#update_MainForm").trigger("reset");
                    update_sucessfully_alert();
                    var table = $("#MainTable").DataTable();
                    var count = table.rows().count()+1;
                    table.row("#tr_"+updated_id).data({
                        "0":0,
                        "1":form_data.FirstName,
                        "2":form_data.LastName,
                        "3":form_data.Email,
                        "4":form_data.MobileNumber,
                        "5":'<button class="mb-6 btn-floating btn-small waves-effect waves-light gradient-45deg-purple-deep-orange" onclick="updated_row('+updated_id+')"><i class="material-icons">edit</i></button> <button class="mb-6 btn-floating btn-small waves-effect waves-light gradient-45deg-purple-deep-orange" onclick="delete_row('+updated_id+')"><i class="material-icons delete-mails">delete</i></button>',
                    }).draw(false);

                    table.order([0, 'desc']);
                    
                    // var aiDisplayMaster = table.column(0).data();
                    // irow = aiDisplayMaster.pop();
                    // console.log("row =>"+iro);
                    // aiDisplayMaster.unshift(irow);
                    // table.draw();

                    table.on( 'order.dt search.dt', function () {
                        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                            cell.innerHTML = i+1;
                        });
                    }).draw();
                    $("#update_model").modal('close');
                });
            },
            errorElement: 'div', errorPlacement: function(error, element) {
                var placement=$(element).data('error');
                if (placement) {
                    $(placement).append(error)
                }
                else {
                    error.insertAfter(element);
                }
            }
        });
    });
    $("#add_btn").click(function() {
        $('#add_model').modal('open');
        $("#MainForm").trigger("reset");

    });
    function delete_row(id) {
        var form_data={id:id,_token:'{{csrf_token()}}'}
        delete_confirm(function() {
            post_request('{{route('client.delete')}}',form_data,function (response) {
                var table = $("#MainTable").DataTable();
                table.row($("#tr_"+id)).remove().draw();
                delete_sucessfully_alert();  
            })
        });
    }
    function updated_row(id) {
        var form_data={id:id,_token:'{{csrf_token()}}'}
        $("#update_MainForm").trigger("reset");
        post_request('{{route('client.get')}}',form_data,function (response) {
            console.log("response =>"+response);
            $("#operation_type").html("Edit");
            $('#update_model').modal('open');
            $("#update_FirstName").val(response.FirstName);
            $("#update_LastName").val(response.LastName);
            $("#update_Email").val(response.Email);
            $("#update_MobileNumber").val(response.MobileNumber);
            $("#updatable_id").val(response.id);
            if (response.IsActive==1) {
                $("#update_IsActive").prop("checked",true);
            }else{
                $("#update_IsActive").prop("checked",false);
            }
            M.updateTextFields();
            $.each(response.selected_menu, function(i,e){
                $("#update_ClientMenu option[value='" + e + "']").prop("selected", true);
            });
            $('select').formSelect();
        })
    }
    function user_rights(id) {
        $("#user_rights").modal('open');
    }
</script>
@stop