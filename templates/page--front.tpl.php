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

<?php print render($page['highlighted']); ?>
<div class="partner-wrapper hidden-xs"> 
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
 
  <div class="content-wrapper">
    <div class="container">
        <div class="row benefits">
            <div class="col-md-12">
                <p class="text-center lead">
                   Regiomino ist ein kostenloser Online-Marktplatz für regional erzeugte Produkte. Sie kaufen und verkaufen komfortabel online, wir erledigen
                   Vermittlung und Abwicklung.
                   <span class="text-muted"> Ihre Vorteile...</span>
                </p>
            </div>
            <div class="col-md-4">
                <img src="<?php echo base_path() . path_to_theme();?>/images/efficient.jpg" alt="Effiziente Beschaffung regionaler Produkte" class="center-block img-circle">  

                <p class="anchor">Für Gastronomen und Händler</p>
                <h4>Effiziente Beschaffung regionaler Produkte</h4> 
                <ul>
                    <li><span class="fa fa-check"></span><strong>Zeit- und Kostenersparnis:</strong> Vereinfachen Sie Ihre Beschaffung: App öffnen, Produkte und
                         Mengen auswählen, Bestellung abschicken. </li>
                    <li><span class="fa fa-check"></span><strong> Günstige Preise:</strong> Sparen sie auf Dauer, denn Sie kaufen beim Produzenten direkt ein. </li>
                    <li><span class="fa fa-check"></span><strong> Hohe Produktqualität:</strong> Volle Transparenz über die Herkunft der Produkte.</li>
                    <li><span class="fa fa-check"></span><strong> Besseres Marketing:</strong> Zeigen Sie regional interessierten Kunden, wo Sie einkaufen. </li>
                    <li><span class="fa fa-check"></span><strong> Vorbestellungen:</strong> Lassen Sie Ihre Kunden vorbestellen und verringern Sie so Ihren Bestand</li>
                </ul>
                <a class="internal btn btn-default" href="#gastronomie"> mehr erfahren <span class="fa fa-chevron-right"></span></a>
            </div>
            <div class="col-md-4">
                 <img src="<?php echo base_path() . path_to_theme();?>/images/direct.jpg" alt="Effektive Direktvermarktung Ihrer Produkte" class="center-block img-circle">  

                 <p class="anchor">Für Produzenten</p>
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
                  <a class="internal btn btn-default" href="#produzenten"> mehr erfahren <span class="fa fa-chevron-right"></span></a>
            </div>
            <div class="col-md-4">
                <img src="<?php echo base_path() . path_to_theme();?>/images/eco.jpg" alt="Wir stärken unsere Wirtschaftskraft nachhaltig" class="center-block img-circle">  

                 <p class="anchor">Für Kommunen</p>
                <h4>Wir stärken unsere Wirtschaftskraft nachhaltig!</h4> 
                <ul>
                    <li><span class="fa fa-check"></span><strong>Ökonomisch:</strong> Ihre Produzenten können zu fairen Preisen verkaufen und erzielen höhere Erlöse.</li>
                    <li><span class="fa fa-check"></span><strong>Nachhaltig:</strong> Ihr Geld bleibt in ihrem regionalen Wirtschaftskreislauf. </li>
                    <li><span class="fa fa-check"></span><strong> Strukturfördernd:</strong> Die Gründung und Führung von Dorfläden/ Stadtteilläden sowie von
Kooperativen wird vereinfacht, weil die Beschaffungskosten geringer werden.</li>
                 </ul>
                <a class="internal btn btn-default" href="#kommunen"> mehr erfahren <span class="fa fa-chevron-right"></span></a>
            </div>
        </div>
    </div>
</div> 
 
 


<div class="content-wrapper white">
    <div class="container ">
        <div class="row participants">
            <div class="col-md-12">
                <h2 class="text-center">Regionales neu entdecken </h2> 
                   <p class="text-center lead">
                    Unsere Teilnehmer verbindet die Leidenschaft für hochwertige regionale Produkte und die Liebe zum Detail. Ehrliche und nachhaltige Produktion
                    als Zutaten für eine regionale Küche, die begeistert!
                   </p>
            </div>
            <div class="col-md-10 col-md-offset-1">
                <div class="map">
                    
                    <div class="text-center clearfix" id="map-control">
                        <div class="control active" data-type="customer"> 
                            <div class="filter-checkbox"><i class="fa fa-check"></i></div>
                            <span class="marker-icon marker-sprite gastro"></span> 
                            <span class="checkbox-label">teilnehmende Gastronomie</span>
                        </div>
                        <div class="control active" data-type="seller"> 
                            <div class="filter-checkbox"><i class="fa fa-check"></i></div>
                            <span class="marker-icon marker-sprite seller"></span>
                            <span class="checkbox-label">teilnehmende Produzenten</span>
                        </div>
                   </div>
                    <div class="map-wrapper"> 
                        <div id="frontpageGoogleMap"></div>
                    </div>
                    <div class="left wall"></div>
                    <div class="right wall"></div> 
                </div><!--map-->
            </div><!--end col-md-10-->
        </div><!-- end row-->
        <div class="row testimonials">
            <div class="col-md-12">
            <h2 class="text-center ">
             Unsere Idee überzeugt 

            </h2>
            <p class="text-center quote-s"> <span class="fa fa-quote-left fa-2x"> </span> </p>
                      
                <div id="testimonials" class="carousel slide col-md-12 " data-interval="8000">
                  <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#testimonials" data-slide-to="0" class="active"></li>
                        <li data-target="#testimonials" data-slide-to="1"></li>
                        <li data-target="#testimonials" data-slide-to="2"></li>
                        <li data-target="#testimonials" data-slide-to="3"></li>
                    </ol>

                      <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active ">
                   
                            <div class="media">
                                <img src="<?php echo base_path() . path_to_theme();?>/images/testimonials/zwingel.jpg" alt="Matthias Zwingel" class="pull-right hidden-xs">
                            
                                <div class="media-body">
                                    <blockquote class="blockquote-reverse"> 
                                        <p class="lead">
                                        <em> "Regiomino kann unseren Beschaffungsaufwand von einer halben Stunde (!) pro Woche und pro Lieferant auf eine halbe Stunde FÜR ALLE Regionallieferanten reduzieren."</em>
                                        </p>
                                        <footer><strong>Matthias Zwingel, Zwingel Handels GmbH, <a href="http://www.bvlh.net/praesidium.html"> Informationen <i class="fa fa-external-link"></i></a> </strong></footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                    <!-- <i class="fa  fa-quote-left fa-lg fa-2x"></i> -->
                            <div class="media">
                                <img src="<?php echo base_path() . path_to_theme();?>/images/testimonials/land.jpg" alt="Markus Herold" class="pull-left  hidden-xs">
                            
                                <div class="media-body">
                                    <blockquote class="blockquote"> 
                                        <p class="lead">
                                        <em> "Regiomino ist ein hervorragendes Beispiel dafür, was Innovationen im ländlichen Raum so erfolgreich macht: die einzigartige Verbindung von kreativen Ideen, zupackendem persönlichen Engagement und gesellschaftlicher Verantwortung. Sie sind ein Vorbild für das Innovationslabor Land." </em>
                                        </p>
                                        <footer><strong> Markus Herold, Filialdirektor Deutsche Bank Bamberg im Rahmen der Preisverleihung "Deutschland – Land der Ideen".</strong></footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                    <!-- <i class="fa  fa-quote-left fa-lg fa-2x"></i> -->
                            <div class="media">
                                <img src="<?php echo base_path() . path_to_theme();?>/images/testimonials/mueller.jpg" alt="Birgit Müller" class="pull-right  hidden-xs">
                            
                                <div class="media-body">
                                    <blockquote class="blockquote-reverse"> 
                                        <p class="lead">
                                        <em> "Das freut mich – dass Sie eine Auszeichnung für ihre wirklich bodenständige Idee erhalten und die wunderbar in die Region von uns passt. Schließlich sind genau wir in der Wirtschaftsregion Bamberg-Forchheim von Stadt u Land geprägt und Sie verbinden das wunderbar mit Ihrem Projekt." </em>
                                        </p>
                                        <footer><strong> Birgit Müller, Wirtschaftsförderin der Stadt Forchheim.</strong></footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                    <!-- <i class="fa  fa-quote-left fa-lg fa-2x"></i> -->
                            <div class="media">
                                 
                            
                                <div class="media-body">
                                    <blockquote class="blockquote"> 
                                        <p class="lead">
                                        <em> "Mit Regiomino kann ich alle regionalen Lieferanten und ihre Angebote auf einer Plattform sehen und einkaufen. Das aufwändige Einholen von Angeboten gehört damit der Vergangenheit an: Und weil es viel einfacher ist Regionales einzukaufen, können wir auch mehr davon beziehen. Auch für unsere Produzenten und die Region ein klarer Vorteil!" </em>
                                        </p>
                                        <footer><strong> Wolfgang Heinzel, <a href="http://www.gasthof-linden.de/" title="Gasthof Linden & Wildkräuterhotel"> Gasthof Linden & Wildkräuterhotel <i class="fa fa-external-link"></i> </a>, sowie 1. Vorsitzender der der Interessengemeinschaft <a href="http://www.regionalbuffet.de/impressum" title="Interessengemeinschaft Regionalbuffet " > Regionalbuffet <i class="fa fa-external-link"></i>
                                        </a> </strong></footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>

                        

                    </div>


                </div>
            </div>
        </div>
    </div><!-- end container-->
</div> <!--end content-wrapper -->   
    
<div class="content-wrapper" id="gastronomie">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="howTo">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="anchor">Für Gastronomen und Händler</p>
                            <h2>Clever regional einkaufen, ohne Telefon und Fax</h2> 
                             <p class="lead">
Sparen Sie Zeit und Kosten bei ihrem wöchentlichen Einkauf, indem Sie komfortabel online bestellen. Vergleichen Sie aktuelle Preise und Angebote
ihrer Stammlieferanten und erhalten Sie Empfehlungen zu neuen Anbietern und deren Spezialitäten. Verwalten Sie Ihre Bestellungen in Rekordzeit und behalten 
Sie den vollen Überblick zu Rechnungen und Kosten.<br> Worauf warten Sie noch? 
                             </p>
                            <button class="btn btn-success btn-lg" id="gastro"><span class="fa fa-rocket"></span> Jetzt loslegen! </button>
                        </div><!-- col-md-6-->
                        <div class="col-md-6 steps steps-rightside gastro">
                           <div class="row">
                                <div class="col-md-offset-2 col-md-10">
                                    <p><strong>So funktioniert´s: </strong>  </p>
                                </div>
                            </div>
                            <div class="row text-rightside">
                                <div class="col-sm-3">
                                     <img src="<?php echo base_path() . path_to_theme();?>/images/frontpage_illus/map.png" alt="Effiziente Beschaffung regionaler Produkte" class="hidden-xs map pull-right">  
                                </div>
                                 <div class="col-sm-9 ">
                                    <p class="text-muted col-md-offset-3">
                                        <strong> Schritt 1:<br></strong>
                                        Geben Sie Ihre Postleitzahl ein und klicken Sie auf "Produzent finden".
                                         Kein Produzent vor Ort? Schlagen Sie uns einfach Ihre Produzenten vor! </p>
                                </div>
                            </div><!-- end row-->
                            <div class="row text-leftside">
                                 <div class="col-sm-3 col-md-push-9">
                                    <img src="<?php echo base_path() . path_to_theme();?>/images/frontpage_illus/select.png" alt="Effiziente Beschaffung regionaler Produkte" class="hidden-xs select pull-right">  
                                </div>
                                
                                <div class="col-sm-9 col-md-pull-3 ">
                                     <p class="text-muted col-md-offset-3">
                                        <strong> Schritt 2:<br></strong>
                                        Suchen Sie sich Ihre Produkte aus und geben Sie die Menge ein. Geben Sie an, wann Sie beliefert werden möchten. Bei jedem Produzenten
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
                                        Entscheiden Sie ob Sie selber abholen oder geliefert bekommen. Sobald Ihre Bestellung abgeschlossen ist wird der Produzent Ihnen die Ware zu einem vereinbarten Zeitpunkt liefern oder zur Abholung vorbereiten.</p>
                                </div>
                                
                            </div><!-- end row-->
                        </div><!-- end col-md-7-->
                    </div>
                </div><!--howTo-->
            </div><!--end col-md-12-->
        </div><!-- end row-->
    </div><!-- end container-->
</div> <!--end content-wrapper -->    

<div class="content-wrapper white" id="produzenten">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="howTo">
                    <div class="row">
                        <div class="col-md-6 col-md-push-6 ">
                           <p class="anchor">Für Produzenten</p>
                           <h2>Erfolgreich im Internet verkaufen</h2> 
                            <p class="lead">
   Präsentieren Sie Ihren Betrieb und Ihre Produkte mit Regiomino online und bieten Sie Ihren Kunden einen einfachen Weg bei Ihnen zu kaufen.
   Unser Vertriebsnetzwerk stärkt Ihre Online-Präsenz und erhöht Ihre Sichtbarkeit im Internet.
   Kinderleichte Angebots- und Preisverwaltung, Bestelleingänge auf einen Blick und Buchhaltung ohne Kopfschmerzen. Wir sind gespannt auf ihre ersten Produkte! 
                            </p>
                            <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#suggestModal"><span class="fa fa-rocket"></span> Jetzt loslegen! </button>
                       </div><!--end col-md-5-->
                       
                    
                        <div class="col-md-6 col-md-pull-6 steps steps-leftside seller">
                             <div class="row">
                                <div class="col-md-10">
                                    <p><strong>So funktioniert´s: </strong>  </p>
                                </div>
                            </div>
                            <div class="row text-leftside">
                                
                                <div class="col-md-5 col-sm-3 col-md-push-7">
                                    <img src="<?php echo base_path() . path_to_theme();?>/images/frontpage_illus/suggest.png" alt="Effektive Direktvermarktung Ihrer Produkte" class="hidden-xs suggest pull-left">  
                                </div><!--end col-md-5-->
                                
                                <div class="col-md-7 col-sm-9 col-md-pull-5">
                                    <p class="text-muted">
                                       <strong> Schritt 1:<br></strong>
                                       Über "Produzent, Gastronom oder Händler vorschlagen" können Sie sich als Teilnehmer für Regiomino vorschlagen.
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
                                        Schon am nächsten Tag ist Ihr Angebot online und Kunden können ganz einfach bei Ihnen einkaufen. <a href="#" data-toggle="modal" data-target="#infoModal">Als Kondition geben Sie Regiomino dafür ab 0% auf den Bestellumsatz.</a>
                                    </p>
                                </div>
                            </div><!-- end row-->
                        </div><!--end col-md-7-->
                    </div>
                </div><!--howTo-->
            </div><!--end col-md-12-->
        </div><!-- end row-->
    </div><!-- end container-->
</div> <!--end content-wrapper-->

<div class="content-wrapper" id="kommunen">
    <div class="container">
        <div class="row ">
            <div class="col-md-12">
                <div class="howTo ">
                    <div class="row">
                        <div class="col-md-6">
                          <p class="anchor">Für Kommunen</p>
                          <h2>Strukturförderung durch regionale Vielfalt und Einzigartigkeit </h2> 
                           <p class="lead">
Regiomino unterstützt regionale Produzenten bei ihrer Geschäftsentwicklung und Vermarktung im Internet. Gastronomie und Handel werden besser
mit Anbietern von regionalen Erzeugnissen vernetzt und Regionen dadurch nachhaltig gestärkt. Lassen Sie uns diesen Prozess gemeinsam vorantreiben! 
                           </p>
                            <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#suggestModal"><span class="fa fa-rocket"></span> Jetzt loslegen! </button>
                        </div><!--end col-md-5-->
                        <div class="col-md-6 steps steps-rightside regional">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-10">
                                    <p><strong>So funktioniert´s: </strong>  </p>
                                </div>
                            </div>
                            <div class="row text-rightside">
                                <div class="col-sm-3">
                                   <img src="<?php echo base_path() . path_to_theme();?>/images/frontpage_illus/suggest.png" alt="Wir stärken unsere Wirtschaftskraft nachhaltig!" class="hidden-xs suggest pull-right">  
    
                                </div>
                                <div class="col-sm-9 ">
                                   
                                    <p class="text-muted col-md-offset-3">
                                        <strong> Schritt 1:<br></strong>
                                       Über "Produzent, Gastronom oder Händler vorschlagen" können Sie uns Ihre Produzenten mitteilen. </p>
                                </div>
                            </div><!--end row-->
                            <div class="row text-leftside">
                                 <div class="col-sm-3 col-md-push-9">
                                   <img src="<?php echo base_path() . path_to_theme();?>/images/frontpage_illus/fly.png" alt="Wir stärken unsere Wirtschaftskraft nachhaltig!" class="hidden-xs bubble pull-left ">  
                                </div>
                                 
                                 <div class="col-sm-9 col-md-pull-3 ">
                                     <p class="text-muted col-md-offset-3">
                                        <strong> Schritt 2:<br></strong>
                                        Regiomino kontaktiert die von Ihnen vorgeschlagenen Produzenten und übernimmt die Abwicklung. </p>
                                </div>
                            </div><!--end row-->
            
                            <div class="row text-rightside">
                                <div class="col-sm-3">
                                     <img src="<?php echo base_path() . path_to_theme();?>/images/frontpage_illus/contact.png" alt="Wir stärken unsere Wirtschaftskraft nachhaltig!" class="hidden-xs pull-right">  
                                </div>
                                 <div class="col-sm-9 ">
                                    <p class="text-muted col-md-offset-3">
                                        Gerne können Sie uns auch eine Email schreiben unter <a href="mailto:support@regiomino.de">support@regiomino.de</a>, oder direkt
                                        unter <a href="tel:+4909131-9291117">09131-9291117</a>einen unserer Mitarbeiter kontaktieren. Oder Sie schreiben Ihre Produzenten an und verweisen auf uns.
                                    </p>
                                </div>
                            </div><!--end row-->
                        </div><!--end col-md-7-->
                    </div>
                </div><!--howTo-->
            </div><!--end col-md-12-->
        </div><!-- end row-->
    </div><!-- end container-->
</div> <!--end content-wrapper --> 

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
                    <h3 class="modal-title text-center" id="suggestModalLabel"><?php print t('Suggest vendor, gastronomy or trader'); ?></h3>
            </div>
            <div class="modal-body">
                <?php print $suggestform; ?>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="infoModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h3 class="modal-title text-center" id="suggestModalLabel">Informationen für Produzenten</h3>
            </div>
            <div class="modal-body">
                <p>Regiomino stellt Ihnen eine Provisionsrechnung auf eingegangene Bestellungen: (dies zu Beginn des Folgemonats)</p>
                <ul>
                    <li>0% für Ihre Bestandskunden (bitte vorher angeben), die bei Ihnen auf Rechnung bezahlen oder bei Barzahlung bei der Lieferung in 2015; 5% für Ihre Bestandskunden, die bei uns über Online-Bezahlsysteme im Voraus bezahlen in 2015. </li>
                    <li>10% bei Neukunden.</li>
                </ul>
                <p>
                Ab 1.000€ Bestellumsatz pro Monat verhandeln wir die Konditionen mit Ihnen individuell.</p>
                <p>

                Und das Einstellen Ihres Angebots ist natürlich kostenlos! Fragen Sie hier einfach bei uns nach, sodass wir Ihnen Unterstützung bieten können.
                </p>
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