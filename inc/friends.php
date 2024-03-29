<div class="tab-pane fade" id="contactos" role="tabpanel" aria-labelledby="friends-tab">

    <div class="contact-list">

        <ul class="ul-contact" id="ul-contacts"></ul>

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
                          <span class="friend-state-details"></span>
                      </div>
                        <p> Nombre: <span id="name-contact"></span> </p>
                        <p> Apellido: <span id="last-name-contact"></span> </p>
                        <p> Usuario: <span id="user-contact"></span> </p>
                        <p> Edad: <span id="age-contact"></span> </p>
                        <p> Genero: <span id="gender-contact"></span> </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>