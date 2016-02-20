<h1>Measuring Performance</h1>
<h4><i>Known as <b>"Application Time"</b>, the amount of time your program takes to render a particular aspect</i></h4>
<hr />

<div class="container">
    <div class="col-md-4">
        <h4>Key performance aspects can include</h4>
        <ul>
            <li>CPU Time</li>
            <li>Memory Consumed</li>
            <li>Fetching DATA (SQL, Redis, Mongo, etc.)</li>
        </ul>
    </div>
    <div class="col-md-3">
        <h4>Variety</h4>
        Measuring your PHP Application's performance will definitely vary from framework to framework. From implementation to implementation.
    </div>

    <div class="col-md-3 ">
    <h4>Learn</h4>
        Most frameworks have some way to print out application performance information. But you can also craft your own.
    </div>
</div>

<hr />

<div class="container">
    <h3>New Relic</h3>
    <div class="col-md-4">
        <img class="img-responsive" width="300" height="54" src="<?php echo IMG;?>/new-relic.png" alt="New Relic" />
    </div>
    <div class="col-md-5">
        I a great tool to monitor your application time over "time" XD . Very good at identifying when things go pear shaped. But has limited insight into the internals of your application.
    </div>
</div>

<hr />


<div class="container">
    <h3>What is <b>measured</b> is <b>managed</b></h3>
    <div class="col-md-4">
        <img src="<?php echo IMG; ?>/tooling.png" alt="Tooling" />
    </div>
    <div class="col-md-5">
       It's easy enough to write your own application monitoring tools. <b>After all, who knows your code better than you?</b>
    </div>

    <div class="clearfix" ></div>
    <br />
    <h1>How I monitor my applications</h1>

    <h4>NGINX Auto Prepend Directive</h4>
    <?php Template::highlight('partials/prepend'); ?>
    <?php Template::highlight('partials/auto_prepend'); ?>
</div>