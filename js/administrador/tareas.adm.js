function cargarSol1() {

    window.location.href = "../administrador/tareas.php";
}

function comentarioAsi (id_solicitud){
    $("#numIdSolicitud").val(id_solicitud);
    $("#numIdSolicitud2").val(id_solicitud);
    $("#numIdSolicitud1").val(id_solicitud);
}


function iniciarTarea(id_solicitud) {
    $("#numIdSolicitud3").val(id_solicitud);
}

var inputs = "textarea[maxlength]";
$(document).on('keyup', "[maxlength]", function (e) {
    var este = $(this),
    maxlength = este.attr('maxlength'),
    maxlengthint = parseInt(maxlength),
    textoActual = este.val(),
    currentCharacters = este.val().length;
    remainingCharacters = maxlengthint - currentCharacters,
    espan = este.prev('label').find('span');	

    // Detectamos si es IE9 y si hemos llegado al final, convertir el -1 en 0 - bug ie9 porq. no coge directamente el atributo 'maxlength' de HTML5
    if (document.addEventListener && !window.requestAnimationFrame) {
        if (remainingCharacters <= -1) {
            remainingCharacters = 0;            
        }
    }
    espan.html(remainingCharacters);
    if (!!maxlength) {
        var texto = este.val();	
        if (texto.length >= maxlength) {
            este.removeClass().addClass("borderojo");
            e.preventDefault();
        }
        else if (texto.length < maxlength) {
            este.removeClass().addClass("bordegris");
        }	
    }	
});
$(document).ready(function () {
    asignada();
    asignada1();
    desarrollo();
    
    function asignada() {
        $.ajax({
            url: '../controladorAdministrador/tarea/solicitudes.read.3.php',
            type: 'POST',
            dataType: 'json',
            data: null,
        }).done(function (json) {
            var datos = '';
            datos += "<table id='tableSolicitudesAsignadas'   class='table  table-striped table-bordered table-responsive'>";
            datos += '<thead >';
                datos += '<tr class="table-light border-primary text-center align-middle ">';
                    datos += '<th  class="border border-primary text-center align-middle ">NÚMERO DE LA SOLICITUD</th>';
                    datos += '<th  class="border border-primary text-center align-middle ">FECHA DE LA SOLICITUD</th>';
                    datos += '<th  class="border border-primary text-wrap align-middle ">PRIORIDAD</th>';
                    datos += '<th  class="border border-primary text-center align-middle ">TIPO DE SOLICITUD</th>';
                    datos += '<th  class="border border-primary text-center align-middle ">TIPO DE DOCUMENTO </th>';
                    datos += '<th  class="border border-primary text-center align-middle ">CÓDIGO  DOCUMENTO </th>';
                    datos += '<th  class="border border-primary text-center align-middle ">CREADO POR: </th>';
                    datos += '<th  class="border border-primary text-center align-middle ">DESCRIPCIÓN DE LA SOLICITUD</th>';
                    datos += '<th  class="border border-primary text-center align-middle ">DOCUMENTO SOPORTE </th>';
                    datos += '<th  class="border border-primary text-center align-middle ">INICIAR TAREA </th>';
                    datos += '<th  class="border border-primary text-center align-middle ">COMENTARIOS</th>';
                datos += '</tr>';
            datos += '</thead>';
            datos += '<tbody>';
            $.each(json, function (key, value) {
                datos += '<tr class="align-middle" >';
                    datos += '<td class=" border border-primary text-wrap align-middle" id="numIdSolicitud">' + value.id_solicitud + ' </td>';
                    datos += '<td class=" border border-primary text-wrap align-middle">' + value.fecha_solicitud + '</td>';
                    datos += '<td class=" border border-primary text-wrap">' + value.prioridad + '</td>';
                    datos += '<td class=" border border-primary text-wrap align-middle">' + value.tipo_solicitud + '</td>';
                    datos += '<td class=" border border-primary text-wrap align-middle">' + value.tipo_documento + '</td>';
                    if(value.codigo_documento == '0000'){
                        datos += '<td class=" border border-primary text-wrap align-middle">No Aplica</td>';
                    }else{
                        datos += '<td class=" border border-primary text-wrap align-middle">' + value.codigo_documento + '</td>';
                    }
                    datos += '<td class=" border border-primary text-wrap align-middle">' + value.usuario + '</td>';
                    datos += '<td class=" border border-primary text-wrap align-middle">' + value.solicitud + '</td>';
                    if (value.documento == "") {
                        datos += '<td class=" border border-primary text-wrap align-middle">Sin Documento Soporte</td>';
                    } else {
                        datos += '<td class=" border border-primary text-center align-middle"><a class="btn btn-primary" href="../documentos/usuarios/' + value.usuario + '/solicitudes/' + value.ruta  + '/' + value.documento + '">'+value.documento+' <i class="fas fa-download"></i></a></td>';
                    }
                    datos += '<td class=" border border-primary  text-center align-middle"><button type="button"  id="btnIniciarTarea" onclick="iniciarTarea(' + value.id_solicitud + ')" class="btn btn-primary" ><i class="far fa-clock"></i></button></td>';
                    datos += '<td class=" border border-primary  text-center align-middle"><button type="button"  id="btnVerComentarios" onclick="comentarioAsi(' + value.id_solicitud + ')" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="far fa-comment-dots"></i></button></td>';
                datos += '</tr>';
            });
            datos += '</tbody>';
            datos += '</table>';
            $('#tareasAsignadas').html(datos);
            $('#tableSolicitudesAsignadas').DataTable({
                "destroy": true,
                "autoWidth": true,
                "responsive": true,
                "searching": true,
                "info": true,
                "ordering": true,
                "colReorder": true,
                "sZeroRecords": true,
                "keys": true,
                "deferRender": true,
                "lengthMenu": [[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
                "iDisplayLength": 20,
                "language": { "url": "../componente/libreria/idioma/es-mx.json" },
                order: [[2, 'asc'], [4, 'asc']],
                rowGroup: {
                    dataSrc: [[2]]
                },
                dom: 'Bflrtip',
                buttons:
                    [
                        // {
                        //     extend: 'pdfHtml5',
                        //     orientation: 'landscape',
                        //     pageSize: 'A4',
                        //     download: 'open',
                        //     title: 'Solicitudes Registradas',
                        //     titleAttr: 'Solicitudes Registradas',
                        //     messageTop: 'Solicitudes Registradas',
                        //     text: '<i class="far fa-file-pdf"></i>',
                        //     exportOptions: {
                        //         columns: [0, 1, 2, 3, 4,  6, 7, 8]
                        //     }
                        // },
                        // {
                        //     extend: 'print',
                        //     title: 'Solicitudes Registradas',
                        //     titleAttr: 'Solicitudes Registradas',
                        //     messageTop: 'Solicitudes Registradas',
                        //     text: '<i class="fas fa-print"></i>',
                        //     exportOptions: {
                        //         columns: [0, 1, 2, 3, 4,  6, 7, 8]
                        //     }
                        // },
                        {
                            extend: 'excelHtml5',
                            text: '<i class="fas fa-file-excel"></i>',
                            sheetName: 'Solicitudes Asignadas',
                            title: 'Solicitudes Asignadas',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4,5, 6, 7, 8]
                            }
                        },
                        {
                            extend: 'copyHtml5',
                            text: '<i class="fas fa-copy"></i>',
                           
                            titleAttr: 'COPIAR',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                            }
                        },
                        {
                            extend: 'searchBuilder',
                            config: {
                                columns: [0,1,2,3,4,5,6],
                                conditions: {
                                    string: {
                                        '!=': null,
                                        '!null': null,
                                        'null': null,
                                        'contains': null,
                                        '!contains': null,
                                        'ends': null,
                                        '!ends': null,
                                        'starts': null,
                                        '!starts ': null
                                    },
                                    num: {
                                        '!=': null,
                                        '!null': null,
                                        '<': null,
                                        '<=': null,
                                        '>': null,
                                        '>=': null,
                                        'null': null,
                                        'between': null,
                                        '!between': null
                                    },
                                    date: {
                                        '!=': null,
                                        '!null': null,
                                        '<': null,
                                        '<=': null,
                                        '>': null,
                                        '>=': null,
                                        'null': null,
                                        'between': null,
                                        '!between': null
                                    }
                                } 
                            } 

                        }
                    ]
            });
        }).fail(function (xhr, status, error) {
            $('#tareasAsignadas').html(error);
        });
    }
    
    /// INICIAR UNA TAREA///
    $(document).on('click', '#btnIniciarTarea', function (event) {
        event.preventDefault();
        $.ajax({
            url: '../controladorAdministrador/tarea/tarea.create.php',
            type: 'POST',
            dataType: 'json',
            data: $('#iniciarTarea').serialize(),
        }).done(function (json) {
            if(json[0].proceso == "OK"){
          
                Swal.fire({
                    icon: 'success',
                    title: 'Tarea Iniciada con éxito',
                    showConfirmButton: false,
                    timer: 3000
                }).then((result) => {
                    cargarSol1();
                })
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Error al crear la tarea',
                });
            }
        }).fail(function (xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error al crear la tarea',
            });
        })
    })

    /// INICIAR UNA TAREA///
    $(document).on('click', '#btnIniciarTarea', function (event) {
        event.preventDefault();
        $.ajax({
            url: '../controladorAdministrador/tarea/tarea.create.2.php',
            type: 'POST',
            dataType: 'json',
            data: $('#iniciarTarea').serialize(),
        }).done(function (json) {
        }).fail(function (xhr, status, error) {
        })
    })

    /// INICIAR UNA TAREA///
    $(document).on('click', '#btnIniciarTarea', function (event) {
        event.preventDefault();
        $.ajax({
            url: '../controladorAdministrador/tarea/solicitudes.comentarios.create.tarea.php',
            type: 'POST',
            dataType: 'json',
            data: $('#iniciarTarea').serialize(),
        }).done(function (json) {
        }).fail(function (xhr, status, error) {
        })
    })

    $(document).on('click', '#btnVerComentarios', function (event) {
        event.preventDefault();
        $.ajax({
            url: '../controladorAdministrador/tarea/solicitudes.comentarios.read.php',
            type: 'POST',
            dataType: 'json',
            data: $('#buscar1').serialize(),
        }).done(function (json) {
            var comentarios = '';
            if (json === 0) {
                comentarios += "<h5>Aun no hay comentarios</h5>";
            } else {
                // datos += '<form action="" class="form-group" id="buscar">';
                comentarios += "<table id='tableComentarios'  class='table  table-striped table-bordered table-responsive'>";
                comentarios += '<thead >';
                comentarios += '<tr class="table-light border-primary ">';
                comentarios += '<th  class="text-center align-middle border border-primary ">FECHA COMENTARIO</th>';
                comentarios += '<th  class="text-center align-middle border border-primary ">USUARIO</th>';
                comentarios += '<th  class="text-center align-middle border border-primary ">COMENTARIO</th>';
                comentarios += '</tr>';
                comentarios += '</thead>';
                comentarios += '<tbody>';
                $.each(json, function (key, value) {
                    comentarios += '<tr class="align-middle" >';
                    comentarios += '<td class=" border border-primary text-wrap" id="numIdSolicitud">' + value.fecha_comentario + ' </td>';
                    comentarios += '<td class=" border border-primary  text-wrap align-middle">' + value.usuario_comentario + '</td>';
                    comentarios += '<td class=" border border-primary  text-wrap align-middle">' + value.comentario + '</td>';
                    comentarios += '</tr>';
                });
                comentarios += '</tbody>';
                comentarios += '</table>';
            }
            $('#comentarios').html(comentarios);
            $('#tableComentarios').DataTable({
                "destroy": true,
                "autoWidth": true,
                "responsive": true,
                "searching": false,
                "info": true,
                "ordering": true,
                "colReorder": true,
                "sZeroRecords": true,
                "fixedColumns": true,
                "fixedHeader": true,
                "keys": true,
                "deferRender": true,
                "lengthMenu": [[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
                "iDisplayLength": 20,
                "language": { "url": "../componente/libreria/idioma/es-mx.json" },
                
                dom: 'Bfrtip',
                buttons:
                    [
                        {
                            extend: 'pdfHtml5',
                            orientation: 'landscape',
                            pageSize: 'A4',
                            download: 'open',
                            title: 'Comentarios sobre la Solicitud',
                            titleAttr: 'Comentarios sobre la Solicitud',
                            messageTop: 'Comentarios sobre la Solicitud',
                            text: '<i class="far fa-file-pdf"></i>',
                            exportOptions: {
                                columns: [0, 1, 2,]
                            }
                        },
                        {
                            extend: 'print',
                            title: 'Comentarios sobre la Solicitud',
                            titleAttr: 'Comentarios sobre la Solicitud',
                            messageTop: 'Comentarios sobre la Solicitud',
                            text: '<i class="fas fa-print"></i>',
                            exportOptions: {
                                columns: [0, 1, 2]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            text: '<i class="fas fa-file-excel"></i>',
                           
                            title: 'Comentarios sobre la Solicitud',
                            exportOptions: {
                                columns: [0, 1, 2]
                            }
                        },
                        {
                            extend: 'copyHtml5',
                            text: '<i class="fas fa-copy"></i>',
                           
                            titleAttr: 'COPIAR',
                            exportOptions: {
                                columns: [0, 1, 2]
                            }
                        }
                    ]
            });
        }).fail(function (xhr, status, error) {
            $('#comentarios').html(error);
        });
    });

      /// ASIGNAR COMENTARIO A LA SOLICITUD///
      $(document).on('click', '#btnCrearcomentario', function (event) {
        event.preventDefault();
        $.ajax({
            url: '../controladorAdministrador/tarea/solicitudes.comentarios.create.php',
            type: 'POST',
            dataType: 'json',
            data: $('#buscar1').serialize(),
        }).done(function (json) {
            if(json !== null){
                Swal.fire({
                    icon: 'error',
                    title: 'Error al crear el comentario',
                });
            }else{
                Swal.fire({
                    icon: 'success',
                    title: 'Comentario Creado con Exito',
                    showConfirmButton: false,
                    timer: 3000
                }).then((result) => {
                    cargarSol1();
                });
            }
        }).fail(function (xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error al crear el comentario',
            });
        });
    });

    function asignada1() {
        $.ajax({
            url: '../controladorAdministrador/tarea/solicitudes.read.4.php',
            type: 'POST',
            dataType: 'json',
            data: null,
        }).done(function (json) {
            var datos = '';
            datos += "<table id='tableSolicitudesAsignadas1'   class='table  table-striped table-bordered table-responsive'>";
            datos += '<thead >';
                datos += '<tr class="table-light border-primary text-center align-middle ">';
                    datos += '<th  class="border border-primary text-center align-middle ">NÚMERO DE LA SOLICITUD</th>';
                    datos += '<th  class="border border-primary text-center align-middle ">FECHA DE LA SOLICITUD</th>';
                    datos += '<th  class="border border-primary text-wrap align-middle ">PRIORIDAD</th>';
                    datos += '<th  class="border border-primary text-center align-middle ">TIPO DE SOLICITUD</th>';
                    datos += '<th  class="border border-primary text-center align-middle ">TIPO DE DOCUMENTO </th>';
                    datos += '<th  class="border border-primary text-center align-middle ">CÓDIGO  DOCUMENTO </th>';
                    datos += '<th  class="border border-primary text-center align-middle ">CREADO POR: </th>';
                    datos += '<th  class="border border-primary text-center align-middle ">DESCRIPCIÓN DE LA SOLICITUD</th>';
                    datos += '<th  class="border border-primary text-center align-middle ">ASIGNADO A </th>';
                    datos += '<th  class="border border-primary text-center align-middle ">FECHA DE ASIGNACIÓN </th>';
                    datos += '<th  class="border border-primary text-center align-middle ">COMENTARIOS</th>';
                datos += '</tr>';
            datos += '</thead>';
            datos += '<tbody>';
            $.each(json, function (key, value) {
                datos += '<tr class="align-middle" >';
                    datos += '<td class=" border border-primary text-wrap align-middle" id="numIdSolicitud">' + value.id_solicitud + ' </td>';
                    datos += '<td class=" border border-primary text-wrap align-middle">' + value.fecha_solicitud + '</td>';
                    datos += '<td class=" border border-primary text-wrap">' + value.prioridad + '</td>';
                    datos += '<td class=" border border-primary text-wrap align-middle">' + value.tipo_solicitud + '</td>';
                    datos += '<td class=" border border-primary text-wrap align-middle">' + value.tipo_documento + '</td>';
                    if(value.codigo_documento == '0000'){
                        datos += '<td class=" border border-primary text-wrap align-middle">No Aplica</td>';
                    }else{
                        datos += '<td class=" border border-primary text-wrap align-middle">' + value.codigo_documento + '</td>';
                    }
                    datos += '<td class=" border border-primary text-wrap align-middle">' + value.usuario + '</td>';
                    datos += '<td class=" border border-primary text-wrap align-middle">' + value.solicitud + '</td>';
                    datos += '<td class=" border border-primary text-wrap align-middle">' + value.usuario_tarea_estado + '</td>';
                    datos += '<td class=" border border-primary text-wrap align-middle">' + value.fecha_tarea_estado + '</td>';
                    datos += '<td class=" border border-primary  text-center align-middle"><button type="button"  id="btnVerComentarios" onclick="comentarioAsi(' + value.id_solicitud + ')" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="far fa-comment-dots"></i></button></td>';
                datos += '</tr>';
            });
            datos += '</tbody>';
            datos += '</table>';
            $('#tareasAsignadas1').html(datos);
            $('#tableSolicitudesAsignadas1').DataTable({
                "destroy": true,
                "autoWidth": true,
                "responsive": true,
                "searching": true,
                "info": true,
                "ordering": true,
                "colReorder": true,
                "sZeroRecords": true,
                "keys": true,
                "deferRender": true,
                "lengthMenu": [[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
                "iDisplayLength": 20,
                "language": { "url": "../componente/libreria/idioma/es-mx.json" },
                order: [[3, 'asc'], [1, 'asc']],
                rowGroup: {
                    dataSrc: [[3]]
                },
                dom: 'Bflrtip',
                buttons:
                    [
                        // {
                        //     extend: 'pdfHtml5',
                        //     orientation: 'landscape',
                        //     pageSize: 'A4',
                        //     download: 'open',
                        //     title: 'Solicitudes Registradas',
                        //     titleAttr: 'Solicitudes Registradas',
                        //     messageTop: 'Solicitudes Registradas',
                        //     text: '<i class="far fa-file-pdf"></i>',
                        //     exportOptions: {
                        //         columns: [0, 1, 2, 3, 4,  6, 7, 8]
                        //     }
                        // },
                        // {
                        //     extend: 'print',
                        //     title: 'Solicitudes Registradas',
                        //     titleAttr: 'Solicitudes Registradas',
                        //     messageTop: 'Solicitudes Registradas',
                        //     text: '<i class="fas fa-print"></i>',
                        //     exportOptions: {
                        //         columns: [0, 1, 2, 3, 4,  6, 7, 8]
                        //     }
                        // },
                        {
                            extend: 'excelHtml5',
                            text: '<i class="fas fa-file-excel"></i>',
                           
                            title: 'Solicitudes Registradas',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4,  6, 7, 8]
                            }
                        },
                        {
                            extend: 'copyHtml5',
                            text: '<i class="fas fa-copy"></i>',
                           
                            titleAttr: 'COPIAR',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4,  6, 7, 8]
                            }
                        },
                        {
                            extend: 'searchBuilder',
                            config: {
                                depthLimit: 2,
                                columns: [0,1,2],
                                conditions: {
                                    string: {
                                        '!=': null,
                                        '!null': null,
                                        'null': null,
                                        'contains': null,
                                        '!contains': null,
                                        'ends': null,
                                        '!ends': null,
                                        'starts': null,
                                        '!starts ': null
                                    }
                                }
                            } 

                        }
                    ]
            });
        }).fail(function (xhr, status, error) {
            $('#tareasAsignadas1').html(error);
        });
    }
    
    function desarrollo() {
        $.ajax({
            url: '../controladorAdministrador/tarea/solicitudes.read.5.php',
            type: 'POST',
            dataType: 'json',
            data: null,
        }).done(function (json) {
            var datos = '';
            datos += "<table id='tableTareasDesarrollo'   class='table  table-striped table-bordered table-responsive'>";
            datos += '<thead >';
                datos += '<tr class="table-light border-primary text-center align-middle ">';
                    datos += '<th  class="border border-primary text-center align-middle ">NÚMERO DE LA SOLICITUD</th>';
                    datos += '<th  class="border border-primary text-center align-middle ">FECHA DE LA SOLICITUD</th>';
                    datos += '<th  class="border border-primary text-wrap align-middle ">PRIORIDAD</th>';
                    datos += '<th  class="border border-primary text-center align-middle ">TIPO DE SOLICITUD</th>';
                    datos += '<th  class="border border-primary text-center align-middle ">TIPO DE DOCUMENTO </th>';
                    datos += '<th  class="border border-primary text-center align-middle ">DESCRIPCIÓN DE LA SOLICITUD</th>';
                    datos += '<th  class="border border-primary text-center align-middle ">ESTADO DE LA TAREA</th>';
                    datos += '<th  class="border border-primary text-center align-middle ">COMENTARIOS</th>';
                datos += '</tr>';
            datos += '</thead>';
            datos += '<tbody>';
            $.each(json, function (key, value) {
                datos += '<tr class="align-middle" >';
                    datos += '<td class=" border border-primary text-wrap align-middle" id="numIdSolicitud">' + value.id_solicitud + ' </td>';
                    datos += '<td class=" border border-primary text-wrap align-middle">' + value.fecha_solicitud + '</td>';
                    datos += '<td class=" border border-primary text-wrap">' + value.prioridad + '</td>';
                    datos += '<td class=" border border-primary text-wrap align-middle">' + value.tipo_solicitud + '</td>';
                    datos += '<td class=" border border-primary text-wrap align-middle">' + value.tipo_documento + '</td>';
                    datos += '<td class=" border border-primary text-wrap align-middle">' + value.solicitud + '</td>';
                    datos += '<td class=" border border-primary text-wrap align-middle">' + value.tarea_estado+ '</td>';
                    datos += '<td class=" border border-primary  text-center align-middle"><button type="button"  id="btnVerComentarios" onclick="comentarioAsi(' + value.id_solicitud + ')" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="far fa-comment-dots"></i></button></td>';
                datos += '</tr>';
            });
            datos += '</tbody>';
            datos += '</table>';
            $('#tareasDesarrollo').html(datos);
            $('#tableTareasDesarrollo').DataTable({
                "destroy": true,
                "autoWidth": true,
                "responsive": true,
                "searching": true,
                "info": true,
                "ordering": true,
                "colReorder": true,
                "sZeroRecords": true,
                "keys": true,
                "deferRender": true,
                "lengthMenu": [[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
                "iDisplayLength": 20,
                "language": { "url": "../componente/libreria/idioma/es-mx.json" },
                order: [[3, 'asc'], [1, 'asc']],
                rowGroup: {
                    dataSrc: [[3]]
                },
                dom: 'Bflrtip',
                buttons:
                    [
                        {
                            extend: 'pdfHtml5',
                            orientation: 'landscape',
                            pageSize: 'A4',
                            download: 'open',
                            title: 'Solicitudes Registradas',
                            titleAttr: 'Solicitudes Registradas',
                            messageTop: 'Solicitudes Registradas',
                            text: '<i class="far fa-file-pdf"></i>',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4,  6, 7, 8]
                            }
                        },
                        {
                            extend: 'print',
                            title: 'Solicitudes Registradas',
                            titleAttr: 'Solicitudes Registradas',
                            messageTop: 'Solicitudes Registradas',
                            text: '<i class="fas fa-print"></i>',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4,  6, 7, 8]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            text: '<i class="fas fa-file-excel"></i>',
                           
                            title: 'Solicitudes Registradas',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4,  6, 7, 8]
                            }
                        },
                        {
                            extend: 'copyHtml5',
                            text: '<i class="fas fa-copy"></i>',
                           
                            titleAttr: 'COPIAR',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4,  6, 7, 8]
                            }
                        },
                        {
                            extend: 'searchBuilder',
                            config: {
                                depthLimit: 2,
                                columns: [0,1,2],
                                conditions: {
                                    string: {
                                        '!=': null,
                                        '!null': null,
                                        'null': null,
                                        'contains': null,
                                        '!contains': null,
                                        'ends': null,
                                        '!ends': null,
                                        'starts': null,
                                        '!starts ': null
                                    }
                                }
                            } 

                        }
                    ]
            });
        }).fail(function (xhr, status, error) {
            $('#tareasDesarrollo').html(error);
        });
    }


})
