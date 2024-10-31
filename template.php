<div id="pt_related" style="display: none;">
    <?php if($show_title): ?>
        <strong>Poets similar to <a href="<?php echo $url; ?>" target="_blank" class="pt_poet"><?php echo $poet; ?></a></strong>
    <?php endif; ?>
</div>
<?php include 'js.php'; ?>
<?php if($type == 'iframe'): ?>
    <script type="text/javascript" src="<?php echo rawurldecode($url); ?>?jsonp=pt_iframe_callback"></script>
<?php else: ?>
    <script type="text/javascript" src="<?php echo rawurldecode($url); ?>?jsonp=pt_list_callback"></script>
<?php endif; ?>
