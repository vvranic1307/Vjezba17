<?php
// Povezivanje s bazom podataka
$host = "localhost";
$username = "root"; // Promijenite ako koristite drugo korisničko ime
$password = ""; // Promijenite ako koristite lozinku
$database = "vjezba17";

// Spajanje na bazu
$conn = new mysqli($host, $username, $password, $database);

// Provjera povezanosti
if ($conn->connect_error) {
    die("Pogreška pri povezivanju s bazom: " . $conn->connect_error);
}

// Dohvaćanje podataka korisnika i država
$sql = "SELECT users.id, users.name, users.lastname, users.email, users.username, countries.country_name 
        FROM users 
        INNER JOIN countries ON users.country_id = countries.id";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prikaz korisnika i država</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f9;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h1>Popis korisnika i država</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Ime</th>
                <th>Prezime</th>
                <th>Email</th>
                <th>Korisničko ime</th>
                <th>Država</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['lastname']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo htmlspecialchars($row['country_name']); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Nema dostupnih podataka.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>

<?php
$conn->close();
?>
