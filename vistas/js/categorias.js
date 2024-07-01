/*=============================================
          EDITAR CATEGORÍA
          =============================================*/

$(document).on("click", ".btnEditarCategoria", function () {
  let idCategoria = $(this).attr("idCategoria");
  let datos = new FormData();
  datos.append("idCategoria", idCategoria);

  $.ajax({
    url: "ajax/categorias.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $("#idCategoria").val(respuesta["id"]);
      $("#editarCategoria").val(respuesta["categoria"]);
    },
  });
});

/*=============================================
          ELIMINAR CATEGORIA
          =============================================*/

$(document).on("click", ".btnEliminarCategoria", function () {
  let idCategoria = $(this).attr("idCategoria");

  Swal.fire({
    title: "Esta seguro de borrar la categoría?",
    text: "Puede cancelar la acción, sino esta seguro!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = "index.php?ruta=categorias&idCategoria=" + idCategoria;
    }
  });
});
