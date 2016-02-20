<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a <?php menuActive('view', 'navbar-brand'); ?> href="<?php echo SITE_URL; ?>/view/">
        <?php echo icon('dashboard'); ?>
        XHProf
      </a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li>
          <a href="<?php echo SITE_URL; ?>/trash" style="color: red;">
            <?php echo icon('trash'); ?>
          </a>
        </li>
        <li <?php menuActive('home'); ?>>
          <a href="<?php echo SITE_URL; ?>/home">
            <?php echo icon('home'); ?>
            Home
          </a>
        </li>
        <li <?php menuActive('info'); ?>>
          <a href="<?php echo SITE_URL; ?>/info">
          <?php echo (icon('info-sign')); ?>
          PHPInfo()
          </a>
        </li>
      </ul>
      <ul class="nav navbar-nav pull-right">
        <?php if (XHPROF_ENABLED): ?>
          <a href="?profile=0" class="btn btn-default navbar-btn xprofile__status--on" style="background: #FFF!important;">
            XHProf
            <input
              type="checkbox"
              class="xprofile__status"
              checked
              onClick="$(this).parents('a')[0].click();"
            />
          </a>
          <?php else: ?>
          <a href="?profile=1" class="btn navbar-btn btn-default xprofile__status--off" style="background: #FFF!important;">
            XHProf
            <input
              type="checkbox"
              class="xprofile__status"
              onClick="$(this).parents('a')[0].click();"
            />
          </a>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>