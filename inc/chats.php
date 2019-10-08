      
      
<div class="tab-pane fade show active" id="conversaciones" role="tabpanel"  aria-labelledby="chat-tab" >
    
    <div class="chatContainer">
      
        <div class="people-list" id="people-list">

          <div class="search">
            <div class="form-group has-search">
              <span class="fa fa-search form-control-feedback"> </span>
              <input type="text" class="form-control search-list" placeholder="Buscar...">
            </div>
          </div>

          <div class="people">

            <ul class="list" id="chats-index"></ul>
          
          </div>
               
        </div>

        <div class="messaging">
            <div class="inbox_msg">

              <div class="mesgs">
                <div class="group-icon"  data-toggle="modal" data-target="#add-group" style="display: none;" ><a href="#"> <img class="group-icon-chat" src="assets/svg/invite-group.svg" title="Invitar grupo" alt="Invitar a grupo"> </a></div>
                <div class="msg_history">
                </div>
              </div>

              <!-- Modal para actualizar el estado -->
            <div class="modal fade" id="add-group" tabindex="-2" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Agregar contacto al chat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="status-list">
                        <form method="post" class="add-user-to-chat">
                            <input id="add-user" type="text" class="form-control" placeholder="Ingresar usuario a agregar">
                            <input id="add-channel" type="text" class="form-control" placeholder="Nombre de canal">
                            <button style="margin: 1.5em 0;" type="submit" class="btn btn-primary" > Agregar </button>
                            <div id="success-message2"></div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            </div>

            <form class="user-chat" method="post" data-id="-">
               <textarea  name="text-chat" id="text-chat" class="text-chat" cols="30" rows="3"></textarea>
               <div class="send-section">
                  <button class="send" type="submit">Enviar <img class="sendIcon" src="assets/svg/send.svg" alt=""></button>
                  <div class="button-wrapper">
                    <span class="label">
                      Subir archivo <img class="sendIcon" src="assets/svg/image.svg" alt="image">
                    </span>
                    
                      <input type="file" name="upload" id="upload" class="upload-box" placeholder="Upload File">
                    
                  </div>
               </div>
            </form>
        </div>
  
  
    </div>

</div>