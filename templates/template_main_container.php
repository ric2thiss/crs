<?php
    function template_main_container(){
        // Customers
        $customers = fetch_customers();
        $customer_count = fetch_customers_count();

        ?>
            <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Customers <br><h1><?php echo $customer_count ?></h1></div>
                                    
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Orders  <br><h1>0</h1></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Products  <br><h1>0</h1></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Deleted  <br><h1>0</h1></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Area Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Bar Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Customers
                            </div>
                            <div class="card-body">
                                    <table id="datatablesSimple">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Customer Name</th>
                                                <th>Contact Name</th>
                                                <th>Address</th>
                                                <th>City</th>
                                                <th>Postal Code</th>
                                                <th>Country</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Customer Name</th>
                                                <th>Contact Name</th>
                                                <th>Address</th>
                                                <th>City</th>
                                                <th>Postal Code</th>
                                                <th>Country</th>
                                                <th>Actions</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>

                                            <?php
                                                foreach($customers as $customer){
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $customer['CustomerID']?></td>
                                                        <td><?php echo $customer['CustomerName'] ?></td>
                                                        <td><?php echo $customer['ContactName'] ?></td>
                                                        <td><?php echo $customer['Address'] ?></td>
                                                        <td><?php echo $customer['City'] ?></td>
                                                        <td><?php echo $customer['PostalCode'] ?></td>
                                                        <td><?php echo $customer['Country'] ?></td>
                                                        <td>
                                                            <button href='' class="btn btn-primary">Edit</button>
                                                            <button href='' class="btn btn-danger">Delete</button>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
        <?php
    }

?>