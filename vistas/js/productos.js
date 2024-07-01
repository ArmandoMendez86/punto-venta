/*=============================================
	CARGANDO LA TABLA DINAMICA DE PRODUCTOS
	=============================================*/
$('.tablaProductos').DataTable({
  "ajax": "ajax/datatable_productos.ajax.php",
});
