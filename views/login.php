<?php
  session_start();
  if ( isset ( $_SESSION["user_information"] ) ) {
    header("location: /chat");
  }
?>
<!-- Head -->   

    <div class="container-fluid">
        
        <div class="row containerLogin">

            <div class="col-sm-12 col-md-7">
                

                    <div class="row logoRow">
                        <img class="uminks" src="assets/images/uminks.png" alt="Uminks">
                    </div>

                    <div class="row figureRow">

                    <div class="figure">
                        <div class="titleLogin"> Bienvenido a <div class="utalk">UTalk</div>, que esperas para charlar con los tuyos! </div>
                    </div>

                    <img class="imageLogin" src="assets/images/people3.png" alt="peopleLogin">
                    
                        

                    </div>


            </div>

            <div class="col-sm-12 col-md-5 formCol">
                
                <div class="formContainer">

                    <ul class="nav sectionTabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            ¿Ya tienes una cuenta? <a class="loginUrl active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Iniciar sesión</a>.
                        </li>
                        <li class="nav-item">
                            <a class="loginUrl" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Registrate</a> y se parte del club.
                        </li>
                    </ul>

                    <div class="tab-content formSection" id="myTabContent">
                        <div class="tab-pane fade  show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            
                            <form method="post" action="/controllers/UserController.php?task=login">

                                <div class="form-group">
                                    <label for="user">Email o Nombre de usuario</label>
                                    <input name="loginData[user_email]" type="text" class="form-control" id="user" placeholder="Email o usuario" required>
                                </div>

                                <div class="form-group">
                                    <label for="user">Contraseña</label>
                                    <input name="loginData[password]" type="password" class="form-control" id="password" placeholder="Contraseña" required>
                                </div>

                                <button type="submit" class="btn btn-primary">Iniciar sesión</button>

                            </form>

                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            
                            <form method="post" action="/controllers/UserController.php?task=register">

                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input name="registerData[first_name]" type="text" class="form-control form-control-sm" id="name" placeholder="Nombre" required>
                                </div>

                                <div class="form-group">
                                    <label for="last-name">Apellido</label>
                                    <input name="registerData[last_name]" type="text" class="form-control form-control-sm" id="last-name" placeholder="Apellido" required>
                                </div>

                                <div class="form-group">
                                    <label for="username">Nombre de usuario</label>
                                    <input name="registerData[username]" type="text" class="form-control form-control-sm" id="username" placeholder="Usuario" required>
                                </div>

                                <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <input name="registerData[password]" type="password" class="form-control form-control-sm" id="password" placeholder="Contraseña" required>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input name="registerData[email]" type="text" class="form-control form-control-sm" id="email" placeholder="Email" required>
                                </div>

                                <div class="form-group">
                                    <label for="date">Fecha de nacimiento</label>
                                    <input name="registerData[date]" type="date" class="form-control form-control-sm" id="date" placeholder="Fecha de nacimiento" required>
                                </div>

                                <div class="form-group">

                                    <label for="gender"> Sexo </label>

                                    <div class="form-check">
                                        <input name="registerData[gender]" class="form-check-input" type="radio" name="gender" id="male" value="male" checked>
                                        <label class="form-check-label" for="gender">
                                            Hombre
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="registerData[gender]" class="form-check-input" type="radio" name="gender" id="female" value="female">
                                        <label class="form-check-label" for="gender">
                                            Mujer
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="registerData[gender]" class="form-check-input" type="radio" name="gender" id="other" value="other">
                                        <label class="form-check-label" for="gender">
                                            Prefiero no decirlo
                                        </label>
                                    </div>

                                    <small id="help" class="form-text text-muted">No revelaremos tu información con alguien más.</small>


                                </div>

                                <button type="submit" class="btn btn-primary">Registrarse</button>

                            </form>


                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

    