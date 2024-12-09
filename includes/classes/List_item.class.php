<?php

// Klass för bucketlist-saker.
class List_item
{
    // Egenskaper.
    private $db;
    private $name;
    private $description;
    private $priority;
    private $errorMessage = "";

    // Konstruktor.
    function __construct() 
    {
        // Ansluter till databasen.
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);

        /* Om anslutningen misslyckas...
        if ($this->db->connect_error) {
            die("Anslutningen till databasen misslyckades: " . $this->db->connect_error);
        }*/

        // Om anslutningen misslyckas...
        if ($this->db->connect_error) {
            throw new Exception("Anslutningen till databasen misslyckades: " . $this->db->connect_error);
        }
    }

    // Setter för namn.
    public function setName(string $name) : bool 
    {
        // Kontrollerar om input-längden är mellan 1 och 64 tecken. Om ja, returneras true.
        if (strlen($name) >= 1 && strlen($name) <= 64) {
            // "Städar" namnet för att förhindra SQL-injektion.
            $this->name = $this->db->real_escape_string($name);
            return true;
        }

        // Om input-längden är inkorrekt, returneras false.
        return false;
    }

    // Getter för namn - hämtar värdet för namn.
    public function getName() : string 
    {
        return $this->name;
    }

    // Setter för beskrivning.
    public function setDescription(string $description) : bool
    {
        // Kontrollerar om input-längden är mellan 1 och 255 tecken. Om ja, returneras true.
        if(strlen($description) >= 1 && strlen($description) <= 255) {
            // "Städar" beskrivningstexten för att förhindra SQL-injektion.
            $this->description = $this->db->real_escape_string($description);
            return true;
        }

        // Om input-längden är inkorrekt, returneras false.
        return false;
    }

    // Getter för beskrivning - hämtar värdet för beskrivning.
    public function getDescription() : string 
    {
        return $this->description;
    }

    // Setter för prioritet.
    public function setPriority(int $priority) : bool 
    {
        // Kontrollerar om prioritet är angiven mellan 1 och 5. Om ja, returneras true.
        if ($priority >= 1 && $priority <= 5) {
            $this->priority = $priority;
            return true;
        }

        // Om prioriteten inte angivits, returneras false. 
        return false;
    }

    // Getter för prioritet - hämtar värdet för prioritet.
    public function getPriority() : int 
    {
        return $this->priority;
    }

    // Lägger till ett nytt listobjekt i bucketlistan. Returnerar true om det lyckas.
    public function addListitem(string $name, string $description, int $priority) : bool 
    {
        // Kontrollerar och validerar input innan lagring. Skickar detaljerade felmeddelande vid ikorrekt inmatning.
        if (!$this->setName(trim($name))) {
            $this->errorMessage = "Namnet måste vara mellan 1 och 64 tecken.";
            return false;
        }
        if (!$this->setDescription(trim($description))) {
            $this->errorMessage = "Beskrivningen måste vara mellan 1 och 255 tecken.";
            return false;
        }
        if (!$this->setPriority(trim($priority))) {
            $this->errorMessage = "Prioriteten måste vara mellan 1 och 5.";
            return false;
        }

        // Skapar en SQL-fråga för att lägga till listobjektet i databasen.
        $sql = "INSERT INTO list_items(name, description, priority) VALUES('" . $this->name . "', '" . $this->description . "', " . $this->priority . ")";
        $result = $this->db->query($sql);

        // Vid lyckad lagring rensas felmeddelandet och returneras true.
        if ($result) {
            $this->errorMessage = ""; 
            return true;
        }

        // Vid misslyckad lagring returneras false.
        return false; 
    }

    // Hämtar alla listobjekt i bucketlistan och sorterar utifrån prioritet (1 först).
    public function getAllListitems() : array 
    {
        // Skapar en SQL-fråga för att hämta alla listobjekt.
        $sql = "SELECT * FROM list_items ORDER BY priority;";
        $result = $this->db->query($sql);

        // Returnerar resultaten som en associativ array.
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Raderar ett specifikt listobjekt med hjälp av ID.
    public function deleteListitem(int $id) : bool 
    {
        $id = intval($id);

        // Skapar en SQL-fråga för att radera ett listobjekt.
        $sql = "DELETE FROM list_items WHERE id = $id;";

        return $this->db->query($sql);
    }

    // Uppdaterar ett specifikt listobjekt med hjälp av ID.
    public function updateListitem(string $name, string $description, int $priority, int $id) : bool
    {
        // Kontrollerar och validerar input innan uppdatering. Skickar detaljerade felmeddelande vid ikorrekt inmatning.
        if (!$this->setName($name)) {
            $this->errorMessage = "Namnet måste vara mellan 1 och 64 tecken.";
            return false;
        }
        if (!$this->setDescription($description)) {
            $this->errorMessage = "Beskrivningen måste vara mellan 1 och 255 tecken.";
            return false;
        }
        if (!$this->setPriority($priority)) {
            $this->errorMessage = "Prioriteten måste vara mellan 1 och 5.";
            return false;
        }

        // Skapar en SQL-fråga för att uppdatera ett listobjekt.
        $sql = "UPDATE list_items SET name='" . $this->name . "', description='" . $this->description . "', priority=" . $this->priority . " WHERE id=$id;";
    
        return $this->db->query($sql);
    }

    public function getListitemByID(int $id) : array {

        // Konverterar ID till heltal.
        $id = intval($id);

        // Skapar en SQL-fråga för att lokalisera och hämta ett specifikt listobjekt.
        $sql = "SELECT * FROM list_items WHERE id=$id;";

        // Returnerar resultaten som en associativ array.
        $result = $this->db->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }


    // Hämtar felmeddelandet som sätts vid ogiltig input.
    public function getErrorMessage(): string 
    {
        return $this->errorMessage;
    }

    // Destruktor som stänger ner databasanslutningen.
    function __destruct()
    {
        $this->db->close();
    }
}
?>