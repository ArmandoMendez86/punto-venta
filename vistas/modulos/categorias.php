<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar categorías

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar categorias</li>

    </ol>

  </section>


  <section class="content">


    <div class="box">
      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">
          Agregar categoría
        </button>

      </div>

      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tablas display" style="width:100%">
          <thead>
            <tr>
              <th>Id</th>
              <th>Categoría</th>
              <th>Acciones</th>
            </tr>
          </thead>

          <tbody>

            <?php

            $item = null;
            $valor = null;

            $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

            foreach ($categorias as $key => $value) {

              echo '
  <tr>
    <td>' . ($key + 1) . '</td>
    <td>' . $value["categoria"] . '</td>';

              echo '
    <td>
      <div class="text-center">
        <button class="btn btn-warning btnEditarCategoria" idCategoria="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditarCategoria">
          <i class="fa fa-pencil"></i>
        </button>
        <button class="btn btn-danger btnEliminarCategoria" idCategoria="' . $value["id"] . '">
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

<div id="modalAgregarCategoria" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

      <form role="form" method="post">
        <div class="modal-header" style="background-color: #3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar categoría</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-folder-open"></i></span>
              <input type="text" class="form-control" name="categoria" placeholder="Ingresar categoría">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
        <?php
        ControladorCategorias::ctrCrearCategoria();
        ?>
      </form>
    </div>
  </div>
</div>

<!-- Modal editar usuario -->

<div id="modalEditarCategoria" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header" style="background-color: #3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar categoria</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-folder-open"></i></span>
              <input type="hidden" class="form-control" id="idCategoria" name="idCategoria">
              <input type="text" class="form-control" id="editarCategoria" name="editarCategoria">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Modificar categoría</button>
        </div>
        <?php

        ControladorCategorias::ctrEditarCategoria();

        ?>
      </form>
    </div>
  </div>
</div>


<!-- Borrar categoria -->
<?php
ControladorCategorias::ctrBorrarCategoria();
?>