<h2><?= ucwords($tag->tag) ?></h2>
<?php if ($tag_content): foreach ($tag_content as $content): ?>
<h3><a href="<?= base_url().$content->module.'/view/'.$content->content_id ?>"><?= $content->title ?></a></h3>
<p>Created with the <a href="<?= base_url().$content->module ?>"><?= display_nice_file_name($content->module) ?></a> App on <?= $content->created_at ?></p>
<?php  endforeach; else: ?>
<h3>There is no content for that tag</h3>
<?php endif; ?>