<?php include("includes/config.php"); ?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $sitename . $divider . "ADD ITEM"; ?></title>

    <!-- Google Fonts. -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <!-- CSS Reset. -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <!-- Milligram CSS. -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">
    <!-- Egen CSS. -->
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <?php include("includes/header.php"); ?>

    <main>
        <?php
        // Initialiserar variabler och behåller värdet om en submit/en POST är gjord, annars sätts defaultvärden.
        $name = $_POST["name"] ?? "";
        $description = $_POST["description"] ?? "";
        $priority = $_POST["priority"] ?? 0;
        ?>

        <h2>ADD ITEM</h2>

        <div class="form-container">
            <form method="POST" action="additem.php">
                <label for="name">NAME:</label>
                <input type="text" id="name" name="name" value="<?= $name; ?>">

                <label for="description">DESCRIPTION:</label>
                <input type="text" id="description" name="description" value="<?= $description; ?>">

                <label for="priority">PRIORITY:</label>
                <select id="priority" name="priority">
                    <option value="0" <?= $priority == 0 ? "selected" : ""; ?>>0</option>
                    <option value="1" <?= $priority == 1 ? "selected" : ""; ?>>1</option>
                    <option value="2" <?= $priority == 2 ? "selected" : ""; ?>>2</option>
                    <option value="3" <?= $priority == 3 ? "selected" : ""; ?>>3</option>
                    <option value="4" <?= $priority == 4 ? "selected" : ""; ?>>4</option>
                    <option value="5" <?= $priority == 5 ? "selected" : ""; ?>>5</option>
                </select>

                <?php
                // Kontrollerar om formuläret har postats.
                if (isset($_POST["name"])) {
                    // Hämtar värden från formuläret.
                    $name = $_POST["name"];
                    $description = $_POST["description"];
                    $priority = $_POST["priority"];

                    // Skapar en instans av List_item-klassen, för hantering av formulär.
                    $listitem = new List_item();

                    // Provar att lagra nytt listobjekt i databasen.
                    if ($listitem->addListitem($name, $description, $priority)) {
                        // Vid lyckad lagring omdirigeras användaren till sidan för bucketlistan.
                        header("Location: bucketlist.php");
                        // Säkertställer att kodexekveringen avslutas.
                        exit();
                    } else {
                        // Vid misslyckad lagring visas ett dynamiskt felmeddelande.
                        echo "<p id='error'>" . $listitem->getErrorMessage() . "</p>";
                    }
                }
                ?>
                <input type="submit" value="ADD ITEM" id="add-button">
            </form>
        </div>
    </main>

    <?php include("includes/footer.php"); ?>
</body>

</html>