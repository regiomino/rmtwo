    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
                    
					<?php if ($logo): ?>
					
							<?php echo l('', '', array('attributes' => array('class' => 'navbar-brand', 'title' => t('Home'), 'rel' => t('Home'), 'id' => 'logo'))); ?>
					<?php endif; ?>
					
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
					
            <li<?php if (('user/register' == $_GET['q'] || ('user/register' == '<front>' && drupal_is_front_page()))) { echo ' class="active"'; } ?>><?php echo l(t('<span class="@class">@linktitle</span>', array('@class' => 'glyphicon glyphicon-user', '@linktitle' => t('Login'))), 'user/register', array('html' => TRUE)); ?></li>
            <li<?php if (('help' == $_GET['q'] || ('user/register' == '<front>' && drupal_is_front_page()))): echo ' class="active"'; endif; ?>><?php echo l(t('<span class="@class">@linktitle</span>', array('@class' => 'glyphicon glyphicon-earphone', '@linktitle' => t('Help'))), 'help', array('html' => TRUE)); ?></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

		<?php print render($page['highlighted']); ?>

    <div class="container main-content">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-12">
					<div class="inner">
						<?php print render($title_prefix); ?>
						<?php if ($title): ?>
								<h1 class="page-title">
									<?php print $title; ?>
								</h1>
						<?php endif; ?>
				
						<?php print render($title_suffix); ?>
		 
						<?php if ($tabs): ?>
							 <!-- <div class="tabs">
										<?php print render($tabs); ?>
								</div>-->
						<?php endif; ?>
						
						<?php print render($page['help']); ?>
						
						<?php if ($action_links): ?>
								<ul class="action-links">
									<?php print render($action_links); ?>
								</ul>
						<?php endif; ?>
						<?php print render($page['content']); ?>
					</div>
        </div>
      </div>

      <hr>

      <footer>
        <p>&copy; Regiomino 2014</p>
      </footer>
    </div> <!-- /container -->