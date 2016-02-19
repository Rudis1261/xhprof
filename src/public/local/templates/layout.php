
<?php
//Check if this is called from the application
if(!defined('SPF')){
	header('Location:/');
	exit();
}

//Main layout page
echo($header."\n");
echo($navbar."\n");
?>

<!-- Main content container -->
<div class="container">

    <!-- Error / Info Messages -->
    <?php if (!empty($msg)): ?>
        <div><?php echo $msg; ?></div>
    <?php endif;?>

    <!-- Actual body content -->
    <?php echo($content."\n"); ?>
</div>

<!-- FOOTER -->
<?php echo($footer); ?>