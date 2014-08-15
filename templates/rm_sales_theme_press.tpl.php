<div class="col-md-12">
<div class="media">
  <a class="pull-left" href="<?php print file_create_url($vars['logo']->field_file[LANGUAGE_NONE][0]['uri']); ?>">
    <?php
        $thumburi = '';
        if(empty($vars['logo']->field_media_thumb[LANGUAGE_NONE][0]['uri'])) {
            $field_info = field_info_field('field_media_thumb');
            $fid = $field_info['settings']['default_image'];
            $image = file_load($fid);
            $thumburi = $image->uri;
        }
        else {
            $thumburi = $vars['logo']->field_media_thumb[LANGUAGE_NONE][0]['uri'];
        }
    ?>
    <img class="media-object" src="<?php print image_style_url('icon', $thumburi); ?>" alt="Download">
  </a>
  <div class="media-body">
    <h4 class="media-heading"><?php print $vars['logo']->title; ?></h4>
    <?php print $vars['logo']->body[LANGUAGE_NONE][0]['value']; ?>
  </div>
</div>
<br />
<table class="table table-bordered">
    <thead>
        <tr>
            <td>Datum</td>
            <td>Pressemitteilung</td>
            <td>Anhang</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach($vars['reports'] as $nid => $report): ?>
            <tr>
                <td><?php print date('d.m.Y', $report->created); ?></td>
                <td><?php print $report->title; ?></td>
                <td><?php foreach($report->field_file[LANGUAGE_NONE] as $file): ?><a href="<?php print file_create_url($file['uri']); ?>" target="_blank"><?php print $file['filename']; ?></a><?php endforeach; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>