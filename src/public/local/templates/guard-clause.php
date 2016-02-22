<h1>Guard Clause</h1>
<h4><i>Else is a code smell in PHP and JavaScript.</i> <b>"The shortest path of execution"</b></h4>
<hr />

<div class="container">
This took me a mind shift to start to do correctly. It's the basis of how you approach coding in general.
</div>

<div class="container">
    <div class="col-md-6">
    <h3>Long way</h3>
    <?php Template::highlight('examples/3.0.1.exiting-early'); ?>
    <?php Template::renderOutput('examples/3.0.1.exiting-early'); ?>
    </div>
    <div class="col-md-6">
    <h3>Short way</h3>
    <?php Template::highlight('examples/3.0.2.exiting-early'); ?>
    <?php Template::renderOutput('examples/3.0.2.exiting-early'); ?>
    </div>
</div>

<br /><br />
<h1>And sometimes it's just about readability</h1>

<div class="container">
    <div class="col-md-6">
    <h3>A pyramid</h3>
    <?php Template::highlight('examples/3.1.0.pyramid'); ?>
    <?php Template::renderOutput('examples/3.1.0.pyramid'); ?>
    </div>
    <div class="col-md-6">
    <h3>Nope, none of that</h3>
    <?php Template::highlight('examples/3.1.1.pyramid'); ?>
    <?php Template::renderOutput('examples/3.1.1.pyramid'); ?>
    </div>
</div>

<br /><br />
<h1>Helps reduce irrelevant processing</h1>

<div class="container">
    <?php Template::highlight('partials/cars'); ?>
    <?php require_once('templates/partials/cars.php'); ?>
</div>

<div class="container">
    <div class="col-md-6">
    <h3>Normally</h3>
    <?php Template::highlight('examples/3.2.0.foreach'); ?>
    <?php Template::renderOutput('examples/3.2.0.foreach'); ?>
    </div>
    <div class="col-md-6">
    <h3>Get out of there</h3>
    <?php Template::highlight('examples/3.2.1.foreach'); ?>
    <?php Template::renderOutput('examples/3.2.1.foreach'); ?>
    </div>
</div>
