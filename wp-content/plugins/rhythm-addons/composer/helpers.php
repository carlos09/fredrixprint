<?php

/**
 *
 * Get El Icons
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( !function_exists('rs_el_icons')) {
  function rs_el_icons() {
    $el_icons = array('icon-mobile','icon-laptop','icon-desktop','icon-tablet','icon-phone','icon-document','icon-documents','icon-search','icon-clipboard','icon-newspaper','icon-notebook','icon-book-open','icon-browser','icon-calendar','icon-presentation','icon-picture','icon-pictures','icon-video','icon-camera','icon-printer','icon-toolbox','icon-briefcase','icon-wallet','icon-gift','icon-bargraph','icon-grid','icon-expand','icon-focus','icon-edit','icon-adjustments','icon-ribbon','icon-hourglass','icon-lock','icon-megaphone','icon-shield','icon-trophy','icon-flag','icon-map','icon-puzzle','icon-basket','icon-envelope','icon-streetsign','icon-telescope','icon-gears','icon-key','icon-paperclip','icon-attachment','icon-pricetags','icon-lightbulb','icon-layers','icon-pencil','icon-tools','icon-tools-2','icon-scissors','icon-paintbrush','icon-magnifying-glass','icon-circle-compass','icon-linegraph','icon-mic','icon-strategy','icon-beaker','icon-caution','icon-recycle','icon-anchor','icon-profile-male','icon-profile-female','icon-bike','icon-wine','icon-hotairballoon','icon-globe','icon-genius','icon-map-pin','icon-dial','icon-chat','icon-heart','icon-cloud','icon-upload','icon-download','icon-target','icon-hazardous','icon-piechart','icon-speedometer','icon-global','icon-compass','icon-lifesaver','icon-clock','icon-aperture','icon-quote','icon-scope','icon-alarmclock','icon-refresh','icon-happy','icon-sad','icon-facebook','icon-twitter','icon-googleplus','icon-rss','icon-tumblr','icon-linkedin','icon-dribbble');
    return array_combine($el_icons, $el_icons);
  }
}

/**
 *
 * Hex to Rgba
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'rs_hex2rgba' ) ) {
  function rs_hex2rgba( $hexcolor, $opacity = 1 ) {

    $hex    = str_replace( '#', '', $hexcolor );

    if( strlen( $hex ) == 3 ) {
      $r    = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
      $g    = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
      $b    = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
    } else {
      $r    = hexdec( substr( $hex, 0, 2 ) );
      $g    = hexdec( substr( $hex, 2, 2 ) );
      $b    = hexdec( substr( $hex, 4, 2 ) );
    }

    return ( isset( $opacity ) && $opacity != 1 ) ? 'rgba('. $r .', '. $g .', '. $b .', '. $opacity .')' : ' ' . $hexcolor;
  }
}

/**
 *
 * Get Fontawesome Icons
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( !function_exists('rs_fontawesome_icons')) {
  function rs_fontawesome_icons() {
    $icons = array('fa fa-adjust','fa fa-adn','fa fa-align-center','fa fa-align-justify','fa fa-align-left','fa fa-align-right','fa fa-ambulance','fa fa-anchor','fa fa-android','fa fa-angellist','fa fa-angle-double-down','fa fa-angle-double-left','fa fa-angle-double-right','fa fa-angle-double-up','fa fa-angle-down','fa fa-angle-left','fa fa-angle-right','fa fa-angle-up','fa fa-apple','fa fa-archive','fa fa-area-chart','fa fa-arrow-circle-down','fa fa-arrow-circle-left','fa fa-arrow-circle-o-down','fa fa-arrow-circle-o-left','fa fa-arrow-circle-o-right','fa fa-arrow-circle-o-up','fa fa-arrow-circle-right','fa fa-arrow-circle-up','fa fa-arrow-down','fa fa-arrow-left','fa fa-arrow-right','fa fa-arrow-up','fa fa-arrows','fa fa-arrows-alt','fa fa-arrows-h','fa fa-arrows-v','fa fa-asterisk','fa fa-at','fa fa-automobile','fa fa-backward','fa fa-ban','fa fa-bank','fa fa-bar-chart','fa fa-bar-chart-o','fa fa-barcode','fa fa-bars','fa fa-beer','fa fa-behance','fa fa-behance-square','fa fa-bell','fa fa-bell-o','fa fa-bell-slash','fa fa-bell-slash-o','fa fa-bicycle','fa fa-binoculars','fa fa-birthday-cake','fa fa-bitbucket','fa fa-bitbucket-square','fa fa-bitcoin','fa fa-bold','fa fa-bolt','fa fa-bomb','fa fa-book','fa fa-bookmark','fa fa-bookmark-o','fa fa-briefcase','fa fa-btc','fa fa-bug','fa fa-building','fa fa-building-o','fa fa-bullhorn','fa fa-bullseye','fa fa-bus','fa fa-cab','fa fa-calculator','fa fa-calendar','fa fa-calendar-o','fa fa-camera','fa fa-camera-retro','fa fa-car','fa fa-caret-down','fa fa-caret-left','fa fa-caret-right','fa fa-caret-square-o-down','fa fa-caret-square-o-left','fa fa-caret-square-o-right','fa fa-caret-square-o-up','fa fa-caret-up','fa fa-cc','fa fa-cc-amex','fa fa-cc-discover','fa fa-cc-mastercard','fa fa-cc-paypal','fa fa-cc-stripe','fa fa-cc-visa','fa fa-certificate','fa fa-chain','fa fa-chain-broken','fa fa-check','fa fa-check-circle','fa fa-check-circle-o','fa fa-check-square','fa fa-check-square-o','fa fa-chevron-circle-down','fa fa-chevron-circle-left','fa fa-chevron-circle-right','fa fa-chevron-circle-up','fa fa-chevron-down','fa fa-chevron-left','fa fa-chevron-right','fa fa-chevron-up','fa fa-child','fa fa-circle','fa fa-circle-o','fa fa-circle-o-notch','fa fa-circle-thin','fa fa-clipboard','fa fa-clock-o','fa fa-close','fa fa-cloud','fa fa-cloud-download','fa fa-cloud-upload','fa fa-cny','fa fa-code','fa fa-code-fork','fa fa-codepen','fa fa-coffee','fa fa-cog','fa fa-cogs','fa fa-columns','fa fa-comment','fa fa-comment-o','fa fa-comments','fa fa-comments-o','fa fa-compass','fa fa-compress','fa fa-copy','fa fa-copyright','fa fa-credit-card','fa fa-crop','fa fa-crosshairs','fa fa-css3','fa fa-cube','fa fa-cubes','fa fa-cut','fa fa-cutlery','fa fa-dashboard','fa fa-database','fa fa-dedent','fa fa-delicious','fa fa-desktop','fa fa-deviantart','fa fa-digg','fa fa-dollar','fa fa-dot-circle-o','fa fa-download','fa fa-dribbble','fa fa-dropbox','fa fa-drupal','fa fa-edit','fa fa-eject','fa fa-ellipsis-h','fa fa-ellipsis-v','fa fa-empire','fa fa-envelope','fa fa-envelope-o','fa fa-envelope-square','fa fa-eraser','fa fa-eur','fa fa-euro','fa fa-exchange','fa fa-exclamation','fa fa-exclamation-circle','fa fa-exclamation-triangle','fa fa-expand','fa fa-external-link','fa fa-external-link-square','fa fa-eye','fa fa-eye-slash','fa fa-eyedropper','fa fa-facebook','fa fa-facebook-square','fa fa-fast-backward','fa fa-fast-forward','fa fa-fax','fa fa-female','fa fa-fighter-jet','fa fa-file','fa fa-file-archive-o','fa fa-file-audio-o','fa fa-file-code-o','fa fa-file-excel-o','fa fa-file-image-o','fa fa-file-movie-o','fa fa-file-o','fa fa-file-pdf-o','fa fa-file-photo-o','fa fa-file-picture-o','fa fa-file-powerpoint-o','fa fa-file-sound-o','fa fa-file-text','fa fa-file-text-o','fa fa-file-video-o','fa fa-file-word-o','fa fa-file-zip-o','fa fa-files-o','fa fa-film','fa fa-filter','fa fa-fire','fa fa-fire-extinguisher','fa fa-flag','fa fa-flag-checkered','fa fa-flag-o','fa fa-flash','fa fa-flask','fa fa-flickr','fa fa-floppy-o','fa fa-folder','fa fa-folder-o','fa fa-folder-open','fa fa-folder-open-o','fa fa-font','fa fa-forward','fa fa-foursquare','fa fa-frown-o','fa fa-futbol-o','fa fa-gamepad','fa fa-gavel','fa fa-gbp','fa fa-ge','fa fa-gear','fa fa-gears','fa fa-gift','fa fa-git','fa fa-git-square','fa fa-github','fa fa-github-alt','fa fa-github-square','fa fa-gittip','fa fa-glass','fa fa-globe','fa fa-google','fa fa-google-plus','fa fa-google-plus-square','fa fa-google-wallet','fa fa-graduation-cap','fa fa-group','fa fa-h-square','fa fa-hacker-news','fa fa-hand-o-down','fa fa-hand-o-left','fa fa-hand-o-right','fa fa-hand-o-up','fa fa-hdd-o','fa fa-header','fa fa-headphones','fa fa-heart','fa fa-heart-o','fa fa-history','fa fa-home','fa fa-hospital-o','fa fa-html5','fa fa-ils','fa fa-image','fa fa-inbox','fa fa-indent','fa fa-info','fa fa-info-circle','fa fa-inr','fa fa-instagram','fa fa-institution','fa fa-ioxhost','fa fa-italic','fa fa-joomla','fa fa-jpy','fa fa-jsfiddle','fa fa-key','fa fa-keyboard-o','fa fa-krw','fa fa-language','fa fa-laptop','fa fa-lastfm','fa fa-lastfm-square','fa fa-leaf','fa fa-legal','fa fa-lemon-o','fa fa-level-down','fa fa-level-up','fa fa-life-bouy','fa fa-life-buoy','fa fa-life-ring','fa fa-life-saver','fa fa-lightbulb-o','fa fa-line-chart','fa fa-link','fa fa-linkedin','fa fa-linkedin-square','fa fa-linux','fa fa-list','fa fa-list-alt','fa fa-list-ol','fa fa-list-ul','fa fa-location-arrow','fa fa-lock','fa fa-long-arrow-down','fa fa-long-arrow-left','fa fa-long-arrow-right','fa fa-long-arrow-up','fa fa-magic','fa fa-magnet','fa fa-mail-forward','fa fa-mail-reply','fa fa-mail-reply-all','fa fa-male','fa fa-map-marker','fa fa-maxcdn','fa fa-meanpath','fa fa-medkit','fa fa-meh-o','fa fa-microphone','fa fa-microphone-slash','fa fa-minus','fa fa-minus-circle','fa fa-minus-square','fa fa-minus-square-o','fa fa-mobile','fa fa-mobile-phone','fa fa-money','fa fa-moon-o','fa fa-mortar-board','fa fa-music','fa fa-navicon','fa fa-newspaper-o','fa fa-openid','fa fa-outdent','fa fa-pagelines','fa fa-paint-brush','fa fa-paper-plane','fa fa-paper-plane-o','fa fa-paperclip','fa fa-paragraph','fa fa-paste','fa fa-pause','fa fa-paw','fa fa-paypal','fa fa-pencil','fa fa-pencil-square','fa fa-pencil-square-o','fa fa-phone','fa fa-phone-square','fa fa-photo','fa fa-picture-o','fa fa-pie-chart','fa fa-pied-piper','fa fa-pied-piper-alt','fa fa-pinterest','fa fa-pinterest-square','fa fa-plane','fa fa-play','fa fa-play-circle','fa fa-play-circle-o','fa fa-plug','fa fa-plus','fa fa-plus-circle','fa fa-plus-square','fa fa-plus-square-o','fa fa-power-off','fa fa-print','fa fa-puzzle-piece','fa fa-qq','fa fa-qrcode','fa fa-question','fa fa-question-circle','fa fa-quote-left','fa fa-quote-right','fa fa-ra','fa fa-random','fa fa-rebel','fa fa-recycle','fa fa-reddit','fa fa-reddit-square','fa fa-refresh','fa fa-remove','fa fa-renren','fa fa-reorder','fa fa-repeat','fa fa-reply','fa fa-reply-all','fa fa-retweet','fa fa-rmb','fa fa-road','fa fa-rocket','fa fa-rotate-left','fa fa-rotate-right','fa fa-rouble','fa fa-rss','fa fa-rss-square','fa fa-rub','fa fa-ruble','fa fa-rupee','fa fa-save','fa fa-scissors','fa fa-search','fa fa-search-minus','fa fa-search-plus','fa fa-send','fa fa-send-o','fa fa-share','fa fa-share-alt','fa fa-share-alt-square','fa fa-share-square','fa fa-share-square-o','fa fa-shekel','fa fa-sheqel','fa fa-shield','fa fa-shopping-cart','fa fa-sign-in','fa fa-sign-out','fa fa-signal','fa fa-sitemap','fa fa-skype','fa fa-slack','fa fa-sliders','fa fa-slideshare','fa fa-smile-o','fa fa-soccer-ball-o','fa fa-sort','fa fa-sort-alpha-asc','fa fa-sort-alpha-desc','fa fa-sort-amount-asc','fa fa-sort-amount-desc','fa fa-sort-asc','fa fa-sort-desc','fa fa-sort-down','fa fa-sort-numeric-asc','fa fa-sort-numeric-desc','fa fa-sort-up','fa fa-soundcloud','fa fa-space-shuttle','fa fa-spinner','fa fa-spoon','fa fa-spotify','fa fa-square','fa fa-square-o','fa fa-stack-exchange','fa fa-stack-overflow','fa fa-star','fa fa-star-half','fa fa-star-half-empty','fa fa-star-half-full','fa fa-star-half-o','fa fa-star-o','fa fa-steam','fa fa-steam-square','fa fa-step-backward','fa fa-step-forward','fa fa-stethoscope','fa fa-stop','fa fa-strikethrough','fa fa-stumbleupon','fa fa-stumbleupon-circle','fa fa-subscript','fa fa-suitcase','fa fa-sun-o','fa fa-superscript','fa fa-support','fa fa-table','fa fa-tablet','fa fa-tachometer','fa fa-tag','fa fa-tags','fa fa-tasks','fa fa-taxi','fa fa-tencent-weibo','fa fa-terminal','fa fa-text-height','fa fa-text-width','fa fa-th','fa fa-th-large','fa fa-th-list','fa fa-thumb-tack','fa fa-thumbs-down','fa fa-thumbs-o-down','fa fa-thumbs-o-up','fa fa-thumbs-up','fa fa-ticket','fa fa-times','fa fa-times-circle','fa fa-times-circle-o','fa fa-tint','fa fa-toggle-down','fa fa-toggle-left','fa fa-toggle-off','fa fa-toggle-on','fa fa-toggle-right','fa fa-toggle-up','fa fa-trash','fa fa-trash-o','fa fa-tree','fa fa-trello','fa fa-trophy','fa fa-truck','fa fa-try','fa fa-tty','fa fa-tumblr','fa fa-tumblr-square','fa fa-turkish-lira','fa fa-twitch','fa fa-twitter','fa fa-twitter-square','fa fa-umbrella','fa fa-underline','fa fa-undo','fa fa-university','fa fa-unlink','fa fa-unlock','fa fa-unlock-alt','fa fa-unsorted','fa fa-upload','fa fa-usd','fa fa-user','fa fa-user-md','fa fa-users','fa fa-video-camera','fa fa-vimeo-square','fa fa-vine','fa fa-vk','fa fa-volume-down','fa fa-volume-off','fa fa-volume-up','fa fa-warning','fa fa-wechat','fa fa-weibo','fa fa-weixin','fa fa-wheelchair','fa fa-wifi','fa fa-windows','fa fa-won','fa fa-wordpress','fa fa-wrench','fa fa-xing','fa fa-xing-square','fa fa-yahoo','fa fa-yelp','fa fa-yen','fa fa-youtube','fa fa-youtube-play','fa fa-youtube-square');
    return array_combine($icons, $icons);
  }
}

/**
 *
 * Walker Category
 * @since 1.0.0
 * @version 1.1.0
 *
 */
class Walker_Portfolio_List_Categories extends Walker_Category {

  function start_el( &$output, $category, $depth = 0, $args = array(), $current_object_id = 0 ) {

    $has_children = get_term_children( $category->term_id, 'portfolio-category' );

    if( empty( $has_children ) ) {
      $cat_name = esc_attr( $category->name );
      $cat_name = apply_filters( 'list_cats', $cat_name, $category );
      $link     = '<a href="#" class="filter" data-filter=".'. strtolower( $category->slug ) .'">';
      $link    .= $cat_name;
      $link    .= '</a>';
      $output  .= $link;
    }

  }

  function end_el( &$output, $page, $depth = 0, $args = array() ) {}

}

/**
 *
 * Set WPAUTOP for shortcode output
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'rs_set_wpautop' ) ) {
  function rs_set_wpautop( $content, $force = true ) {
    if ( $force ) {
      $content = wpautop( preg_replace( '/<\/?p\>/', "\n", $content ) . "\n" );
    }
    return do_shortcode( shortcode_unautop( $content ) );
  }
}

/**
 *
 * element values post, page, categories
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'rs_element_values' ) ) {
  function rs_element_values(  $type = '', $query_args = array() ) {

    $options = array();

    switch( $type ) {

      case 'pages':
      case 'page':
      $pages = get_pages( $query_args );

      if ( !empty($pages) ) {
        foreach ( $pages as $page ) {
          $options[$page->post_title] = $page->ID;
        }
      }
      break;

      case 'posts':
      case 'post':
      $posts = get_posts( $query_args );

      if ( !empty($posts) ) {
        foreach ( $posts as $post ) {
          $options[$post->post_title] = lcfirst($post->post_title);
        }
      }
      break;

      case 'tags':
      case 'tag':

      $tags = get_terms( $query_args['taxonomies'], $query_args['args'] );
        if ( !empty($tags) ) {
          foreach ( $tags as $tag ) {
            $options[$tag->name] = $tag->term_id;
        }
      }
      break;

      case 'categories':
      case 'category':

      $categories = get_categories( $query_args );
      if ( !empty($categories) ) {
        foreach ( $categories as $category ) {
          $options[$category->name] = $category->term_id;
        }
      }
      break;

      case 'custom':
      case 'callback':

      if( is_callable( $query_args['function'] ) ) {
        $options = call_user_func( $query_args['function'], $query_args['args'] );
      }

      break;

    }

    return $options;

  }
}

/**
 *
 * Animations
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'rs_get_animations' ) ) {
  function rs_get_animations() {

    $animations = array(
      '',
      'fadeIn',
      'fadeInLeft',
      'fadeInRight',
      'fadeInUp',
      'fadeInDown',
      'bounce',
      'flash',
      'pulse',
      'shake',
      'swing',
      'tada',
      'wobble',
      'bounceIn',
      'bounceInLeft',
      'bounceInRight',
      'bounceInUp',
      'bounceInDown',
    );

    $animations = apply_filters( 'rs_animations', $animations );
    return $animations;

  }
}

/**
 *
 * Get Bootstrap Col
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'rs_get_bootstrap_col' ) ) {
  function rs_get_bootstrap_col( $width = '' ) {
    $width = explode('/', $width);
    $width = ( $width[0] != '1' ) ? $width[0] * floor(12 / $width[1]) : floor(12 / $width[1]);
    return  $width;
  }
}

/**
 * Get font choices for theme options
 * @param bool $return_string if true returned array is strict, example array item: font_name => font_label
 * @return array
 */
if(!function_exists('rs_get_font_choices')) {
  function rs_get_font_choices($return_strict = false) {
    $aFonts = array(
      array(
        'value' => 'default',
        'label' => __('Default', 'rhythm-addons'),
        'src' => ''
      ),
      array(
        'value' => 'Verdana',
        'label' => 'Verdana',
        'src' => ''
      ),
      array(
        'value' => 'Geneva',
        'label' => 'Geneva',
        'src' => ''
      ),
      array(
        'value' => 'Arial',
        'label' => 'Arial',
        'src' => ''
      ),
      array(
        'value' => 'Arial Black',
        'label' => 'Arial Black',
        'src' => ''
      ),
      array(
        'value' => 'Trebuchet MS',
        'label' => 'Trebuchet MS',
        'src' => ''
      ),
      array(
        'value' => 'Helvetica',
        'label' => 'Helvetica',
        'src' => ''
      ),
      array(
        'value' => 'sans-serif',
        'label' => 'sans-serif',
        'src' => ''
      ),
      array(
        'value' => 'Georgia',
        'label' => 'Georgia',
        'src' => ''
      ),
      array(
        'value' => 'Times New Roman',
        'label' => 'Times New Roman',
        'src' => ''
      ),
      array(
        'value' => 'Times',
        'label' => 'Times',
        'src' => ''
      ),
      array(
        'value' => 'serif',
        'label' => 'serif',
        'src' => ''
      ),
      array(
        'value' => 'Nella Sue',
        'label' => 'Nella Sue',
        'src' => ''
      )
    );

    if (file_exists(RS_ROOT . '/composer/google-fonts.json')) {

      //ts_load_filesystem();
      //WP_Filesystem();
      //global $wp_filesystem;

      //$google_fonts = $wp_filesystem->get_contents(get_template_directory() . '/framework/fonts/google-fonts.json');
      $google_fonts = file_get_contents(RS_ROOT . '/composer/google-fonts.json', true);
      $aGoogleFonts = json_decode($google_fonts, true);

      if (!isset($aGoogleFonts['items']) || !is_array($aGoogleFonts['items'])) {
        return;
      }

      $aFonts[] = array(
        'value' => 'google_web_fonts',
        'label' => '---Google Web Fonts---',
        'src' => ''
      );

      foreach ($aGoogleFonts['items'] as $aGoogleFont) {
        $aFonts[] = array(
          'value' => 'google_web_font_' . $aGoogleFont['family'],
          'label' => $aGoogleFont['family'],
          'src' => ''
        );
      }
    }

    if ($return_strict) {
      $aFonts2 = array();
      foreach ($aFonts as $font) {
        $aFonts2[$font['value']] = $font['label'];
      }
      return $aFonts2;
    }
    return $aFonts;
  }
}

/**
 * Get custom term values array
 * @param type $type
 * @return type
 */
function rs_get_custom_term_values($type) {

	$items = array();
	$terms = get_terms($type, array('orderby' => 'name'));
	if (is_array($terms) && !is_wp_error($terms)) {
		foreach ($terms as $term) {
			$items[$term -> name] = $term -> term_id;
		}
	}
	return $items;
}
