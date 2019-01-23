<html>
    <head>
        <meta name="viewport" content="initial-scale=1.0, width=device-width" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
        <title>Añadir nueva suscripción</title>
    </head>
    <body>
        <div class="container">
            <div class="jumbotron">
                <h1>Añadir nueva suscripción</h1>
            </div>
            <?php
            require_once 'class/subscriptionClass.php';
            require_once 'class/tablaClass.php';

            $server = "localhost";
            $user = "root";
            $password = "";
            $db = "AOM";
            
            try {
                $conn = new PDO("mysql:host=$server;dbname=$db", $user, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

                $suscriptionName = filter_input(INPUT_POST, "suscriptionName", FILTER_SANITIZE_STRING);
                $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING);
                $cycle = filter_input(INPUT_POST, "cycle", FILTER_VALIDATE_INT);
                $firstBill = filter_input(INPUT_POST, "firstBill", FILTER_SANITIZE_STRING);
                $remainMe = filter_input(INPUT_POST, "remainMe", FILTER_VALIDATE_INT);
                $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_INT);
                //$userID = filter_input(INPUT_POST, "userID", FILTER_VALIDATE_INT);

                $subscription = new subscriptionClass();

                echo $suscriptionName;
                if (!empty($subscriptionName) && !empty($description) && !empty($firstBill) && !empty($cycle) && !empty($remainMe) && !empty($price)) {
                    $subscription->subscriptionName = $subscriptionName;
                    $subscription->description = $description;
                    $subscription->firstBill = $firstBill;
                    $subscription->cycle = $cycle;
                    $subscription->remainMe = $remainMe;
                    $subscription->price = $price;
                    $subscription->save();
                }
                ?>

                <form method="POST">
                    <div class="form-group">
                        <label for="subscriptionName">Nombre de la suscripción:</label>
                        <input type="text" class="form-control" id="subscriptionName" name="subscriptionName">
                    </div>
                    <div class="form-group">
                        <label for="description">Descripción (Ej. Salón, habitación):</label>
                        <input type="text" class="form-control" id="description"  name="description">
                    </div>
                    <div class="form-group">
                        <label for="firstBill">Primera factura :</label>
                        <input type="date" class="form-control" id="firstBill"  name="firstBill">
                    </div>
                    <div class="form-group">
                        <label for="cycle">Periodo de renovación:</label>
                        <select name="cycle" id="cycle" class="form-control"> 
                            <option selected></option>
                            <option value="7">Semanal</option>
                            <option value="30">Mensual</option>
                            <option value="365">Anual</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="remainMe">Aviso de renovación:</label>
                        <select name="remainMe" id="remainMe" class="form-control"> 
                            <option selected></option>
                            <option value="1">1 día antes</option>
                            <option value="7">1 semana antes</option>
                            <option value="15">2 semanas antes</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Coste de la suscripción:</label>
                        <input type="number" class="form-control" id="price" name="price">
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar suscripción</button>
                </form>

                <?php
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
            ?>
        </div>
    </body>
</html>
</body>
</html>
