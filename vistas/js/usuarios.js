/*=============================================
	PEWVISUALIZAR FOTO
	=============================================*/

$(".nuevaFoto").change(function () {
  let imagen = this.files[0];

  let datosImagen = new FileReader();
  datosImagen.readAsDataURL(imagen);

  $(datosImagen).on("load", function (event) {
    let rutaImagen = event.target.result;
    $(".previsualizarImagen").attr("src", rutaImagen);
  });
});

/*=============================================
	EDITAR USUARIO
	=============================================*/

$(document).on("click", ".btnEditarUsuario", function () {
  let idUsuario = $(this).attr("idUsuario");
  let datos = new FormData();
  datos.append("idUsuario", idUsuario);

  $.ajax({
    url: "ajax/usuarios.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $("#editarNombre").val(respuesta["nombre"]);
      $("#editarUsuario").val(respuesta["usuario"]);
      $("#fotoActual").val(respuesta["foto"]);
      $("#editarPerfil").val(respuesta["perfil"]);
      $("#idUsuario").val(respuesta["id"]);

      if (respuesta["foto"] != "") {
        $(".previsualizarImagen").attr("src", respuesta["foto"]);
      }
    },
  });
});

/*=============================================
	ACTIVAR USUARIO
	=============================================*/

$(document).on("click", ".btnActivar", function (e) {
  let boton = e.target;
  let idUsuario = $(boton).attr("idUsuario");
  let estado = $(boton).attr("estado");

  if (estado == 0) {
    $(boton).removeClass("btn-danger");
    $(boton).addClass("btn-success");
    $(boton).html("Activado");
    $(boton).attr("estado", 1);
  } else {
    $(boton).removeClass("btn-success");
    $(boton).addClass("btn-danger");
    $(boton).html("Desactivado");
    $(boton).attr("estado", 0);
  }

  let datos = new FormData();
  datos.append("activarIdUsuario", $(boton).attr("idUsuario"));
  datos.append("estado", $(boton).attr("estado"));

  $.ajax({
    url: "ajax/usuarios.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      //Buscar solucion para no recargar la pagina en resolucion
      //de celulares
      window.location = "usuarios";
    },
  });
});

/*=============================================
	VALIDANDO USUARIO
	=============================================*/

$("#usuario").change(function () {
  $(".alert").remove();
  let usuario = $(this).val();
  let datos = new FormData();
  datos.append("validarUsuario", usuario);

  $.ajax({
    url: "ajax/usuarios.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      if (respuesta) {
        $("#usuario")
          .parent()
          .after(
            "<div class='alert alert-warning'>Ya existe este usuario, intenta con otro!</div>"
          );
        $("#usuario").val("");
      }
    },
  });
});

/*=============================================
	ELIMINAR USUARIO
	=============================================*/

$(document).on("click", ".btnEliminarUsuario", function () {
  let idUsuario = $(this).attr("idUsuario");
  let fotoUsuario = $(this).attr("fotoUsuario");
  let usuario = $(this).attr("usuario");
  Swal.fire({
    title: "Esta seguro de borrar el usuario?",
    text: "Puede cancelar la acción, sino esta seguro!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      window.location =
        "index.php?ruta=usuarios&idUsuario=" +
        idUsuario +
        "&usuario=" +
        usuario +
        "&fotoUsuario=" +
        fotoUsuario;
    }
  });
});
