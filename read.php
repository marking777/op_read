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

    if(isset($_POST['submit'])){
        $naam = $_POST['naam'];
        $achternaam = $_POST['achternaam'];
        $geboortedatum = $_POST['geboortedatum'];
        $email = $_POST['email'];
        $telefoon = $_POST['telefoon'];

        $data = [
            'naam' => $naam,
            'achternaam' => $achternaam,
            'geboortedatum' => $geboortedatum,
            'email' => $email,
            'telefoon' => $telefoon,
        ];
        $sql = "INSERT INTO contacts (naam, achternaam, geboortedatum, email, telefoon)
        VALUES (:naam, :achternaam, :geboortedatum, :email, :telefoon)";

        $stmt= $pdo->prepare($sql);
        $stmt->execute($data);  
    }
    $stmt = $pdo->query("SELECT * FROM contacts");
    

  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
    <h1 class="h1">contactenlijst</h1>
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">naam</th>
      <th scope="col">achternaam</th>
      <th scope="col">geboortedatum</th>
      <th scope="col">email</th>
      <th scope="col">telefoon</th>
      <th scope="col">bewerken</th>
      <th scope="col">Delete</th>
      
    </tr>
  </thead>
  <tbody>
    <?php
    while ($row = $stmt->fetch()) {
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['naam']."</td>";
        echo "<td>".$row['achternaam']."</td>";
        echo "<td>".$row['geboortedatum']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "<td>".$row['telefoon']."</td>";
        echo "<td><a href='' class= 'btn btn-success'>Bewerken</a></td>";
        echo "<td><a href='delete.php' class= 'btn btn-danger'>Delete</a></td>";
        
        echo "</tr>";
    }  
   ?>
  </tbody>
</table>
    <form method="post"> 
        
        
        <H1>contact toevoegen</H1>
        <div class="input">
        <input type="text" name="naam" placeholder="naam" required>
        <input type="text" name="achternaam" placeholder="achternaam" required>
        <input type="date" name="geboortedatum" placeholder="geboortedatum" required>
        <input type="email" name="email" placeholder="emaail" required>
        <input type="text" name="telefoon" placeholder="telefoon" required>
       
        <input type="submit" name="submit">
    </form></div>
   
</body>
</html>
