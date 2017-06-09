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
        prod_nombre: {
            required: true,
            rangelength: [2, 50]
        },
        prod_precio: {
            required: true,
            number: true
        },
        prod_stock: {
            required: true,
            number: true
        },
        prod_id_categoria: {
            required: true,
            number: true
        },
    },
    messages: {
        prod_nombre: {
            required: "Ingrese el nombre del producto",
            rangelength: "Por favor, ingrese un valor entre 2 y 50 caracteres"
        },
        prod_precio: {
            required: "Ingrese el precio de venta",
            number: "Por favor, ingrese solo números"
        },
        prod_stock: {
            required: "Ingrese el stock inicial",
            number: "Por favor, ingrese solo números"
        },
        prod_id_categoria: {
            required: "Seleccione una categoría",
            number: "Por favor, ingrese solo números"
        }
    },
    submitHandler: function(form) {
        var dataString = 'prod_nombre=' + $('#prod_nombre').val()
                + '&prod_precio=' + $('#prod_precio').val()
                + '&prod_stock=' + $('#prod_stock').val()
                + '&prod_id_categoria=' + $('#prod_id_categoria').val()
                + '&agregar_producto=1';
        $.ajax({
            type: "POST",
            url: "includes/agregarProducto.php",
            data: dataString
        }).done(function(data) {
            $("#form_add_product").modal("hide");
            $("#info").html(data);
            verProducto();
        });
    }
});
