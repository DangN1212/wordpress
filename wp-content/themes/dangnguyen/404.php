<?php get_header(); ?>
<div class="content">
<div>
<?php
	_e('404 not found;','dangnguyen');
	get_search_form();
	_e('Content categories:','dangnguyen');
	echo '<div>'
 ?>
</div>
<div id="sidebar">
    <?php get_sidebar(); ?>
</div>
</div>
<?php get_footer(); ?>