<?php
function customer_update() {
    // Fetch customers (assuming this function is defined and works correctly)
    $customers = fetch_customers();

    // Check if 'id' is provided in the query string
    if (isset($_GET['id'])) {
        $customerID = $_GET['id'];
        $customerFound = false;

        // Find the customer with the matching ID
        foreach ($customers as $customer) {
            if ($customer["CustomerID"] == $customerID) {
                $customerFound = true;
                break;
            }
        }

        if ($customerFound) {
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
                // Update customer details
                $updatedCustomer = [
                    'CustomerID' => $customerID,
                    'CustomerName' => $_POST['customername'],
                    'ContactName' => $_POST['contactname'],
                    'Address' => $_POST['address'],
                    'City' => $_POST['city'],
                    'PostalCode' => $_POST['postal'],
                    'Country' => $_POST['country']
                ];

                if (update_customer($updatedCustomer)) {  // Assuming update_customer() updates the customer in the database
                    echo "
                    <script>
                    alert('Customer updated successfully');
                    window.location.href = 'customer_update.php?id=" . $_GET['id'] . "';
                    </script>";
                } else {
                    echo "<script>alert('Failed to update customer');</script>";
                }
            }
            ?>
            <div class="container p-4">
                <h1 class="mt-4 mb-4">Update Customer - Record</h1>
                <hr>
                <a href="customers.php" class="text-dark fs-5 " style="text-decoration: none;"><i class="fa-solid fa-right-left"></i> Back</a>
                <div class="container col-md-8 pb-5"> 

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $customerID; ?>" method="POST">
                        <div class="mb-3">
                            <label for="customer-name" class="form-label">Customer Name</label>
                            <input type="text" value="<?php echo $customer['CustomerName']; ?>" name="customername" class="form-control" id="customer-name">
                        </div>
                        <div class="mb-3">
                            <label for="contact-name" class="form-label">Contact Name</label>
                            <input type="text" value="<?php echo $customer['ContactName']; ?>" name="contactname" class="form-control" id="contact-name">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" value="<?php echo $customer['Address']; ?>" name="address" class="form-control" id="address">
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" value="<?php echo $customer['City']; ?>" name="city" class="form-control" id="city">
                        </div>
                        <div class="mb-3">
                            <label for="postalcode" class="form-label">Postal Code</label>
                            <input type="number" value="<?php echo $customer['PostalCode']; ?>" name="postal" class="form-control" id="postalcode">
                        </div>
                        <div class="mb-3">
                            <label for="country" class="form-label">Country</label>
                            <input type="text" value="<?php echo $customer['Country']; ?>" name="country" class="form-control" id="country">
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary" value="Update">
                    </form>
                </div>
            </div>
            <?php
        } else {
            echo "<script>alert('Customer not found');</script>";
        }
    } else {
        echo "<script>alert('No Customer ID provided');</script>";
    }
}

function update_customer($customer) {
    $conn = db_conn();
    $stmt = $conn->prepare("UPDATE customer SET CustomerName = ?, ContactName = ?, Address = ?, City = ?, PostalCode = ?, Country = ? WHERE CustomerID = ?");
    return $stmt->execute([
        $customer['CustomerName'],
        $customer['ContactName'],
        $customer['Address'],
        $customer['City'],
        $customer['PostalCode'],
        $customer['Country'],
        $customer['CustomerID']
    ]);
}
?>
