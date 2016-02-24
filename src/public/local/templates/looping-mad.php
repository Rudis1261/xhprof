<h1>Looping Mad</h1>
<h4><i>No we aren't loosing our minds just yet</i></h4>
<hr />

<h1>Where things get called, is important</h1>
<ul>
    <li>File Operation are expensive</li>
    <li>Network trips are expensive</li>
    <li>Getting data is expensive</li>
    <li>Complex is complex for a reason <i><b>"Simplicity is the ultimate complexity"</b></i></li>
</ul>

<div class="container">
    <?php //Template::render('partials/heroes'); ?>
    <div class="col-md-6">
    <h3></h3>
    <?php //Template::highlight('examples/5.0.0.test'); ?>
    <?php //Template::renderOutput('examples/5.0.0.test'); ?>
    </div>
    <div class="col-md-6">
    <h3></h3>
    <?php //Template::highlight('examples/5.0.1.test'); ?>
    <?php //Template::renderOutput('examples/5.0.1.test'); ?>
    </div>
</div>


<br /><br />
<h1>Sometimes, things are hidden from the eye</h1>

<div class="container">
    <div class="col-md-6">
    <h3>Opening file on each write</h3>
    <?php Template::highlight('examples/5.1.0.fopen'); ?>
    <?php Template::renderOutput('examples/5.1.0.fopen'); ?>
    </div>
    <div class="col-md-6">
    <h3>Single file handle for all writes</h3>
    <?php Template::highlight('examples/5.1.1.fopen'); ?>
    <?php Template::renderOutput('examples/5.1.1.fopen'); ?>
    </div>
</div>


<br /><br />
<h1>Sometimes it's not obvious, until someone points it out.</h1>

<div class="container">
    <div class="col-md-6">
    <h3>A conditional in the For loop</h3>
    <?php Template::highlight('examples/5.2.0.for'); ?>
    <?php Template::renderOutput('examples/5.2.0.for'); ?>
    </div>
    <div class="col-md-6">
    <h3>A for loop based off a derived value</h3>
    <?php Template::highlight('examples/5.2.1.for'); ?>
    <?php Template::renderOutput('examples/5.2.1.for'); ?>
    </div>
</div>


<br /><br />
<h1>Nested foreach loops</h1>

<div class="container">
    <?php Template::render('partials/poster_prep'); ?>
    <?php Template::highlight('partials/poster_prep'); ?>
</div>
<div class="container">
    <div class="col-md-6">
        <h3>N+1 Problem</h3>

        <?php Template::highlight('examples/5.3.0.nested'); ?>
        <br />
        <center>
            <?php Template::render('examples/5.3.0.nested'); ?>
        </center>
        </div>
        <div class="col-md-6">
        <h3>PreProcessing Based on needed data</h3>
        <?php Template::highlight('examples/5.3.1.nested'); ?>
        <br />
        <center>
            <?php Template::render('examples/5.3.1.nested'); ?>
        </center>
    </div>
</div>