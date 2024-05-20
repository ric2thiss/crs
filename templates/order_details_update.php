<?php
function order_details_update() {
    // Initialize Fetching of Data Functions
    $orders = fetch_orders();
    $productIDs = fetch_products(); 
    $orderdetails = fetch_order_details();

    // Check if 'id' is provided in the query string
    if (isset($_GET['id'])) {
        $orderDetailID = $_GET['id'];
        $orderDetailFound = false;

        // Find the order detail with the matching ID
        foreach ($orderdetails as $orderdetail) {
            if ($orderdetail["OrderDetailID"] == $orderDetailID) {
                $orderDetailFound = true;
                break;
            }
        }

        if ($orderDetailFound) {
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
                // Update order details
                $updatedOrderDetail = [
                    'OrderDetailID' => $orderDetailID,
                    'OrderID' => $_POST['OrderID'],
                    'ProductID' => $_POST['ProductID'],
                    'Quantity' => $_POST['Quantity']
                ];

                if (update_order_detail($updatedOrderDetail)) {  // Update the order detail in the database
                    echo "
                    <script>
                    alert('Order detail updated successfully');
                    window.location.href = 'update_order_details.php?id=" . $_GET['id'] . "';
                    </script>";
                } else {
                    echo "<script>alert('Failed to update Order detail');</script>";
                }
            }
            ?>
            <div class="container p-4">
                <h1 class="mt-4 mb-4">Update Order Detail - Record</h1>
                <hr>
                <a href="order_details.php" class="text-dark fs-5" style="text-decoration: none;"><i class="fa-solid fa-right-left"></i> Back</a>
                <div class="container col-md-8 pb-5"> 
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $orderDetailID; ?>" method="POST">
                    <div class="mb-3">
                        <label for="OrderID" class="form-label">Order ID</label>
                        <select name="OrderID" class="form-select" aria-label="Default select example" required>
                            <option disabled>Select Order ID</option>
                            <?php
                                foreach($orders as $order){
                                    // Set selected option
                                    $selected = ($orderdetail['OrderID'] == $order["OrderID"]) ? 'selected' : '';
                                    echo '<option value="'.$order["OrderID"].'" '.$selected.'>'.$order["OrderID"].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="ProductID" class="form-label">Product</label>
                        <select name="ProductID" class="form-select" aria-label="Default select example" required>
                            <option disabled>Select Product ID : NAME</option>
                            <?php
                                foreach($productIDs as $productID){
                                    // Set selected option
                                    $selected = ($orderdetail['ProductID'] == $productID["ProductID"]) ? 'selected' : '';
                                    echo '<option value="'.$productID["ProductID"].'" '.$selected.'>' .  $productID["ProductID"]. ". " .$productID["ProductName"].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="Quantity" class="form-label">Quantity</label>
                        <input type="number" value="<?php echo htmlspecialchars($orderdetail['Quantity']); ?>" name="Quantity" class="form-control" id="Quantity" aria-describedby="emailHelp" required>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Update Order Detail">
                </form>

            </div>
            <?php
        } else {
            echo "<script>alert('Order detail not found');</script>";
        }
    } else {
        echo "<script>alert('No Order Detail ID provided');</script>";
    }
}

function update_order_detail($updatedOrderDetail) {
    $conn = db_conn();
    $stmt = $conn->prepare("UPDATE orderdetails SET OrderID = ?, ProductID = ?, Quantity = ? WHERE OrderDetailID = ?");
    return $stmt->execute([
        $updatedOrderDetail['OrderID'],
        $updatedOrderDetail['ProductID'],
        $updatedOrderDetail['Quantity'],
        $updatedOrderDetail['OrderDetailID']
    ]);
}
?>
