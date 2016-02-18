    <!-- Begin page content -->
    <div class="container">
      <div class="page-header">
        <h1>Sticky footer with fixed navbar</h1>
      </div>
      <p class="lead">Pin a fixed-height footer to the bottom of the viewport in desktop browsers with this custom HTML and CSS. A fixed navbar has been added with <code>padding-top: 60px;</code> on the <code>body > .container</code>.</p>
      <p>Back to <a href="../sticky-footer">the default sticky footer</a> minus the navbar.</p>
    </div>

    <div class="container">
        <?php
            $amount = 5000000;
            $factor = $amount / 10;
            $range = range(1, $amount);

            for($i = 1; $i < count($range); $i++) {
                if ($i % $factor == 0) {
                    echo "Running $i<br />";
                }
            }



            $count = count($range);
            for($i = 1; $i < $count; $i++) {
                if ($i % $factor == 0) {
                    echo "Running $i<br />";
                }
            }
        ?>
    </div>