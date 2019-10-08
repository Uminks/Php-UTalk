
      <nav class="navbar navbar-expand-lg navbar-light bgCustomReverse">
        <button class="svgButton" id="menu-toggle"> <img src="assets/svg/invisible.svg" alt="visible"> </button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle setting" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Tu cuenta <img class="settingsIcon" src="assets/svg/settings.svg" alt="settings">
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item setItem" href="#"  data-toggle="modal"  data-target="#status-update">
                Estado
                <svg class="state" id="stateBullet" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="<?php echo colorState($_SESSION["user_information"]["connection_status"]);  ?>">
                  <path d="M 12 2 C 6.48 2 2 6.48 2 12 C 2 17.52 6.48 22 12 22 C 17.52 22 22 17.52 22 12 C 22 6.48 17.52 2 12 2 z M 12 4 C 16.41 4 20 7.59 20 12 C 20 16.41 16.41 20 12 20 C 7.59 20 4 16.41 4 12 C 4 7.59 7.59 4 12 4 z M 12 6 C 8.69 6 6 8.69 6 12 C 6 15.31 8.69 18 12 18 C 15.31 18 18 15.31 18 12 C 18 8.69 15.31 6 12 6 z"/>
                </svg>
                </a> 
                <a class="dropdown-item setItem" href="#" data-toggle="modal" data-target="#perfil-settings">Perfil</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item setItem" href="controllers/UserController.php?task=logout" >Salir</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>


  <!-- Modal para actualizar la data -->
  <div class="modal fade" id="perfil-settings" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Configuración de tu perfil</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" id="update-info" method="POST">
        <div class="modal-body">
          
              <div class="file-field">
                <div class="text-center">
                  <img class="addImage" src="assets/images/people2.png"
                    class="rounded-circle z-depth-1-half avatar-pic" alt="example placeholder avatar">
                </div>
              </div>

              <div class="form-group">
                  <label for="name">Nombre</label>
                  <input type="text" name="first_name" class="form-control form-control-sm" id="name" value="<?php echo $_SESSION["user_information"]["first_name"]?>" required>
              </div>
              <div class="form-group">
                  <label for="last-name">Apellido</label>
                  <input type="text" name="last_name" class="form-control form-control-sm" id="last-name" value="<?php echo $_SESSION["user_information"]["last_name"]?>" required>
              </div>
              <div class="form-group">
                  <label for="username">Nombre de usuario</label>
                  <input type="text" autocomplete="username" disabled class="form-control form-control-sm" id="username"  value="<?php echo $_SESSION["user_information"]["username"]?>" required>
              </div>
              <div class="form-group">
                  <label for="passwordRenove">Contraseña</label>
                  <input type="password" name="oldpw" disabled class="form-control form-control-sm" id="passwordRenove"  value="<?php echo $_SESSION["user_information"]["password"]?>" required>
              </div>
              <div class="form-group">
                  <label for="password">Nueva contraseña</label>
                  <input type="password" name="password" autocomplete="new-password" class="form-control form-control-sm" id="password" placeholder="Contraseña">
              </div>
              <div class="form-group">
                  <label for="date">Fecha de nacimiento</label>
                  <input type="date" name="date" class="form-control form-control-sm" id="date"  value="<?php echo date("Y-m-d",strtotime($_SESSION["user_information"]["date"])) ;?>" required>
              </div>

              <div id="success-message"></div>
           
        </div>
        <div class="modal-footer">
          <button type="button" id="close-update" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal para actualizar el estado -->
  <div class="modal fade" id="status-update" tabindex="-2" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Actualizar estado</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="status-list">
              <ul class="status-ul">
                <li><a href="javascript:updateUserStatus(0)">Disponible <span class="state-choice" style="background: green;"></span></a></li>
                <li><a href="javascript:updateUserStatus(1)">Ausente <span class="state-choice" style="background: orange;"></span></a></li>
                <li><a href="javascript:updateUserStatus(2)">Ocupado <span class="state-choice" style="background: darkred;"></span></a></li>
                <li><a href="javascript:updateUserStatus(3)">Desconectado <span class="state-choice" style="background: lightgray;"></span></a></li>
              </ul>
          </div>
        </div>
      </div>
    </div>
  </div>


  <?php 
  
    function colorState($status) {
      
        switch($status){
          case 0 : {
            return 'green';
            break;
          }
          case 1 : {
            return 'orange';
            break;
          }
          case 2 : {
            return 'darkred';
            break;
          }
          case 3 : {
            return 'lightgray';
            break;
          }
        }
  
    }
  
  
  
  
  ?>