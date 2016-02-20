    <!-- Begin page content -->
    <div class="container">
      <div class="page-header">
        <h1>Profiling PHP with XHProf <small>Increasing your PHP application's performance</small></h1>
      </div>
    </div>

    <div class="container">
        <div class="col-md-8">
            <h4>What we will cover</h4>
            <ul>
                <li>Just how fast is your PHP application?</li>
                <li>Using XHProf</li>
                <li>Exiting Early</li>
                <li>N+1 Problem</li>
                <li>Looping mad</li>
            </ul>
        </div>
        <div class="col-md-4">
            <img class="img img-responsive" src="<?php echo SITE_URL; ?>/assets/img/php.jpg" alt="logo" />
        </div>
        <h2>Databases</h2>
        <?php
            $db->query('SHOW DATABASES');
            $rows = $db->getRows();
            if (!empty($rows)) {
                foreach ($rows as $row) {
                    echo '<div>' . $row['Database'] . '</div>';
                }
            }
        ?>

        <h2>Tables in `local` database</h2>
        <?php
            $db->query('SHOW TABLES');
            $rows = $db->getRows();
            if (!empty($rows)) {
                foreach ($rows as $row) {
                    echo '<div>' . current($row) . '</div>';
                }
            }

            Template::render('examples/1.0.for-in-assertion');
            Template::highlight('examples/1.0.for-in-assertion');

            Template::render('examples/1.1.for-before-assertion');
            Template::highlight('examples/1.1.for-before-assertion');
        ?>
    </div>