<?php include("includes/config.php"); ?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $sitename . $divider . "HOME"; ?></title>

    <!-- Google Fonts. -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <!-- CSS Reset. -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <!-- Milligram CSS. -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">
    <!-- Egen CSS. -->
    <link rel="stylesheet" href="css/main.css">
</head>

<body class="">

    <?php include("includes/header.php"); ?>

    <main>
        <div class="about">
            <section>
            <h2>Om uppgiften</h2>
                <p id="task">
                    Moment 2 behandlar grunderna i objektorienterad PHP och databasanslutningar. Uppgiften gick 
                    ut på att skapa denna enkla webbplats som hanterar en s.k. BUCKETLIST där jag kan lägga till,
                    uppdatera och radera i listan. 
                    <br>
                    <br>
                    Under utvecklingen har en logisk och överskådlig filstruktur skapats med mappar för <b>diagram</b> 
                    samt <b>includes</b> som innehåller klass-filen och återanvändbara delar så som header med navigation 
                    och footer. I klassfilen finns metoder som bland annat sköter databasanslutning och databehandling där
                    olika SQL-kommandon använts för att möjliggöra CRUD.
                    <br>
                    <br>
                    En anslutning mot en lokal MySQL-databas gjordes under utvecklingen där förändringarna kunde följas i 
                    admin-verktyget phpMyAdmin.
                </p>
            </section>
            <section>
            <h2>Mina reflektioner</h2>
                <p id="reflections">
                    PHP har, precis som tidigare programmeringsspråk vi arbetat med, varit hyfsat svårt att komma in
                    i, främst för att syntaxen varit annorlunda men också för att flexibiliteten varit ganska överväldigande
                    och hur allt hänger ihop liksom. 
                    <br>
                    <br>
                    För mig kändes denna uppgift ganska mäktig som "första" uppgift i PHP och det 
                    har varit svårt att förstå felmeddelanden och anledningar till varför saker och ting inte fungerar. Men det är 
                    jag ju van vid sedan tidigare och många delar i uppgiften känns ju igen. 
                    <br>
                    <br>
                    Det jag uppskattat är att mängden kod 
                    som behövts för komplicerade uppgifter inte varit lika omfattande som exempelvis JavaScript och jag har 
                    verkligen gillat att arbeta direkt i HTML-filerna och det har varit perfekt att ha en lokal utvecklingsmiljö
                    med XAMPP så länge det har fungerat. 
                </p>
            </section>
        </div>
    </main>

    <?php include("includes/footer.php"); ?>
</body>

</html>