function cargarSol1() {

    window.location.href = "../administrador/tareas.php";
}

function comentarioAsi (id_solicitud){
    $("#numIdSolicitud").val(id_solicitud);
    $("#numIdSolicitud1").val(id_solicitud);
}

function iniciarTarea(id_solicitud) {
    $("#numIdSolicitud3").val(id_solicitud);
}

$(document).ready(function () {
    asignada();

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
                    if (value.documento == null) {
                        datos += '<td class=" border border-primary text-wrap align-middle">Sin Documento Soporte</td>';
                    } else {
                        datos += '<td class=" border border-primary text-center align-middle"><a class="btn btn-primary" href="../documentos/usuarios/' + value.usuario + '/solicitudes/' + value.ruta  + '/' + value.documento + '"><i class="fas fa-download"></i></a></td>';
                    }
                    datos += '<td class=" border border-primary  text-center align-middle"><button type="button"  id="btnIniciarTarea" onclick="iniciarTarea(' + value.id_solicitud + ')" class="btn btn-primary" ><i class="far fa-clock"></i></button></td>';
                    datos += '<td class=" border border-primary  text-center align-middle"><button type="button"  id="btnVerComentarios" onclick="comentarioAsi(' + value.id_solicitud + ')" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="far fa-comment-dots"></i></button></td>';
                datos += '</tr>';
            });
            datos += '</tbody>';
            datos += '</table>';
            $('#solicitudesAsignadas').html(datos);
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
                            autoFiltre: true,
                            title: 'Solicitudes Registradas',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4,  6, 7, 8]
                            }
                        },
                        {
                            extend: 'copyHtml5',
                            text: '<i class="fas fa-copy"></i>',
                            autoFiltre: true,
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
            $('#solicitudesAsignadas').html(error);
        });
    }
    
    /// INICIAR UNA TAREA///
    $(document).on('click', '#btnIniciarTarea', function (event) {
        event.preventDefault();
        $.ajax({
            url: '../controladorAdministrador/tarea/tarea.create.php',
            type: 'POST',
            dataType: 'json',
            data: $('#buscar').serialize(),
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
            data: $('#buscar').serialize(),
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
            data: $('#buscar').serialize(),
        }).done(function (json) {
        }).fail(function (xhr, status, error) {
        })
    })


})
