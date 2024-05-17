<?php 
    include 'templates/template_header.php';
    include 'templates/template_top_nav.php';
    include 'templates/template_side_nav.php';


    // Container or Main element in HTML

    include 'templates/suppliers_table.php';

    // Footer element
    include 'templates/template_footer.php';


    // BackEnd 
    include 'functions/suppliers.php';
    include 'functions/db.php';

?>

<?=template_header( 'Suppliers - Records' )?>
    <body class="sb-nav-fixed">
        <!-- Top Navigation -->
        <?=template_top_nav()?>
        <div id="layoutSidenav">
            <!-- Side Navigation -->
            <?=template_side_nav()?>
            <div id="layoutSidenav_content">
                <!-- Main -->
                <main>
                    <?=suppliers_table()?>
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
    </body>
</html>
