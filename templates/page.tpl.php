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
            <?php
            global $user;
            if($user->uid > 0) {
                echo l(t('<span class="@class"></span> @linktitle', array('@class' => 'glyphicon glyphicon-user', '@linktitle' => t('Log out'))), 'user/logout', array('query' => drupal_get_destination(), 'html' => TRUE, 'attributes' => array('class' => array('btn', 'btn-warning'))));
            }
            else {
                echo l(t('<span class="@class"></span> @linktitle', array('@class' => 'glyphicon glyphicon-user', '@linktitle' => t('Log in'))), 'user/register', array('query' => drupal_get_destination(), 'html' => TRUE, 'attributes' => array('class' => array('btn', 'btn-success'))));
            }
            ?>
            <button class="btn btn-danger" data-toggle="modal" data-target="#suggestModal">
                <span class="glyphicon glyphicon-plus"></span> <?php print t('Suggest vendor or gastronomy'); ?>
            </button>
        </div>

        </div><!--/.nav-collapse -->
      </div>
    </div>

	<?php print render($page['highlighted']); ?>

    <div class="container main-content">

        <div class="col-md-12">

            <?php print render($title_prefix); ?>
            <?php if ($title): ?>
                 <div class="page-header">
                    <h1 class="page-title">
                        <?php print $title; ?>
                    </h1>
                 </div>
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

        <footer class="col-md-12">
            &nbsp;
        </footer>


    </div> <!-- /container -->

    <div class="jumbotron footer-header">

        <div class="container">

            <div class="col-md-12">
                <ul class="list-inline">
                    <li><?php print l(t('Imprint'), 'node/1'); ?></li>
                    <li><?php print l(t('About us'), 'node/3'); ?></li>
                    <li><?php print l(t('Help & Contact'), 'kontakt'); ?></li>
                    <li><?php print l(t('Press'), 'node/1'); ?></li>
                    <li><?php print l(t('Sitemap'), 'node/1'); ?></li>
                    <li><?php print l(t('News'), 'https://www.facebook.com/regiomino', array('external' => TRUE)); ?></li>
                    <li><?php print l(t('Jobs'), 'jobs'); ?></li>
                    <li><?php print l(t('Privacy'), 'node/2'); ?></li>
                    <li><?php print l(t('Terms & Conditions'), 'node/4'); ?></li>
                </ul>

            </div>

        </div>

    </div>

    <div class="jumbotron footer-content">

        <div class="container">

            <div class="col-md-5"><p>&copy; Regiomino 2014</p></div>
            <div class="col-md-4"><p>&copy; Regiomino 2014</p></div>
            <div class="col-md-3"><p>&copy; Regiomino 2014</p></div>

        </div>

    </div>

    <?php if ($messages): ?>
        <div class="modal fade" id="messageModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div id="messages">
                            <div class="section clearfix">
                                <?php print $messages; ?>
                            </div>
                        </div> <!-- /.section, /#messages -->
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    <?php endif; ?>

    <div class="modal fade" id="suggestModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!--<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h2 class="modal-title" id="suggestModalLabel"><?php /*print t('Suggest vendor or gastronomy'); */?></h2>
                </div>-->
                <div class="modal-body">
                    <?php print $suggestform; ?>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->