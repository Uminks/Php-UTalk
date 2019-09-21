<!-- Head -->   
<?php include '../inc/head.php'; ?>

    <div class="container-fluid">
        
        <div class="row containerLogin">

            <div class="col-sm-12 col-md-7">
                

                    <div class="row logoRow">
                        <img class="uminks" src="../assets/images/uminks.png" alt="Uminks">
                    </div>

                    <div class="row figureRow">

                    <div class="figure">
                        <h1 class="titleLogin"> Bienvenido a UTalk, que esperas para charlar con los tuyos! </h1>
                    </div>

                    <img class="imageLogin" src="../assets/images/people3.png" alt="peopleLogin">
                    
                        

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
                            
                            <form action="">

                                <div class="form-group">
                                    <label for="user">Email o Nombre de usuario</label>
                                    <input type="text" class="form-control" id="user" placeholder="Email o usuario" required>
                                </div>

                                <div class="form-group">
                                    <label for="user">Contraseña</label>
                                    <input type="password" class="form-control" id="password" placeholder="Contraseña" required>
                                </div>

                                <button type="submit" class="btn btn-primary">Iniciar sesión</button>

                            </form>

                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            
                            <form action="">

                                <div class="form-group">
                                    <label for="user">Nombre</label>
                                    <input type="text" class="form-control form-control-sm" id="user" placeholder="Email o usuario" required>
                                </div>

                                <div class="form-group">
                                    <label for="user">Apellido</label>
                                    <input type="text" class="form-control form-control-sm" id="user" placeholder="Email o usuario" required>
                                </div>

                                <div class="form-group">
                                    <label for="user">Nombre de usuario</label>
                                    <input type="text" class="form-control form-control-sm" id="user" placeholder="Email o usuario" required>
                                </div>

                                <div class="form-group">
                                    <label for="user">Contraseña</label>
                                    <input type="password" class="form-control form-control-sm" id="password" placeholder="Contraseña" required>
                                </div>

                                <div class="form-group">
                                    <label for="user">Email</label>
                                    <input type="text" class="form-control form-control-sm" id="user" placeholder="Email o usuario" required>
                                </div>

                                <div class="form-group">
                                    <label for="user">Fecha de nacimiento</label>
                                    <input type="date" class="form-control form-control-sm" id="user" placeholder="Email o usuario" required>
                                </div>

                                <div class="form-group">

                                    <label for="user"> Sexo </label>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="male" value="male" checked>
                                        <label class="form-check-label" for="gender">
                                            Hombre
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                                        <label class="form-check-label" for="gender">
                                            Mujer
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="other" value="other">
                                        <label class="form-check-label" for="gender">
                                            Prefiero no decirlo
                                        </label>
                                    </div>

                                </div>

                                <button type="submit" class="btn btn-primary">Registrarse</button>

                            </form>


                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

<!-- Footer -->   
<?php include '../inc/footer.php' ?>
    