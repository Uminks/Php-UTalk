    
    
    <div class="sideNav" id="sidebar-wrapper">
      <div class="sidebar-heading">  <?php echo welcomeMessage(). " " . $_SESSION["user_information"]["username"];  ?> </div>
      <div class="list-group list-group-flush">
        <a href="#conversaciones" class="list-group-item list-group-item-action bgCustom" id="chat-tab" data-toggle="tab"  role="tab" aria-controls="chat" aria-selected="true">Chat <img src="assets/svg/chats.svg" alt=""></a>
        <a href="#contactos" class="list-group-item list-group-item-action bgCustom" id="friends-tab" data-toggle="tab"  role="tab" aria-controls="friends" aria-selected="false" >Contactos <img src="assets/svg/contacts.svg" alt=""></a>
        <a href="#solicitudes" class="list-group-item list-group-item-action bgCustom" id="solicitudes-tab" data-toggle="tab"  role="tab" aria-controls="solicitudes" aria-selected="false">Solicitudes de Amistad <img src="assets/svg/request.svg" alt=""></a>
        <a href="#agregar" class="list-group-item list-group-item-action bgCustom" id="add-tab" data-toggle="tab" role="tab" aria-controls="add" aria-selected="false">Agregar contactos <img src="assets/svg/add.svg" alt=""></a>
      </div>
    </div>

    <?php

      function welcomeMessage() {

        switch($_SESSION["user_information"]["gender"]){
          case "male" : {
            return "Bienvenido";
            break;
          }
          case "female" : {
            return "Bienvenida";
            break;
          }
          case "other" : {
            return "Bienvenid@";
            break;
          }
        }

      }


    ?>