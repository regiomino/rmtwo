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

        <div class="navbar-form navbar-right" role="form">
            <?php echo l(t('<span class="@class"></span> @linktitle', array('@class' => 'glyphicon glyphicon-user', '@linktitle' => t('Log in'))), 'user/register', array('html' => TRUE, 'attributes' => array('class' => array('btn', 'btn-success')))); ?>
            <?php echo l(t('<span class="@class"></span> @linktitle', array('@class' => 'glyphicon glyphicon-plus', '@linktitle' => t('Suggest a vendor'))), 'suggest', array('html' => TRUE, 'attributes' => array('class' => array('btn', 'btn-danger')))); ?>

        </div>

        </div><!--/.nav-collapse -->
      </div>
    </div>

		<?php print render($page['highlighted']); ?>

    <div class="container main-content">
      <!-- Example row of columns -->

        <div class="col-md-12">
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
        </div>


      <?php print render($page['content']); ?>

      <hr>

      <footer>
        <p>&copy; Regiomino 2014</p>
      </footer>
    </div> <!-- /container -->