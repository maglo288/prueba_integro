@extends('layouts.app')

@section('content')
<div class="container">
    @csrf
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Usuarios
                    <a href="#" id="open-modal-crear" class="btn btn-sm btn-primary float-right open_modal-crear" data-toggle="modal" data-target="#ModalCreateUser">Crear</a>
                </div>
                <div class="card-body" id='table_films'>
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
                        <tbody id='tbody_films'>
                           
                            <tr>
                                <td>gg</td>
                                <td>yy</td>
                                <td>yy</td>
                                <td>
                                    <a href="#" id="open-modal-edit" data-toggle="modal" class="btn btn-primary btn-sm open-modal" data-target="#ModalEditUser">Editar</a>
                                </td>
                                <td>
                                    <form action="" method="Post" >
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="Eliminar" class="btn btn-sm btn-danger" onclick="return confirm('¿Desea eliminar..?')">
                                    </form>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!--modal crear-->
<div class="modal fade" id="ModalCreateUser" aria-hidden="true" >
    <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
    <h4 class="modal-title" id="CrudModal">Crear Usuario</h4>
    </div>
    <div class="modal-body">
    <input type="hidden" name="film_id" id="film_id" >
    @csrf
    <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
        <strong>Nombre:</strong>
        <input type="text" name="name" maxlength="5" id="name" class="form-control" placeholder="Usuario" onchange="validate()" required>
        </div>
        </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
        <strong>Nickname:</strong>
        <input type='text' name="nickname" pattern="[A-Za-z0-9]" id="nickname" class="form-control" placeholder="Nickname" >
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
        </div>
        </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
    <button onclick="SaveUser()" id="btn-save" name="btnsave" class="btn btn-primary" >Guardar</button>
    <a href="" class="btn btn-danger">Cancelar</a>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
<!-- Modal Editar-->
<div class="modal fade" id="ModalEditUser" aria-hidden="true" >
    <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
    <h4 class="modal-title" id="EditCrudModal">Editar Usuario</h4>
    </div>
    <div class="modal-body">
    <input type="hidden" name="film_id" id="film_id" >
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <strong>Nombre:</strong>
            <input type="text" name="name" id="name" class="form-control" placeholder="Usuario" onchange="validate()" required value=''>
            </div>
            </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <strong>Nickname:</strong>
            <textarea name="nickname" id="nickname" class="form-control" placeholder="Nickname" value=''></textarea>
            </div>
            </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <strong>Email:</strong>
            <input type="email" name="email" id="email" class="form-control" placeholder="Email" onblur="validate()" onkeypress="validate()" required value=''>
            </div>
            </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <strong>Contraseña:</strong>
            <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" onblur="validate()" onkeypress="validate()" required value=''>
            </div>
            </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
    <input type='hidden' id='id_film' name='id_film' value=''>
    <button onclick="SaveEditUser()" id="edit-btn-save" name="edit-btn-save" class="btn btn-primary" >Guardar</button>
    <a href="" class="btn btn-danger">Cancelar</a>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <script>
        $( document ).ready(function() {
            console.log( "ready!" );
            refreshUsers();
        });
        function validate(){
        
            document.filmForm.btnsave.disabled=true
        }

        function refreshUsers(){
            
            var type = "GET";      
            var ajaxurl = "film/film_all";
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
                    console.log(data)
                    $.each(data, function() {
                        console.log(data);
                        var html+='<tr>';
                        html+='<td>'+this.title+'</td>';
                        html+='<td>'+this.synopsis+'</td>';
                        html+='<td>'+this.age+'</td>';
                        html+='</tr>';
                    })
                }
            });  
             
            $('#tbody_films').html(html);
        }

        $(document).on("click", "#open-modal-edit", function () {
            console.log("click editar")
            id_film = $(this).data('film')
            console.log("film es: "+id_film)
            var type = "GET";      
            var ajaxurl = "film/info";
            var formData = {
                id_film: id_film,
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('[name="_token"]').val()
                }
                })
            $.ajax({
                type: type,
                url: ajaxurl,
                data: formData,
                dataType: 'json',
                success: function (data) {
                    console.log(data)
                    $("#ModalEditPelicula").modal('show')
                    $.each(data, function() {
                        console.log(data);
                        $('#id_film').val(id_film)
                        $("#ModalEditTransfer #edit_title").val(this.title)
                        $("#ModalEditTransfer #edit_synopsis").val(this.synopsis)
                        $("#ModalEditTransfer #edit_age").val(this.age)
                    })
                }
            });         
        });

        function SaveFilm(){
            console.log("save");
            title = $("#title").val()
            synopsis = $("#synopsis").val()
            age = $("#age").val()
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
            })
            var formData = {
            title: title,
            synopsis: synopsis,
            age: age,
            }
            var type = "POST";
            var ajaxurl = 'films';
            $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function(data) {
                $("#ModalCreatePelicula").modal('hide')
                nowuiDashboard.showNotification('primary', 'now-ui-icons ui-2_like', 'top', 'center', 'Película creada con éxito.')
                location.reload()
            }
            });
        }

        function SaveEditFilm(){
            var id_film = $('#ModalEditPelicula #id_film').val()
            var title = $("#ModalEditPelicula #edit_title").val();
            var synopsis = $("#ModalEditPelicula #edit_synopsis").val()
            var synopsis = $("#ModalEditPelicula #edit_age").val()

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
                }
            })
            console.log("films : "+id_film)
            var formData = {
                id:id_film,
                title: title,
                synopsis: synopsis,
                age: age,
            }
            console.log(formData)
            var type = "PUT";      
            var ajaxurl = "film/"+id_film;
            $.ajax({
                type: type,
                url: ajaxurl,
                data: formData,
                dataType: 'json',
                success: function (data) {
                console.log(data);
                nowuiDashboard.showNotification('primary','now-ui-icons ui-2_like','top','center', 'Pelicula actualizada con éxito.')
                //location.reload()
                },        
            });
    
        }

        /*$(document).on('click','#open-modal-crear',function(){
        /*var url = "domain.com/yoururl";
        var tour_id= $(this).val();
        $.get(url + '/' + tour_id, function (data) {
            //success data
            console.log(data);
            $('#tour_id').val(data.id);
            $('#name').val(data.name);
            $('#details').val(data.details);
            $('#btn-save').val("update");
            $('#myModal').modal('show');
        }) */
        //console.log("sdd");
    //});
    </script>