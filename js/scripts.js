$(function () {
    /*
     * PRODUCTO
     */
    $('#btn_crearProducto').on('click', function () {
        $('#form_crearProducto').validate({
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
                var dataString = $('#form_crearProducto').serialize();
                $.ajax({
                    type: "POST",
                    url: "includes/producto/crearProducto.php",
                    data: dataString
                }).done(function (data) {
                    $("#barra_progreso").hide();
                    $("#modal_crearProducto").modal("hide");
                    $("#info").html(data);
                    $('#form_crearProducto')[0].reset();
                    verProducto();
                });
                return;
            }
        });
        return;
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
                    var respuesta = JSON.parse(data);
                    if (respuesta['codigo'] == 1) {
                        $("#modal_modificarProducto").modal("hide");
                        $("#info").html(respuesta['mensaje']);
                        $('#form_modificarProducto')[0].reset();
                        verProducto();
                    } else if (respuesta['codigo'] == 2) {
                        $("#modal_modificarProducto").modal("hide");
                        $("#info").html(respuesta['mensaje']);
                        $('#form_modificarProducto')[0].reset();
                    }
                });
                return;
            }
        });
        return;
    });
    $('#btn_eliminarProducto').on('click', function () {
        $('#form_eliminarProducto').validate({
            rules: {
                E_PROD_DESCRIPCION: {
                    required: true,
                    rangelength: [2, 255]
                }
            },
            messages: {
                E_PROD_DESCRIPCION: {
                    required: "Por favor, ingrese un nombre para el producto.",
                    rangelength: "Por favor, ingrese un valor entre 2 y 30 caracteres"
                }
            },
            submitHandler: function (form) {
                var dataString = $('#form_eliminarProducto').serialize();
                var url = 'includes/producto/eliminarProducto.php';
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: dataString,
                    success: function (json) {
                        $("#barra_progreso").hide();
                        var respuesta = JSON.parse(json);
                        if (respuesta['codigo'] == 1) {
                            $("#modal_eliminarProducto").modal("hide");
                            $("#info").html(respuesta['mensaje']);
                            verProducto();
                            $('#form_eliminarProducto')[0].reset();
                        } else if (respuesta['codigo'] == 2) {
                            $("#modal_eliminarProducto").modal("hide");
                            $("#info").html(respuesta['mensaje']);
                            $('#form_eliminarProducto')[0].reset();
                        }
                    }
                });
                return;
            }
        });
        return;
    });
    /*
     * MARCA
     */
    $('#btn_crearMarca').on('click', function () {
        $('#form_crearMarca').validate({
            rules: {
                C_MARCA_NOMBRE: {
                    required: true,
                    rangelength: [2, 50]
                }
            },
            messages: {
                C_MARCA_NOMBRE: {
                    required: "Por favor, ingrese un nombre de Marca.",
                    rangelength: "Ingrese entre 2 y 50 caracters, por favor."
                }
            },
            submitHandler: function (form) {
                var dataString = $('#form_crearMarca').serialize();
                var url = 'includes/producto/marca/crearMarca.php';
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: dataString,
                    success: function (form) {
                        $("#modal_crearMarca").modal("hide");
                        $("#info").html(form);
                        verMarca();
                        $('#form_crearMarca')[0].reset();
                        function cerrar() {
                            $("#mensaje").fadeOut(400);
                        }
                        setTimeout(cerrar, 2000);
                    }
                });
                return;
            }
        });
    });
    $('#btn_modificarMarca').on('click', function () {
        $('#form_modificarMarca').validate({
            rules: {
                M_MARCA_NOMBRE: {
                    required: true,
                    rangelength: [2, 255]
                }
            },
            messages: {
                M_MARCA_NOMBRE: {
                    required: "Por favor, ingrese un nombre para la Marca",
                    rangelength: "Por favor, ingrese un valor entre 2 y 30 caracteres"
                }
            },
            submitHandler: function (form) {
                var dataString = $('#form_modificarMarca').serialize();
                var url = 'includes/producto/marca/modificarMarca.php';
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: dataString,
                    success: function (form) {
                        $("#modal_modificarMarca").modal("hide");
                        $("#info").html(form);
                        verMarca()();
                        $('#form_modificarMarca')[0].reset();
                        function cerrar() {
                            $("#mensaje").fadeOut(400);
                        }
                        setTimeout(cerrar, 2000);
                    }
                });
                return;
            }
        });
    });
    $('#btn_eliminarMarca').on('click', function () {
        $('#form_eliminarMarca').validate({
            rules: {
                E_MARCA_NOMBRE: {
                    required: true,
                    rangelength: [2, 255]
                }
            },
            messages: {
                E_MARCA_NOMBRE: {
                    required: "Por favor, ingrese un nombre para la Marca",
                    rangelength: "Por favor, ingrese un valor entre 2 y 30 caracteres"
                }
            },
            submitHandler: function (form) {
                var dataString = $('#form_eliminarMarca').serialize();
                var url = 'includes/producto/marca/eliminarMarca.php';
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: dataString,
                    success: function (form) {
                        $("#modal_eliminarMarca").modal("hide");
                        $("#info").html(form);
                        verMarca();
                        $('#form_eliminarMarca')[0].reset();
                        function cerrar() {
                            $("#mensaje").fadeOut(400);
                        }
                        setTimeout(cerrar, 2000);
                    }
                });
                return;
            }
        });
    });
    /*
     * CATEGORIA
     */
    $('#btn_crearCategoria').on('click', function () {
        $('#form_crearCategoria').validate({
            rules: {
                C_CATEGORIA_NOMBRE: {
                    required: true,
                    rangelength: [2, 50]
                }
            },
            messages: {
                C_CATEGORIA_NOMBRE: {
                    required: "Por favor, ingrese un nombre de categoría.",
                    rangelength: "Ingrese entre 2 y 50 caracters, por favor."
                }
            },
            submitHandler: function (form) {
                var dataString = $('#form_crearCategoria').serialize();
                var url = 'includes/producto/categoria/crearCategoria.php';
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: dataString,
                    success: function (form) {
                        $("#modal_crearCategoria").modal("hide");
                        $("#info").html(form);
                        verCategoria();
                        $('#form_crearCategoria')[0].reset();
                        function cerrar() {
                            $("#mensaje").fadeOut(400);
                        }
                        setTimeout(cerrar, 2000);
                    }
                });
                return;
            }
        });
    });
    $('#btn_modificarCategoria').on('click', function () {
        $('#form_modificarCategoria').validate({
            rules: {
                M_CATEGORIA_NOMBRE: {
                    required: true,
                    rangelength: [2, 255]
                }
            },
            messages: {
                M_CATEGORIA_NOMBRE: {
                    required: "Por favor, ingrese un nombre para la Categoría",
                    rangelength: "Por favor, ingrese un valor entre 2 y 30 caracteres"
                }
            },
            submitHandler: function (form) {
                var dataString = $('#form_modificarCategoria').serialize();
                var url = 'includes/producto/categoria/modificarCategoria.php';
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: dataString,
                    success: function (form) {
                        $("#modal_modificarCategoria").modal("hide");
                        $("#info").html(form);
                        verCategoria();
                        $('#form_modificarCategoria')[0].reset();
                        function cerrar() {
                            $("#mensaje").fadeOut(400);
                        }
                        setTimeout(cerrar, 2000);
                    }
                });
                return;
            }
        });
    });
    $('#btn_eliminarCategoria').on('click', function () {
        $('#form_eliminarCategoria').validate({
            rules: {
                E_CATEGORIA_NOMBRE: {
                    required: true,
                    rangelength: [2, 255]
                }
            },
            messages: {
                E_CATEGORIA_NOMBRE: {
                    required: "Por favor, ingrese un nombre para la Categoría",
                    rangelength: "Por favor, ingrese un valor entre 2 y 30 caracteres"
                }
            },
            submitHandler: function (form) {
                var dataString = $('#form_eliminarCategoria').serialize();
                var url = 'includes/producto/categoria/eliminarCategoria.php';
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: dataString,
                    success: function (form) {
                        $("#modal_eliminarCategoria").modal("hide");
                        $("#info").html(form);
                        verCategoria();
                        $('#form_eliminarCategoria')[0].reset();
                        function cerrar() {
                            $("#mensaje").fadeOut(400);
                        }
                        setTimeout(cerrar, 2000);
                    }
                });
                return;
            }
        });
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
function verMarca() {
    var url = 'includes/producto/marca/verMarca.php';
    $.ajax({
        type: 'POST',
        url: url,
        success: function (data) {
            $("#verMarca").html(data);
        }
    });
    return false;
}

function verCategoria() {
    var url = 'includes/producto/categoria/verCategoria.php';
    $.ajax({
        type: 'POST',
        url: url,
        success: function (data) {
            $("#verCategoria").html(data);
        }
    });
    return false;
}

/*
 * FORMULARIOS PRODUCTO
 */
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
    return;
}

function llamarFormularioEliminarProducto(idProducto) {
    var url = "php/llamarRegistroProducto.php";
    $.ajax({
        type: "POST",
        url: url,
        data: 'id=' + idProducto
    }).done(function (data) {
        var datos = eval(data);
        $('#E_PROD_ID').val(datos[0]);
        $('#E_PROD_DESCRIPCION').val(datos[1]);
        $('#modal_eliminarProducto').modal({
            show: true,
            backdrop: 'static'
        });
    });
    return;
}

/*
 * FORMULARIOS MARCA
 */
function llamarFormularioEditarMarca(idMarca) {
    $('#form_modificarMarca')[0].reset();
    var url = 'php/llamarRegistroMarca.php';
    $.ajax({
        type: 'POST',
        url: url,
        data: 'id=' + idMarca,
        success: function (valores) {
            var datos = eval(valores);
            $('#M_MARCA_ID').val(idMarca);
            $('#M_MARCA_NOMBRE').val(datos[1]);
            $('#modal_modificarMarca').modal({
                show: true,
                backdrop: 'static'
            });
        }
    });
    return;
}

function llamarFormularioEliminarMarca(idMarca) {
    $('#form_eliminarMarca')[0].reset();
    var url = 'php/llamarRegistroMarca.php';
    $.ajax({
        type: 'POST',
        url: url,
        data: 'id=' + idMarca,
        success: function (valores) {
            var datos = eval(valores);
            $('#E_MARCA_ID').val(idMarca);
            $('#E_MARCA_NOMBRE').val(datos[1]);
            $('#modal_eliminarMarca').modal({
                show: true,
                backdrop: 'static'
            });
        }
    });
    return;
}

/*
 * FORMULARIOS CATEGORIA
 */
function llamarFormularioEditarCategoria(idCategoria) {
    $('#form_modificarCategoria')[0].reset();
    var url = 'php/llamarRegistroCategoria.php';
    $.ajax({
        type: 'POST',
        url: url,
        data: 'id=' + idCategoria,
        success: function (valores) {
            var datos = eval(valores);
            $('#M_CATEGORIA_ID').val(idCategoria);
            $('#M_CATEGORIA_NOMBRE').val(datos[1]);
            $('#modal_modificarCategoria').modal({
                show: true,
                backdrop: 'static'
            });
        }
    });
    return;
}

function llamarFormularioEliminarCategoria(idCategoria) {
    $('#form_eliminarCategoria')[0].reset();
    var url = 'php/llamarRegistroCategoria.php';
    $.ajax({
        type: 'POST',
        url: url,
        data: 'id=' + idCategoria,
        success: function (valores) {
            var datos = eval(valores);
            $('#E_CATEGORIA_ID').val(idCategoria);
            $('#E_CATEGORIA_NOMBRE').val(datos[1]);
            $('#modal_eliminarCategoria').modal({
                show: true,
                backdrop: 'static'
            });
        }
    });
    return;
}

function cargarDatos() {
    verProducto();
    verMarca();
    verCategoria();
}