    <footer class="footer">
      <div class="container">
        <p class="text-muted">
          EXEC TIME: <b><?php echo round(microtime_float() - START_TIME, 5); ?></b> Seconds
         | MEM: <b><?php echo echoBytes(memory_get_peak_usage()); ?></b>
         | SQL: <b><?php echo count($db->queries); ?></b> Queries
        </p>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="<?php echo SITE_URL; ?>/assets/js/bootstrap.js"></script>
  </body>
</html>