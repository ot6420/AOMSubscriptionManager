<html>
    <head>
        <meta name="viewport" content="initial-scale=1.0, width=device-width" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

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

            //$id = filter_input(INPUT_GET, 'userID', FILTER_VALIDATE_INT);
            $id = 2;
            
            $subscriptionName = filter_input(INPUT_POST, "subscriptionName", FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING);
            $cycle = filter_input(INPUT_POST, "cycle", FILTER_VALIDATE_INT);
            $firstBill = filter_input(INPUT_POST, "firstBill", FILTER_SANITIZE_STRING);
            $remainMe = filter_input(INPUT_POST, "remainMe", FILTER_VALIDATE_INT);
            $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT);
            $subscriptionID = filter_input(INPUT_POST, "subscriptionID", FILTER_VALIDATE_INT);

            $subscription = new subscriptionClass();

            if (!empty($description) && !empty($cycle) && !empty($firstBill) && !empty($remainMe) && !empty($price)) {
                $subscription->subscriptionName = $subscriptionName;
                $subscription->description = $description;
                $subscription->cycle = $cycle;
                $subscription->firstBill = $firstBill;
                $subscription->remainMe = $remainMe;
                $subscription->price = $price;
                $subscription->userID = $id;
                $subscription->save();
                echo "Suscripción añadida correctamente";
            }
            ?>
            <form method="POST">
                <input type="hidden" class="form-control" id="subscriptionID" name="subscriptionID" value="<?= $subscription->subscriptionID ?>">
                <div class="form-group">
                    <label for="subscriptionName">Nombre:</label>
                    <input type="text" class="form-control" id="subscriptionName" name="subscriptionName" value="<?= $subscription->subscriptionName ?>">
                </div>
                <div class="form-group">
                    <label for="description">Descripción:</label>
                    <input type="text" class="form-control" id="description"  name="description" value="<?= $subscription->description ?>">
                </div>
                <div class="form-group">
                    <label for="cycle">Ciclo de pago:</label>
                    <input type="number" class="form-control" id="cycle"  name="cycle" value="<?= $subscription->cycle ?>">
                </div>
                <div class="form-group">
                    <label for="firstBill">Primera factura:</label>
                    <input type="date" class="form-control" id="firstBill" name="firstBill"  value="<?= $subscription->firstBill ?>">
                </div>
                <div class="form-group">
                    <label for="remainMe">Notificación de recordatorio:</label>
                    <input type="number" class="form-control" id="remianMe"  name="remainMe" value="<?= $subscription->remainMe ?>">
                </div>
                <div class="form-group">
                    <label for="price">Coste:</label>
                    <input type="number" class="form-control" id="price"  name="price" value="<?= $subscription->price ?>">
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </body>
</html>
</body>
</html>