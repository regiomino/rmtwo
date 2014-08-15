<div class="col-md-12">
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