<?php
header("Content-Type: application/xml");

// Database connection details
$host = 'localhost'; // or your database host
$dbname = 'photobazaar';
$username = 'root';  // or your database username
$password = '';      // or your database password

// Create a PDO instance to connect to the database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Load the XML data from the request
    $xmlData = file_get_contents("php://input");
    $xml = simplexml_load_string($xmlData);

    // Extract email from the XML data
    $email = (string) $xml->email;

    // Prepare the XML response object
    $xmlResponse = new SimpleXMLElement("<response></response>");

    // Query the database to check if the email exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Email exists in the database
        $xmlResponse->addChild("status", "success");
        $xmlResponse->addChild("message", "Email found. You can log in.");
    } else {
        // Email does not exist
        $xmlResponse->addChild("status", "failure");
        $xmlResponse->addChild("message", "Email not found. Please sign up.");
    }

    // Send the XML response
    echo $xmlResponse->asXML();
} catch (PDOException $e) {
    // Handle database connection error
    $xmlResponse = new SimpleXMLElement("<response></response>");
    $xmlResponse->addChild("status", "failure");
    $xmlResponse->addChild("message", "Database connection failed: " . $e->getMessage());
    echo $xmlResponse->asXML();
}
?>
