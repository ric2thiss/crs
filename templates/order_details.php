<?php
    function sanitizeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function order_details(){

        $orders = fetch_orders();
        $productIDs = fetch_products(); 
        $orderdetails = fetch_order_details();


        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
            // Sanitize input
            $orderID = filter_input(INPUT_POST, 'OrderID', FILTER_SANITIZE_NUMBER_INT);
            $productID = filter_input(INPUT_POST, 'productID', FILTER_SANITIZE_NUMBER_INT);
            $quantity = filter_input(INPUT_POST, 'Quantity', FILTER_SANITIZE_NUMBER_INT);
        
            // Save the details to the database
            if (save_order_details($orderID, $productID, $quantity)) {
                echo "<script>
                        alert('Order details added successfully');
                        window.location.href = 'order_details.php';
                      </script>";
            } else {
                echo "<script>alert('Failed to add order details');</script>";
            }
        }
        
        ?>
            <div class="container-fluid px-4">
                        <h1 class="mt-4 mb-4">Order Details</h1>
    
                        <hr>
                        <!-- FORM INSERT NEW CATEGORY -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create New Order Details</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
                                        <div class="mb-3">
                                        <label for="Quantity" class="form-label">Order ID</label>
                                            <select class="form-select" name="OrderID" aria-label="Default select example">
                                                <option selected>Select OrderID</option>
                                                <?php
                                                    foreach($orders as $order){
                                                        ?>
                                                        <option value="<?php echo $order["OrderID"];?>"><?php echo $order["OrderID"];?></option>
                                                        <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                        <label for="Quantity" class="form-label">Product</label>
                                            <select class="form-select" name="productID" aria-label="Default select example">
                                                <option selected>Select Product</option>
                                                <?php
                                                    foreach($productIDs as $productID){
                                                        ?>
                                                        <option value="<?php echo $productID["ProductID"];?>"><?php echo $productID["ProductName"];?></option>
                                                        <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="Quantity" class="form-label">Quantity</label>
                                            <input type="number" name="Quantity" class="form-control" id="Quantity" aria-describedby="emailHelp" required>
                                        </div>
                                        <input type="submit" name="submit" class="btn btn-primary" value="Add New Order Details">
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Current Count of Orders - <span><?php echo fetch_order_datails_count() ?></span>
                                <button  type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><li class="fa fa-add"></li> Add Orders</button>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table">
                                    <thead>
                                        <tr>
                                            <th>OrderDetailID</th>
                                            <th>OrderID</th>
                                            <th>ProductID</th>
                                            <th>Quantity</th>
                                            <th>Actions</th> <!-- Added a new column for actions -->
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>OrderDetailID</th>
                                            <th>OrderID</th>
                                            <th>ProductID</th>
                                            <th>Quantity</th>
                                            <th>Actions</th> <!-- Added a new column for actions -->
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($orderdetails as $orderdetail) { ?>
                                            <tr>
                                                <td><?php echo $orderdetail['OrderDetailID'] ?></td>
                                                <td><?php echo $orderdetail['OrderID'] ?></td>
                                                <td><?php echo $orderdetail['ProductID'] ?></td>
                                                <td><?php echo $orderdetail['Quantity'] ?></td>
                                                <td>
                                                    <a href="update_order_details.php?id=<?php echo $orderdetail['OrderDetailID'] ?>" class="btn btn-primary">Edit</a>
                                                    <a href="delete_order_detail.php?id=<?php echo $orderdetail['OrderDetailID'] ?>" class="btn btn-danger">Delete</a>

                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
        <?php
    }

?>

