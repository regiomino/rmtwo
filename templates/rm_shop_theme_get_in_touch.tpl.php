<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 06.08.14
 * Time: 15:33
 */
?>
<div class="col-md-8">
    <p>Wir haben Ihnen die häufigsten Fragen zusammengestellt. Vielleicht finden Sie hier die Antwort auf Ihr Problem. Falls nicht, schreiben Sie uns doch einfach. Sie erhalten schnelle Hilfe von einem unserer kompetenten Support-Mitarbeiter.</p>
    <div class="panel-group" id="accordion">
        <?php if(isset($vars['faq'])): foreach($vars['faq'] as $nid => $faq): ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php print $nid; ?>">
                            <?php print $faq->title; ?>
                        </a>
                    </h4>
                </div>
                <div id="collapse<?php print $nid; ?>" class="panel-collapse collapse">
                    <div class="panel-body">
                        <?php print $faq->body[LANGUAGE_NONE][0]['value']; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; endif; ?>
    </div>

</div>
<div class="col-md-4">
    <?php print render($vars['contactform']); ?>
    <br />
    <br />
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Postanschrift</h3>
        </div>
        <div class="panel-body">
            Regiomino GmbH<br />Habichtweg 6<br />91096 Möhrendorf
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Telefon-Support</h3>
        </div>
        <div class="panel-body">
            09131-9291117
        </div>
    </div>
</div>
