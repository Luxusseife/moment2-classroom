<?php
// Deklarerar variabler för dynamisk hantering av sidtitel.
$sitename = "MOMENT 2";
$divider = " | ";

// Flagga för aktivering av utvecklingsläge. True för lokal utveckling och false för publicering.
$devMode = false;

// Aktiverar felrapportering och visar felmeddelanden om utvecklingsläget är aktiverat.
if ($devMode) {
    error_reporting(-1);
    ini_set("display_errors", 1);
}

// Aktiverar stöd för att inkludera klassfiler automatiskt.
spl_autoload_register(function ($class_name) {
    // Inkluderar klassfilen från katalogen "classes" baserat på klassens namn.
    include 'classes/' . $class_name . '.class.php';
});

// Definierar databasinställningar beroende på om utvecklingsläge är aktiverat.
if ($devMode) {
    // Lokala databasinställningar.
    define("DBHOST", "");
    define("DBUSER", "");
    define("DBPASS", "");
    define("DBDATABASE", "");
} else {
    // Globala databasinställningar för publicering.
    define("DBHOST", "");
    define("DBUSER", "");
    define("DBPASS", "");
    define("DBDATABASE", "");
}

?>