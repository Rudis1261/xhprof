    <footer class="footer">
      <div class="footer-spacer">EXEC TIME:</div><b><?php echo round(microtime_float() - START_TIME, 5); ?></b><br />
      <div class="footer-spacer">MEMORY:</div><b><?php echo echoBytes(memory_get_peak_usage()); ?></b><br />
      <div class="footer-spacer">SQL QUERY:</div><b><?php echo count($db->queries); ?></b><br />
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="<?php echo SITE_URL; ?>/assets/js/bootstrap.js"></script>
  </body>
</html>