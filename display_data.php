
<?php
// Same database configuration as above
include 'db_config.php';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->query("SELECT * FROM invoices ORDER BY created_at DESC");
    $records = $stmt->fetchAll();
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Records</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>All Records</h1>
    <table>
        <tr>
            <th>Invoice No</th>
            <th>Security</th>
            <th>Amount</th>
            <th>Lab ID</th>
            <th>Date</th>
        </tr>
        <?php foreach ($records as $record): ?>
        <tr>
            <td><?= $record['invoice_number'] ?></td>
            <td><?= $record['security'] ?></td>
            <td><?= $record['amount'] ?></td>
            <td><?= $record['lab_id'] ?></td>
            <td><?= $record['created_at'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>