$('#agregarProducto').on('hidden.bs.modal',function(e){
    $('#C_DESCRIPCION').val('');
    $('#C_CODIGO').val('');
    $('#C_ID_MARCA').val('');
    $('#C_ID_IMPUESTO').val('');
    $('#C_ID_CATEGORIA').val('');
    $('#C_PRECIO_COSTO').val('');
    $('#C_PRECIO_MINORISTA').val('');
    $('#C_PRECIO_MAYORISTA').val('');
    $('#C_CANT_ACTUAL').val('');
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
        /*ID_ESTADO: {
            required: true,
            number: true
        },*/
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
        /*ID_ESTADO: {
            required: "Seleccione un estado",
            number: "Por favor, ingrese solo números"
        },*/
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
    submitHandler: function(form) {
        var dataString = 'C_DESCRIPCION=' + $('#C_DESCRIPCION').val()
                + '&C_CODIGO=' + $('#C_CODIGO').val()
                //+ '&ID_ESTADO=' + $('#ID_ESTADO').val()
                + '&C_ID_MARCA=' + $('#C_ID_MARCA').val()
                + '&C_ID_IMPUESTO=' + $('#C_ID_IMPUESTO').val()
                + '&C_ID_CATEGORIA=' + $('#C_ID_CATEGORIA').val()
                + '&C_PRECIO_COSTO=' + $('#C_PRECIO_COSTO').val()
                + '&C_PRECIO_MINORISTA=' + $('#C_PRECIO_MINORISTA').val()
                + '&C_PRECIO_MAYORISTA=' + $('#C_PRECIO_MAYORISTA').val()
                + '&C_CANT_ACTUAL=' + $('#C_CANT_ACTUAL').val()
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

function actualizarProducto(idProducto){
/*
 * $('#').val('');
    $('#').val('');
    $('#').val('');
    $('#').val('');
    $('#').val('');
    $('#').val('');
    $('#').val('');
    $('#').val('');
    $('#').val('');
 */
    var ID =idProducto;
    var DESCRIPCION = $('#form_update_product'.idProducto).find('input[name="DESCRIPCION"]').val();
    var CODIGO= $('#form_update_product'.idProducto).find('input[name="CODIGO"]').val();
    var ID_IMPUESTO = $('#form_update_product'.idProducto).find('input[name="ID_IMPUESTO"]').val();
    var ID_CATEGORIA = $('#form_update_product'.idProducto).find('input[name="ID_CATEGORIA"]').val();
    var PRECIO_COSTO = $('#form_update_product'.idProducto).find('input[name="PRECIO_COSTO"]').val();
    var PRECIO_MINORISTA = $('#form_update_product'.idProducto).find('input[name="PRECIO_MINORISTA"]').val();
    var PRECIO_MAYORISTA = $('#form_update_product'.idProducto).find('input[name="PRECIO_MAYORISTA"]').val();
    var CANT_ACTUAL = $('#form_update_product'.idProducto).find('input[name="CANT_ACTUAL"]').val();
}