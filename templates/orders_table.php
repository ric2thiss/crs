<?php
    function sanitizeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    function orders_table(){

        $orders = fetch_orders();
        $orders_count = fetch_order_count();
        $customerIDs = fetch_customers(); 
        $EmployeeIDs = fetch_employees();
        $shipperIDs = fetch_shippers();

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
            // Sanitize input
            $customerID = filter_input(INPUT_POST, 'customerID', FILTER_SANITIZE_NUMBER_INT);
            $employeeID = filter_input(INPUT_POST, 'employeeID', FILTER_SANITIZE_NUMBER_INT);
            $shipperID = filter_input(INPUT_POST, 'shipperID', FILTER_SANITIZE_NUMBER_INT);
            $orderDate = filter_input(INPUT_POST, 'OrderDate', FILTER_SANITIZE_STRING);
        
            // Save the details to the database
            if (save_order_to_database($customerID, $employeeID, $shipperID, $orderDate)) {
                echo "<script>
                        alert('Order created successfully');
                        window.location.href = 'orders.php';
                      </script>";
            } else {
                echo "<script>alert('Failed to create order');</script>";
            }
        }
        
        ?>
            <div class="container-fluid px-4">
                        <h1 class="mt-4 mb-4">Orders - Records</h1>
    
                        <hr>
                        <!-- FORM INSERT NEW CATEGORY -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create New Category</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
                                        <div class="mb-3">
                                            <select class="form-select" name="customerID" aria-label="Default select example">
                                                <option selected>Select Customer</option>
                                                <?php
                                                    foreach($customerIDs as $customerID){
                                                        ?>
                                                        <option value="<?php echo $customerID["CustomerID"];?>"><?php echo $customerID["CustomerName"];?></option>
                                                        <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <select class="form-select" name="employeeID" aria-label="Default select example">
                                                <option selected>Select Employee</option>
                                                <?php
                                                    foreach($EmployeeIDs as $EmployeeID){
                                                        ?>
                                                        <option value="<?php echo $EmployeeID["EmployeeID"];?>"><?php echo $EmployeeID["LastName"] . " " . $EmployeeID["LastName"];?></option>
                                                        <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <select class="form-select" name="shipperID" aria-label="Default select example">
                                                <option selected>Select Shipper</option>
                                                <?php
                                                    foreach($shipperIDs as $shipperID){
                                                        ?>
                                                        <option value="<?php echo $shipperID["ShipperID"];?>"><?php echo $shipperID["ShipperName"]?></option>
                                                        <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="OrderDate" class="form-label">OrderDate</label>
                                            <input type="date" name="OrderDate" class="form-control" id="OrderDate" aria-describedby="emailHelp" required>
                                        </div>
                                        <input type="submit" name="submit" class="btn btn-primary" value="Create New Order">
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
                                Current Count of Orders - <span><?php echo $orders_count ?></span>
                                <button  type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><li class="fa fa-add"></li> Add Orders</button>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table">
                                    <thead>
                                        <tr>
                                            <th>OrderID</th>
                                            <th>CustomerID</th>
                                            <th>EmployeeID</th>
                                            <th>OrderDate</th>
                                            <th>ShipperID</th>
                                            <th>Actions</th> <!-- Added a new column for actions -->
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>OrderID</th>
                                            <th>CustomerID</th>
                                            <th>EmployeeID</th>
                                            <th>OrderDate</th>
                                            <th>ShipperID</th>
                                            <th>Actions</th> <!-- Added a new column for actions -->
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($orders as $order) { ?>
                                            <tr>
                                                <td><?php echo $order['OrderID'] ?></td>
                                                <td><?php echo $order['CustomerID'] ?></td>
                                                <td><?php echo $order['EmployeeID'] ?></td>
                                                <td><?php echo $order['OrderDate'] ?></td>
                                                <td><?php echo $order['ShipperID'] ?></td>
                                                <td>
                                                    <a href="order_update.php?id=<?php echo $order['OrderID'] ?>" class="btn btn-primary">Edit</a>
                                                    <a href="delete_orders.php?id=<?php echo $order['OrderID'] ?>" class="btn btn-danger">Delete</a>

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