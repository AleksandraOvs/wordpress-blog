<!DOCTYPE html>
<html <?php language_attributes() ?>>
<head>
  <title><?php echo wp_get_document_title() ?></title>

  <meta charset="<?php bloginfo('chrset') ?>">
  <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="description" content="">

<?php wp_head() ?>
</head>

<body class="relative">

  <!-- Preloader -->
  <div class="loader-mask">
    <div class="loader">
      <div></div>
      <div></div>
    </div>
  </div>

  <div class="main-wrapper oh">

    <header class="nav-type-1 dark-nav">

      <!-- Fullscreen search -->
      <div class="search-wrap">
        <div class="search-inner">
          <div class="search-cell">
            <form method="get" action="<?php echo site_url() ?>">
              <div class="search-field-holder">
                <input type="search" name="s" class="form-control main-search-input" placeholder="Найти что-то...">
                <div class="search-submit-icon"><i class="icon icon_search"></i></div>
                <input type="submit" class="search-submit" value="search">
              </div>
            </form>
          </div>
        </div>
        <i class="icon icon_close search-close" id="search-close"></i>
      </div> <!-- end fullscreen search -->

      <nav class="navbar navbar-fixed-top">
        <div class="navigation">
          <div class="container relative">

            <div class="row">

              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                  <span class="sr-only">Навигация</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
              </div> <!-- end navbar-header -->
              <!-- side menu -->
              <div class="side-menu nav-left hidden-sm hidden-xs">
								<div class="nav-inner">
                    <a href="#" class="logo">Курс Миши</a>
                </div>
              </div> <!-- end side menu -->

              <div class="col-md-12 nav-wrap">
                <div class="collapse navbar-collapse text-center" id="navbar-collapse">
                <?php
                if (has_nav_menu('head_menu')){
                    $mobile_search = '<li id="mobile-search" class="hidden-lg hidden-md">
                    <form method="get" class="mobile-search" action="'. site_url() .'">
                      <input type="search" name="s" class="form-control" placeholder="Search...">
                      <button type="submit" class="search-button">
                        <i class="icon icon_search"></i>
                      </button>
                    </form>
                  </li>';
                wp_nav_menu(array(
                    'theme_location' => 'head_menu',
                    'container' => false,
                    'menu_class' => 'nav navbar-nav',
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s' . $mobile_search . '</ul>',
                    'depth' => 2,
                    'walker' => new Site_Nav()

                ));
            }
                ?>
                </div> <!-- end collapse -->
              </div> <!-- end col -->

              <!-- side menu -->
              <div class="side-menu right mobile-left-align">
								<div class="nav-inner">
                  <div class="nav-search-wrap hidden-sm hidden-xs right">
                    <a href="#" class="nav-search search-trigger">
                      <i class="icon icon_search"></i>
                    </a>
                  </div>
                </div>
              </div> <!-- end side menu -->

            </div> <!-- end row -->
          </div> <!-- end container -->
        </div> <!-- end navigation -->
      </nav> <!-- end navbar -->
    </header>


