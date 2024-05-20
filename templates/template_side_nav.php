<?php

    function template_side_nav(){
        ?>
         <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Dashboard</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="customers.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Customers
                            </a>
                            <a class="nav-link" href="category.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                                Categories
                            </a>
                            <a class="nav-link" href="orders.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-filter"></i></div>
                                Orders
                            </a>
                            <a class="nav-link" href="order_details.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-file"></i></div>
                                Orders Details
                            </a>
                            <a class="nav-link" href="products.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-cart-shopping"></i></div>
                                Products
                            </a>
                            <a class="nav-link" href="suppliers.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-parachute-box"></i></div>
                                Suppliers
                            </a>
                            <a class="nav-link" href="shippers.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-truck-field"></i></div>
                                Shippers
                            </a>
                            <div class="sb-sidenav-menu-heading">Management</div>
                            <a class="nav-link" href="employees.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                Employees
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Admin
                    </div>
                </nav>
            </div>
        <?php
    }

?>