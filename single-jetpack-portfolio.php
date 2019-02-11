<?php get_header(); ?>
    <div id="swup" class="main-content">
      <section class="work-post">
        <div class="-inner --intro">
          <div class="-left transition-in">
            <h1>
              <?php the_title(); ?>
            </h1>
            <small>
              Laboratorio de Gobierno
            </small>
          </div>
          <div class="-right">
            <!-- BEGIN: Work Post Image -->
            <figure>
              <div class="-image" style="background-image: url(<?php echo wp_get_attachment_image_url( get_post_thumbnail_id(), 'single__featured'); ?>);"></div>
            </figure>
            <!-- END: Work Post Image -->
          </div>
        </div>
        <div class="-inner --content transition-in">
          <div class="-left">
            <h3>
              Project's Client
            </h3>
            <a href="#">
              Municipalidad de Recoleta
            </a>
            <time>
              February, 2018.
            </time>

            <h3>
              People Involved
            </h3>
            <ul>
              <li>
                <a href="#">Dámaris Sepúlveda</a>
              </li>
              <li>
                <a href="#">Felipe Escandón</a>
              </li>
              <li>
                <a href="#" class="--inactive">Elisa Briones</a>
              </li>
              <li>
                <a href="#">Héctor Vergara</a>
              </li>
              <li>
                <a href="#">Katalina Papic</a>
              </li>
              <li>
                <a href="#" class="--inactive">Milenko Lasnibat</a>
              </li>
              <li>
                <a href="#" class="--inactive">Paulina Buvinic</a>
              </li>
              <li>
                <a href="#">Denise Misleh</a>
              </li>
              <li>
                <a href="#" class="--inactive">Myriam Meyer</a>
              </li>
            </ul>
          </div>
          <div class="-right">
			<?php the_content(); ?>
          </div>
        </div>
        <div class="-inner --gallery transition-in">
          <!-- BEGIN: Work Post Image Gallery -->
          <!--
            - Assign images in CSS with 'background-image: url('IMAGE_URL');'
          -->
          <div class="-image work-post1"></div>
          <!-- END: Work Post Image Gallery -->
          <div class="-image work-post2"></div>
          <div class="-image work-post3"></div>
          <div class="-image work-post4"></div>
        </div>
      </section>

      <section class="next-project transition-in">
        <!-- BEGIN: Next Project - Replace 'href' attribute -->
        <a href="#" class="inner">
          <h3>Next Project</h3>
          <h1>
            Public innovators network.
          </h1>
        </a>
        <!-- END: Next Project -->
      </section>
    </div>
<?php get_footer(); ?>