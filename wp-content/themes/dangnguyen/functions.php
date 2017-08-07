<?php

/**
  @ Thiết lập các hằng dữ liệu quan trọng
  @ THEME_URL = get_stylesheet_directory() - đường dẫn tới thư mục theme
  @ CORE = thư mục /core của theme, chứa các file nguồn quan trọng.
**/
  define( 'THEME_URL', get_stylesheet_directory() );
  define( 'CORE', THEME_URL . '/core' );
/**
  @ Load file /core/init.php
  @ Đây là file cấu hình ban đầu của theme mà sẽ không nên được thay đổi sau này.
  **/

  require_once( CORE . '/init.php' );
/**
@ Thiết lập $content_width để khai báo kích thước chiều rộng của nội dung
**/
if(!isset($content_width)){
 /*
 * Nếu biến $content_width chưa có dữ liệu thì gán giá trị cho nó
 */
 $content_width = 620;
}

/**
  @ Thiết lập các chức năng sẽ được theme hỗ trợ
  **/
   if ( ! function_exists( 'dangnguyen_theme_setup' ) ) {
    function dangnguyen_theme_setup(){
     /* Thiet lap text domain */
     $language_folder  = THEME_URL . '/languages';
     load_theme_textdomain('dangnguyen',$language_folder);

     /* Tu dong them link RSS vao the head */
     add_theme_support('automatic-feed-links');

     /* Them post thumbnail */
     add_theme_support('post-thumbnails');

     /* Them post format */
     add_theme_support('post-formats' , array(
      'image',
      'video',
      'gallery',
      'quote',
      'link'
      ));

     /* Them title tag */
     add_theme_support('title-tag');

     /* Them custom background */
     $default_background = array(
       'default-color'=>'#ffffff'
      );
     add_theme_support('custom-background',$default_background);

     /* Them menu */

     register_nav_menu('primary-menu',__('Primary Menu','dangnguyen'));

     /* Them sidebar */
     $sidebar = array(
       'name' => __('Main sidebar','dangnguyen'),
       'id' => 'main-sidebar',
       'description' => __('Default sidebar'),
       'class' => 'main-sidebar',
       'before_title' => '<h3 class="widgettitle"',
       'after_title' => '</h3>'
      );

     register_sidebar($sidebar);
    }
    add_action('init','dangnguyen_theme_setup');
   }

/*----
 Template functions
 ----*/
if(!function_exists('load_header')){
 function load_header(){ ?>

 <div class="site-name">
 <?php
   if( is_home()){
       printf('<h1><a href="%1$s" title="%2$s">%3$s</a></h1>',
           get_bloginfo('url'),
           get_bloginfo('description'),
           get_bloginfo('sitename'));
   }else{
       printf('<p><a href="%1$s" title="%2$s">%3$s</a></p>',
           get_bloginfo('url'),
           get_bloginfo('description'),
           get_bloginfo('sitename'));
   }?>
   </div>
<?php
    }
   }

/*---
Thiet lap menu
---*/
if(!function_exists('load_menu')){
    function load_menu($slug){
        $menu = array('theme_location'=> $slug,
                        'container' => 'nav',
                        'container_class' => $slug,
            );
        wp_nav_menu($menu);
    }
}


/**
Ham tao phan trang
**/

if( !function_exists('show_pagination') ) {

 function show_pagination(){
  if( $GLOBALS['wp_query']->max_num_pages < 3 ) {
   return '';
  }
  ?>

  <nav class="pagination" role="navigation">
  <?php if( get_next_posts_link() ): ?>
  <div class="prev">
   <?php next_posts_link( __('Older Posts','dangnguyen')); ?>
  </div>
  <?php endif; ?>
  <?php  if( get_previous_posts_link()): ?>
<div class="next"><?php previous_posts_link( __('Newest Posts','dangnguyen')); ?>
</div>
<?php endif; ?>

  </nav>
  <?php
 }
}


/**
Ham hien thi thumbnail
    @ Hàm hiển thị ảnh thumbnail của post.
    @ Ảnh thumbnail sẽ không được hiển thị trong trang single
    @ Nhưng sẽ hiển thị trong single nếu post đó có format là Image
    @ dangnguyen_thumbnail( $size )
**/
if(!function_exists('dangnguyen_thumbnail')){
    function dangnguyen_thumbnail($size){
        if( !is_single()  && !post_password_required() || has_post_format('image') ) : ?>
            <figure class="post-thumbnail"><?php the_post_thumbnail($size); ?></figure>
<?php
    endif;
    }
}
/**
@ Hàm hiển thị tiêu đề của post trong .entry-header
@ Tiêu đề của post sẽ là nằm thẻ h1 ở trang single
@ Còn ở trang chủ và trang lưu trữ, nó sẽ là h2
@ dangnguyen_entry_header
**/
if(!function_exists('dangnguyen_entry_header')){
    function dangnguyen_entry_header(){
        if(is_single()){?>
            <h1 class="entry-title">
                <a href=" <?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                    <?php the_title(); ?>
                </a>
            </h1>
        <?php }else{ ?>
            <h2 class="entry-title">
                <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute();?>">
                    <?php the_title();?>
                </a>
            </h2>
        <?php
        }
    }
}

/**
@Hàm hiển thị thông tin của post (Post meta)
@dangnguyen_entry_meta()
**/
if(!function_exists('dangnguyen_entry_meta')){
    function dangnguyen_entry_meta(){
        if(!is_page()){?>
            <div class="entry-meta">
                <?php
                    printf( __('<span class="author">Posted by %1$s </span>','dangnguyen'),get_the_author());
                    printf( __('<span class="date-published"> at %1$s </span>','dangnguyen'),get_the_date());
                    printf( __('<span class="category"> in %1$s </span>','dangnguyen'),get_the_category_list(','));
                    if(comments_open()):
                        echo '<span class="meta-reply">';
                            comments_popup_link(
                                __('Leave a comment','dangnguyen'),
                                __('One comment','danguyen'),
                                __('% comments','dangnguyen'),
                                __('Read all comments','dangnguyen')
                                );
                        echo '</span>';
                    endif;
                ?>
            </div>
       <?php }
    }
}

/*
* Thêm chữ Read More và except
*/
function dangnguyen_readmore(){
    return '...<a class="read-more" href="'.get_permalink(get_the_ID()).'">'.__('Read More','dangnguyen').'</a>';
}
add_filter('excerpt_more','dangnguyen_readmore');
/**
@ Hàm hiển thị nội dung post type
@ Hàm này sẽ hiển thị đoạn rút gọn của post ngoài trang chủ (the excerpt)
@ Nhưng nó sẽ hiển thị toàn bộ nội dung của post ở trang single (the concent)
@ danguyen_entry_content()
**/

if(!function_exists('dangnguyen_entry_content')){
    function dangnguyen_entry_content(){
        if(!is_single()){
            the_excerpt();
        }else{
            the_content();
            echo 1;
            /*
        * Code hiển thị phân trang trong post type
        */
        $link_pages = array(
            'before' => __('<p>Page:','dangnguyen'),
            'after' => __('</p>'),
            'nextpagelink' => __('Next page','dangnguyen'),
            'previouspagelink' => __('Previous page','dangnguyen')
            );
        wp_link_pages($link_pages);
        }
    }
}


/**
dangnguyen_entry_tag = hien thi tag
**/
if(!function_exists('dangnguyen_entry_tag')){
  function dangnguyen_entry_tag(){
    if(has_tag()){
      echo '<div class="entry-tag">';
      printf(__('Tagged in %1$s', 'dangnguyen'),get_the_tag_list('',','));
      echo '</div>';
    }
  }
}