<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
           
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Menü ein-/ausblenden</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="menudesc text-uppercase">Menü</span>
            </button>

            <div class="btn-group btn-group-lg view-toggle" id ='viewToggle'>
              <button type="button" data-action="mapView" class="btn btn-default"><i class="fa fa-fw fa-map-marker"></i></button>
              <button type="button" data-action="listView" id="showList" class="btn btn-default active"><i class="fa fa-fw fa-list"></i></button>
            </div>

            <div class="cart-toggle" id="cart-toggle"> 
                <span class="fa fa fa-shopping-cart"></span>
                <span id="item-amount" class="item-amount"> </span>
            </div>
            
            <div class="navbar-brand"> 
            <?php if ($logo): ?>
                <?php echo l('', '', array('attributes' => array('title' => t('Home'), 'id' => 'logo'))); ?>
            <?php endif; ?>
            </div>
        </div>
        <div class="navbar-collapse collapse">
            <div class="nav navbar-nav navbar-right">
                <?php print rm_user_get_navbar(); ?>
                <div class="dropdown">
                    <a href="#" class="navi-link dropdown-toggle" id="helpDD" data-toggle="dropdown"> Hilfe <span class="caret"></span> <span class="fa fa-chevron-down"></span> </a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="helpDD">
                        <li role="presentation"><a role="menuitem" tabindex="-1" class="help-link" href="http://www.regiomino.de/kontakt">Besuchen Sie unseren Hilfebereich &raquo;</a></li>
                       
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="mailto:support@regiomino.de"><span class="fa fa-fw fa-paper-plane"></span> Schreiben Sie uns</a></li>
                        
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="tel:+4909131-9291117"><span class="fa fa-fw fa-phone"></span> Rufen Sie uns an: 09131-9291117</a></li>
                    </ul>
                </div>
                <button class="btn btn-danger" data-toggle="modal" data-target="#suggestModal">
                    <span class="fa fa-plus"></span> <?php print t('Suggest vendor, gastronomy or trader'); ?>
                </button>
            </div>
        </div><!--/.nav-collapse -->
    </div>
</div><!-- end navbar -->
<div class="breadcrumbs-container large"></div>
<div class="container">
   
    
   
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
                <div class="col-md-12"><p class="text-center text-muted small">Die auf www.regiomino.de gezeigten Angebote richten sich ausschließlich an Unternehmen und Gewerbetreibende. Alle Preise sind Netto-Preise zzgl. der beim Angebot genannten MwSt.</p></div>
            </div>
            
            <!--<div class="row">
                <div class="col-md-12"><p class="text-center">&copy; Regiomino 2014</p></div>
            </div>-->
        </div>   
    </div> 

    <div class="modal fade" id="suggestModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="suggestModalLabel"><?php print t('Suggest vendor, gastronomy or trader'); ?></h4>
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