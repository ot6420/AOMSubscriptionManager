<html><head>
        <meta name="viewport" content="initial-scale=1.0, width=device-width" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
        <title>Editar datos de perfil</title>
    </head>
    <body>
        <div class="container">
            <div class="jumbotron">
                <h1>Editar datos de perfil</h1>
            </div>
            <?php
            $server = "localhost";
            $user = "root";
            $password = "";
            $db = "AOM";
            try {

                $conn = new PDO("mysql:host=$server;dbname=$db", $user, $password);

//Con esta línea indicamos que si hay algún error se trate como una excepción

                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
                $id = 2;

                $firstName = filter_input(INPUT_POST, "firstName", FILTER_SANITIZE_STRING);
                $lastName = filter_input(INPUT_POST, "lastName", FILTER_SANITIZE_STRING);
                $birthDate = filter_input(INPUT_POST, "birthDate", FILTER_SANITIZE_STRING);
                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
                $interfaceLanguage = filter_input(INPUT_POST, "interfaceLanguage", FILTER_SANITIZE_STRING);
                $userID = filter_input(INPUT_POST, "userID", FILTER_VALIDATE_INT);
                if (!empty($firstName) && !empty($lastName) && !empty($userID)) {
                    $sql = "update Users set firstName='$firstName', lastName='$lastName', birthDate='$birthDate', email='$email', interfaceLanguage='$interfaceLanguage' where userID=$userID";
                    if ($conn->exec($sql)) {
                        ?>
                        <div class="alert alert-success">
                            <strong>Correcto: </strong> Alumno editado .
                        </div>
                        <?php
                    }
                }

                if (!empty($id)) {
                    $sql = "select * from Users where userID = $id";
                    $res = $conn->query($sql);
                    $user = $res->fetch();

                    $sqlLanguages = "select * from Languages";
                    $resLanguages = $conn->query($sqlLanguages);
                    $language = $resLanguages->fetch();
                    echo $language['languageName'];
                    
                    if (!empty($user)) {
                        ?>

                        <form method="POST">
                            <input type="hidden" class="form-control" id="userID" name="userID" value="<?= $user['userID'] ?>">
                            <div class="form-group">
                                <label for="firstName">Nombre:</label>
                                <input type="text" class="form-control" id="firstName" name="firstName" value="<?= $user['firstName'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="lastName">Apellidos:</label>
                                <input type="text" class="form-control" id="lastName"  name="lastName" value="<?= $user['lastName'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="birthDate">Fecha de nacimiento:</label>
                                <input type="date" class="form-control" id="birthDate"  name="birthDate" value="<?= $user['birthDate'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Correo electrónico:</label>
                                <input type="email" class="form-control" id="email"  name="email" value="<?= $user['email'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="interfaceLanguage">Lenguaje de la interfaz:</label>
                                <select name="interfaceLanguage" id="interfaceLanguage">
                                    <option>Seleccione un lenguage:</option>
                            <?php
                                foreach($language as $x) {
                            ?>
                                    <option value="<?php echo $x['languageName'];?>"><?php echo $x['languageName'];?></option>
                            <?php
                                }
                            ?>
                            </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </form>
                        <?php
                    } else {
                        ?><p>Alumno desconocido</p>
                        <?php
                    }
                } else {
                    ?><p>Falta el id</p>
                    <?php
                }
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
            ?>
        </div>
    </body>
</html>
</body>
</html>
