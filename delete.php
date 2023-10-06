<?php
$host = 'localhost:3307';
$db   = 'read';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try 
{
     $pdo = new PDO($dsn, $user, $pass, $options);
} 
catch (\PDOException $e) 
{
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

if (isset($_POST['delete_id'])) {
    $id_to_delete = $_POST['delete_id'];

    $sql = "DELETE FROM contacts WHERE id = :id";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id_to_delete, PDO::PARAM_INT);
        $stmt->execute();
        echo "Record deleted successfully.";
    } catch (\PDOException $e) {
        echo "Error deleting record: " . $e->getMessage();
    }
}
?>

<form method="post">
    <input type="text" name="delete_id" placeholder="voer id in">
    <input type="submit" value="Delete">
</form>
