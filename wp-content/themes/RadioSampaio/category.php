<?php
/**
 * A Simple Category Template
 */
get_header();?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>Últimas Notícias</h1>

            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <article>
                <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                <div class="row">
                    <div class="group1 col-sm-6 col-md-6">
                        <span class="glyphicon glyphicon-folder-open"></span>  <a href="<?php the_permalink();?>"><?php $category = get_the_category(); echo $category[0]->cat_name;
?></a>
                        <span class="glyphicon glyphicon-bookmark"></span>  <?php the_tags( 'Tags: ', ', ', '<br />' ); ?>
                    </div>
                    <div class="group2 col-sm-6 col-md-6">
                        <span class="glyphicon glyphicon-pencil"></span> <a href="<?php the_permalink();?>#comments">20 Comments</a>
                        <span class="glyphicon glyphicon-time"></span><?php the_time('j \d\e F \à\s g:i a') ?>
                    </div>
                </div>
                <hr>
                <img src="http://placehold.it/900x300" class="img-responsive">
                <br />
                <p class="lead">Aries is the first sign of the zodiac, and that's pretty much how those born under this sign see themselves: first. Aries are the leaders of the pack, first in line to get things going. Whether or not everything gets done </p>

                <p> <?php wp_limit_post(250,'...',true);?></p>

                <p class="text-right">
                    <a href="<?php the_permalink(); ?>" class="text-right">
                        Leia mais...
                    </a>
                </p>

                <hr>
            </article>
            <?php endwhile; else : ?>
	        <p><?php _e( 'Desculpe, nenhuma notícia listado.' ); ?></p>
            <?php endif; ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-4">

            <!-- Blog Search Well -->
            <div class="well">
                <h4>Blog Search</h4>
                <div class="input-group">
                    <input type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                </div>
                <!-- /.input-group -->
            </div>

            <!-- Blog Categories Well -->
            <div class="well">
                <h4>Blog Categories</h4>
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-unstyled">
                            <li><a href="#">Category Name</a>
                            </li>
                            <li><a href="#">Category Name</a>
                            </li>
                            <li><a href="#">Category Name</a>
                            </li>
                            <li><a href="#">Category Name</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <ul class="list-unstyled">
                            <li><a href="#">Category Name</a>
                            </li>
                            <li><a href="#">Category Name</a>
                            </li>
                            <li><a href="#">Category Name</a>
                            </li>
                            <li><a href="#">Category Name</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /.row -->
            </div>

            <!-- Side Widget Well -->
            <div class="well">
                <h4>Side Widget Well</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
            </div>

        </div>

    </div>
    <!-- /.row -->
    
</div> <!-- container-fluid -->
<?php get_footer();?>