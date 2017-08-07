<?php get_header(); ?>
<div class="content">
<div id="main-content">
<div class="archive-title">
	<?php 
		if(is_tag()){
			printf('Post tagged: %1$s',single_tag_title('',false));
		}esleif( is_category() ){
			printf('Post categorized: %1$s',single_cat_title('',false));
		}elseif(is_day()){
			printf('Daily Archive: %1$s',get_the_time('l,F j,Y'));
		}elseif(is_month()){
			printf('Monthly Archive: %1$s',get_the_time('F Y'));
		}elseif(is_year()){
			printf('Yearly Archive: %1$s',get_the_time('Y'));
		}
	?>
</div>
<?php 
	if(is_tag() || is_category()){?>
		<div class="archive-description">
			<?php echo term_description(); ?>
		</div>	
<?php
	}
?>
 <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
  <?php get_template_part('content',get_post_format()); ?>
 <?php endwhile ?>
   <?php show_pagination(); ?>
<?php else: ?>
 <?php get_template_part('content','none'); ?>
<?php endif; ?>
</div>
<div id="sidebar">
    <?php get_sidebar(); ?>
</div>
</div>
<?php get_footer(); ?>