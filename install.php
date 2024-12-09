<?php
// Inkluderar konfigurationsfilen med definierade databasuppgifter (lokalt/globalt).
include("includes/config.php");

// Ansluter till databasen med hjälp av MYSQLI.
$db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);

// Kollar av om anslutningen misslyckades - stänger då ner och skickar ett felmeddelande.
if ($db->connect_error) {
    die("Anslutningen misslyckades: " . $db->connect_error);
}

// Skapar en ny tabell (tar först bort tabellen om den redan finns och skriver över med ny data).
$sql = "
    DROP TABLE IF EXISTS list_items; 
    CREATE TABLE list_items(
        id INT(11) PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(64) NOT NULL,
        description VARCHAR(255) NOT NULL,
        priority TINYINT NOT NULL,
        created_at TIMESTAMP NOT NULL DEFAULT current_timestamp()
    );";

// Skickar SQL-frågan till servern.
if ($db->multi_query($sql)) {
    // Lyckat meddelande.
    echo "Tabellen skapades!";
} else {
    // Felmeddelande med detaljerad felbeskrivning.
    echo "Fel uppstod när tabellen skulle skapas: " . $db->error;
}
?>