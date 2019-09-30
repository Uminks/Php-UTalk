<div class="tab-pane fade" id="contactos" role="tabpanel" aria-labelledby="friends-tab">

    <div class="contact-list">

        <ul class="ul-contact">

            <li class="contact">

                <div class="left-info">
                    <div class="friend-info">
                        <img class="image-contact" src="assets/images/people2.png" alt="contact image">
                        <span class="friend-state" style="background: orange;"></span>
                    </div>
                    <h2 class="title-contact"> Luis Fernando Vargas Gómez <span class="user-contact">(Develtwist)</span></h2>
                </div>
                <div class="options-contact">
                    <a href="#"> <img src="assets/svg/new-message.svg" title="Nuevo mensaje" alt="Enviar mensaje"> </a>
                    <a href="#"> <img src="assets/svg/invite-group.svg" title="Invitar grupo" alt="Invitar a grupo"> </a>
                    <a class="friendDetails"  href="#"> <img src="assets/svg/detail-friend.svg" title="Detalles del contacto" alt="Ver detalles"> </a>
                    <a href="#"> <img src="assets/svg/block-friend.svg" title="Bloquear contacto" alt="Bloquear"> </a>
                    <a class="deleteFriend" href="#"> <img src="assets/svg/delete-friend.svg" title="Eliminar contacto" alt="Eliminar"> </a>
                </div>
            </li>

            <li class="contact">
                <div class="left-info">
                    <div class="friend-info">
                        <img class="image-contact" src="assets/images/people2.png" alt="contact image">
                        <span class="friend-state" style="background: green;"></span>
                    </div>
                    <h2 class="title-contact"> Brayan bladimir Montañez Ortiz <span class="user-contact">(BBMO)</span></h2>
                </div>
                <div class="options-contact">
                    <a href="#"> <img src="assets/svg/new-message.svg" title="Nuevo mensaje" alt="Enviar mensaje"> </a>
                    <a href="#"> <img src="assets/svg/invite-group.svg" title="Invitar grupo" alt="Invitar a grupo"> </a>
                    <a class="friendDetails" href="#"> <img src="assets/svg/detail-friend.svg" title="Detalles del contacto" alt="Ver detalles"> </a>
                    <a href="#"> <img src="assets/svg/block-friend.svg" title="Bloquear contacto" alt="Bloquear"> </a>
                    <a class="deleteFriend" href="#"> <img src="assets/svg/delete-friend.svg" title="Eliminar contacto" alt="Eliminar"> </a>
                </div>
            </li>

            <li class="contact">

                <div class="left-info">
                    <div class="friend-info">
                        <img class="image-contact" src="assets/images/people2.png" alt="contact image">
                        <span class="friend-state" style="background: lightgray;"></span>
                    </div>
                    <h2 class="title-contact"> Maria Bolivar Perez <span class="user-contact">(MBPLorem)</span></h2>
                </div>
                <div class="options-contact">
                    <a href="#"> <img src="assets/svg/new-message.svg" title="Nuevo mensaje" alt="Enviar mensaje"> </a>
                    <a href="#"> <img src="assets/svg/invite-group.svg" title="Invitar grupo" alt="Invitar a grupo"> </a>
                    <a class="friendDetails" href="#"> <img src="assets/svg/detail-friend.svg" title="Detalles del contacto" alt="Ver detalles"> </a>
                    <a href="#"> <img src="assets/svg/block-friend.svg" title="Bloquear contacto" alt="Bloquear"> </a>
                    <a class="deleteFriend" href="#"> <img src="assets/svg/delete-friend.svg" title="Eliminar contacto" alt="Eliminar"> </a>
                </div>
            </li>

        </ul>

    </div>

    <!-- Confirmacion de eliminacion -->
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="confirmDelete">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Estas seguro que deseas eliminar este contacto?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="modal-btn-si">Si</button>
                    <button type="button" class="btn btn-primary" id="modal-btn-no">No</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Detalles del usuario -->
    <div class="modal fade" id="friendDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detalles del usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="friend-data">
                      <div class="friend-info-details">
                          <img class="image-contact-details" src="assets/images/people2.png" alt="contact image">
                          <span class="friend-state-details" style="background: orange;"></span>
                      </div>
                        <p> Nombre: <span> Nombre </span> </p>
                        <p> Apellido: <span> Apellido </span> </p>
                        <p> Usuario: <span> Usuario </span> </p>
                        <p> Edad: <span> Edad </span> </p>
                        <p> Genero: <span> Genero </span> </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>