<?php
function update_supplier() {
    // Fetch suppliers (assuming this function is defined and works correctly)
    $suppliers = fetch_suppliers();

    // Check if 'id' is provided in the query string
    if (isset($_GET['id'])) {
        $SupplierID = $_GET['id'];
        $supplierFound = false;

        // Find the supplier with the matching ID
        foreach ($suppliers as $supplier) {
            if ($supplier["SupplierID"] == $SupplierID) {
                $supplierFound = true;
                break;
            }
        }

        if ($supplierFound) {
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
                // Sanitize input
                $supplierName = htmlspecialchars(trim($_POST['SupplierName']));
                $contactName = htmlspecialchars(trim($_POST['contactname']));
                $address = htmlspecialchars(trim($_POST['address']));
                $city = htmlspecialchars(trim($_POST['city']));
                $postalCode = htmlspecialchars(trim($_POST['postal']));
                $country = htmlspecialchars(trim($_POST['country']));
                $phone = htmlspecialchars(trim($_POST['phone']));

                // Update supplier details
                $updatedSupplier = [
                    'SupplierID' => $SupplierID,
                    'SupplierName' => $supplierName,
                    'ContactName' => $contactName,
                    'Address' => $address,
                    'City' => $city,
                    'PostalCode' => $postalCode,
                    'Country' => $country,
                    'Phone' => $phone
                ];

                if (save_updated_supplier($updatedSupplier)) {  // Update the supplier in the database
                    echo "
                    <script>
                    alert('Supplier updated successfully');
                    window.location.href = 'update_supplier.php?id=" . $_GET['id'] . "';
                    </script>";
                } else {
                    echo "<script>alert('Failed to update Supplier');</script>";
                }
            }
            ?>
            <div class="container p-4">
                <h1 class="mt-4 mb-4">Update Supplier - Record</h1>
                <hr>
                <a href="suppliers.php" class="text-dark fs-5" style="text-decoration: none;"><i class="fa-solid fa-right-left"></i> Back</a>
                <div class="container col-md-8 pb-5"> 
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $SupplierID; ?>" method="POST">
                    <div class="mb-3">
                        <label for="SupplierName" class="form-label">Supplier Name</label>
                        <input type="text" value="<?php echo htmlspecialchars($supplier['SupplierName']); ?>" name="SupplierName" class="form-control" id="SupplierName" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="contactname" class="form-label">Contact Name</label>
                        <input type="text" value="<?php echo htmlspecialchars($supplier['ContactName']); ?>" name="contactname" class="form-control" id="contactname">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" value="<?php echo htmlspecialchars($supplier['Address']); ?>" name="address" class="form-control" id="address">
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <input type="text" value="<?php echo htmlspecialchars($supplier['City']); ?>" name="city" class="form-control" id="city">
                    </div>
                    <div class="mb-3">
                        <label for="postal" class="form-label">Postal Code</label>
                        <input type="number" value="<?php echo htmlspecialchars($supplier['PostalCode']); ?>" name="postal" class="form-control" id="postal">
                    </div>
                    <div class="mb-3">
                        <label for="country" class="form-label">Country</label>
                        <input type="text" value="<?php echo htmlspecialchars($supplier['Country']); ?>" name="country" class="form-control" id="country">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" value="<?php echo htmlspecialchars($supplier['Phone']); ?>" name="phone" class="form-control" id="phone">
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Update Supplier">
                </form>
                </div>
            </div>
            <?php
        } else {
            echo "<script>alert('Supplier not found');</script>";
        }
    } else {
        echo "<script>alert('No Supplier ID provided');</script>";
    }
}

function save_updated_supplier($updatedSupplier) {
    $conn = db_conn();
    $stmt = $conn->prepare("UPDATE suppliers SET SupplierName = ?, ContactName = ?, Address = ?, City = ?, PostalCode = ?, Country = ?, Phone = ? WHERE SupplierID = ?");
    return $stmt->execute([
        $updatedSupplier['SupplierName'],
        $updatedSupplier['ContactName'],
        $updatedSupplier['Address'],
        $updatedSupplier['City'],
        $updatedSupplier['PostalCode'],
        $updatedSupplier['Country'],
        $updatedSupplier['Phone'],
        $updatedSupplier['SupplierID']
    ]);
}
?>
