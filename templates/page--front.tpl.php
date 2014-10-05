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
            </div>
        </div>
        <div class="navbar-collapse collapse">
            <div class="nav navbar-nav navbar-right">
                <?php print rm_user_get_navbar(); ?>
                <div class="dropdown">
                    <a href="#" class="navi-link dropdown-toggle" id="helpDD" data-toggle="dropdown"> Hilfe <span class="caret"></span> </a>
                        
                        <ul class="dropdown-menu" role="menu" aria-labelledby="helpDD">
                            <li role="presentation"><a role="menuitem" tabindex="-1" class="help-link" href="http://www.regiomino.de/kontakt">Besuchen Sie unseren Hilfebereich &raquo;</a></li>
                           
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="mailto:support@regiomino.de"><span class="fa fa-paper-plane"></span> Schreiben Sie uns</a></li>
                            
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="tel:+4909131-9291117"><span class="fa fa-phone"></span> Rufen Sie uns an: 09131-9291117</a></li>
                        </ul>
                </div>
                <button class="btn btn-danger" data-toggle="modal" data-target="#suggestModal">
                    <span class="fa fa-plus"></span> <?php print t('Suggest vendor or gastronomy'); ?>
                </button>
            </div>
        </div><!--/.nav-collapse -->
    </div>
</div><!-- end navbar -->

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

<!--<div class="benefits-wrapper">
    <div class="container">
        <div class="row entries">
            <div class="col-md-4">
                <p><strong>Für Gastronomen und Händler</strong></p>
                        <h4>Effiziente Beschaffung regionaler Produkte</h4> 
                        <ul>
                            <li><span class="fa fa-check"></span><strong>Zeit- und Kostenersparnis:</strong> Vereinfachen Sie Ihre Beschaffung: App öffnen, Produkte und
                                 Mengen auswählen, Bestellung abschicken. </li>
                            <li><span class="fa fa-check"></span><strong> Günstige Preise:</strong> Sparen sie auf Dauer, denn Sie kaufen beim Produzenten direkt ein. </li>
                            <li><span class="fa fa-check"></span><strong> Hohe Produktqualität:</strong> Volle Transparenz über die Herkunft der Produkte.</li>
                            <li><span class="fa fa-check"></span><strong> Besseres Marketing:</strong> Zeigen Sie regional interessierten Kunden, wo Sie einkaufen. </li>
                            <li><span class="fa fa-check"></span><strong> Vorbestellungen:</strong> Lassen Sie Ihre Kunden vorbestellen und verringern Sie so Ihren Bestand</li>
                        </ul>
                        <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#suggestModal"><span class="fa fa-rocket"></span> Jetzt loslegen! </button>
            </div>
            <div class="col-md-4">
                 <p> <strong>Für Lieferanten und Produzenten</strong></p>
                    <h4>Effektive Direktvermarktung Ihrer Produkte</h4> 
                    <ul>
                        <li><span class="fa fa-check"></span><strong>Höhere Erträge:</strong>  Wir übernehmen Ihre Vermarktung ohne Grundgebühren. Unschlagbar! </li>
                        <li><span class="fa fa-check"></span><strong>Gewinnen Sie neue Kundengruppen:</strong> Sichern Sie sich den Zugang zu modernen
                        Verbrauchern. </li>
                        <li><span class="fa fa-check"></span><strong>Zukunftssicherheit:</strong> Neue Absatzkanäle - weniger Abhängigkeit von großen
                        Handelskonzernen. </li>
                        <li><span class="fa fa-check"></span><strong>Zeit- und damit Kostenersparnis:</strong> Vereinfachen Sie Ihre Direktvermarktung - Bestellung,
                        Abrechnung, Bezahlung und Buchhaltung. </li>
                    </ul>
                    <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#suggestModal"><span class="fa fa-rocket"></span> Jetzt loslegen! </button>
            </div>
            <div class="col-md-4">
                 <p><strong>Für Kommunen</strong></p>
                <h4>Wir stärken unsere Wirtschaftskraft nachhaltig!</h4> 
                <ul>
                    <li><span class="fa fa-check"></span><strong>Ökonomisch:</strong> Ihre Produzenten können zu fairen Preisen verkaufen und erzielen höhere Erlöse.</li>
                    <li><span class="fa fa-check"></span><strong>Nachhaltig:</strong> Ihr Geld bleibt in ihrem regionalen Wirtschaftskreislauf. </li>
                    <li><span class="fa fa-check"></span><strong> Strukturfördernd:</strong> Die Gründung und Führung von Dorfläden/ Stadtteilläden sowie von
Kooperativen wird vereinfacht, weil die Beschaffungskosten geringer werden.</li>
                 </ul>
                 <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#suggestModal"><span class="fa fa-rocket"></span> Jetzt loslegen! </button>
            </div>
        </div>
    </div>
</div>-->
    
<div class="benefits-wrapper">
    <div class="container">
        <div class="row ">
            <div class="col-md-12">
                <div class="benefits"> 
                    <div class="col-md-5">
                        <p class="anchor">Für Gastronomen und Händler</p>
                        <h2> Effiziente Beschaffung regionaler Produkte</h2> 
                        <ul>
                            <li><span class="fa fa-check"></span><strong>Zeit- und Kostenersparnis<br></strong> Vereinfachen Sie Ihre Beschaffung: App öffnen, Produkte und
                                 Mengen auswählen, Bestellung abschicken. </li>
                            <li><span class="fa fa-check"></span><strong> Günstige Preise<br></strong> Sparen sie auf Dauer, denn Sie kaufen beim Produzenten<br> direkt ein. </li>
                            <li><span class="fa fa-check"></span><strong> Hohe Produktqualität<br></strong> Volle Transparenz über die Herkunft der Produkte.</li>
                            <li><span class="fa fa-check"></span><strong> Besseres Marketing<br></strong> Zeigen Sie regional interessierten Kunden, wo Sie einkaufen. </li>
                            <li><span class="fa fa-check"></span><strong> Vorbestellungen<br></strong> Lassen Sie Ihre Kunden vorbestellen und verringern Sie so<br> Ihren Bestand</li>
                        </ul>
                        <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#suggestModal"><span class="fa fa-rocket"></span> Jetzt loslegen! </button>
                    </div><!-- col-md-5-->
                    <div class="col-md-7 steps steps-rightside gastro">
                        <p class="hidden-md hidden-lg"><strong>So funktioniert´s: </strong></p>
                        <div class="row text-rightside">
                            <div class="col-sm-3">
                                 <img src="<?php echo base_path() . path_to_theme();?>/images/frontpage_illus/map.png" alt="Effiziente Beschaffung regionaler Produkte" class="hidden-xs map pull-right">  
                            </div>
                             <div class="col-sm-9 ">
                                <p class="text-muted col-md-offset-3">
                                    <strong> Schritt 1:<br></strong>
                                    Geben Sie Ihre Adresse ein und klicken Sie auf "Lieferant finden".
                                     Kein Lieferant vor Ort? Schlagen Sie uns einfach Ihre Lieferanten/Produzenten vor! </p>
                            </div>
                        </div><!-- end row-->
                        <div class="row text-leftside">
                             <div class="col-sm-3 col-md-push-9">
                                <img src="<?php echo base_path() . path_to_theme();?>/images/frontpage_illus/select.png" alt="Effiziente Beschaffung regionaler Produkte" class="hidden-xs select pull-right">  
                            </div>
                            
                            <div class="col-sm-9 col-md-pull-3 ">
                                 <p class="text-muted col-md-offset-3">
                                    <strong> Schritt 2:<br></strong>
                                    Suchen Sie sich Ihre Produkte aus und geben Sie die Menge ein. Geben Sie an, wann Sie beliefert werden möchten. Bei jedem Lieferanten/Produzenten
                                    können Sie spezielle regionale Produkte bestellen, mit denen Sie Ihre Kunden begeistern werden.
                                 </p>
                            </div>
                           
                        </div><!-- end row-->
                        <div class="row text-rightside">
                            <div class="col-sm-3">
                                 <img src="<?php echo base_path() . path_to_theme();?>/images/frontpage_illus/payment.png" alt="Effiziente Beschaffung regionaler Produkte" class="hidden-xs payment pull-right">  
                            </div>
                            <div class="col-sm-9 ">
                                <p class="text-muted col-md-offset-3">
                                    <strong> Schritt 3:<br></strong>
                                     Wählen Sie die Zahlungsart aus. Anstatt jeden Monat unzählige Überweisungen tätigen zu müssen, können Sie auch direkt online Ihre Zahlung abwickeln. Rechnungen und steuerrelevante Dokumente werden Ihnen per Mail zugeschickt.
                                </p>
                            </div>
                        </div><!-- end row-->
                        <div class="row text-leftside">
                             <div class="col-sm-3 col-md-push-9">
                                <img src="<?php echo base_path() . path_to_theme();?>/images/frontpage_illus/delivery.png" alt="Effiziente Beschaffung regionaler Produkte" class="hidden-xs delivery pull-right">  
                            </div>
                            
                            <div class="col-sm-9 col-md-pull-3 ">
                                 <p class="text-muted col-md-offset-3">
                                    <strong> Schritt 4:<br></strong>
                                    Entscheiden Sie ob Sie selber abholen oder geliefert bekommen. Sobald Ihre Bestellung abgeschlossen ist wird der Lieferant/Produzent Ihnen die Ware zu einem vereinbarten Zeitpunkt liefern oder zur Abholung vorbereiten.</p>
                            </div>
                            
                        </div><!-- end row-->
                    </div><!-- end col-md-7-->
                </div><!--benefits-->
            </div><!--end col-md-12-->
        </div><!-- end row-->
    </div><!-- end container-->
</div> <!--end benefits-wrapper -->    

<div class="benefits-wrapper white">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="benefits">
                     <div class="col-md-5 col-md-push-7 ">
                        <p class="anchor">Für Lieferanten und Produzenten</p>
                        <h2> Effektive Direktvermarktung Ihrer Produkte</h2> 
                        <ul>
                            <li><span class="fa fa-check"></span><strong>Höhere Erträge<br>  </strong>  Wir übernehmen Ihre Vermarktung ohne Grundgebühren. Unschlagbar! </li>
                            <li><span class="fa fa-check"></span><strong>Gewinnen Sie neue Kundengruppen<br>  </strong>  Sichern Sie sich den Zugang zu modernen
                            Verbrauchern. </li>
                            <li><span class="fa fa-check"></span><strong>Zukunftssicherheit<br> </strong>   Neue Absatzkanäle - weniger Abhängigkeit von großen
                            Handelskonzernen. </li>
                            <li><span class="fa fa-check"></span><strong>Zeit- und damit Kostenersparnis<br> </strong>   Vereinfachen Sie Ihre Direktvermarktung - Bestellung,
                            Abrechnung, Bezahlung und Buchhaltung. </li>
                        </ul>
                         <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#suggestModal"><span class="fa fa-rocket"></span> Jetzt loslegen! </button>
                    </div><!--end col-md-5-->
                    
                    
                    <div class="col-md-7 col-md-pull-5 steps steps-leftside seller">
                        <p class="hidden-md hidden-lg"><strong>So funktioniert´s: </strong></p>
                        <div class="row text-leftside">
                            
                            <div class="col-md-5 col-sm-3 col-md-push-7">
                                <img src="<?php echo base_path() . path_to_theme();?>/images/frontpage_illus/suggest.png" alt="Effektive Direktvermarktung Ihrer Produkte" class="hidden-xs suggest pull-left">  
                            </div><!--end col-md-5-->
                            
                            <div class="col-md-7 col-sm-9 col-md-pull-5">
                                <p class="text-muted">
                                   <strong> Schritt 1:<br></strong>
                                   Über den roten Button (oberer rechter Seitenbereich) können Sie sich als Lieferant/Produzent für Regiomino vorschlagen.
                                   Wir werden Sie dann umgehend kontaktieren.
                                </p>
                            </div><!--end col-md-7-->
                        </div><!-- end row-->
                        <div class="row text-rightside">
                            <div class="col-sm-3">
                                <img src="<?php echo base_path() . path_to_theme();?>/images/frontpage_illus/list.png" alt="Effektive Direktvermarktung Ihrer Produkte" class="hidden-xs listimage pull-right">  
                            </div><!--end col-md-3-->
                            <div class="col-md-7 col-sm-9 ">
                                <p class="text-muted ">
                                    <strong> Schritt 2:<br></strong>
                                    Schicken Sie uns Ihre Preisliste und teilen Sie uns Ihre Lieferbedingungen mit.
                                </p>
                            </div><!--end col-md-7-->
                        </div><!-- end row-->
                        <div class="row text-leftside">
                            
                            <div class="col-md-5 col-sm-3 col-md-push-7">
                                <img src="<?php echo base_path() . path_to_theme();?>/images/frontpage_illus/shop.png" alt="Effektive Direktvermarktung Ihrer Produkte" class="hidden-xs shop pull-left">  
                            </div>
                            
                            <div class="col-md-7 col-sm-9 col-md-pull-5">
                                <p class="text-muted">
                                    <strong> Schritt 3:<br></strong>
                                    Schon am nächsten Tag ist Ihr Angebot online und Kunden können ganz einfach bei Ihnen einkaufen.
                                    Als Kondition erhält Regiomino von Ihnen bis zu 10% auf die Bestellung.
                                </p>
                            </div>
                        </div><!-- end row-->
                    </div><!--end col-md-7-->
                   
                </div><!--benefits-->
            </div><!--end col-md-12-->
        </div><!-- end row-->
    </div><!-- end container-->
</div> <!--end benefits-wrapper-->


<div class="benefits-wrapper">
    <div class="container">
        <div class="row ">
            <div class="col-md-12">
                <div class="benefits "> 
                    <div class="col-md-5">
                      <p class="anchor">Für Kommunen</p>
                      <h2>Wir stärken unsere Wirtschaftskraft nachhaltig!</h2> 
                       <ul>
                           <li><span class="fa fa-check"></span><strong>Ökonomisch<br> </strong> Ihre Produzenten können zu fairen Preisen verkaufen und erzielen höhere Erlöse.</li>
                           <li><span class="fa fa-check"></span><strong>Nachhaltig<br> </strong> Ihr Geld bleibt in ihrem regionalen Wirtschaftskreislauf. </li>
                           <li><span class="fa fa-check"></span><strong> Strukturfördernd<br></strong> Die Gründung und Führung von Dorfläden/ Stadtteilläden sowie von
Kooperativen wird vereinfacht, weil die Beschaffungskosten geringer werden.</li>
                        </ul>
                        <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#suggestModal"><span class="fa fa-rocket"></span> Jetzt loslegen! </button>
                    </div><!--end col-md-5-->
                    <div class="col-md-7 steps steps-rightside regional">
                        <p class="hidden-md hidden-lg"><strong>So funktioniert´s: </strong></p>
                        <div class="row text-rightside">
                            <div class="col-sm-3">
                               <img src="<?php echo base_path() . path_to_theme();?>/images/frontpage_illus/suggest.png" alt="Wir stärken unsere Wirtschaftskraft nachhaltig!" class="hidden-xs suggest pull-right">  

                            </div>
                            <div class="col-sm-9 ">
                                <p class="text-muted col-md-offset-3">
                                    <strong> Schritt 1:<br></strong>
                                    Über den roten Button (oberer rechter Seitenbereich) können Sie uns Ihre Lieferanten/Produzenten mitteilen. </p>
                            </div>
                        </div><!--end row-->
                        <div class="row text-leftside">
                             <div class="col-sm-3 col-md-push-9">
                               <img src="<?php echo base_path() . path_to_theme();?>/images/frontpage_illus/fly.png" alt="Wir stärken unsere Wirtschaftskraft nachhaltig!" class="hidden-xs bubble pull-left ">  
                            </div>
                             
                             <div class="col-sm-9 col-md-pull-3 ">
                                 <p class="text-muted col-md-offset-3">
                                    <strong> Schritt 2:<br></strong>
                                    Regiomino kontaktiert die von Ihnen vorgeschlagenen Lieferanten/Produzenten und übernimmt die Abwicklung. </p>
                            </div>
                        </div><!--end row-->
        
                        <div class="row text-rightside">
                            <div class="col-sm-3">
                                 <img src="<?php echo base_path() . path_to_theme();?>/images/frontpage_illus/contact.png" alt="Wir stärken unsere Wirtschaftskraft nachhaltig!" class="hidden-xs pull-right">  
                            </div>
                             <div class="col-sm-9 ">
                                <p class="text-muted col-md-offset-3">
                                    Gerne können Sie uns auch eine Email schreiben unter <a href="mailto:support@regiomino.de">support@regiomino.de</a>, oder direkt
                                    unter <a href="tel:+4909131-9291117">09131-9291117</a>einen unserer Mitarbeiter kontaktieren. Oder Sie schreiben Ihre Produzenten an und verweisen sie auf uns.
                                </p>
                            </div>
                        </div><!--end row-->
                    </div><!--end col-md-7-->
                </div><!--benefits-->
            </div><!--end col-md-12-->
        </div><!-- end row-->
    </div><!-- end container-->
</div> <!--end benefits-wrapper --> 

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
                    <h3 class="modal-title text-center" id="suggestModalLabel"><?php print t('Suggest vendor or gastronomy'); ?></h3>
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