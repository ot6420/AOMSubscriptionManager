
<?php
session_start();
require_once 'bbdd.php';
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>AOM Subscription Manager</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--===============================================================================================-->	
        <link rel="icon" type="image/png" href="favicon.ico"/>
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="assets/css/inicio-sesion/style.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <!--===============================================================================================-->
    </head>
    <body>
        <div class="limitador">
            <div class="todo">
                <div class="caja">	
                    <form class="formulario" action="" method="post" >
                        <span class="titulo">AOM</span> 
                        <span class="sub-titulo">Versión 0.0</span>
                        <span class="sub-titulo"></span>
                        <div class="input" >
                            <input class="caja-input" type="text" id="email" name="email" autocomplete="new-password" placeholder="Email"  required>
                            <span class="icono">
                                <i class="fa fa-user-circle" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="input" >
                            <input class="caja-input" type="password" id="password" name="password" autocomplete="new-password" placeholder="Contraseña" required>						
                            <span class="icono">
                                <i class="fas fa-lock-open"></i>
                            </span>
                        </div>


                        <div class="todo-form-btn">
                            <button type="submit" class="caja-titulo-btn" name="enter">
                                ENTRAR
                            </button>
                        </div><br>

                        <?php
                      //  print_r($_POST);
                        if (isset($_POST["enter"])) {
                      //      echo 'hola';
                            $user = $_POST["email"];
                            $pass = $_POST["password"];
                            $a = new bbdd("Users","userid");
                            $res=$a->login($user, $pass);
                            if($res){
                               header("Location:mainpage.php");
                            }else{
                                echo'<script>alert("Contraseña incorrecta")</script>';
                             
                            }
                        }
                        
                        ?>


                        <div class="text-center">
                            <a class="txt5" href="recuperar-password/">
                                Recuperar contraseña  <i class="fa fa-key" aria-hidden="true"></i>
                            </a><br>
                            <a class="txt4" href="registre/">
                                Registro <i class="fas fa-user-plus"></i>
                            </a><br><br>

                        </div>
                    </form>
                </div>
            </div>
            <div id="footerRedesSocialesPermanente">
                <div class="flotanteIzquierdaFooter">
                    <a >AOM Team</a>
                </div>
                <div class="flotanteDerechaFooter">
                    <a href="#"> © Copyright 2018</a>
                </div>
            </div>
    </body>
</html>
