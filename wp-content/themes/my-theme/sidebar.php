
            <!-- Sidebar -->
            <aside class="col-md-3 sidebar">
            
            <?php if( is_active_sidebar('sideside')) dynamic_sidebar('sideside') ?>


              <!-- Search -->
              <div class="widget">
                <div class="heading-lines">
                  <h3 class="widget-title heading">Поиск по сайту</h3>
                </div>
                <form action="<?php echo site_url()?>" class="relative">
                  <input name="s" type="text" placeholder="Что ищем?">
                </form>
                <input type="submit" value="Искать" id="submit-button" class="btn btn-lg btn-color">
              </div>
            <?php if($categories = get_categories() ) : ?>
              <!-- Categories -->
              <div class="widget categories">
                <div class="heading-lines">
                  <h3 class="widget-title heading">Рубрики</h3>
                </div>
                <ul class="list-dividers">
                <?php foreach ($categories as $category) :?>  
                    <li>
                    <a href="<?php echo get_category_link($category) ?>"><?php echo $category->name?></a><span><?php echo $category->count ?></span>
                  </li>
                <?php endforeach; ?>
                </ul>
              </div>
            <?php endif; ?>
              <!-- Ad banner -->
              <div class="widget custom-ad-banner">
                <a href="#">
                  <img src="<?php echo get_stylesheet_directory_uri() ?>/img/banner.jpg" alt="">
                </a>
              </div>
            

                <?php
                $args = array(
                    'posts_per_page' => 4,
                    'ignore_sticky_posts' => true
                );
                $query = new WP_Query( $args );

                if ($query->have_posts() ): //если посты найдены
                ?>
              <!-- Recent Posts -->
              <div class="widget recent-posts">
                <div class="heading-lines">
                  <h3 class="widget-title heading">Свежее на блоге</h3>
                </div>
                <div class="entry-list w-thumbs">
                  <ul class="posts-list list-dividers">
                    <?php while ($query->have_posts() ): $query->the_post(); ?>
                    <li class="entry-li">
                      <article class="post-small clearfix">
                        <div class="entry-img">
                          <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('smallpic') ?>
                          </a>
                        </div>
                        <div class="entry">
                          <h3 class="entry-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
                          <ul class="entry-meta list-inline">
                            <li class="entry-date">
                              <a href="#"><?php the_time('j F Y') ?></a>
                            </li>
                          </ul>
                        </div>
                      </article>
                    </li>
                    <?php endwhile; ?>
                  </ul>
                </div>
              </div>
            <?php endif;
            wp_reset_postdata(); ?>
            </aside> <!-- end sidebar -->