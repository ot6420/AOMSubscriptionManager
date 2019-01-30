<html><head>
        <meta name="viewport" content="initial-scale=1.0, width=device-width" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
        <title>Nuevo usuario</title>
    </head>
    <body>
        <div class="container">
            <div class="jumbotron">
                <h1>Nuevo usuario</h1>
            </div>
            <?php
            require_once 'class/userClass.php';
            require_once 'class/languageClass.php';
            require_once 'class/tablaClass.php';

            $firstName = filter_input(INPUT_POST, "firstName", FILTER_SANITIZE_STRING);
            $lastName = filter_input(INPUT_POST, "lastName", FILTER_SANITIZE_STRING);
            $birthDate = filter_input(INPUT_POST, "birthDate", FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
            $pass = filter_input(INPUT_POST, "pass", FILTER_SANITIZE_STRING);
            $pass1 = filter_input(INPUT_POST, "pass1", FILTER_SANITIZE_STRING);
            $interfaceLanguage = filter_input(INPUT_POST, "interfaceLanguage", FILTER_SANITIZE_STRING);
            $userID = filter_input(INPUT_POST, "userID", FILTER_VALIDATE_INT);

            $user1 = new userClass();
            
            if ($pass == $pass1) {
            if (!empty($firstName) && !empty($lastName) && !empty($birthDate) && !empty($email)) {
                $user1->firstName = $firstName;
                $user1->lastName = $lastName;
                $user1->birthDate = $birthDate;
                $user1->email = $email;
                $user1->pass = $pass;
                $user1->interfaceLanguage = $interfaceLanguage;
                $user1->userType = 1;
                $user1->save();
                echo "Usuario registrado correctamente";
            }
        } else {
            echo "Las contraseñas no coinciden";
        }

            $language = "catalan";
            ?>

            <form method="POST">
                <input type="hidden" class="form-control" id="userID" name="userID" value="<?= $user1->userID ?>">
                <div class="form-group">
                    <label for="firstName">Nombre:</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" value="<?= $user1->firstName ?>">
                </div>
                <div class="form-group">
                    <label for="lastName">Apellidos:</label>
                    <input type="text" class="form-control" id="lastName"  name="lastName" value="<?= $user1->lastName ?>">
                </div>
                <div class="form-group">
                    <label for="birthDate">Fecha de nacimiento:</label>
                    <input type="date" class="form-control" id="birthDate"  name="birthDate" value="<?= $user1->birthDate ?>">
                </div>
                <div class="form-group">
                    <label for="email">Correo electrónico:</label>
                    <input type="email" class="form-control" id="email"  name="email" value="<?= $user1->email ?>">
                </div>
                <div class="form-group">
                    <label for="pass">Contraseña:</label>
                    <input type="password" class="form-control" id="pass"  name="pass" value="<?= $user1->pass ?>">
                </div>
                <div class="form-group">
                    <label for="pass1">Repetir contraseña:</label>
                    <input type="password" class="form-control" id="pass1"  name="pass1">
                </div>
                <div class="form-group">
                    <label for="interfaceLanguage">Lenguaje de la interfaz:</label>
                    <select name="interfaceLanguage" id="interfaceLanguage">
                            <option value="1"><?php echo $language; ?></option>
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </body>
</html>
</body>
</html>
