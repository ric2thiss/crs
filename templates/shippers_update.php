<?php
function shipper_update() {
    // Initialize Fetching of Data Functions
    $shippers = fetch_shippers();

    // Check if 'id' is provided in the query string
    if (isset($_GET['id'])) {
        $shipperID = $_GET['id'];
        $shipperFound = false;

        // Find the shipper with the matching ID
        foreach ($shippers as $shipper) {
            if ($shipper["ShipperID"] == $shipperID) {
                $shipperFound = true;
                break;
            }
        }

        if ($shipperFound) {
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
                // Sanitize input
                $shipperName = htmlspecialchars(trim($_POST['ShipperName']));
                $phone = htmlspecialchars(trim($_POST['phone']));

                // Validate input
                $errors = [];
                if (empty($shipperName)) {
                    $errors[] = "Shipper Name is required.";
                }
                if (empty($phone)) {
                    $errors[] = "Phone number is required.";
                } elseif (!preg_match("/^[0-9]{10,15}$/", $phone)) {
                    $errors[] = "Phone number should be between 10 and 15 digits.";
                }

                // If there are no errors, proceed to update the shipper in the database
                if (empty($errors)) {
                    $updatedShipper = [
                        'ShipperID' => $shipperID,
                        'ShipperName' => $shipperName,
                        'Phone' => $phone
                    ];

                    if (update_shipper($updatedShipper)) {
                        echo "
                        <script>
                        alert('Shipper updated successfully');
                        window.location.href = 'update_shipper.php?id=" . $_GET['id'] . "';
                        </script>";
                    } else {
                        echo "<script>alert('Failed to update shipper');</script>";
                    }
                } else {
                    // Display errors
                    foreach ($errors as $error) {
                        echo "<script>alert('$error');</script>";
                    }
                }
            }
            ?>
            <div class="container p-4">
                <h1 class="mt-4 mb-4">Update Shipper - Record</h1>
                <hr>
                <a href="shippers.php" class="text-dark fs-5" style="text-decoration: none;"><i class="fa-solid fa-right-left"></i> Back</a>
                <div class="container col-md-8 pb-5"> 
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $shipperID; ?>" method="POST">
                    <div class="mb-3">
                        <label for="ShipperName" class="form-label">Shipper Name</label>
                        <input type="text" value="<?php echo htmlspecialchars($shipper['ShipperName']); ?>" name="ShipperName" class="form-control" id="ShipperName" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" value="<?php echo htmlspecialchars($shipper['Phone']); ?>" name="phone" class="form-control" id="phone" required>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Update Shipper">
                </form>
            </div>
            <?php
        } else {
            echo "<script>alert('Shipper not found');</script>";
        }
    } else {
        echo "<script>alert('No Shipper ID provided');</script>";
    }
}

function update_shipper($updatedShipper) {
    $conn = db_conn();
    $stmt = $conn->prepare("UPDATE shippers SET ShipperName = ?, Phone = ? WHERE ShipperID = ?");
    return $stmt->execute([
        $updatedShipper['ShipperName'],
        $updatedShipper['Phone'],
        $updatedShipper['ShipperID']
    ]);
}
?>