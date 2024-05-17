<?php
    function sanitizeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    function products_table(){

        $products = fetch_products();
        $products_count = fetch_products_count();
        
        ?>
            <div class="container-fluid px-4">
                        <h1 class="mt-4 mb-4">Products - Records</h1>
    
                        <hr>
    
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Current Count of Products - <span><?php echo $products_count?></span>
                                <button  type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><li class="fa fa-add"></li> Add Products</button>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table">
                                    <thead>
                                        <tr>
                                            <th>ProductID</th>
                                            <th>ProductName</th>
                                            <th>SupplierID</th>
                                            <th>CategoryID</th>
                                            <th>Unit</th>
                                            <th>Price</th>
                                            <th>Actions</th> <!-- Added a new column for actions -->
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ProductID</th>
                                            <th>ProductName</th>
                                            <th>SupplierID</th>
                                            <th>CategoryID</th>
                                            <th>Unit</th>
                                            <th>Price</th>
                                            <th>Actions</th> <!-- Added a new column for actions -->
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($products as $product) { ?>
                                            <tr>
                                                <td><?php echo $product['ProductID'] ?></td>
                                                <td><?php echo $product['ProductName'] ?></td>
                                                <td><?php echo $product['SupplierID'] ?></td>
                                                <td><?php echo $product['CategoryID'] ?></td>
                                                <td><?php echo $product['Unit'] ?></td>
                                                <td><?php echo $product['Price'] ?></td>
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