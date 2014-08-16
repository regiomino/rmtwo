    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <div class="navbar-brand"> 
            <?php if ($logo): ?>
                            <?php echo l('', '', array('attributes' => array('title' => t('Home'), 'rel' => t('Home'), 'id' => 'logo'))); ?>
            <?php endif; ?>
            </div>

        </div>
        <div class="navbar-collapse collapse">

        <div class="navbar-form navbar-right" role="form">
            <?php print rm_user_get_navbar(); ?>
            <button class="btn btn-danger" data-toggle="modal" data-target="#suggestModal">
                <span class="glyphicon glyphicon-plus"></span> <?php print t('Suggest vendor or gastronomy'); ?>
            </button>
        </div>

        </div><!--/.nav-collapse -->
      </div>
    </div>

	

    <div class="container">
        <div class="row">
                <?php if(user_is_logged_in() && $tabs): ?>
                    <div class="col-md-12">
                        <?php print render($tabs); ?>
                    </div>
                <?php endif; ?>
                <div class="col-md-12">
                    <div class="main-content clearfix"> 
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
                        
                        <?php print render($page['content']); ?>
                </div>
            </div>
        </div>


      

       


    </div> <!-- /container -->

    <div class="container">
        <div class="footer"> 
            <div class="row"> 
                <div class="col-md-12">
                    <ul class="list-inline text-center">
                        <?php $footerlinks = rm_user_get_footer_links(); ?>
                        <?php foreach($footerlinks as $footerlink): ?>
                            <li><?php print l($footerlink[0], $footerlink[1], $footerlink[2]); ?></li>
                        <?php endforeach; ?>
                    </ul>
    
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12"><p class="text-center">&copy; Regiomino 2014</p></div>
            </div>
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