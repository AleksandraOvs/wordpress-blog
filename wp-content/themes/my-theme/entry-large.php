              <!-- large post -->
              <article <?php post_class('entry-item large-post') ?>>

              <div class="entry-header">
                <div class="entry-category"><?php the_category(', ');?></div>
                <h2 class="entry-title">
                  <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                </h2>
              </div>
              
           
              <?php if(has_post_thumbnail()) : ?>
                <div class="entry-img">
                  <a href="<?php the_permalink() ?>">
                  <?php the_post_thumbnail('bigpic'); ?>
                  </a>
                </div>
                <?php endif; ?>
                <div class="entry-wrap">
                  <div class="entry">

                    <div class="entry-content">
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Aliquet nec ullamcorper sit amet risus. Posuere lorem ipsum dolor sit amet consectetur adipiscing. Diam sit amet nisl suscipit adipiscing bibendum est...
                      </p>
                      <div class="text-center">
                        <a href="blog-single.html" class="read-more underline-link">Читать далее</a>
                      </div>
                    </div>

                    <div class="entry-meta-wrap clearfix">
                      <ul class="entry-meta">
                        <li class="entry-date">
                          <a href="#">1 января 2020</a>
                        </li>
                        <li class="entry-comments">
                        <a href="<?php the_permalink() ?>#comments"><?php comments_number() ?></a>
                        </li>
                      </ul>


                    </div>

                  </div>
                </div>
              </article> <!-- end large post -->
