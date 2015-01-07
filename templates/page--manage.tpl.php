 <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-brand">
                <?php if ($logo): ?>
                    <?php echo l('', '', array('attributes' => array('title' => t('Home'), 'id' => 'logo'))); ?>
                <?php endif; ?>
                </div>
            </div>
            <!-- /.navbar-header -->

            <div class="nav navbar-nav navbar-right">
                <?php print rm_user_get_navbar(); ?>
                <button class="btn btn-danger" data-toggle="modal" data-target="#suggestModal">
                    <span class="glyphicon glyphicon-plus"></span> <?php print t('Suggest vendor, gastronomy or trader'); ?>
                </button>
                <!-- /.dropdown -->
            </div>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <?php print render($tabs); ?>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <?php print render($page['content']); ?>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <div class="modal fade" id="suggestModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h3 class="modal-title text-center" id="suggestModalLabel"><?php print t('Suggest vendor, gastronomy or trader'); ?></h3>
                </div>
                <div class="modal-body">
                    <?php print $suggestform; ?>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
    <?php if ($messages):
    ?>
        <div class="modal fade full-width-close" id="messageModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div id="messages">
                            <div class="section clearfix">
                                <?php print $messages; ?>
                            </div>
                        </div> <!-- /.section, /#messages -->
                    </div>
                
                    <div class="modal-footer">
                        <button type="button" class="btn btn-lg  btn-default" data-dismiss="modal" > <i class="fa fa-times"></i> Schließen </button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    <?php endif; ?>