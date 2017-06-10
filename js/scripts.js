$('#agregarProducto').on('hidden.bs.modal',function(e){
    $('#DESCRIPCION').val('');
    $('#CODIGO').val('');
    $('#ID_MARCA').val('');
    $('#ID_IMPUESTO').val('');
    $('#ID_CATEGORIA').val('');
    $('#PRECIO_COSTO').val('');
    $('#PRECIO_MINORISTA').val('');
    $('#PRECIO_MAYORISTA').val('');
    $('#CANT_ACTUAL').val('');
} );

function verProducto() {
    $.ajax({
        type: 'GET',
        url: "includes/verProductos.php"
    }).done(function(msg) {
        $("#verProductos").html(msg);
    });
}

$('#form_add_product').validate({
    rules: {
        DESCRIPCION: {
            required: true,
            rangelength: [2, 50]
        },
        CODIGO: {
            rangelength: [2, 30]
        },
        PRECIO_MINORISTA: {
            required: true,
            number: true
        },
        PRECIO_COSTO: {
            required: true,
            number: true
        },
        PRECIO_MAYORISTA: {
            required: true,
            number: true
        },
        CANT_ACTUAL: {
            required: true,
            number: true
        },
        /*ID_ESTADO: {
            required: true,
            number: true
        },*/
        ID_CATEGORIA: {
            required: true,
            number: true
        },
        ID_MARCA: {
            required: true,
            number: true
        },
        ID_IMPUESTO: {
            required: true,
            number: true
        }
    },
    messages: {
        DESCRIPCION: {
            required: "Ingrese el nombre del producto",
            rangelength: "Por favor, ingrese un valor entre 2 y 50 caracteres"
        },
        CODIGO: {
            rangelength: "Por favor, ingrese un valor entre 2 y 30 caracteres"
        },
        PRECIO_MINORISTA: {
            required: "Ingrese el precio de venta",
            number: "Por favor, ingrese solo números"
        },
        PRECIO_COSTO: {
            required: "Ingrese el precio de costo",
            number: "Por favor, ingrese solo números"
        },
        PRECIO_MAYORISTA: {
            required: "Ingrese el precio mayorista",
            number: "Por favor, ingrese solo números"
        },
        CANT_ACTUAL: {
            required: "Ingrese el stock inicial",
            number: "Por favor, ingrese solo números"
        },
        /*ID_ESTADO: {
            required: "Seleccione un estado",
            number: "Por favor, ingrese solo números"
        },*/
        ID_CATEGORIA: {
            required: "Seleccione una categoría",
            number: "Por favor, ingrese solo números"
        },
        ID_MARCA: {
            required: "Seleccione una marca",
            number: "Por favor, ingrese solo números"
        },
        ID_IMPUESTO: {
            required: "Seleccione un impuesto",
            number: "Por favor, ingrese solo números"
        }
    },
    submitHandler: function(form) {
        var dataString = 'DESCRIPCION=' + $('#DESCRIPCION').val()
                + '&CODIGO=' + $('#CODIGO').val()
                //+ '&ID_ESTADO=' + $('#ID_ESTADO').val()
                + '&ID_MARCA=' + $('#ID_MARCA').val()
                + '&ID_IMPUESTO=' + $('#ID_IMPUESTO').val()
                + '&ID_CATEGORIA=' + $('#ID_CATEGORIA').val()
                + '&PRECIO_COSTO=' + $('#PRECIO_COSTO').val()
                + '&PRECIO_MINORISTA=' + $('#PRECIO_MINORISTA').val()
                + '&PRECIO_MAYORISTA=' + $('#PRECIO_MAYORISTA').val()
                + '&CANT_ACTUAL=' + $('#CANT_ACTUAL').val()
                + '&agregar_producto=1';
        $.ajax({
            type: "POST",
            url: "includes/agregarProducto.php",
            data: dataString
        }).done(function(data) {
            $("#agregarProducto").modal("hide");
            $("#info").html(data);
            verProducto();
        });
    }
});
