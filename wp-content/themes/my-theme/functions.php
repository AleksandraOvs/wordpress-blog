<?php
add_filter('show_admin_bar', '__return_false');
//admin_enqueue_scripts
//login_enqueue_scripts
add_action ('wp_enqueue_scripts', 'wp_js_and_css');
    function wp_js_and_css(){
        wp_enqueue_style ('gfonts', 'http://fonts.googleapis.com/css?family=Montserrat:300,400%7COpen+Sans:400,400i,700%7CMerriweather:400ii?subset=cyrillic');
        wp_enqueue_style ('bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.min.css', array(), '1.0');
        wp_enqueue_style ('font-icons', get_stylesheet_directory_uri() . '/css/font-icons.css', array(), '1.0');
        wp_enqueue_style ('sliders', get_stylesheet_directory_uri() . '/css/sliders.css', array(), null);
        wp_enqueue_style ('main', get_stylesheet_directory_uri() . '/css/style.css', array(), time());
        wp_enqueue_style ('responsive', get_stylesheet_directory_uri() . '/css/responsive.css', array(), null);
        wp_enqueue_style ('spacings', get_stylesheet_directory_uri() . '/css/spacings.css', array(), null);
        wp_enqueue_style ('bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.min.css', array(), null);
        wp_enqueue_style ('animate', get_stylesheet_directory_uri() . '/css/animate.min.css', array(), null);
        wp_deregister_script('jquery');
        wp_enqueue_script ('jquery', get_stylesheet_directory_uri() . '/js/jquery.min.js', array(), null, true);
        wp_enqueue_script ('js-bootstrap', get_stylesheet_directory_uri() . '/js/bootstrap.min.js', array('jquery'), null, true);
        wp_enqueue_script ('js-plugins', get_stylesheet_directory_uri() . '/js/plugins.js', array('jquery'), null, true);
        wp_enqueue_script ('js-scripts', get_stylesheet_directory_uri() . '/js/scripts.js', array('jquery'), null, true);

		if(is_singular())
			wp_enqueue_script('comment-reply');
    };
add_action ('after_setup_theme', 'gut_styles');

function gut_styles(){
	add_theme_support('editor-styles');
	add_editor_style('css/style-gutenberg.css');
}

register_nav_menus(array(
        'head_menu' => 'Главное меню'
));
add_theme_support('post-thumbnails');
add_image_size ('bigpic', 888, 578, true);
add_image_size ('mediumpic', 425,324, true);
add_image_size ('smallpic', 88, 69, true);

add_action('widgets_init', 'themewidget');

function themewidget(){
	register_sidebar(
		array(
			'id' => 'sideside',
			'name' => 'Сайдбар',
			'description' => 'Сюда добавляем виджеты',
			'before_widget' => '<div class="widget">',
			'after_widget' => '</div>',
			'before_title' => '<div class="heading-lines">
			<h3 class="widget-title heading">',
			'after_title' => '</h3></div>'
		)
		);

	unregister_widget('WP_Widget_Search');
	unregister_widget('WP_Widget_Recent_Posts');
	unregister_widget('WP_Widget_Categories');
}
    class Site_Nav extends Walker_Nav_menu{
        public function start_lvl( &$output, $depth = 0, $args = null ) {
            if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
                $t = '';
                $n = '';
            } else {
                $t = "\t";
                $n = "\n";
            }
            $indent = str_repeat( $t, $depth );
    
            // Default class.
            $classes = array( 'dropdown-menu' );
    
            /**
             * Filters the CSS class(es) applied to a menu list element.
             *
             * @since 4.8.0
             *
             * @param string[] $classes Array of the CSS classes that are applied to the menu `<ul>` element.
             * @param stdClass $args    An object of `wp_nav_menu()` arguments.
             * @param int      $depth   Depth of menu item. Used for padding.
             */
            $class_names = implode( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
            $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
    
            $output .= "{$n}{$indent}<ul$class_names>{$n}";
        }
        /**
	 * Starts the element output.
	 *
	 * @since 3.0.0
	 * @since 4.4.0 The {@see 'nav_menu_item_args'} filter was added.
	 * @since 5.9.0 Renamed `$item` to `$data_object` and `$id` to `$current_object_id`
	 *              to match parent class for PHP 8 named parameter support.
	 *
	 * @see Walker::start_el()
	 *
	 * @param string   $output            Used to append additional content (passed by reference).
	 * @param WP_Post  $data_object       Menu item data object.
	 * @param int      $depth             Depth of menu item. Used for padding.
	 * @param stdClass $args              An object of wp_nav_menu() arguments.
	 * @param int      $current_object_id Optional. ID of the current menu item. Default 0.
	 */
	public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
		// Restores the more descriptive, specific name for use within this method.
		$menu_item = $data_object;

		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

		$classes   = empty( $menu_item->classes ) ? array() : (array) $menu_item->classes;
        if(in_array('menu-item-has-children', $classes)[
            $classes[] = 'dropdown'
        ]);
        
		// $classes[] = 'menu-item-' . $menu_item->ID;

		/**
		 * Filters the arguments for a single nav menu item.
		 *
		 * @since 4.4.0
		 *
		 * @param stdClass $args      An object of wp_nav_menu() arguments.
		 * @param WP_Post  $menu_item Menu item data object.
		 * @param int      $depth     Depth of menu item. Used for padding.
		 */
		$args = apply_filters( 'nav_menu_item_args', $args, $menu_item, $depth );

		/**
		 * Filters the CSS classes applied to a menu item's list item element.
		 *
		 * @since 3.0.0
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param string[] $classes   Array of the CSS classes that are applied to the menu item's `<li>` element.
		 * @param WP_Post  $menu_item The current menu item object.
		 * @param stdClass $args      An object of wp_nav_menu() arguments.
		 * @param int      $depth     Depth of menu item. Used for padding.
		 */
		$class_names = implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $menu_item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		/**
		 * Filters the ID attribute applied to a menu item's list item element.
		 *
		 * @since 3.0.1
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param string   $menu_item_id The ID attribute applied to the menu item's `<li>` element.
		 * @param WP_Post  $menu_item    The current menu item.
		 * @param stdClass $args         An object of wp_nav_menu() arguments.
		 * @param int      $depth        Depth of menu item. Used for padding.
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $menu_item->ID, $menu_item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names . '>';

		$atts           = array();
		$atts['title']  = ! empty( $menu_item->attr_title ) ? $menu_item->attr_title : '';
		$atts['target'] = ! empty( $menu_item->target ) ? $menu_item->target : '';
		if ( '_blank' === $menu_item->target && empty( $menu_item->xfn ) ) {
			$atts['rel'] = 'noopener';
		} else {
			$atts['rel'] = $menu_item->xfn;
		}
		$atts['href']         = ! empty( $menu_item->url ) ? $menu_item->url : '';
		$atts['aria-current'] = $menu_item->current ? 'page' : '';

		/**
		 * Filters the HTML attributes applied to a menu item's anchor element.
		 *
		 * @since 3.6.0
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param array $atts {
		 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
		 *
		 *     @type string $title        Title attribute.
		 *     @type string $target       Target attribute.
		 *     @type string $rel          The rel attribute.
		 *     @type string $href         The href attribute.
		 *     @type string $aria-current The aria-current attribute.
		 * }
		 * @param WP_Post  $menu_item The current menu item object.
		 * @param stdClass $args      An object of wp_nav_menu() arguments.
		 * @param int      $depth     Depth of menu item. Used for padding.
		 */
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $menu_item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( is_scalar( $value ) && '' !== $value && false !== $value ) {
				$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		/** This filter is documented in wp-includes/post-template.php */
		$title = apply_filters( 'the_title', $menu_item->title, $menu_item->ID );

		/**
		 * Filters a menu item's title.
		 *
		 * @since 4.4.0
		 *
		 * @param string   $title     The menu item's title.
		 * @param WP_Post  $menu_item The current menu item object.
		 * @param stdClass $args      An object of wp_nav_menu() arguments.
		 * @param int      $depth     Depth of menu item. Used for padding.
		 */
		$title = apply_filters( 'nav_menu_item_title', $title, $menu_item, $args, $depth );

		$item_output  = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . $title . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		/**
		 * Filters a menu item's starting output.
		 *
		 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
		 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
		 * no filter for modifying the opening and closing `<li>` for a menu item.
		 *
		 * @since 3.0.0
		 *
		 * @param string   $item_output The menu item's starting HTML output.
		 * @param WP_Post  $menu_item   Menu item data object.
		 * @param int      $depth       Depth of menu item. Used for padding.
		 * @param stdClass $args        An object of wp_nav_menu() arguments.
		 */
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $menu_item, $depth, $args );
	}

    }

	function theme_add_contacts($contactmethods){
		$contactmethods['instagram'] = 'Instagram profile';
		$contactmethods['facebook'] = 'Fb profile';
		$contactmethods['twitter'] = 'twitter profile';
		$contactmethods['pinterest'] = 'pinterest profile';
		return $contactmethods;
	}

	add_filter('user_contactmethods', 'theme_add_contacts', 10, 1);

	function theme_comment($comment, $args, $depth ){
		// <li>
		// <div class="comment-body">
		//   <img src="img/comment_1.jpg" class="comment-avatar" alt="">
		//   <div class="comment-content">
		// 	<span class="comment-author">Александр</span>
		// 	<span class="comment-date">20 января 2020 в 20:20</span>
		// 	<p>Подскажите пожалуйста, мой код не вставляется!</p>
		// 	<a href="#">Ответить</a>
		//   </div>
		// </div>
		// </li> 
		?><li <?php comment_class() ?> id="comment-<?php comment_ID() ?>">
			<div class="comment-body">
				<?php echo get_avatar($comment, 70, '', '', array('class'=>'comment-avatar')) ?>
				<div class="comment-content">
					<span class="comment-author"><?php comment_author() ?></span>
					<span class="comment-date"><?php comment_date('j F Y в H:i')?></span>
					<?php comment_text() ?>
					<?php comment_reply_link( array_merge(
						$args,
						array(
							'depth' => $depth,
							'max_depth' => $args['max_depth']
						)
					) );?>
				</div>
			</div>
		<?php //без закрывающего тега </li>

	}

	/*
 * $num число, от которого будет зависеть форма слова
 * $form_for_1 первая форма слова, например Товар
 * $form_for_2 вторая форма слова - Товара
 * $form_for_5 третья форма множественного числа слова - Товаров
 */
function true_wordform($num, $form_for_1, $form_for_2, $form_for_5){
	$num = abs($num) % 100; // берем число по модулю и сбрасываем сотни (делим на 100, а остаток присваиваем переменной $num)
	$num_x = $num % 10; // сбрасываем десятки и записываем в новую переменную
	if ($num > 10 && $num < 20) // если число принадлежит отрезку [11;19]
		return $form_for_5;
	if ($num_x > 1 && $num_x < 5) // иначе если число оканчивается на 2,3,4
		return $form_for_2;
	if ($num_x == 1) // иначе если оканчивается на 1
		return $form_for_1;
	return $form_for_5;
}