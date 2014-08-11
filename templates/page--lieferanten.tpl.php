<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
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

<div class="container-fluid">
    <div class="row">
        <?php print render($page['content']); ?>
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