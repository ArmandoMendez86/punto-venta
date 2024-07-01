/*=============================================
	CARGANDO LA TABLA DINAMICA DE PRODUCTOS
	=============================================*/

$.ajax({
  url: "ajax/datatable_productos.ajax.php",
  success: function (respuesta) {
    console.log(respuesta);
  },
});
