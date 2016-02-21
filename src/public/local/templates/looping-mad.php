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
    <?php Template::render('partials/heroes'); ?>
    <div class="col-md-6">
    <h2></h2>
    <?php Template::highlight('examples/4.0.0.test'); ?>
    <?php Template::renderOutput('examples/4.0.0.test'); ?>
    </div>
    <div class="col-md-6">
    <h2></h2>
    <?php Template::highlight('examples/4.0.1.test'); ?>
    <?php Template::renderOutput('examples/4.0.1.test'); ?>
    </div>
</div>

<br /><br />
<h1>Sometimes hidden in complex applications</h1>


<div class="container">
    <div class="col-md-6">
    <h2></h2>
    <?php Template::highlight('examples/4.1.0.hidden'); ?>
    <?php Template::renderOutput('examples/4.1.0.hidden'); ?>
    </div>
    <div class="col-md-6">
    <h2></h2>
    <?php Template::highlight('examples/4.1.1.hidden'); ?>
    <?php Template::renderOutput('examples/4.1.1.hidden'); ?>
    </div>
</div>