<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar productos

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar productos</li>

    </ol>

  </section>


  <section class="content">


    <div class="box">
      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">
          Agregar producto
        </button>

      </div>

      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tablas display" style="width:100%">
          <thead>
            <tr>
              <th>#</th>
              <th>Imagen</th>
              <th>Codigo</th>
              <th>Descripción</th>
              <th>Categoría</th>
              <th>Stock</th>
              <th>Precio de compra</th>
              <th>Precio de venta</th>
              <th>Venta</th>
              <th>Agregado</th>
              <th>Acciones</th>
            </tr>
          </thead>

          <tbody>

            <?php

            $item = null;
            $valor = null;
            $productos = ControladorProductos::ctrMostrarProductos($item, $valor);

            foreach ($productos as $key => $value) {

              echo '
              <tr>
              <td>' . ($key + 1) . '</td>
              <td>' . $value["imagen"] . '</td>
              <td>' . $value["codigo"] . '</td>
              <td>' . $value["descripcion"] . '</td>';

              $item = "id";
              $valor = $value["id_categoria"];
              $categoria = ControladorCategorias::ctrMostrarCategorias($item, $valor);

              echo '
              <td>' . $categoria["categoria"] . '</td>
              <td>' . $value["stock"] . '</td>
              <td>' . $value["precio_compra"] . '</td>
              <td>' . $value["precio_venta"] . '</td>
              <td>' . $value["ventas"] . '</td>
              <td>' . $value["fecha"] . '</td>
              <td>
              <div class="text-center">
                <button class="btn btn-warning btnEditarProducto" data-toggle="modal" data-target="#modalEditarProducto">
                  <i class="fa fa-pencil"></i>
                </button>
                <button class="btn btn-danger btnEliminarProducto">
                  <i class="fa fa-times"></i>
                </button>
              </div>
            </td>
            </tr>
              ';
            }

            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>


<!-- Modal para agregar usuario -->

<div id="modalAgregarProducto" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header" style="background-color: #3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar producto</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>
              <input type="number" class="form-control" name="codigo" placeholder="Ingresar codigo">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
              <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Ingresar descripción">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
              <input type="number" class="form-control" name="stock" min="0" placeholder="Stock">
            </div>
          </div>

          <div class="form-group row">
            <div class="col-xs-6">
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                <input type="number" class="form-control" name="compra" min="0" placeholder="Precio compra">
              </div>
            </div>

            <div class="col-xs-6">
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                <input type="number" class="form-control" name="venta" min="0" placeholder="Precio venta">
              </div>

              <br>

              <!-- Checbox para porcentaje -->
              <div class="col-xs-6">
                <div class="form-group">
                  <label>
                    <input type="checkbox" name="" id="" class="minimal porcentaje" checked>
                    Utilizar porcentaje
                  </label>
                </div>
              </div>

              <div class="col-xs-6" style="padding: 0;">
                <div class="input-group">
                  <input type="number" name="" id="" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>
                  <span class="input-group-addon"> <i class="fa fa-percent"></i> </span>
                </div>
              </div>

            </div>
          </div>

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
              <select class="form-control input-lg" name="categoria">
                <option value="">Seleccionar categoria</option>
                <option value="Administrador">Administrador</option>
                <option value="Especial">Especial</option>
                <option value="Vendedor">Vendedor</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="panel">SUBIR IMAGEN</div>
            <input type="file" class="fotoProducto" name="fotoProducto">
            <p class="help-block text-center mt-2">Peso maximo de la foto 2MB</p>
            <div class="text-center">
              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizarImagen" width="150px">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>

      </form>
    </div>
  </div>
</div>

<!-- Modal editar usuario -->

<div id="modalEditarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header" style="background-color: #3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar usuario</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
              <input type="hidden" class="form-control" id="idUsuario" name="idUsuario">
              <input type="text" class="form-control" id="editarNombre" name="editarNombre">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-sunglasses"></i></span>
              <input type="text" class="form-control" id="editarUsuario" name="editarUsuario" readonly>
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input type="text" class="form-control" name="editarPassword" placeholder="Nueva contraseña">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-eye-open"></i></span>
              <select class="form-control input-lg" name="editarPerfil" id="editarPerfil">
                <option value="Administrador">Administrador</option>
                <option value="Especial">Especial</option>
                <option value="Vendedor">Vendedor</option>
              </select>
            </div>
          </div>
          <div class="form-group">

            <div class="panel">SUBIR FOTO</div>
            <input type="file" class="nuevaFoto" name="editarFoto">
            <input type="hidden" name="fotoActual" id="fotoActual">
            <p class="help-block text-center mt-2">Peso maximo de la foto 2MB</p>
            <div class="text-center">
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarImagen" width="150px">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Modificar usuario</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Borrar usuario -->
<?php
if ($_GET) {
  ControladorUsuarios::ctrBorrarUsuario();
}
?>