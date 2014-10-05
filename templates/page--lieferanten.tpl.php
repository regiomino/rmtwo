<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
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
            
            <?php
                $block = module_invoke('rm_shop', 'block_view', 'regiomino_smart_entry_header');
                print render($block['content']);
            ?>
            
            </div>
        </div>
        <div class="navbar-collapse collapse">

            <div class="nav navbar-nav navbar-right" >
                <?php print rm_user_get_navbar(); ?>
                <div class="dropdown">
                    <a href="#" class="navi-link dropdown-toggle" id="helpDD" data-toggle="dropdown"> Hilfe <span class="caret"></span> </a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="helpDD">
                        <li role="presentation"><a role="menuitem" tabindex="-1" class="help-link" href="http://www.regiomino.de/kontakt">Besuchen Sie unseren Hilfebereich &raquo;</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="mailto:support@regiomino.de"><span class="fa fa-paper-plane fa-fw"></span> Schreiben Sie uns</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="tel:+4909131-9291117"><span class="fa fa-phone fa-fw"></span> Rufen Sie uns an: 09131-9291117</a></li>
                    </ul>
                </div>
                
                <button class="btn btn-danger" data-toggle="modal" data-target="#suggestModal">
                    <span class="fa fa-plus"></span> <?php print t('Suggest vendor or gastronomy'); ?>
                </button>
            </div>

        </div><!--/.nav-collapse -->
    </div>
</div>

<div class="container">
   
    <?php if(user_is_logged_in() && ($tabs['#primary'] || $tabs['#secondary'])): ?>
     <div class="row">
        <div class="col-md-12 main">
            <?php print render($tabs); ?>
        </div>
     </div>
    <?php endif; ?>
   
    <div class="row"> 
        <?php print render($page['content']); ?>
    </div>
</div>

 <div class="container-fluid">
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

    <div class="modal fade" id="suggestModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="suggestModalLabel"><?php print t('Suggest vendor or gastronomy'); ?></h4>
                </div>
                <div class="modal-body">
                    <?php print $suggestform; ?>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <?php if ($messages): ?>
        <div class="modal fade" id="messageModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <br />
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