<?php 
    include 'templates/template_header.php';
    include 'templates/template_top_nav.php';
    include 'templates/template_side_nav.php';


    // Container or Main element in HTML
    // include 'templates/template_main_container.php';
    include 'templates/customer_table.php';

    // Footer element
    include 'templates/template_footer.php';


    // BackEnd 
    include 'functions/customer.php';

?>

<?=template_header( 'Customers - Records' )?>
    <body class="sb-nav-fixed">
        <!-- Top Navigation -->
        <?=template_top_nav()?>
        <div id="layoutSidenav">
            <!-- Side Navigation -->
            <?=template_side_nav()?>
            <div id="layoutSidenav_content">
                <!-- Main -->
                <main>
                    <?=customer_table()?>
                </main>
                <!-- Footer -->

            </div>
        </div>
        <!-- JS libraries -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
            <script src="js/scripts.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
            <script src="assets/demo/chart-area-demo.js"></script>
            <script src="assets/demo/chart-bar-demo.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
            <script src="js/datatables-simple-demo.js"></script>


            <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    </body>
</html>
