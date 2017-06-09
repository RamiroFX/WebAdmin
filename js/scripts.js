function verProducto() {
    $.ajax({
        type: 'GET',
        url: "includes/verProductos.php"
    }).done(function (msg) {
        $("#verProductos").html(msg);
    });
}
