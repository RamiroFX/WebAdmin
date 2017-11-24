$('#btn_agregarProducto').on('click', function () {
    $('#form_agregarProducto').validate({
        rules: {
            C_DESCRIPCION: {
                required: true,
                rangelength: [2, 50]
            },
            C_CODIGO: {
                rangelength: [2, 30]
            },
            C_PRECIO_MINORISTA: {
                required: true,
                number: true
            },
            C_PRECIO_COSTO: {
                required: true,
                number: true
            },
            C_PRECIO_MAYORISTA: {
                required: true,
                number: true
            },
            C_CANT_ACTUAL: {
                required: true,
                number: true
            },
            C_ID_CATEGORIA: {
                required: true,
                number: true
            },
            C_ID_MARCA: {
                required: true,
                number: true
            },
            C_ID_IMPUESTO: {
                required: true,
                number: true
            }
        },
        messages: {
            C_DESCRIPCION: {
                required: "Ingrese el nombre del producto",
                rangelength: "Por favor, ingrese un valor entre 2 y 50 caracteres"
            },
            C_CODIGO: {
                rangelength: "Por favor, ingrese un valor entre 2 y 30 caracteres"
            },
            C_PRECIO_MINORISTA: {
                required: "Ingrese el precio de venta",
                number: "Por favor, ingrese solo números"
            },
            C_PRECIO_COSTO: {
                required: "Ingrese el precio de costo",
                number: "Por favor, ingrese solo números"
            },
            C_PRECIO_MAYORISTA: {
                required: "Ingrese el precio mayorista",
                number: "Por favor, ingrese solo números"
            },
            C_CANT_ACTUAL: {
                required: "Ingrese el stock inicial",
                number: "Por favor, ingrese solo números"
            },
            C_ID_CATEGORIA: {
                required: "Seleccione una categoría",
                number: "Por favor, ingrese solo números"
            },
            C_ID_MARCA: {
                required: "Seleccione una marca",
                number: "Por favor, ingrese solo números"
            },
            C_ID_IMPUESTO: {
                required: "Seleccione un impuesto",
                number: "Por favor, ingrese solo números"
            }
        },
        submitHandler: function (form) {
            $("#barra_progreso").show();
            var dataString = $('#form_agregarProducto').serialize();
            $.ajax({
                type: "POST",
                url: "includes/producto/agregarProducto.php",
                data: dataString
            }).done(function (data) {
                $("#barra_progreso").hide();
                $("#modal_agregarProducto").modal("hide");
                $("#info").html(data);
                $('#form_agregarProducto')[0].reset();
                verProducto();
            });
            return;
        }
    });
});

$('#btn_modificarProducto').on('click', function () {
    $('#form_modificarProducto').validate({
        rules: {
            M_PROD_DESCRIPCION: {
                required: true,
                rangelength: [2, 50]
            },
            M_PROD_CODIGO: {
                rangelength: [2, 30]
            },
            M_PROD_PRECIO_MINORISTA: {
                required: true,
                number: true
            },
            M_PROD_PRECIO_COSTO: {
                required: true,
                number: true
            },
            M_PROD_PRECIO_MAYORISTA: {
                required: true,
                number: true
            },
            M_PROD_CANT_ACTUAL: {
                number: true
            },
            M_PROD_ID_ESTADO: {
                required: true,
                number: true
            },
            M_PROD_ID_CATEGORIA: {
                required: true,
                number: true
            },
            M_PROD_ID_MARCA: {
                required: true,
                number: true
            },
            M_PROD_ID_IMPUESTO: {
                required: true,
                number: true
            }
        },
        messages: {
            M_PROD_DESCRIPCION: {
                required: "Ingrese el nombre del producto",
                rangelength: "Por favor, ingrese un valor entre 2 y 50 caracteres"
            },
            M_PROD_CODIGO: {
                rangelength: "Por favor, ingrese un valor entre 2 y 30 caracteres"
            },
            M_PROD_PRECIO_MINORISTA: {
                required: "Ingrese el precio de venta",
                number: "Por favor, ingrese solo números"
            },
            M_PROD_PRECIO_COSTO: {
                required: "Ingrese el precio de costo",
                number: "Por favor, ingrese solo números"
            },
            M_PROD_PRECIO_MAYORISTA: {
                required: "Ingrese el precio mayorista",
                number: "Por favor, ingrese solo números"
            },
            M_PROD_CANT_ACTUAL: {
                number: "Por favor, ingrese solo números"
            },
            M_PROD_ID_ESTADO: {
                required: "Seleccione un estado",
                number: "Por favor, ingrese solo números"
            },
            M_PROD_ID_CATEGORIA: {
                required: "Seleccione una categoría",
                number: "Por favor, ingrese solo números"
            },
            M_PROD_ID_MARCA: {
                required: "Seleccione una marca",
                number: "Por favor, ingrese solo números"
            },
            M_PROD_ID_IMPUESTO: {
                required: "Seleccione un impuesto",
                number: "Por favor, ingrese solo números"
            }
        },
        submitHandler: function (form) {
            $("#barra_progreso").show();
            var dataString = $('#form_modificarProducto').serialize();
            $.ajax({
                type: "POST",
                url: "includes/producto/modificarProducto.php",
                data: dataString
            }).done(function (data) {
                $("#barra_progreso").hide();
                $("#modal_modificarProducto").modal("hide");
                $("#info").html(data);
                $('#form_modificarProducto')[0].reset();
                verProducto();
            });
            return;
        }
    });
});

function verProducto() {
    $.ajax({
        type: 'GET',
        url: "includes/producto/verProductos.php"
    }).done(function (msg) {
        $("#verProductos").html(msg);
        $("#barra_progreso").hide();
    });
    return false;
}

function llamarFormularioModificarProducto(idProducto) {
    var url = "php/llamarRegistroProducto.php";
    $.ajax({
        type: "POST",
        url: url,
        data: 'id=' + idProducto
    }).done(function (data) {
        var datos = eval(data);
        $('#M_PROD_ID').val(datos[0]);
        $('#M_PROD_DESCRIPCION').val(datos[1]);
        $('#M_PROD_CODIGO').val(datos[2]);
        $('#M_PROD_ID_ESTADO').val(datos[3]);
        $('#M_PROD_ID_MARCA').val(datos[4]);
        $('#M_PROD_ID_IMPUESTO').val(datos[5]);
        $('#M_PROD_ID_CATEGORIA').val(datos[6]);
        $('#M_PROD_PRECIO_COSTO').val(datos[7]);
        $('#M_PROD_PRECIO_MINORISTA').val(datos[8]);
        $('#M_PROD_PRECIO_MAYORISTA').val(datos[9]);
        $('#M_PROD_CANT_ACTUAL').val(datos[10]);
        $('#modal_modificarProducto').modal({
            show: true,
            backdrop: 'static'
        });
    });
}

function eliminarProducto(idProducto) {
    var dataString = 'ID_PRODUCTO=' + idProducto
            + '&eliminar_producto=3';
    $.ajax({
        type: "POST",
        url: "includes/eliminarProducto.php",
        data: dataString
    }).done(function (data) {
        var datos = eval(data);
        $('#M_PROD_ID').val(datos[0]);
        $('#M_PROD_DESCRIPCION').val(datos[1]);
        $('#M_PROD_CODIGO').val(datos[2]);
        $('#M_PROD_ID_ESTADO').val(datos[3]);
        $('#M_PROD_ID_MARCA').val(datos[4]);
        $('#M_PROD_ID_IMPUESTO').val(datos[5]);
        $('#M_PROD_ID_CATEGORIA').val(datos[6]);
        $('#M_PROD_PRECIO_COSTO').val(datos[7]);
        $('#M_PROD_PRECIO_MINORISTA').val(datos[8]);
        $('#M_PROD_PRECIO_MAYORISTA').val(datos[9]);
        $('#M_PROD_CANT_ACTUAL').val(datos[10]);
        $('#modal_modificarProducto').modal({
            show: true,
            backdrop: 'static'
        });
    });
}