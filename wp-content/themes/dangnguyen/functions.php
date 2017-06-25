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
