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

$(".btnEditarUsuario").click(function () {
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
	EDITAR USUARIO
	=============================================*/

  $(".btnActivar").click(function () {
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