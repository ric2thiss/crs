<?php
    function sanitizeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    function shippers_table(){

        $shippers = fetch_shippers();
        $shippers_count = fetch_shippers_count();
        
        ?>
            <div class="container-fluid px-4">
                        <h1 class="mt-4 mb-4">Products - Records</h1>
    
                        <hr>
    
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Current Count of Products - <span><?php echo $shippers_count?></span>
                                <button  type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><li class="fa fa-add"></li> Add Products</button>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table">
                                    <thead>
                                        <tr>
                                            <th>ShipperID</th>
                                            <th>ShipperName</th>
                                            <th>Phone</th>
                                            <th>Actions</th> <!-- Added a new column for actions -->
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ShipperID</th>
                                            <th>ShipperName</th>
                                            <th>Phone</th>
                                            <th>Actions</th> <!-- Added a new column for actions -->
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($shippers as $shipper) { ?>
                                            <tr>
                                                <td><?php echo $shipper['ShipperID'] ?></td>
                                                <td><?php echo $shipper['ShipperName'] ?></td>
                                                <td><?php echo $shipper['Phone'] ?></td>
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