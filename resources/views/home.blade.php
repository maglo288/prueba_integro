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
                <div class="card-header">Películas
                    <a href="#" id="open-modal-crear" class="btn btn-sm btn-primary float-right open_modal-crear"
                        data-toggle="modal" data-target="#ModalCreatePelicula">Crear</a>
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
                                <th>Título</th>
                                <th>Sinopsis</th>
                                <th>Año</th>
                                <th colspan="2">Acciones</th>

                            </tr>
                        </thead>
                        <tbody id='tbody_films'>
                            
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!--modal crear-->
<div class="modal fade" id="ModalCreatePelicula" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="CrudModal">Cargar Película</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="film_id" id="film_id">
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Título:</strong>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Título">
                            <span id="error-title" class="invalid-feedback" style="display: none;" role="alert">
                                <strong>
                                    Este campo es obligatorio
                                </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Sinopsis:</strong>
                            <textarea name="synopsis" id="synopsis" class="form-control"
                                placeholder="Sinopsis"></textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Año:</strong>
                            <input type="number" name="age" maxlength="4" id="age" class="form-control"
                                placeholder="Año" onblur="validate()" onkeypress="validate()" required>
                            <span id="error-age" class="invalid-feedback" style="display: none;" role="alert">
                                <strong>
                                    Este campo es obligatorio y debe ser menor o igual al año 2020.
                                </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button onclick="SaveFilm()" id="btn-save" name="btnsave"
                            class="btn btn-primary">Guardar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Editar-->
<div class="modal fade" id="ModalEditPelicula" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="EditCrudModal">Editar Película</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="film_id" id="film_id">
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Título:</strong>
                            <input type="text" name="edit_title" id="edit_title" class="form-control"
                                placeholder="Título" value='' required>
                            <span id="error-title-edit" class="invalid-feedback" style="display: none;" role="alert">
                                <strong>
                                    Este campo es obligatorio
                                </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Sinopsis:</strong>
                            <textarea name="edit_synopsis" id="edit_synopsis" class="form-control"
                                placeholder="Sinopsis" value=''></textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Año:</strong>
                            <input type="number" maxlength="4" name="edit_age" id="edit_age" class="form-control"
                                placeholder="Año" onblur="validate()" onkeypress="validate()" value='' required>
                                <span id="error-age-edit" class="invalid-feedback" style="display: none;" role="alert">
                                    <strong>
                                        Este campo es obligatorio y debe ser menor o igual al año 2020.
                                    </strong>
                                </span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button onclick="SaveEditFilm()" id="edit-btn-save" name="edit-btn-save"
                            class="btn btn-primary">Guardar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Eliminar-->
<div class="modal fade" id="ModalDeletePelicula" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="EditCrudModal">Eliminar Película</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="film_id" id="film_id">
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        Esta seguro que desea eliminar la pelicula ?
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button onclick="SaveDeleteFilm()" id="edit-btn-save" name="edit-btn-save"
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
            refreshFilms();
        });
        function validate(){
        
            //document.filmForm.btnsave.disabled=true
        }

        function refreshFilms(){
            $(".div-load").show()
            
            var type = "GET";      
            var ajaxurl = "films/film_all";
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
                    $.each(data.films, function(i, item) {
                        console.log(item.title)
                        html+='<tr>';
                        html+='<td>'+item.title+'</td>';
                        html+='<td>'+item.synopsis+'</td>';
                        html+='<td>'+item.age+'</td>';
                        html+= '<td>\
                            <a href="#" id="open-modal-edit" data-film="'+item.id+'" data-toggle="modal" class="btn btn-primary btn-sm open-modal" data-target="#ModalEditPelicula">Editar</a>\
                        </td>'
                        html+= '<td>\
                            <a href="#" id="open-modal-delete" data-film="'+item.id+'" data-toggle="modal" class="btn btn-danger btn-sm open-modal" data-target="#ModalDeletePelicula">Eliminar</a>\
                        </td>'
                        html+='</tr>';
                    })
                    $('#tbody_films').html(html);
                    $(".div-load").hide()
                }
            });  
        }

        $(document).on("click", "#open-modal-edit", function () {
            console.log("click editar")
            id_film = $(this).data('film')
            console.log("film es: "+id_film)
            var type = "GET";      
            var ajaxurl = "films/info/"+id_film;
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
                dataType: 'json',
                success: function (data) {
                    var res = data.film
                    $("#ModalEditPelicula").modal('show')
                    $('#ModalEditPelicula #film_id').val(id_film)
                    $("#ModalEditPelicula #edit_title").val(res.title)
                    $("#ModalEditPelicula #edit_synopsis").val(res.synopsis)
                    $("#ModalEditPelicula #edit_age").val(res.age)
                }
            });         
        });
        
        $(document).on("click", "#open-modal-delete", function () {
            console.log("click editar")
            id_film = $(this).data('film')
            $("#ModalDeletePelicula").modal('show')
            $('#ModalDeletePelicula #film_id').val(id_film)
                    
        });

        function SaveFilm(){
            title = $("#ModalCreatePelicula #title").val()
            synopsis = $("#ModalCreatePelicula #synopsis").val()
            age = $("#ModalCreatePelicula #age").val()
            if(validacionesCrear() == 0){
                $(".div-load").show()
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
                        $("#ModalCreatePelicula").modal('hide');
                        refreshFilms();
                        
                    }
                });
            }
        }

        function SaveEditFilm(){            
            var id_film = $('#ModalEditPelicula #film_id').val()
            var title = $("#ModalEditPelicula #edit_title").val();
            var synopsis = $("#ModalEditPelicula #edit_synopsis").val()
            var age = $("#ModalEditPelicula #edit_age").val()
            if(validacionesEditar() == 0){
                $(".div-load").show()
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('[name="_token"]').val()
                    }
                })
                console.log("films : "+id_film)
                var formData = {
                    id: id_film,
                    title: title,
                    synopsis: synopsis,
                    age: age,
                }
                console.log(formData)
                var type = "PUT";      
                var ajaxurl = "films/"+id_film;
                $.ajax({
                    type: type,
                    url: ajaxurl,
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);
                        if (data == 1){

                            $("#ModalEditPelicula").modal('hide')
                            refreshFilms();

                        }
                    //location.reload()
                    },        
                });
            }
        }
        function SaveDeleteFilm(){
            var id_film = $('#ModalDeletePelicula #film_id').val()

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
                }
            })
            console.log("films : "+id_film)
            var type = "DELETE";      
            var ajaxurl = "films/"+id_film;
            $.ajax({
                type: type,
                url: ajaxurl,
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    if (data == 1){

                        $("#ModalDeletePelicula").modal('hide')
                        refreshFilms();

                    }
                //location.reload()
                },        
            });
    
        }

        function validacionesEditar(){
            id_film = $('#ModalEditPelicula #film_id').val()
            edit_title = $("#ModalEditPelicula #edit_title").val()
            edit_synopsis = $("#ModalEditPelicula #edit_synopsis").val()
            edit_age = $("#ModalEditPelicula #edit_age").val()
            error = 0;
            if (edit_title == '' || edit_title == undefined ) {
                $("#error-title-edit").css('display', 'block');
                error = 1;
            }else{
                $("#error-title-edit").css('display', 'none');
            }

            if (edit_age == '' || edit_age == undefined || isNaN(edit_age) || edit_age > '2020') {
                $("#error-age-edit").css('display', 'block');
                error = 1;
            }else{
                $("#error-age-edit").css('display', 'none');
            }
            return error;
        }

        function validacionesCrear(){
            id_film = $('#ModalCreatePelicula #film_id').val()
            title = $("#ModalCreatePelicula #title").val()
            age = $("#ModalCreatePelicula #age").val()
            error = 0;
            if (title == '' || title == undefined ) {
                $("#error-title").css('display', 'block');
                error = 1;
            }else{
                $("#error-title").css('display', 'none');
            }

            if (age == '' || age == undefined || isNaN(age) || age > '2020') {
                $("#error-age").css('display', 'block');
                error = 1;
            }else{
                $("#error-age").css('display', 'none');
            }
            return error;
        }
</script>
@endpush