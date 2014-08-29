<div class="col-sm-12 col-md-12">

    <h1 class="page-header"><?php print t('Your commission agreements'); ?></h1>
    
    <?php if(empty($vars['agreements'])): ?>
    
        <div class="alert alert-danger" role="alert"><?php print t('No commission agreements have been set for you. Your products cannot be purchased unless these are added.'); ?></div>
        
    <?php else: ?>
        <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Für wen?</th>
                    <th>Prozent?</th>
                    <th>Datum der Erstellung</th>
                    <th>Letzte Aktualisierung</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($vars['agreements'] as $agreement): ?>
                    <tr>
                        <td>
                            <?php
                                print ($agreement->field_user_reference[LANGUAGE_NONE][0]['target_id'] == 0) ? t('for all') : t('for @user', array('@user' => format_username(user_load($agreement->field_user_reference[LANGUAGE_NONE][0]['target_id']))));
                            ?>
                        </td>
                        <td>
                            <?php print number_format($agreement->field_commission[LANGUAGE_NONE][0]['value'], 2, ",", "."); ?>%
                        </td>
                        <td><?php print date('d.m.Y', $agreement->created); ?></td>
                        <td><?php print date('d.m.Y', $agreement->changed); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    <?php endif; ?>
</div>