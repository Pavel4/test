<?php

load_theme_textdomain( 'pro_blogg', TEMPLATEPATH.'/languages' );
 
$locale = get_locale();
$locale_file = TEMPLATEPATH."/languages/$locale.php";
if ( is_readable($locale_file) )
	require_once($locale_file);

$themename = 'problogg';
$themetitle = 'ProBlogg';



//require_once( dirname( __FILE__ ) . '/theme-options.php' );



add_filter( 'wp_title', 'dess_page_title' );



function dess_page_title($title){

  if( empty( $title ) && ( is_home() || is_front_page() ) ) {

    return __( 'Home', 'pro_blogg' ) . ' | ' . get_bloginfo( 'description' );

  }

  return $title;

}



if (function_exists('add_theme_support')) {

	add_theme_support('menus');

	register_nav_menu('header-menu','Header Menu');



	add_theme_support( 'post-thumbnails' );

	add_theme_support( 'automatic-feed-links' );

	add_theme_support( "title-tag" );

	add_image_size('blog_image',790,435,true);

}



if ( ! isset( $content_width ) ) {

	$content_width = 600;

}



function problogg_add_editor_styles() {

    add_editor_style( 'css/editor-style.css' );

}

add_action( 'admin_init', 'problogg_add_editor_styles' );



function dess_get_excerpt($num_chars) {

    $temp_str = substr(strip_shortcodes(strip_tags(get_the_content())),0,$num_chars);

    $temp_parts = explode(" ",$temp_str);

    $temp_parts[(count($temp_parts) - 1)] = '';

    

    if(strlen(strip_tags(get_the_content())) > 125)

      return implode(" ",$temp_parts) . '...';

    else

      return implode(" ",$temp_parts);

}



add_action('wp_enqueue_scripts', 'dess_theme_imports');



function dess_theme_imports(){



	global $themename;

    global $themetitle;



    wp_enqueue_style( $themename.'_flexslider_style', get_stylesheet_directory_uri().'/css/flexslider.css' );

    wp_enqueue_style( $themename.'_slicknav_style', get_stylesheet_directory_uri().'/css/slicknav.min.css' );

	wp_enqueue_style( $themename.'_style', get_stylesheet_uri(),999 );



	wp_enqueue_script( 'jquery' );

	wp_enqueue_script( $themename.'_imagesloaded_script', get_stylesheet_directory_uri() . '/js/imagesloaded.pkgd.min.js' );

	wp_enqueue_script( $themename.'_masonry_script', get_stylesheet_directory_uri() . '/js/masonry.pkgd.min.js' );

	wp_enqueue_script( $themename.'_flexslider_script', get_stylesheet_directory_uri() . '/js/jquery.flexslider-min.js' );

	wp_enqueue_script( $themename.'_infinite-scoll_script', get_stylesheet_directory_uri() . '/js/jquery.infinitescroll.js' );

	wp_enqueue_script( $themename.'_slicknav_script', get_stylesheet_directory_uri() . '/js/jquery.slicknav.min.js' );

	wp_enqueue_script( $themename.'_script', get_stylesheet_directory_uri() . '/js/scripts.js' );



	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {

		wp_enqueue_script( 'comment-reply' );

	}



}



add_action('admin_enqueue_scripts', 'dess_admin_imports');



function dess_admin_imports(){



	global $themename;

    global $themetitle;

    

    wp_enqueue_media();

	wp_enqueue_style( $themename.'_style', get_stylesheet_directory_uri().'/css/admin-style.css' );

	wp_enqueue_script( $themename.'_script', get_stylesheet_directory_uri() . '/js/admin-scripts.js' );

}



function dess_widgets_init() {



	register_sidebar( array(

		'name' => 'Primary Sidebar',

		'id' => 'sidebar-1',

		'before_widget' => '<div id="%1$s" class="widget_box %2$s">',

		'after_widget' => '</div>',

		'before_title' => '<h3 class="side_title">',

		'after_title' => '</h3>',	

	) );



	register_sidebar( array(

		'name' => 'Footer Col 1',

		'id' => 'footer-1',

		'before_widget' => '<div id="%1$s" class="widget_box footer_box %2$s">',

		'after_widget' => '</div>',

		'before_title' => '<h3 class="footer_title">',

		'after_title' => '</h3>',

	) );



	register_sidebar( array(

		'name' => 'Footer Col 2',

		'id' => 'footer-2',

		'before_widget' => '<div id="%1$s" class="widget_box footer_box %2$s">',

		'after_widget' => '</div>',

		'before_title' => '<h3 class="footer_title">',

		'after_title' => '</h3>',

	) );



	register_sidebar( array(

		'name' => 'Footer Col 3',

		'id' => 'footer-3',

		'before_widget' => '<div id="%1$s" class="widget_box footer_box %2$s">',

		'after_widget' => '</div>',

		'before_title' => '<h3 class="footer_title">',

		'after_title' => '</h3>',

		'ignore_sticky_posts' => true

	) );

	

}

add_action( 'widgets_init', 'dess_widgets_init' );



function dess_post_meta_box() {



	add_meta_box(

			'dess_post_settings',

			__('Post Settings','pro_blogg'),

			'dess_post_meta_box_callback',

			'post'

		);

}

add_action( 'add_meta_boxes', 'dess_post_meta_box' );



function dess_post_meta_box_callback( $post ) {



	wp_nonce_field( 'dess_post_save_meta_box_data', 'dess_post_meta_box_nonce' );



	$show_in_homepage = get_post_meta( $post->ID, 'ex_show_in_homepage', true );

	$show_in_slider = get_post_meta( $post->ID, 'show_in_slider', true );

	$type = get_post_meta( $post->ID, 'page_featured_type', true );



	/*

	echo '<p><label for="show_in_homepage">Show in Homepage: </label>';

	echo '<input type="checkbox" id="show_in_homepage" name="ex_show_in_homepage" value="Yes" '.($show_in_homepage ==  'Yes' ? 'checked' : '' ).' /></p>'; */



	echo '<p><label for="show_in_slider">'.__('Show in Slider','pro_blogg').': </label>';

	echo '<input type="checkbox" id="show_in_slider" name="show_in_slider" value="Yes" '.($show_in_slider ==  'Yes' ? 'checked' : '' ).' /></p>';



	echo '<p><label for="video_type">'.__('Featured Type','pro_blogg').': </label><br/>';

	echo '<select id="video_type" name="dess_post[page_featured_type]"><option value="">Image</option><option value="youtube" '.($type == 'youtube' ? 'selected="selected"' : '').'>Youtube</option><option value="vimeo" '.($type == 'vimeo' ? 'selected="selected"' : '').'>Vimeo</option></select></p>';



	echo '<p><label for="video_id">'.__('Video ID','pro_blogg').': </label><br/>';

	echo '<input type="text" id="video_id" name="dess_post[page_video_id]" value="'.get_post_meta( $post->ID, 'page_video_id', true ).'" /></p>';

}



function dess_post_save_meta_box_data( $post_id ) {



	if ( ! isset( $_POST['dess_post_meta_box_nonce'] ) ) {

		return;

	}



	if ( ! wp_verify_nonce( $_POST['dess_post_meta_box_nonce'], 'dess_post_save_meta_box_data' ) ) {

		return;

	}



	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {

		return;

	}



	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {



		if ( ! current_user_can( 'edit_page', $post_id ) ) {

			return;

		}



	} else {



		if ( ! current_user_can( 'edit_post', $post_id ) ) {

			return;

		}

	}



	$show_in_homepage = sanitize_text_field( $_POST['ex_show_in_homepage'] );

	$show_in_slider = sanitize_text_field( $_POST['show_in_slider'] );



	//update_post_meta( $post_id, 'ex_show_in_homepage', $show_in_homepage );

	update_post_meta( $post_id, 'show_in_slider', $show_in_slider );



	$arr = array();

	if (isset($_POST['dess_post'])){

	$arr = $_POST['dess_post'];

	}



	foreach ($arr as $key => $value) {

		$val = sanitize_text_field($value);

		update_post_meta( $post_id, $key, $val );

	}



}

add_action( 'save_post', 'dess_post_save_meta_box_data' );



function dess_customize_register($wp_customize){

    

    $wp_customize->add_section(

	'header_section',

	array( 

		'title' => __('Logo','pro_blogg'), 

		'capability' => 'edit_theme_options', 

		'description' =>  __('Allows you to edit your theme\'s layout.','pro_blogg')

	)

	);



	$wp_customize->add_setting('dess_options[logo]', array(

	    'default'           => get_stylesheet_directory_uri().'/images/logo.png',

	    'capability'        => 'edit_theme_options',

	    'type'           => 'option',

	    'sanitize_callback' => 'sanitize_customizer_val',

	));

	 

	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'logo', array(

	    'label'    => __('Logo Image','pro_blogg'),

	    'section'  => 'header_section',

	    'settings' => 'dess_options[logo]',

	)));



	$wp_customize->add_section(

	'slider_section', 

	array( 

		'title' =>  __('Slider','pro_blogg'), 

		'capability' => 'edit_theme_options', 

		'description' =>  __('Allows you to set your slider','pro_blogg')

	)

);



	$wp_customize->add_setting('dess_options[show_slider]', array(

    'capability' => 'edit_theme_options',

    'type'       => 'option',

    'default'       => '1',

    'sanitize_callback' => 'sanitize_customizer_val',

	));

	 

	$wp_customize->add_control('dess_options[show_slider]', array(

	    'settings' => 'dess_options[show_slider]',

	    'label'    => __('Show Slider','pro_blogg'),

	    'section'  => 'slider_section',

	    'type'     => 'checkbox', 

	));



	$wp_customize->add_section(

	'sm_section', 

	array( 

		'title' =>  __('Social Media','pro_blogg'), 

		'capability' => 'edit_theme_options', 

		'description' =>  __('Allows you to set your social media URLs','pro_blogg')

	)

);

	$socials = array('twitter','facebook','google-plus','instagram','pinterest','vimeo','youtube','linkedin');

	for($i=0;$i<count($socials);$i++){

		$name = str_replace('-',' ',ucfirst($socials[$i]));

		$wp_customize->add_setting('dess_options['.$socials[$i].'_url]', array(

	    'capability' => 'edit_theme_options',

	    'type'       => 'option',

	    'sanitize_callback' => 'sanitize_customizer_val',

		));

		 

		$wp_customize->add_control('dess_options['.$socials[$i].'_url]', array(

		    'settings' => 'dess_options['.$socials[$i].'_url]',

		    'label'    => $name.' URL',

		    'section'  => 'sm_section',

		    'type'     => 'text', 

		));

	}



	$wp_customize->add_section(

	'footer_section', 

	array( 

		'title' =>  __('Footer','pro_blogg'), 

		'capability' => 'edit_theme_options', 

		'description' =>  __('Allows you to set your footer settings','pro_blogg')

	)

);



	$wp_customize->add_setting('dess_options[copyright]', array(

    'capability' => 'edit_theme_options',

    'type'       => 'option',

    'sanitize_callback' => 'sanitize_customizer_val',

	));

	 

	$wp_customize->add_control('dess_options[copyright]', array(

	    'settings' => 'dess_options[copyright]',

	    'label'    => __('Copyright Text','pro_blogg'),

	    'section'  => 'footer_section',

	    'type'     => 'textarea', 

	));

 

}

add_action('customize_register', 'dess_customize_register');



function dess_options($name, $default = false) {

    $options = ( get_option( 'dess_options' ) ) ? get_option( 'dess_options' ) : null;

    // return the option if it exists

    if ( isset( $options[ $name ] ) ) {

        return apply_filters( 'dess_options_$name', $options[ $name ] );

    }

    // return default if nothing else

    return apply_filters( 'dess_options_$name', $default );

}



function sanitize_customizer_val($value){

	return esc_html($value);

}



$custom_back_args = array(

	'default-color' => 'FFFFFF',

);

add_theme_support( 'custom-background', $custom_back_args );


/*
$custom_header_args = array(

	'default-image' => get_template_directory_uri().'/images/logo.png',

);

add_theme_support( "custom-header", $custom_header_args ); */



if ( class_exists( 'WP_Customize_Control' ) ) {



    class dessTextAreaControl extends WP_Customize_Control {

        public $type = 'textarea';

        public function __construct( $manager, $id, $args = array() ) {

            $this->statuses = array( '' => 'Default');

            parent::__construct( $manager, $id, $args );

        }

 

        public function render_content() {

            echo '<label>

                <span class="customize-control-title">' . esc_html( $this->label ) . '</span>

                <textarea rows="5" style="width:100%;" ';

            $this->link();

            echo '>' . esc_textarea( $this->value() ) . '</textarea>

                </label>';

        }

    }

 

}