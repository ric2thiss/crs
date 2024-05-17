<?php
    function sanitizeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    function suppliers_table(){

        $suppliers = fetch_suppliers();
        $suppliers_count = fetch_suppliers_count();
        
        ?>
            <div class="container-fluid px-4">
                        <h1 class="mt-4 mb-4">Supplier - Records</h1>
    
                        <hr>
    
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Current Count of Categories - <span><?php echo $suppliers_count?></span>
                                <button  type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><li class="fa fa-add"></li> Add Supplier</button>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table">
                                    <thead>
                                        <tr>
                                            <th>SupplierID</th>
                                            <th>SupplierName</th>
                                            <th>ContactName</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>PostalCode</th>
                                            <th>Country</th>
                                            <th>Phone</th>
                                            <th>Actions</th> <!-- Added a new column for actions -->
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>SupplierID</th>
                                            <th>SupplierName</th>
                                            <th>ContactName</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>PostalCode</th>
                                            <th>Country</th>
                                            <th>Phone</th>
                                            <th>Actions</th> <!-- Added a new column for actions -->
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($suppliers as $supplier) { ?>
                                            <tr>
                                                <td><?php echo $supplier['SupplierID'] ?></td>
                                                <td><?php echo $supplier['SupplierName'] ?></td>
                                                <td><?php echo $supplier['ContactName'] ?></td>
                                                <td><?php echo $supplier['Address'] ?></td>
                                                <td><?php echo $supplier['City'] ?></td>
                                                <td><?php echo $supplier['PostalCode'] ?></td>
                                                <td><?php echo $supplier['Country'] ?></td>
                                                <td><?php echo $supplier['Phone'] ?></td>

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