<article id="post-<?php the_ID ?>" <?php post_class(); ?> >
    <div class="entry-thumbnail">
        <?php dangnguyen_thumbnail('thumbnail') ?>
    </div>
    <div class="entry-header">
        <?php dangnguyen_entry_header();
        dangnguyen_entry_meta();?>
    </div>
    <div class="entry-content">
    	<?php dangnguyen_entry_content(); ?>
    	<?php  ( is_single()  ? dangnguyen_entry_tag() : ''); ?>
    </div>
</article>