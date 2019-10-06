      
      
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
                <div class="msg_history">
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