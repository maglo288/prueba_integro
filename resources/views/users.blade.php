@extends('layouts.app')
@section('content')

<div class="div-load">        
    <img src="http://dimaco.com.gt/img/icons/loading.gif">
</div>
<div class="container">
    @csrf
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Usuarios
                    <a href="#" id="open-modal-crear" class="btn btn-sm btn-primary float-right open_modal-crear"
                        data-toggle="modal" data-target="#ModalCreateUser">Crear</a>
                </div>
                <div class="card-body" id='table_users'>
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Nickname</th>
                                <th>Email</th>
                                <th colspan="2">Acciones</th>

                            </tr>
                        </thead>
                        <tbody id='tbody_users'>
                            
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!--modal crear-->
<div class="modal fade" id="ModalCreateUser" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="CrudModal">Crear Usuario</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="user_id" id="user_id">
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Nombre"
                                onchange="validate()" required minlength="5">
                            <span id="error-name" class="invalid-feedback" style="display: none;" role="alert">
                                <strong>
                                    Este campo es obligatorio y debe ser mínimo de 5 caracteres.
                                </strong>
                            </span>
                                
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Nickname:</strong>
                            <input type='text' name="nickname" pattern="[A-Za-z0-9]" id="nickname" class="form-control" placeholder="Nickname" required>
                            <span id="error-nickname" class="invalid-feedback" style="display: none;" role="alert">
                                <strong>
                                    Este campo es obligatorio 
                                </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Email:</strong>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email" onblur="validate()" onkeypress="validate()" required>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Contraseña:</strong>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" onblur="validate()" onkeypress="validate()" required>
                            <span id="error-password" class="invalid-feedback" style="display: none;" role="alert">
                                <strong>
                                    Este campo es obligatorio y debe contener al menos 1 letra mayúscula y 1 número.
                                </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button onclick="SaveUser()" id="btn-save" name="btnsave"
                            class="btn btn-primary">Guardar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Editar-->
<div class="modal fade" id="ModalEditUser" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="EditCrudModal">Editar Usuario</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="user_id" id="user_id">
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Usuario:</strong>
                            <input type="text" name="edit_name" id="edit_name" class="form-control"
                                placeholder="Título" onchange="validate()" value='' required minlength="5">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Nickname:</strong>
                            <input type='text' name="edit_nickname" pattern="[A-Za-z0-9]" id="edit_nickname" class="form-control" placeholder="Nickname" required >
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Email:</strong>
                            <input type="email" name="edit_email" id="edit_email" class="form-control" placeholder="Email" onblur="validate()" onkeypress="validate()" required>
                        </div>
                    </div>
                    <!--<div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Contraseña:</strong>
                            <input type="password" name="edit_password" id="edit_password" class="form-control" placeholder="Contraseña" onblur="validate()" onkeypress="validate()" required>
                        </div>
                    </div>-->
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button onclick="SaveEditUser()" id="edit-btn-save" name="edit-btn-save"
                            class="btn btn-primary">Guardar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Eliminar-->
<div class="modal fade" id="ModalDeleteUser" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="EditCrudModal">Eliminar Usuario</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="user_id" id="user_id">
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        Esta seguro que desea eliminar el usuario ?
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button onclick="SaveDeleteUser()" id="edit-btn-save" name="edit-btn-save"
                            class="btn btn-primary">Aceptar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')


<script type="text/javascript">
    $( document ).ready(function() {
            console.log( "ready!" );
            refreshUser();
        });
        function validate(){
        
            //document.filmForm.btnsave.disabled=true
        }

        function refreshUser(){
            $(".div-load").show()
            
            var type = "GET";      
            var ajaxurl = "users/user_all";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('[name="_token"]').val()
                }
            })
            var html='';
            $.ajax({
                type: type,
                url: ajaxurl,
                dataType: 'json',
                success: function (data) {
                    
                    $.each(data.users, function(i, item) {
                        console.log("data es: "+item);
                        html+='<tr>';
                        html+='<td>'+item.name+'</td>';
                        html+='<td>'+item.nickname+'</td>';
                        html+='<td>'+item.email+'</td>';
                        html+= '<td>\
                            <a href="#" id="open-modal-edit" data-user="'+item.id+'" data-toggle="modal" class="btn btn-primary btn-sm open-modal" data-target="#ModalEditUser">Editar</a>\
                        </td>'
                        html+= '<td>\
                            <a href="#" id="open-modal-delete" data-user="'+item.id+'" data-toggle="modal" class="btn btn-danger btn-sm open-modal" data-target="#ModalDeleteUser">Eliminar</a>\
                        </td>'
                        html+='</tr>';
                    })
                    $('#tbody_users').html(html);
                    $(".div-load").hide()
                }
            });  
        }

        $(document).on("click", "#open-modal-edit", function () {
            console.log("click editar")
            id_user = $(this).data('user')
            console.log("film es: "+id_user)
            var type = "GET";      
            var ajaxurl = "users/info/"+id_user;
            var formData = {
                id_user: id_user,
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('[name="_token"]').val()
                }
                })
            $.ajax({
                type: type,
                url: ajaxurl,
                dataType: 'json',
                success: function (data) {
                    var res = data.user
                    $("#ModalEditUser").modal('show')
                    $('#ModalEditUser #user_id').val(id_user)
                    $("#ModalEditUser #edit_name").val(res.name)
                    $("#ModalEditUser #edit_nickname").val(res.nickname)
                    $("#ModalEditUser #edit_email").val(res.email)
                    $("#ModalEditUser #edit_password").val(res.password)
                }
            });         
        });
        
        $(document).on("click", "#open-modal-delete", function () {
            console.log("click editar")
            id_user = $(this).data('user')
            $("#ModalDeleteUser").modal('show')
            $('#ModalDeleteUser #user_id').val(id_user)
                    
        });

        function SaveUser(){
            
            name = $("#name").val()
            nickname = $("#nickname").val()
            email = $("#email").val()
            password = $("#password").val()
            if(validacionesCrear()== 0){
                $(".div-load").show()
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('[name="_token"]').val()
                }
                })
                var formData = {
                    name: name,
                    nickname: nickname,
                    email: email,
                    password: password,
                }
                var type = "POST";
                var ajaxurl = 'users';
                $.ajax({
                    type: type,
                    url: ajaxurl,
                    data: formData,
                    dataType: 'json',
                    success: function(data) {
                        $("#ModalCreateUser").modal('hide');
                        refreshUser();
                        
                    }
                });
            }
        }

        function SaveEditUser(){            
            var id_user = $('#ModalEditUser #user_id').val()
            var name = $("#ModalEditUser #edit_name").val();
            var nickname = $("#ModalEditUser #edit_nickname").val()
            var email = $("#ModalEditUser #edit_email").val()

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
                }
            })
            console.log("users : "+id_user)
            var formData = {
                id: id_user,
                name: name,
                nickname: nickname,
                email: email,
            }
            console.log(formData)
            var type = "PUT";      
            var ajaxurl = "users/"+id_user;
            $.ajax({
                type: type,
                url: ajaxurl,
                data: formData,
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    if (data == 1){

                        $("#ModalEditUser").modal('hide')
                        refreshUser();

                    }
                //location.reload()
                },        
            });
    
        }
        function SaveDeleteUser(){
            var id_user = $('#ModalDeleteUser #user_id').val()

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
                }
            })
            console.log("users : "+id_user)
            var type = "DELETE";      
            var ajaxurl = "users/"+id_user;
            $.ajax({
                type: type,
                url: ajaxurl,
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    if (data == 1){

                        $("#ModalDeleteUser").modal('hide')
                        refreshUser();

                    }
                //location.reload()
                },        
            });
    
        }

        function validacionesCrear(){
            id_user = $('#ModalCreateUser #user_id').val()
            name = $("#ModalCreateUser #name").val()
            nickname = $("#ModalCreateUser #nickname").val()
            password = $("#ModalCreateUser #password").val()
            error = 0;
            patron = /[A-Za-z0-9]/;
            if (name == '' || name == undefined ) {
                $("#error-name").css('display', 'block');
                error = 1;
            }else{
                $("#error-name").css('display', 'none');
            }

            if (nickname == '' || nickname == undefined || !patron.test(nickname)) {
                $("#error-nickname").css('display', 'block');
                error = 1;
            }else{
                $("#error-nickname").css('display', 'none');
            }

            if (password == '' || password == undefined) {
                $("#error-password").css('display', 'block');
                error = 1;
            }else{
                $("#error-password").css('display', 'none');
            }
            return error;
        }

        function validacionesEditar(){
            id_user = $('#ModalEditUser #user_id').val()
            edit_name = $("#ModalEditUser #edit_name").val()
            edit_nickname = $("#ModalEditUser #edit_nickname").val()
            error = 0;
            patron = /[A-Za-z0-9]/;
            if (edit_name == '' || edit_name == undefined ) {
                $("#error-edit_name").css('display', 'block');
                error = 1;
            }else{
                $("#error-edit_name").css('display', 'none');
            }

            if (edit_nickname == '' || edit_nickname == undefined || !patron.test(edit_nickname)) {
                $("#error-edit_nickname").css('display', 'block');
                error = 1;
            }else{
                $("#error-edit_nickname").css('display', 'none');
            }

        
        }
</script>
@endpush