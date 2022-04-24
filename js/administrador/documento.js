function cargar1() {
    window.location.href = "../administrador/documentos.php";
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

function estadoDocumento(id_versionamiento, estado_version) {
    $("#numeroVersionamiento").val(id_versionamiento);
    $("#estadoDocAct").val(estado_version);
}

function modDoc(id_documento, nombre_documento) {
    $("#idDocumentoCambiar").val(id_documento);
    $("#nuevoNombreDoc").val(nombre_documento);
}

function modificarTipoDoc (id_tipo_documento, tipo_documento, sigla_tipo_documento){    
    $("#numidTipoDocumentoMod").val(id_tipo_documento);
    $("#txtTipoDocumentoMod").val(tipo_documento);
    $("#txtSiglaTipoDocumentoMod").val(sigla_tipo_documento);
}

function eliminacionTipoDoc (id_tipo_documento, tipo_documento, sigla_tipo_documento){
    $("#numidTipDocElim").val(id_tipo_documento);
    $("#txtTipoDocElim").val(tipo_documento);
    $("#txtSiglaTipDocElim").val(sigla_tipo_documento);
}

$(document).ready(function () {
    buscar();    
    buscarTipoDocumento();
    buscarDocuCrea();
    buscarDocuAdm();
    buscarDocuObs();
    buscaDocTra();
    buscarTipoDocumento1()
    /**
     * Se realiza la consulta de los documentos vigentes para mostrar en la vistaEmpleado/consultas.frm.php
     */
    /// MOSTRAR TIPO DOCUMENTOS ///
    function buscarTipoDocumento(){
    $.ajax({
        url:'../controladorAdministrador/tipoDocumento.read.php',
        type: 'POST',
        dataType: 'json',
        data : null,
    }).done(function(json){
            /**
         * Se crea la tabla para mostrar los datos consultados
         */
        var datos = '';
            datos += "<table id='tablaTipoDoc' class='table  table-striped table-bordered table-responsive '  >"; 
            datos += '<thead >';
                    datos += '<tr class="table-light border-primary ">';
                        datos += '<th  class="text-center align-middle border border-primary ">NOMBRE TIPO DOCUMENTO</th>';
                        datos += '<th  class="text-center align-middle border border-primary ">SIGLA TIPO DOCUMENTO</th>';
                        datos += '<th  class="text-center align-middle border border-primary ">ESTADO TIPO DOCUMENTO</th>';
                        datos += '<th  class="text-center align-middle border border-primary ">ACTUALIZAR TIPO DOCUMENTO</th>';
                        datos += '<th  class="text-center align-middle border border-primary ">CAMBIAR ESTADO</th>';
                    datos += '</tr>';
                datos +=  '</thead>';
                datos += '<tbody>';
                    $.each(json, function(key, value){
                        datos += '<tr class="align-middle" >';
                            datos += '<td class=" border border-primary text-center align-middle">'+value.tipo_documento+'</td>';
                            datos += '<td class=" border border-primary text-center align-middle">'+value.sigla_tipo_documento+'</td>';
                            datos += '<td class=" border border-primary text-center align-middle">'+value.estado+'</td>';
                            datos += '<td class=" border border-primary text-center align-middle"><button type="button" onclick="modificarTipoDoc('+value.id_tipo_documento+',\''+value.tipo_documento+'\',\''+value.sigla_tipo_documento+'\')" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#actualizarTipoDocuento"><i class="far fa-edit"></i></button></td>';
                            datos += '<td class=" border border-primary text-center align-middle"><button type="button" onclick="eliminacionTipoDoc('+value.id_tipo_documento+',\''+value.tipo_documento+'\',\''+value.sigla_tipo_documento+'\')" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cambiarEstadoTipoDoc"><i class="fas fa-times"></i></button></td>';
                        datos += '</tr>';
                    });
                datos += '</tbody>';
            datos += '</table>';
        $('#tipoDocumentos').html(datos);
        $('#tablaTipoDoc').dataTable({
            "destroy" : true,
            "autoWidth": true,
            "responsive": true,
            "searching": true,
            "info":     true,
            "ordering": true,
            "colReorder": true,
            "sZeroRecords": true,
            
            "keys": true,
            "deferRender": true,
            "lengthMenu":	[[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
            "iDisplayLength":	20,
            "language": {"url": "../componente/libreria/idioma/es-mx.json"},
            dom:  'Qfrtip',
            dom:  'Bfrtip',
            searchBuilder: true,
            buttons: [
                {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'A4',
                    download: 'open',
                    title: 'Tipo Documentos',
                    titleAttr: 'Tipo Documentos',
                    messageTop: 'Tipo Documentos',
                    text : '<i class="far fa-file-pdf"></i>',
                    exportOptions : {
                        columns: [0,1,2,3]
                    }
                },
                {
                    extend: 'print',
                    title: 'Tipo Documentos',
                    titleAttr: 'Tipo Documentos',
                    messageTop: 'Tipo Documentos',
                    text : '<i class="fas fa-print"></i>',
                    exportOptions : {
                        columns: [0,1,2,3]
                    }
                },
                {
                    extend: 'excelHtml5',
                    text : '<i class="fas fa-file-excel"></i>',
                    autoFiltre : true ,
                    title: 'Tipo Documentos',
                    exportOptions : {
                        columns: [0,1,2,3]
                    }
                },
                {
                    extend: 'copyHtml5',
                    text : '<i class="fas fa-copy"></i>',
                    autoFiltre : true ,
                    titleAttr: 'COPIAR',
                    exportOptions : {
                        columns: [0,1,2,3]
                    }
                },
                {
                    extend: 'searchBuilder'
                    
                }                      
            ],
            
        });
    }).fail(function(xhr, status, error){
        $('#tipoDocumentos').html(error);
    })
    }

    /// REGISTRAR TIPO DOCUMENTOS ///
    $(document).on('click','#btnRegistrarTipoDocumento',function(event){
        event.preventDefault();
            $.ajax({
                url:'../controladorAdministrador/tipoDocumento.create.php',
                type: 'POST',
                dataType: 'json',
                data : $('#TipoDocumentos').serialize(),
            }).done(function(json){
                if(json !== null){
                    Swal.fire({
                        icon: 'error',
                        title: 'Error el tipo de documento o la sigla ya existen',
                    });
                }else{
                    Swal.fire({
                        icon: 'success',
                        title: 'Tipo de documento creado con éxito',
                        showConfirmButton: false,
                        timer: 2500
                    }).then((result) => {
                        cargar1();
                    });
                }
                    
            }).fail(function(xhr, status, error){
                Swal.fire({
                    icon: 'error',
                    title: 'Error al crear el tipo de documento',
                });
        })
    })

    /// MODIFICAR TIPO DOCUMENTOS///
    $(document).on('click','#btnModificarTipoDoc',function(event){
    event.preventDefault();
        $.ajax({
            url:'../controladorAdministrador/tipoDocumento.update.php',
            type: 'POST',
            dataType: 'json',
            data : $('#ModificarTipoDoc').serialize(),
        }).done(function(json){
            if(json !== null){
                Swal.fire({
                    icon: 'error',
                    title: 'Error el tipo de documento o la sigla ya existen',
                });
            }else{
                Swal.fire({
                    icon: 'success',
                    title: 'Tipo de documento actualizado con éxito',
                    showConfirmButton: false,
                    timer: 2500
                    }).then((result) => {
                        cargar1();
                    });
                }
        }).fail(function(xhr, status, error){
            Swal.fire({
                icon: 'error',
                title: 'Error al actualizar el tipo de documento',
            });
        })
    })

    /// CAMBIO DE ESTADO TIPO DOCUMENTOS///
    $(document).on('click','#btnEliminarTipDoc',function(event){
            event.preventDefault();
                $.ajax({
                    url:'../controladorAdministrador/tipoDocumento.delete.php',
                    type: 'POST',
                    dataType: 'json',
                    data : $('#inactivarTipoDoc').serialize(),
                }).done(function(json){
                    if(json !== null){
                        Swal.fire({
                            icon: 'error',
                            title: 'Error no se puede modificar el estado',
                        });
                    }else{
                        Swal.fire({
                            icon: 'success',
                            title: 'Estado actualizado con éxito',
                            showConfirmButton: false,
                            timer: 2500
                            }).then((result) => {
                                cargar1();
                        });
                    }
                }).fail(function(xhr, status, error){
                    Swal.fire({
                        icon: 'error',
                        title: 'Error al actualizar el estado',
                    });
            })
    
    })

    buscarMacroproceso();
    /// MOSTRAR PROCESO ///
    function buscarMacroproceso() {
        $.ajax({
            url: '../controladorAdministrador/macroproceso.read.php',
            type: 'GET',
            dataType: 'json',
            data: null,
        }).done(function (json) {
            var macroproceso = "";
            macroproceso += '<option> - Seleccione un Macroproceso -</option>';
            $.each(json, function (key, value) {
                if (value.estado == "ACTIVO") {
                    macroproceso += '<option value='+ value.id_macroproceso +'>' +value.macroproceso+'</option>';
                }
            });
            $('#macroprocesoNuevo').html(macroproceso);
        }).fail(function (xhr, status, error) {
            $('#macroprocesoNuevo').html(error);
        });
    }
    	
    $("#macroprocesoNuevo").change(function () {
        buscarProceso(this.value);
    });

    buscarProceso("")
    /// MOSTRAR PROCESO ///
    function buscarProceso(id_macroproceso) {
        $.ajax({
            url: '../controladorAdministrador/proceso.read.php',
            type: 'GET',
            dataType: 'json',
            data: null,
        }).done(function (json) {
            var proceso = 0;
            var filter = json.filter(e=>e.id_macroproceso == id_macroproceso)

            proceso += '<option disabled selected> - Seleccione un Proceso -</option>';

            $.each(filter, function (key, value) {
                if (value.estado == "ACTIVO") {
                    proceso += '<option   value=' + value.id_proceso + '>'+value.proceso+'</option>';
                }
            });
            $('#procesoNuevo').html(proceso);
        }).fail(function (xhr, status, error) {
            $('#procesoNuevo').html(error);
        });
    }

    /// MOSTRAR TIPO DOCUMENTOS ///
   function buscarTipoDocumento1() {
        $.ajax({
            url: '../controladorAdministrador/tipoDocumento.read.php',
            type: 'POST',
            dataType: 'json',
            data: null,
        }).done(function (json) {
            var tipoDocumento = 0;
            tipoDocumento += '<option disabled selected> - Seleccione un Tipo de Documento -</option>';
            $.each(json, function (key, value) {
                if (value.estado == "ACTIVO") {
                    tipoDocumento += '<option value=' + value.id_tipo_documento +'>'+value.sigla_tipo_documento+ ' - ' + value.tipo_documento + '</option>';
                }
            });
            $('#tipoDocumento').html(tipoDocumento);
        }).fail(function (xhr, status, error) {
            $('#tipoDocumento').html(error);
        });
    }
    
    /// CREAR NÚMERO   DE CÓDIGO ///
    $(document).on('click', '#btnAsignarCod', function (event) {
        event.preventDefault();
        $.ajax({
            url: '../controladorAdministrador/codigo.read.php',
            type: 'POST',
            dataType: 'json',
            data: $('#crearDoc').serialize(),
        }).done(function (json) {
            if (json == "") {
                var resul = 1;
                $('#txtcodigo').val(resul);
                $("#btnAsignarCod").prop("hidden", true);
                $("#macroprocesoNuevo").prop("disabled", true);
                $("#procesoNuevo").prop("disabled", true);
                $("#tipoDocumento").prop("disabled", true);
                $("#nombreAsig").prop("hidden", false);
                $("#codigoAsi").prop("hidden", false);
                $("#btncrearDoc").prop("hidden", false);
                $("#btncrearResDoc").prop("hidden", false);
                $("#objetivoDoc").prop("hidden", false);
            } else {
                var miCadena = "";
                var divisiones = "";
                var sss = "";
                var dd = "";
                var resul = 0;
                $.each(json, function (key, value) {
                    miCadena = value.codigo;
                    divisiones = miCadena.split("-");
                    sss = divisiones[2];
                    dd = parseInt(sss);
                    var uno = 1;
                    resul = dd + uno;
                })
                $('#txtcodigo').val(resul);
                $("#btnAsignarCod").prop("hidden", true);
                $("#macroprocesoNuevo").prop("disabled", true);
                $("#procesoNuevo").prop("disabled", true);
                $("#tipoDocumento").prop("disabled", true);
                $("#nombreAsig").prop("hidden", false);
                $("#codigoAsi").prop("hidden", false);
                $("#btncrearDoc").prop("hidden", false);
                $("#btncrearResDoc").prop("hidden", false);
                $("#objetivoDoc").prop("hidden", false);
            };
        }).fail(function (xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error al crear el documento',
            });
        });
    });
    
    $(document).on('click', '#btncrearResDoc', function () {
        $("#btnAsignarCod").prop("hidden", false);
        $("#macroprocesoNuevo").prop("disabled", false);
        $("#procesoNuevo").prop("disabled", false);
        $("#tipoDocumento").prop("disabled", false);
        $("#nombreAsig").prop("hidden", true);
        $("#codigoAsi").prop("hidden", true);
        $("#btncrearDoc").prop("hidden", true);
        $("#btncrearResDoc").prop("hidden", true)
        $("#objetivoDoc").prop("hidden", true);
    })

    /// CREAR DOCUMENTO///
    $(document).on('click', '#btncrearDoc', function (event) {
        event.preventDefault();
        $.ajax({
            url: '../controladorAdministrador/documento.create.php',
            type: 'POST',
            dataType: 'json',
            data: $('#crearDoc').serialize(),
        }).done(function (json) {
            if (json[0].proceso == "OK") {
                Swal.fire({
                    icon: 'success',
                    title: 'Documento Creado con Exito',
                    showConfirmButton: false,
                   
                }).then((result) => {
                    
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'No se pudo crear el Documento!.. Favor Verifique los datos ingresado!',
                    showConfirmButton: false,
                   
                }).then((result) => {
                   
                });
            }
        }).fail(function (xhr, status, error) {

        });

    });


   /// MOSTRAR DOCUMENTOS CREADOS
    function buscarDocuCrea() {
        $.ajax({
        url: '../controladorAdministrador/documento.read2.php',
        type: 'POST',
        dataType: 'json',
        data: null,
        }).done(function (json) {
        /**
         * Se crea la tabla para mostrar los datos consultados
         */
        var datos = '';
        datos += "<table id='tableConsultaDocR'  class='table  table-striped table-bordered table-responsive '   >";
            datos += '<thead >';
                datos += '<tr class="table-light border-primary ">';
                    datos += '<th  class="text-center align-middle border border-primary " >MACROPROCESO  </th>' ;
                    datos += '<th  class="text-center align-middle border border-primary ">PROCESO</th>';
                    datos += '<th  class="text-center align-middle border border-primary ">TIPO DOCUMENTO</th>';
                    datos += '<th  class="text-center align-middle border border-primary ">CÓDIGO </th>';
                    datos += '<th  class="text-center align-middle border border-primary ">NOMBRE DOCUMENTO</th>';
                    datos += '<th  class="text-center align-middle border border-primary ">VERSIÓN</th>';
                    datos += '<th  class="text-center align-middle border border-primary ">MODIFICAR  NOMBRE</th>';
                    datos += '<th  class="text-center align-middle border border-primary ">ESTADO</th>';
                    datos += '<th  class="text-center align-middle border border-primary ">CAMBIAR ESTADO</th>';
                datos += '</tr>';
            datos += '</thead>';
        datos += '<tbody>';
        $.each(json, function (key, value) {
            datos += '<tr class="align-middle" >';
            datos += '<td class=" border border-primary  text-wrap" >' + value.id_versionamiento + '</td>';
            datos += '<td class=" border border-primary  text-wrap">' + value.proceso + '</td>';
            datos += '<td class=" border border-primary  text-wrap">' + value.tipo_documento + '</td>';
            datos += '<td class=" border border-primary text-wrap align-middle">' + value.codigo + '</td>';
            datos += '<td class=" border border-primary text-wrap">' + value.nombre_documento + '</td>';
            datos += '<td class= "text-center align-middle border border-primary ">' + value.numero_version + '</td>';
            datos += '<td class=" border border-primary text-wrap">' + value.estado_version + '</td>';
            datos += '<td class=" border border-primary text-center align-middle"><button type="button" onclick="modDoc(' + value.id_documento + ',\'' + value.nombre_documento + '\')" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modifiDoc"><i class="fas fa-edit"></i></button></td>';
            datos += '<td class=" border border-primary text-wrap">' + value.estado_version + '</td>';
            datos += '</tr>';
        })
        datos += '</tbody>';
        datos += '</table>';
        $('#documentosRg').html(datos);
        $('#tableConsultaDocR').DataTable({
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
            "lengthMenu": [
                [5, 10, 20, 25, 50, -1],
                [5, 10, 20, 25, 50, "Todos"]
            ],
            "iDisplayLength": 100,
            "language": {
                "url": "../componente/libreria/idioma/es-mx.json"
            },
            dom: 'Qfrtip',
            dom: 'Bfrtip',
            order: [
                [1, 'asc'],
                [2, 'asc']
            ],
            rowGroup: {
                dataSrc: 1
            },
            buttons: [{
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'A4',
                    download: 'open',
                    title: 'Documentos Registrados',
                    titleAttr: 'Documentos Registrados',
                    messageTop: 'Documentos Registrados',
                    text: '<i class="far fa-file-pdf"></i>',
                    exportOptions: {
                        columns: [ 1, 2, 3, 4, 5,6]
                    }
                },
                {
                    extend: 'print',
                    title: 'Documentos Registrados',
                    titleAttr: 'Documentos Registrados',
                    messageTop: 'Documentos Registrados',
                    text: '<i class="fas fa-print"></i>',
                    exportOptions: {
                        columns: [ 1, 2, 3, 4, 5,6]
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class="fas fa-file-excel"></i>',
                    autoFiltre: true,
                    title: 'Documentos Registrados',
                    exportOptions: {
                        columns: [ 1, 2, 3, 4, 5,6]
                    }
                },
                {
                    extend: 'copyHtml5',
                    text: '<i class="fas fa-copy"></i>',
                    autoFiltre: true,
                    titleAttr: 'COPIAR',
                    exportOptions: {
                        columns: [ 1, 2, 3, 4, 5,6]
                    }
                },
                {
                    extend: 'searchBuilder'

                }
            ]
        });
        }).fail(function (xhr, status, error) {
        $('#documentosRg').html(error);
        })
    }
    



















 
    /// MOSTRAR PARA ADMINISTRACIÓN DE DOCMENTOS
    function buscarDocuAdm() {
        $.ajax({
            url: '../controladorAdministrador/documento.read4.php',
            type: 'POST',
            dataType: 'json',
            data: null,
        }).done(function (json) {
            /**
             * Se crea la tabla para mostrar los datos consultados
             */
            var datos = '';
            datos += "<table id='tableConsultaAdm'  class='table  table-striped table-bordered table-responsive    '   >";
            datos += '<thead >';
            datos += '<tr class="table-light border-primary ">';
            datos += '<th  class="text-center align-middle border border-primary " hidden>NÚMERO  </th>' ;
            datos += '<th  class="text-center align-middle border border-primary ">PROCESO</th>';
            datos += '<th  class="text-center align-middle border border-primary ">TIPO DOCUMENTO</th>';
            datos += '<th  class="text-center align-middle border border-primary ">CÓDIGO </th>';
            datos += '<th  class="text-center align-middle border border-primary ">NOMBRE DOCUMENTO</th>';
            datos += '<th  class="text-center align-middle border border-primary ">VERSIÓN</th>';
            datos += '<th  class="text-center align-middle border border-primary ">INACTIVAR</th>';
            datos += '</tr>';
            datos += '</thead>';
            datos += '<tbody>';
            $.each(json, function (key, value) {
                if (value.estado_version = 'V') {
                    estado_version = 'Vigente'
                }
                datos += '<tr class="align-middle" >';
                datos += '<td class=" border border-primary  text-wrap" hidden>' + value.id_versionamiento + '</td>';
                datos += '<td class=" border border-primary text-wrap">' + value.proceso + '</td>';
                datos += '<td class=" border border-primary text-wrap">' + value.tipo_documento + '</td>';
                datos += '<td class=" border border-primary text-wrap align-middle">' + value.codigo + '</td>';
                datos += '<td class=" border border-primary text-wrap">' + value.nombre_documento + '</td>';
                datos += '<td class=" border border-primary text-center align-middle">' + value.numero_version + '</td>';
                datos += '<td class=" border border-primary text-center align-middle"><button type="button" onclick="estadoDocumento(' + value.id_versionamiento + ',\'' + estado_version + '\')" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#inactivarDoc"><i class="fas fa-times"></i></button></td>';
                datos += '</tr>';
            })
            datos += '</tbody>';
            datos += '</table>';
            $('#documentosAdm').html(datos);
            $('#tableConsultaAdm').DataTable({
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
                "lengthMenu": [
                    [5, 10, 20, 25, 50, -1],
                    [5, 10, 20, 25, 50, "Todos"]
                ],
                "iDisplayLength": 100,
                "language": {
                    "url": "../componente/libreria/idioma/es-mx.json"
                },
                dom: 'Qfrtip',
                dom: 'Bfrtip',
                order: [
                    [1, 'asc'],
                    [2, 'asc']
                ],
                rowGroup: {
                    dataSrc: 1
                },
                buttons: [{
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        download: 'open',
                        title: 'Documentos Registrados',
                        titleAttr: 'Documentos Registrados',
                        messageTop: 'Documentos Registrados',
                        text: '<i class="far fa-file-pdf"></i>',
                        exportOptions: {
                            columns: [ 1, 2, 3, 4 ,5]
                        }
                    },
                    {
                        extend: 'print',
                        title: 'Documentos Registrados',
                        titleAttr: 'Documentos Registrados',
                        messageTop: 'Documentos Registrados',
                        text: '<i class="fas fa-print"></i>',
                        exportOptions: {
                            columns: [ 1, 2, 3, 4  ,5]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i>',
                        autoFiltre: true,
                        title: 'Documentos Registrados',
                        exportOptions: {
                            columns: [ 1, 2, 3, 4 ,5]
                        }
                    },
                    {
                        extend: 'copyHtml5',
                        text: '<i class="fas fa-copy"></i>',
                        autoFiltre: true,
                        titleAttr: 'COPIAR',
                        exportOptions: {
                            columns: [ 1, 2, 3, 4 ,5]
                        }
                    },
                    {
                        extend: 'searchBuilder'

                    }
                ]
            });
        }).fail(function (xhr, status, error) {
            $('#documentosAdm').html(error);
        })
    }

    /// MOSTRAR DOCUMENTOS OBSOLETOS
    function buscarDocuObs() {
        $.ajax({
            url: '../controladorAdministrador/documento.obsoletos.read.php',
            type: 'POST',
            dataType: 'json',
            data: null,
        }).done(function (json) {
            /**
             * Se crea la tabla para mostrar los datos consultados
             */
            var datos = '';
            datos += "<table id='tableConsultaObso'  class='table  table-striped table-bordered table-responsive '    >";
            datos += '<thead >';
            datos += '<tr class="table-light border-primary ">';
            datos += '<th  class="text-center align-middle border border-primary " hidden>NÚMERO  </th>' ;
            datos += '<th  class="text-center align-middle border border-primary ">PROCESO</th>';
            datos += '<th  class="text-center align-middle border border-primary ">TIPO DOCUMENTO</th>';
            datos += '<th  class="text-center align-middle border border-primary ">CÓDIGO </th>';
            datos += '<th  class="text-center align-middle border border-primary ">NOMBRE DOCUMENTO</th>';
            datos += '<th  class="text-center align-middle border border-primary ">VERSIÓN</th>';
            datos += '<th  class="text-center align-middle border border-primary ">VER DOCUMENTO</th>';
            datos += '<th  class="text-center align-middle border border-primary ">FECHA INACTIVACIÓN</th>';
            datos += '</tr>';
            datos += '</thead>';
            datos += '<tbody>';
            $.each(json, function (key, value) {
                datos += '<tr class="align-middle" >';
                datos += '<td class=" border border-primary  text-wrap" hidden>' + value.id_versionamiento + '</td>';
                datos += '<td class=" border border-primary  text-wrap">' + value.proceso + '</td>';
                datos += '<td class=" border border-primary text-wrap align-middle">' + value.tipo_documento + '</td>';
                datos += '<td class=" border border-primary  text-wrap ">' + value.codigo + '</td>';
                datos += '<td class=" border border-primary text-wrap">' + value.nombre_documento + '</td>';
                datos += '<td class=" border border-primary text-center align-middle">' + value.numero_version + '</td>';
                datos += '<td class=" border border-primary text-center align-middle"><a class="btn btn-primary" href="../documentos/procesos/' + value.sigla_proceso + '/' + value.sigla_tipo_documento + '/' +value.codigo+ '/' + value.numero_version + '/' + value.documento + '"><i class="fas fa-download"></i></a></td>';
                datos += '<td class=" border border-primary text-wrap">' + value.fecha_obsoleto + '</td>';
                datos += '</tr>';
            })
            datos += '</tbody>';
            datos += '</table>';
            $('#documentosObs').html(datos);
            $('#tableConsultaObso').DataTable({
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
                "lengthMenu": [
                    [5, 10, 20, 25, 50, -1],
                    [5, 10, 20, 25, 50, "Todos"]
                ],
                "iDisplayLength": 100,
                "language": {
                    "url": "../componente/libreria/idioma/es-mx.json"
                },
                dom: 'Qfrtip',
                dom: 'Bfrtip',
                order: [
                    [1, 'asc'],
                    [2, 'asc']
                ],
                rowGroup: {
                    dataSrc: 1
                },
                buttons: [{
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        download: 'open',
                        title: 'Documentos Obsoletos',
                        titleAttr: 'Documentos Obsoletos',
                        messageTop: 'Documentos Obsoletos',
                        text: '<i class="far fa-file-pdf"></i>',
                        exportOptions: {
                            columns: [ 1, 2, 3, 4,5,7 ]
                        }
                    },
                    {
                        extend: 'print',
                        title: 'Documentos Obsoletos',
                        titleAttr: 'Documentos Obsoletos',
                        messageTop: 'Documentos Obsoletos',
                        text: '<i class="fas fa-print"></i>',
                        exportOptions: {
                            columns: [ 1, 2, 3, 4,5,7]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i>',
                        autoFiltre: true,
                        title: 'Documentos Obsoletos',
                        exportOptions: {
                            columns: [ 1, 2, 3, 4,5,7]
                        }
                    },
                    {
                        extend: 'copyHtml5',
                        text: '<i class="fas fa-copy"></i>',
                        autoFiltre: true,
                        titleAttr: 'COPIAR',
                        exportOptions: {
                            columns: [ 1, 2, 3, 4,5,7]
                        }
                    },
                    {
                        extend: 'searchBuilder'

                    }
                ]
            });
        }).fail(function (xhr, status, error) {
            $('#documentosObs').html(error);
        })
    }

    /// MOSTRAR DOCUMENTOS TRAMITE
    function buscaDocTra() {
        $.ajax({
            url: '../controladorAdministrador/documento.tramite.read.php',
            type: 'POST',
            dataType: 'json',
            data: null,
        }).done(function (json) {
            /**
             * Se crea la tabla para mostrar los datos consultados
             */
            var datos = '';
            datos += "<table id='tableConsultaTram'  class='table  table-striped table-bordered table-responsive '    >";
            datos += '<thead >';
            datos += '<tr class="table-light border-primary ">';
            datos += '<th  class="text-center align-middle border border-primary " hidden>NÚMERO  </th>' ;
            datos += '<th  class="text-center align-middle border border-primary ">PROCESO</th>';
            datos += '<th  class="text-center align-middle border border-primary ">TIPO DOCUMENTO</th>';
            datos += '<th  class="text-center align-middle border border-primary ">CÓDIGO </th>';
            datos += '<th  class="text-center align-middle border border-primary ">NOMBRE DOCUMENTO</th>';
            datos += '<th  class="text-center align-middle border border-primary ">VERSIÓN</th>';
            datos += '<th  class="text-center align-middle border border-primary ">VER DOCUMENTO</th>';
            datos += '</tr>';
            datos += '</thead>';
            datos += '<tbody>';
            $.each(json, function (key, value) {
                datos += '<tr class="align-middle" >';
                datos += '<td class=" border border-primary  text-wrap" hidden>' + value.id_versionamiento + '</td>';
                datos += '<td class=" border border-primary  text-wrap">' + value.proceso + '</td>';
                datos += '<td class=" border border-primary text-wrap align-middle">' + value.tipo_documento + '</td>';
                datos += '<td class=" border border-primary  text-wrap ">' + value.codigo + '</td>';
                datos += '<td class=" border border-primary text-wrap">' + value.nombre_documento + '</td>';
                datos += '<td class=" border border-primary text-center align-middle">' + value.numero_version + '</td>';
                datos += '<td class=" border border-primary text-center align-middle"><a class="btn btn-primary" href="../documentos/procesos/' + value.sigla_proceso + '/' + value.sigla_tipo_documento + '/' +value.codigo+ '/' + value.numero_version + '/' + value.documento + '"><i class="fas fa-download"></i></a></td>';
                datos += '</tr>';
            })
            datos += '</tbody>';
            datos += '</table>';
            $('#Doctramite').html(datos);
            $('#tableConsultaTram').DataTable({
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
                "lengthMenu": [
                    [5, 10, 20, 25, 50, -1],
                    [5, 10, 20, 25, 50, "Todos"]
                ],
                "iDisplayLength": 100,
                "language": {
                    "url": "../componente/libreria/idioma/es-mx.json"
                },
                dom: 'Qfrtip',
                dom: 'Bfrtip',
                order: [
                    [1, 'asc'],
                    [2, 'asc']
                ],
                rowGroup: {
                    dataSrc: 1
                },
                buttons: [{
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        download: 'open',
                        title: 'Documentos En Tramite',
                        titleAttr: 'Documentos En Tramite',
                        messageTop: 'Documentos En Tramite',
                        text: '<i class="far fa-file-pdf"></i>',
                        exportOptions: {
                            columns: [ 1, 2, 3, 4,5]
                        }
                    },
                    {
                        extend: 'print',
                        title: 'Documentos En Tramite',
                        titleAttr: 'Documentos En Tramite',
                        messageTop: 'Documentos En Tramite',
                        text: '<i class="fas fa-print"></i>',
                        exportOptions: {
                            columns: [ 1, 2, 3, 4,5]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i>',
                        autoFiltre: true,
                        title: 'Documentos En Tramite',
                        exportOptions: {
                            columns: [ 1, 2, 3, 4,5]
                        }
                    },
                    {
                        extend: 'copyHtml5',
                        text: '<i class="fas fa-copy"></i>',
                        autoFiltre: true,
                        titleAttr: 'COPIAR',
                        exportOptions: {
                            columns: [ 1, 2, 3, 4,5   ]
                        }
                    },
                    {
                        extend: 'searchBuilder'

                    }
                ]
            });
        }).fail(function (xhr, status, error) {
            $('#Doctramite').html(error);
        })
    }



     /// CAMBIAR NOMBRE DE DOCUMENTO///
     $(document).on('click', '#btnCambiarNomDoc', function (event) {
        event.preventDefault();
        $.ajax({
            url: '../controladorAdministrador/documento.update.php',
            type: 'POST',
            dataType: 'json',
            data: $('#cambiarNomDoc').serialize(),
        }).done(function (json) {
            Swal.fire({
                icon: 'success',
                title: 'Documento Modificado con Exito',
                showConfirmButton: false,
                timer: 3000
            }).then((result) => {
                cargar1();
            })
        }).fail(function (xhr, status, error) {
            alert(error);
        })

    })

   

    /// Inactivar Docum ///
    $(document).on('click', '#btnInactivarDoc', function (event) {
        event.preventDefault();
        $.ajax({
            url: '../controladorAdministrador/versionamiento.update.php',
            type: 'POST',
            dataType: 'json',
            data: $('#inactivarDocVig').serialize(),
        }).done(function (json) {
            Swal.fire({
                icon: 'success',
                title: 'Documento Inactivado con Exito',
                showConfirmButton: false,
                timer: 3000
            }).then((result) => {
                cargar1();
            })
        }).fail(function (xhr, status, error) {
            alert(error);
        })
    })



    function buscar() {
        $.ajax({
            url: '../controladorAdministrador/documento.read.php',
            type: 'POST',
            dataType: 'json',
            data: null,
        }).done(function (json) {
            /**
             * Se crea la tabla para mostrar los datos consultados
             */
            var datos = '';
            datos += "<table id='tableConsultaDoc'  class='table  table-striped table-bordered table-responsive '   >";
            datos += '<thead >';
            datos += '<tr class="table-light border-primary ">';
            datos += '<th  class="text-center align-middle border border-primary " >MACROPROCESO  </th>' ;
            datos += '<th  class="text-center align-middle border border-primary " >PROCESO</th>' ;
            datos += '<th  class="text-center align-middle border border-primary ">TIPO DOCUMENTO</th>';
            datos += '<th  class="text-center align-middle border border-primary ">CÓDIGO </th>';
            datos += '<th  class="text-center align-middle border border-primary ">NOMBRE DOCUMENTO</th>';
            datos += '<th  class="text-center align-middle border border-primary ">VERSIÓN</th>';
            datos += '<th  class="text-center align-middle border border-primary ">FECHA DE VIGENCIA</th>';
            datos += '<th  class="text-center align-middle border border-primary ">DESCARGAR DOCUMENTO</th>';
            datos += '</tr>';
            datos += '</thead>';
            datos += '<tbody>';
            $.each(json, function (key, value) {
                datos += '<tr class="align-middle" >';
                datos += '<td class=" border border-primary  text-wrap" >' + value.id_versionamiento + '</td>';
                datos += '<td class=" border border-primary  text-wrap">' + value.proceso + '</td>';
                datos += '<td class=" border border-primary text-center align-middle">' + value.tipo_documento + '</td>';
                datos += '<td class=" border border-primary text-wrap align-middle">' + value.codigo + '</td>';
                datos += '<td class=" border border-primary text-wrap">' + value.nombre_documento + '</td>';
                datos += '<td class=" border border-primary text-center align-middle">' + value.numero_version + '</td>';
                datos += '<td class=" border border-primary text-center align-middle">' + value.fecha_aprobacion + '</td>';
                datos += '<td class=" border border-primary text-center align-middle"><a class="btn btn-primary" href="../documentos/procesos/' + value.sigla_proceso + '/' + value.sigla_tipo_documento + '/' +value.codigo+ '/'+ value.numero_version + '/' + value.documento + '"><i class="fas fa-download"></i></a></td>';
                datos += '</tr>';
            });
            datos += '</tbody>';
            datos += '</table>';
            $('#consulta').html(datos);
            $('#tableConsultaDoc').DataTable({
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
                "lengthMenu": [
                    [5, 10, 20, 25, 50, -1],
                    [5, 10, 20, 25, 50, "Todos"]
                ],
                "iDisplayLength": 100,
                "language": {
                    "url": "../componente/libreria/idioma/es-mx.json"
                },
                dom: 'Qfrtip',
                dom: 'Bfrtip',
                order: [
                    [1, 'asc'],
                    [2, 'asc'],
                    
                ],
                rowGroup: {
                    dataSrc: 1
                },
                buttons: [{
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        download: 'open',
                        title: 'Documentos Vigentes',
                        titleAttr: 'Documentos Vigentes',
                        messageTop: 'Documentos Vigentes',
                        text: '<i class="far fa-file-pdf"></i>',
                        exportOptions: {
                            columns: [ 1, 2, 3, 4, 5,6]
                        }
                    },
                    {
                        extend: 'print',
                        title: 'Documentos Vigentes',
                        titleAttr: 'Documentos Vigentes',
                        messageTop: 'Documentos Vigentes',
                        text: '<i class="fas fa-print"></i>',
                        exportOptions: {
                            columns: [ 1, 2, 3, 4, 5,6]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i>',
                        autoFiltre: true,
                        title: 'Documentos Vigentes',
                        exportOptions: {
                            columns: [ 1, 2, 3, 4, 5,6]
                        }
                    },
                    {
                        extend: 'copyHtml5',
                        text: '<i class="fas fa-copy"></i>',
                        autoFiltre: true,
                        titleAttr: 'COPIAR',
                        exportOptions: {
                            columns: [ 1, 2, 3, 4, 5,6]
                        }
                    },
                    {
                        extend: 'searchBuilder'

                    }
                ]
            });
        }).fail(function (xhr, status, error) {
            $('#consulta').html(error);
        });
    }




    /// MOSTRAR FORMULARIO PARA CREAR TIPO DE DOCUMENO///
    $(document).on('click','#btnCrearTipoDoc', function(){
        $("#btnCrearTipoDoc").prop("hidden", true);
        $("#TipoDocumentos").prop("hidden", false);
        $("#tipoDocumentosRes").prop("hidden", true);
        $("#volverRegistroTipoDoc").prop("hidden", false);
    })

    /// MOSTRAR PROCESOS REGISTRADOS///
    $(document).on('click','#volverRegistroTipoDoc', function(){
        $("#btnCrearTipoDoc").prop("hidden", false);
        $("#TipoDocumentos").prop("hidden", true);
        $("#tipoDocumentosRes").prop("hidden", false);
        $("#volverRegistroTipoDoc").prop("hidden", true);
    })


})