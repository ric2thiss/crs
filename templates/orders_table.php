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
        


        ?>
            <div class="container-fluid px-4">
                        <h1 class="mt-4 mb-4">Orders - Records</h1>
    
                        <hr>
    
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Current Count of Customers - <span><?php echo $orders_count ?></span>
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
                                                    <button class="btn btn-primary">Edit</button>
                                                    <button class="btn btn-danger">Delete</button>
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