<html><head>
        <meta name="viewport" content="initial-scale=1.0, width=device-width" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
        <title>Editar datos de suscripción</title>
    </head>
    <body>
        <div class="container">
            <div class="jumbotron">
                <h1>Editar datos de la suscripción</h1>
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

//Con esta línea indicamos que si hay algún error se trate como una excepción

                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
                $id = 2;

                $subscriptionName = filter_input(INPUT_POST, "subscriptionName", FILTER_SANITIZE_STRING);
                $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING);
                $cycle = filter_input(INPUT_POST, "cycle", FILTER_VALIDATE_INT);
                $firstBill = filter_input(INPUT_POST, "firstBill", FILTER_SANITIZE_STRING);
                $remainMe = filter_input(INPUT_POST, "remainMe", FILTER_VALIDATE_INT);
                $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_INT);
                $subscriptionID = filter_input(INPUT_POST, "subscriptionID", FILTER_VALIDATE_INT);
                if (!empty($subscriptionName) && !empty($cycle) && !empty($subscriptionID)) {
                    $sql = "update Subscription set subscriptionName='$subscriptionName', description='$description', cycle=$cycle, firstBill='$firstBill', renainMe=$remainMe, price='$price' where subscriptionID=$subscriptionID";
                    if ($conn->exec($sql)) {
                        ?>
                        <div class="alert alert-success">
                            <strong>Correcto: </strong> Suscripción editada .
                        </div>
                        <?php
                    }
                }

                if (!empty($id)) {
                    
                    $subscriptionFind = new subscriptionClass();
                    $subscriptionFind->load($id);
                    
                    if (!empty($subscriptionFind)) {
                        ?>

                        <form method="POST">
                            <input type="hidden" class="form-control" id="subscriptionID" name="subscriptionID" value="<?= $subscriptionFind->subscriptionID ?>">
                            <div class="form-group">
                                <label for="subscriptionName">Nombre:</label>
                                <input type="text" class="form-control" id="subscriptionName" name="subscriptionName" value="<?= $subscriptionFind->subscriptionName ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="description">Descripción:</label>
                                <input type="text" class="form-control" id="description"  name="description" value="<?= $subscriptionFind->description ?>">
                            </div>
                            <div class="form-group">
                                <label for="cycle">Ciclo de pago:</label>
                                <input type="number" class="form-control" id="cycle"  name="cycle" value="<?= $subscriptionFind->cycle ?>">
                            </div>
                            <div class="form-group">
                                <label for="firstBill">Primera factura:</label>
                                <input type="date" class="form-control" id="firstBill"  value="<?= $subscriptionFind->firstBill ?>">
                            </div>
                            <div class="form-group">
                                <label for="remainMe">Notificación de recordatorio:</label>
                                <input type="number" class="form-control" id="remianMe"  name="remainMe" value="<?= $subscriptionFind->remainMe ?>">
                            </div>
                            <div class="form-group">
                                <label for="price">Coste:</label>
                                <input type="number" class="form-control" id="price"  name="price" value="<?= $subscriptionFind->price ?>">
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </form>
                        <?php
                    } else {
                        ?><p>Suscripción desconocida</p>
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