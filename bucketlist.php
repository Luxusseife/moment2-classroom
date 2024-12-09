<?php include("includes/config.php"); ?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $sitename . $divider . "BUCKETLIST"; ?></title>

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

    <?php
    // Sätter variabler till default-värden från start.
    $name = "";
    $description = "";
    $priority = 0;
    ?>

    <main>
        <h2>BUCKETLIST</h2>

        <?php
        // Skapar en instans av List_item-klassen, för hämtning av listobjekt.
        $listitem = new List_item();

        // Kontrollerar om ett DELETEID tagits emot...
        if (isset($_GET['deleteid'])) {
            // Konverterar ID till ett heltal.
            $deleteid = intval($_GET['deleteid']);

            // Anropar raderings-metoden för att försöka radera listobjektet.
            if ($listitem->deleteListitem($deleteid)) {
                echo "<p id='confirmation'>Saken blev borttagen från listan!</p>";
            } else {
                echo "<p id='error'>Fel vid radering av sak från listan. Prova igen!</p>";
            }
        }

        // Hämtar alla listobjekt från bucketlistan.
        $bucketitem = $listitem->getAllListitems();

        if (empty($bucketitem)) {
            echo "<p>This bucketlist is empty. To add an item, go to <strong>ADD</strong> to get started!</p>";
        } else {
            ?>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>PRIORITY</th>
                            <th>NAME</th>
                            <th>DESCRIPTION</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Loopar igenom varje listobjekt och skriver ut dem i en tabell.
                        foreach ($bucketitem as $bi) {
                            ?>
                            <tr>
                                <td><strong><?= $bi['priority']; ?></strong></td>
                                <td><?= $bi['name']; ?></td>
                                <td><?= $bi['description']; ?></td>
                                <td>
                                    <button class="edititem-button" type="button"><a href="edititem.php?id=<?= $bi['id']; ?>">EDIT</a></button>
                                    <button class="deleteitem-button" type="button"><a href="bucketlist.php?deleteid=<?= $bi['id']; ?>">ERASE</a></button>
                                </td>
                            </tr>
                            <?php
                        }
        }
        ?>
                </tbody>
            </table>
        </div>
    </main>

    <?php include("includes/footer.php"); ?>
</body>

</html>