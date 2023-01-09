<?php get_header() ?>
    
    <div class="content-wrapper oh">

      <!-- Content -->
      <section class="content blog-standard">
        <div class="container relative">
          <div class="row">
            <!-- grid posts -->
            <div class="col-md-9 post-content mb-50">
            <?php if (is_search() ): ?>
                <div class="category-description">
                    <h1>Результаты поиска по запросу: &laquo;<?php the_search_query()?>&raquo;</h1>
                </div>
            <?php endif; ?>
              <?php if(have_posts()) : ?>
              <?php 
              $count = 1;
              while(have_posts() ) : the_post();

                if (is_sticky()){
                    get_template_part('entry', 'large');
                }else {
                    if ($count ==1 ){
                        echo '<div class="row items-grid">';
                    }
                    get_template_part('entry');
                    $count++;
                }

            //   if ($count == 1){
            //       get_template_part('entry', 'large');
            //       echo '<div class="row items-grid">';
            //   }else {
            //     get_template_part('entry');
            //   }

            //   $count++;

            endwhile;
            if ($count > 1) {
                echo '</div>';
            }
            ?>

              <div class="row mt-20">
                <div class="col-md-12 text-center pagination">
                  <?php
                      echo paginate_links(array(
                          'prev_next' => true,
                          'prev_text' => __('<i class="icon arrow_carrot-left"></i>>'),
                          'next_text' => __('<i class="icon arrow_carrot-right"></i>>'),
                      ));
                  ?>

                </div>
              </div>
                    <?php else: ?>
                        <p>По вашему запросу ничего не найдено</p>
                      <?php endif; ?>
            </div> <!-- end col -->
            <?php get_sidebar() ?>

          </div> <!-- end row -->
        </div> <!-- end container -->
      </section> <!-- end content -->

      <?php get_footer() ?>