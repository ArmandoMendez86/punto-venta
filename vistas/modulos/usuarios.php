<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar usuarios

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar usuarios</li>

    </ol>

  </section>


  <section class="content">


    <div class="box">
      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">
          Agregar usuario
        </button>

      </div>

      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tablas display" style="width:100%">
          <thead>
            <tr>
              <th>#</th>
              <th>Nombre</th>
              <th>Usuario</th>
              <th>Foto</th>
              <th>Perfil</th>
              <th>Estado</th>
              <th>Ultimo login</th>
              <th>Fecha</th>
              <th>Acciones</th>
            </tr>
          </thead>

          <tbody>

            <?php

            $item = null;
            $valor = null;

            $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

            foreach ($usuarios as $key => $value) {

              echo '
              <tr>
                <td>' . $value["id"] . '</td>
                <td>' . $value["nombre"] . '</td>
                <td>' . $value["usuario"] . '</td>';

              if ($value["foto"] != "") {
                echo '<td><img src="' . $value["foto"] . '" class="img-tumnbail" width="40px"></td>';
              } else {
                echo '<td><img src="vistas/img/usuarios/default/anonymous.png" class="img-tumnbail" width="40px"></td>';
              }
              echo '
                <td>' . $value["perfil"] . '</td>';

              if ($value["estado"] != 0) {
                echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario="' . $value["id"] . '" estado=' . $value["estado"] . '>Activado</button></td>';
              } else {
                echo '  <td><button class="btn btn-danger btn-xs btnActivar" idUsuario="' . $value["id"] . '" estado=' . $value["estado"] . '>Desactivado</button></td>';
              }


              echo '
                <td>' . $value["ultimo_login"] . '</td>
                <td>' . $value["fecha"] . '</td>
                <td>
                  <div class="text-center">
                    <button class="btn btn-warning btnEditarUsuario" idUsuario="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditarUsuario">
                      <i class="fa fa-pencil"></i>
                    </button>
                    <button class="btn btn-danger">
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

<div id="modalAgregarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header" style="background-color: #3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar usuario</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
              <input type="text" class="form-control" name="nombre" placeholder="Ingresar nombre">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-sunglasses"></i></span>
              <input type="text" class="form-control" name="usuario" placeholder="Ingresar usuario">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-eye-open"></i></span>
              <select class="form-control input-lg" name="perfil">
                <option value="">Seleccionar perfil</option>
                <option value="Administrador">Administrador</option>
                <option value="Especial">Especial</option>
                <option value="Vendedor">Vendedor</option>
              </select>
            </div>
          </div>
          <div class="form-group">

            <div class="panel">SUBIR FOTO</div>
            <input type="file" class="nuevaFoto" name="nuevaFoto">
            <p class="help-block text-center mt-2">Peso maximo de la foto 2MB</p>
            <div class="text-center">
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarImagen" width="150px">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
        <?php
        if ($_POST) {
          ControladorUsuarios::ctrCrearUsuario();
        }
        ?>
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
        <?php
        if ($_POST) {
          ControladorUsuarios::ctrEditarUsuario();
        }
        ?>
      </form>
    </div>

  </div>
</div>