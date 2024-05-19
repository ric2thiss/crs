<?php
function orders_update() {
    // Initialize Fetching of Data Functions
    $orders = fetch_orders();
    $customerIDs = fetch_customers(); 
    $EmployeeIDs = fetch_employees();
    $shipperIDs = fetch_shippers();

    // Check if 'id' is provided in the query string
    if (isset($_GET['id'])) {
        $orderID = $_GET['id'];
        $orderFound = false;

        // Find the order with the matching ID
        foreach ($orders as $order) {
            if ($order["OrderID"] == $orderID) {
                $orderFound = true;
                break;
            }
        }

        if ($orderFound) {
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
                // Update order details
                $updatedOrder = [
                    'OrderID' => $orderID,
                    'CustomerID' => $_POST['customerID'],
                    'EmployeeID' => $_POST['employeeID'],
                    'ShipperID' => $_POST['shipperID'],
                    'OrderDate' => $_POST['OrderDate']
                ];

                if (update_order($updatedOrder)) {  // Update the order in the database
                    echo "
                    <script>
                    alert('Order updated successfully');
                    window.location.href = 'order_update.php?id=" . $_GET['id'] . "';
                    </script>";
                } else {
                    echo "<script>alert('Failed to update Order');</script>";
                }
            }
            ?>
            <div class="container p-4">
                <h1 class="mt-4 mb-4">Update Order - Record</h1>
                <hr>
                <a href="orders.php" class="text-dark fs-5" style="text-decoration: none;"><i class="fa-solid fa-right-left"></i> Back</a>
                <div class="container col-md-8 pb-5"> 
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $orderID; ?>" method="POST">
                    <div class="mb-3">
                        <label for="customerID" class="form-label">Customer</label>
                        <select name="customerID" class="form-select" aria-label="Default select example" required>
                            <option disabled>Select Customer</option>
                            <?php
                                foreach($customerIDs as $customerID){
                                    // Set selected option
                                    $selected = ($order['CustomerID'] == $customerID["CustomerID"]) ? 'selected' : '';
                                    echo '<option value="'.$customerID["CustomerID"].'" '.$selected.'>'.$customerID["CustomerName"].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="employeeID" class="form-label">Employee</label>
                        <select name="employeeID" class="form-select" aria-label="Default select example" required>
                            <option disabled>Select Employee</option>
                            <?php
                                foreach($EmployeeIDs as $employeeID){
                                    // Set selected option
                                    $selected = ($order['EmployeeID'] == $employeeID["EmployeeID"]) ? 'selected' : '';
                                    echo '<option value="'.$employeeID["EmployeeID"].'" '.$selected.'>'.$employeeID["LastName"].' '.$employeeID["FirstName"].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="shipperID" class="form-label">Shipper</label>
                        <select name="shipperID" class="form-select" aria-label="Default select example" required>
                            <option disabled>Select Shipper</option>
                            <?php
                                foreach($shipperIDs as $shipperID){
                                    // Set selected option
                                    $selected = ($order['ShipperID'] == $shipperID["ShipperID"]) ? 'selected' : '';
                                    echo '<option value="'.$shipperID["ShipperID"].'" '.$selected.'>'.$shipperID["ShipperName"].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="OrderDate" class="form-label">Order Date</label>
                        <input type="date" value="<?php echo htmlspecialchars($order['OrderDate']); ?>" name="OrderDate" class="form-control" id="OrderDate" aria-describedby="emailHelp" required>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Update Order">
                </form>

            </div>
            <?php
        } else {
            echo "<script>alert('Order not found');</script>";
        }
    } else {
        echo "<script>alert('No Order ID provided');</script>";
    }
}

function update_order($updatedOrder) {
    $conn = db_conn();
    $stmt = $conn->prepare("UPDATE orders SET CustomerID = ?, EmployeeID = ?, ShipperID = ?, OrderDate = ? WHERE OrderID = ?");
    return $stmt->execute([
        $updatedOrder['CustomerID'],
        $updatedOrder['EmployeeID'],
        $updatedOrder['ShipperID'],
        $updatedOrder['OrderDate'],
        $updatedOrder['OrderID']
    ]);
}
?>
