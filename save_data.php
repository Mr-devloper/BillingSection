
<?php
// Database configuration for InfinityFree
$host = 'sql211.infinityfree.com';
$dbname = 'if0_38090824_db_bill';
$username = 'if0_38090824';
$password = '4H1HfrNQQkCO';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create table if not exists
    $conn->exec("CREATE TABLE IF NOT EXISTS invoices (
        id INT AUTO_INCREMENT PRIMARY KEY,
        invoice_number VARCHAR(50) NOT NULL,
        security VARCHAR(50) NOT NULL,
        amount DECIMAL(10,2) NOT NULL,
        lab_id VARCHAR(50) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    // Insert data
    $stmt = $conn->prepare("INSERT INTO invoices (invoice_number, security, amount, lab_id) 
                          VALUES (:invoice_number, :security, :amount, :lab_id)");
    
    $stmt->bindParam(':invoice_number', $_POST['invoiceNumber']);
    $stmt->bindParam(':security', $_POST['security']);
    $stmt->bindParam(':amount', $_POST['amount']);
    $stmt->bindParam(':lab_id', $_POST['labId']);
    
    $stmt->execute();
    
    echo "Data saved successfully";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
