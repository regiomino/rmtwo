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

    <?php print render($page['highlighted']); ?>
    <div class="partner-wrapper"> 
        <div class="container">
            <div class="row">
                <div class="partner-logos" id="partner-logos">
                    <div class="partner first">
                        <a data-toggle="tooltip" class="text-hide sprite ideen" href="http://www.land-der-ideen.de/ausgezeichnete-orte/preistraeger/regiomino-online-supermarkt-f-r-regionales"
                        title="Regiomino ist Preisträger des bundesweiten Wettbewerbs „Ausgezeichnete Orte im Land der Ideen“ 2014."> </a>
                    </div>
                    <div class="partner">
                        <a data-toggle="tooltip" class="text-hide sprite metropolregion" href="http://www.metropolregionnuernberg.de/"
                        title="Metropolregion Nürnberg">Metropolregion Nürnberg </a>
                    </div>
                    <div class="partner">
                        <a data-toggle="tooltip" class="text-hide sprite regionalbewegung" href="http://www.regionalbewegung.de/"
                        title="Der Bundesverband der Regionalbewegung e.V. ist Dachverband und Interessenvertretung für Regionalinitiativen.">Die Regionalbewegung </a>
                    </div>
                     <div class="partner">
                        <a data-toggle="tooltip" class="text-hide sprite regionalbuffet" href="http://www.regionalbuffet.de/"
                        title="Regionalbuffet">Regionalbuffet</a>
                    </div>
                    <div class="partner">
                        <a data-toggle="tooltip" class="text-hide sprite genussregion" href="http://www.genussregion-oberfranken.de/"
                        title="Genussregion Oberfranken">Genussregion Oberfranken </a>
                    </div>
                    <div class="partner">
                        <a data-toggle="tooltip" class="text-hide sprite region-bamberg" href="https://www.stadt.bamberg.de/index.phtml?mNavID=1829.647&amp;sNavID=1829.647&amp;La=1"
                        title="Region Bamberg - weil´s mich überzeugt">Region Bamberg - weil´s mich überzeugt</a>
                    </div>
                    <div class="partner last">
                        <a data-toggle="tooltip" class="text-hide sprite vegetarierbund" href="http://www.vebu.de/"
                        title="Vegetarierbund Deutschland">Vegetarierbund Deutschland</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="main-content white-wrapper clearfix"> 
        <div class="container">
            <div class="row">
                
                    <div class="col-md-12">
                        
                            <?php print render($title_prefix); ?>
                            <?php if ($title): ?>
                              <!--   <div class="page-header">
                                    <h2 class="page-title text-center">
                                        Regiomino ist die Lösung 
                                    </h2>
                                    <p class="lead text-center">
                                        Get the lowdown on the key pieces of Bootstrap's infrastructure, including our approach to better, faster, stronger web development.
                                    </p>
                                 </div>-->
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
                            
                            
                            <div class="row">
                                <div class="benefits"> 
                                    <div class="col-md-4">
                                      <img src="<?php echo base_path() . path_to_theme();?>/images/efficient.jpg" alt="Effiziente Beschaffung regionaler Produkte" class="img-circle">  
                                      <h4> Effiziente Beschaffung regionaler Produkte</h4> 
                                        <ul>
                                           <li><span class="glyphicon glyphicon-ok"></span><strong>Zeit- und Kostenersparnis: </strong> Vereinfachen Sie Ihre Beschaffung: App öffnen, Produkte und
                                                Mengen auswählen, Bestellung abschicken. </li>
                                           <li><span class="glyphicon glyphicon-ok"></span><strong> Günstige Preise:</strong> Sparen sie auf Dauer, denn Sie kaufen beim Produzenten direkt ein. </li>
                                           <li><span class="glyphicon glyphicon-ok"></span><strong> Hohe Produktqualität: </strong> Volle Transparenz über die Herkunft der Produkte.</li>
                                           <li><span class="glyphicon glyphicon-ok"></span><strong> Besseres Marketing:</strong> Zeigen Sie regional interessierten Kunden, wo Sie einkaufen. </li>
                                           <li><span class="glyphicon glyphicon-ok"></span><strong> Vorbestellungen:</strong> Lassen Sie Ihre Kunden vorbestellen und verringern Sie so Ihren Bestand</li>
                                        </ul>
                                    </div>
                                   
                                    <div class="col-md-4">
                                        <img src="<?php echo base_path() . path_to_theme();?>/images/direct.jpg" alt="Effektive Direktvermarktung Ihrer Produkte" class="img-circle"> 
                                        <h4> Effektive Direktvermarktung Ihrer Produkte</h4> 
                                        <ul>
                                            <li><span class="glyphicon glyphicon-ok"></span><strong>Höhere Erträge:  </strong>  Wir übernehmen Ihre Vermarktung ohne Grundgebühren. Unschlagbar! </li>
                                            <li><span class="glyphicon glyphicon-ok"></span><strong>Gewinnen Sie neue Kundengruppen:  </strong>  Sichern Sie sich den Zugang zu modernen
                                            Verbrauchern. </li>
                                            <li><span class="glyphicon glyphicon-ok"></span><strong>Zukunftssicherheit: </strong>   Neue Absatzkanäle - weniger Abhängigkeit von großen
                                            Handelskonzernen. </li>
                                            <li><span class="glyphicon glyphicon-ok"></span><strong>Zeit- und damit Kostenersparnis: </strong>   Vereinfachen Sie Ihre Direktvermarktung - Bestellung,
                                            Abrechnung, Bezahlung und Buchhaltung. </li>
                                        </ul>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <img src="<?php echo base_path() . path_to_theme();?>/images/eco.jpg" alt="Wir stärken unsere Wirtschaftskraft nachhaltig" class="img-circle"> 
                                        <h4> Wir stärken unsere Wirtschaftskraft nachhaltig</h4> 
                                        <ul>
                                           <li><span class="glyphicon glyphicon-ok"></span><strong>Ökonomisch: </strong> Ihre Produzenten können zu fairen Preisen verkaufen, erzielen höhere Erlöse
    und werden nicht von den großen Handelskonzernen ausgebeutet. </li>
                                           <li><span class="glyphicon glyphicon-ok"></span><strong>Nachhaltig: </strong> Ihr Geld bleibt in ihrem regionalen Wirtschaftskreislauf. </li>
                                           <li><span class="glyphicon glyphicon-ok"></span><strong> Strukturfördernd:</strong> Die Gründung und Führung von Dorfläden/ Stadtteilläden sowie von
    Kooperativen wird vereinfacht, weil die Beschaffungskosten geringer werden.</li>
                                         
                                        </ul>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
    
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