@extends('layouts.app')

@section('content')
<div class="container">
    @csrf
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Películas
                    <a href="#" id="open-modal-crear" class="btn btn-sm btn-primary float-right open_modal-crear" data-toggle="modal" data-target="#ModalCreatePelicula">Crear</a>
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
                           
                            <tr>
                                <td>gg</td>
                                <td>yy</td>
                                <td>yy</td>
                                <td>
                                    <a href="#" id="open-modal-edit" data-toggle="modal" class="btn btn-primary btn-sm open-modal" data-target="#ModalEditPelicula">Editar</a>
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
<div class="modal fade" id="ModalCreatePelicula" aria-hidden="true" >
    <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
    <h4 class="modal-title" id="CrudModal">Cargar Película</h4>
    </div>
    <div class="modal-body">
    <input type="hidden" name="film_id" id="film_id" >
    @csrf
    <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
    <strong>Título:</strong>
    <input type="text" name="title" id="title" class="form-control" placeholder="Título" onchange="validate()" >
    </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
    <strong>Sinopsis:</strong>
    <textarea name="synopsis" id="synopsis" class="form-control" placeholder="Sinopsis" ></textarea>
    </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
    <strong>Año:</strong>
    <input type="number" name="age" maxlength="4" id="age" class="form-control" placeholder="Año" onblur="validate()" onkeypress="validate()" required>
    </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
    <button onclick="SaveFilm()" id="btn-save" name="btnsave" class="btn btn-primary" >Guardar</button>
    <a href="" class="btn btn-danger">Cancelar</a>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
<!-- Modal Editar-->
<div class="modal fade" id="ModalEditPelicula" aria-hidden="true" >
    <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
    <h4 class="modal-title" id="EditCrudModal">Editar Película</h4>
    </div>
    <div class="modal-body">
    <input type="hidden" name="film_id" id="film_id" >
    @csrf
    <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
    <strong>Título:</strong>
    <input type="text" name="edit_title" id="edit_title" class="form-control" placeholder="Título" onchange="validate()" value=''>
    </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
    <strong>Sinopsis:</strong>
    <textarea name="edit_synopsis" id="edit_synopsis" class="form-control" placeholder="Sinopsis" value=''></textarea>
    </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
    <strong>Año:</strong>
    <input type="number" maxlength="4" name="edit_age" id="edit_age" class="form-control" placeholder="Año" onblur="validate()" onkeypress="validate()" value='' required>
    </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
    <input type='hidden' id='id_film' name='id_film' value=''>
    <button onclick="SaveEditFilm()" id="edit-btn-save" name="edit-btn-save" class="btn btn-primary" >Guardar</button>
    <a href="" class="btn btn-danger">Cancelar</a>
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
        
            document.filmForm.btnsave.disabled=true
        }

        function refreshFilms(){
            
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
                        /*var html+='<tr>';
                        html+='<td>'+this.title+'</td>';
                        html+='<td>'+this.synopsis+'</td>';
                        html+='<td>'+this.age+'</td>';
                        html+='</tr>';*/
                        $('#open-modal-edit').attr('data-film',this.id);
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
@endpush