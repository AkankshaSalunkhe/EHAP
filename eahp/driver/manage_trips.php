<?php
session_start();
require 'db.php';

if (!isset($_SESSION['driver_id'])) {
    header('Location: login.php');
    exit();
}

$driver_id = $_SESSION['driver_id'];

// Accept a trip
if (isset($_POST['accept_trip'])) {
    $trip_id = $_POST['trip_id'];
    $stmt = $pdo->prepare("UPDATE trips SET status = 'accepted' WHERE id = :trip_id AND driver_id = :driver_id");
    $stmt->execute(['trip_id' => $trip_id, 'driver_id' => $driver_id]);
}

// Get pending trips
$stmt = $pdo->prepare("SELECT * FROM trips WHERE status = 'pending'");
$stmt->execute();
$trips = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Manage Trips</h1>
<?php foreach ($trips as $trip): ?>
    <p>
        Patient: <?php echo htmlspecialchars($trip['patient_name']); ?><br>
        Pickup: <?php echo htmlspecialchars($trip['pickup_location']); ?><br>
        Dropoff: <?php echo htmlspecialchars($trip['dropoff_location']); ?><br>
        <form method="post">
            <input type="hidden" name="trip_id" value="<?php echo $trip['id']; ?>">
            <button type="submit" name="accept_trip">Accept Trip</button>
        </form>
    </p>
<?php endforeach; ?>
