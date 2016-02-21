<h1>Exiting Early</h1>
<h4><i>Nope, not leaving office 1 hour earlier every day. No.</i> Rather: <b>"The shortest path of execution"</b></h4>
<hr />

<div class="container">
This took me a mind shift to start to do correctly. It's the basis of how you approach coding in general.
</div>

<div class="container">
    <div class="col-md-6">
    <h2>Long way</h2>
    <?php Template::highlight('examples/3.0.1.exiting-early'); ?>
    <?php Template::renderOutput('examples/3.0.1.exiting-early'); ?>
    </div>
    <div class="col-md-6">
    <h2>Short way</h2>
    <?php Template::highlight('examples/3.0.2.exiting-early'); ?>
    <?php Template::renderOutput('examples/3.0.2.exiting-early'); ?>
    </div>
</div>

<br /><br />
<h1>And sometimes it's just about readability</h1>

<div class="container">
    <div class="col-md-6">
    <h2>A pyramid</h2>
    <?php Template::highlight('examples/3.1.0.pyramid'); ?>
    <?php Template::renderOutput('examples/3.1.0.pyramid'); ?>
    </div>
    <div class="col-md-6">
    <h2>Nope, none of that</h2>
    <?php Template::highlight('examples/3.1.1.pyramid'); ?>
    <?php Template::renderOutput('examples/3.1.1.pyramid'); ?>
    </div>
</div>

<br /><br />
<h1>Where things get called, is important</h1>
<ul>
    <li>File Operation are expensive</li>
    <li>Network trips are expensive</li>
    <li>Getting data is expensive</li>
    <li>Complex is complex for a reason <i><b>"Simplicity is the ultimate complexity"</b></i></li>
</ul>

<div class="container">
    <?php Template::render('partials/heroes'); ?>
    <div class="col-md-6">
    <h2></h2>
    <?php Template::highlight('examples/3.2.0.test'); ?>
    <?php Template::renderOutput('examples/3.2.0.test'); ?>
    </div>
    <div class="col-md-6">
    <h2></h2>
    <?php Template::highlight('examples/3.2.1.test'); ?>
    <?php Template::renderOutput('examples/3.2.1.test'); ?>
    </div>
</div>