<?php get_header(); ?>

<?php $gallery_style = get_field('gallery_style')? get_field('gallery_style'): "default"; ?>

<section class="work-inf work-inf-style-<?php echo $gallery_style; ?>">
    <div class="container">
        <div class="work-inf__inner">
            <div class="work-inf__inner__tabs">
                <div class="work-inf__inner__tabs__links work-inf__inner--categories1">
                    <ul class="work-inf__inner__tabs__links__list">
                        <?php

                        global $post;
                        $current_post_slug = $post->post_name;
                        $current_post_title = $post->post_title;

                        $args = array(
                            'post_type' => 'galleries',
                            'posts_per_page' => -1,
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'gallery_type',
                                    'field'    => 'slug',
                                    'terms'    => 'category',
                                ),
                            ),
                        );
                        $loop = new WP_Query($args);
                        while ($loop->have_posts()) : $loop->the_post();
                            $post_slug = get_post_field('post_name', get_post());
                            if ($current_post_slug === $post_slug) {
                                $item_class = 'current_gallery_item';
                            } else {
                                $item_class = '';
                            }
                        ?>
                            <li class="<?= $item_class; ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                        <?php endwhile;
                        wp_reset_postdata();
                        ?>
                    </ul>
                    <div class="work-inf__inner__tabs__links__filter">
                        <p class="work-inf__inner__tabs__links__filter--name">Filter by </p>
                        <span class="work-inf__inner__tabs__links__filter--selected"><span></span></span>
                        <span class="current-tag">#<?= $current_post_title; ?></span>
                    </div>
                </div>
                <div class="work-inf__inner__tabs__btns work-inf__inner--tags">
                    <?php
                    $args = array(
                        'post_type' => 'galleries',
                        'posts_per_page' => -1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'gallery_type',
                                'field'    => 'slug',
                                'terms'    => 'hashtag',
                            ),
                        ),
                    );
                    $loop = new WP_Query($args);
                    while ($loop->have_posts()) : $loop->the_post(); ?>

                        <?php
                        $post_slug = get_post_field('post_name', get_post());
                        if ($current_post_slug === $post_slug) {
                            $item_class = 'current_gallery_item';
                        } else {
                            $item_class = '';
                        } ?>


                        <a class="<?php echo  $item_class; ?>" href="<?php the_permalink(); ?>">#<?php the_title(); ?></a>
                    <?php endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php if(get_field('hero_video')){ ?>
<section class="hero hero-hp gallery-hero gallery-hero-style-<?php echo $gallery_style; ?>">
    <video playsinline muted autoplay loop poster="<?php the_field('fallback_video_image'); ?>">
        <source src="<?php the_field('hero_video'); ?>" type="video/mp4">
        <!-- <source src="movie.ogg" type="video/ogg"> -->
    </video>
    <div class="video-mask"></div>
    <div class="container">

        <button class="sound-btn">
            <img class="sound-on" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/sound.svg" hidden />
            <img class="sound-off" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/mute.svg" />
        </button>
        <div class="hero__scroll">
            <a href="#expertise">
                <svg width="20" height="36" viewBox="0 0 20 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="1.50315" y="1.04551" width="17.4858" height="34.3045" rx="8.74291" stroke="#9F9F9F" stroke-width="1.3" />
                    <circle cx="10.246" cy="7.94767" r="1.96879" fill="#C4C4C4" id="scrollDot" />
                </svg>
            </a>
        </div>
    </div>
</section>
<?php } ?>

    <?php if (get_field('gallery_title')) : ?>
    <section class="gallery-title gallery-title-style-<?php echo $gallery_style; ?>">
        <div class="container">
            <h1><?php the_field('gallery_title') ;?></h1>
            <?php the_field('gallery_description') ;?>
        </div>
    </section>
    <?php endif; ?>

    <section class="work-items work-items-style-<?php echo $gallery_style; ?>">
        <div class="container">
            <div class="news__inner">
                <?php
                if (have_rows('gallery_grid')) :
                    while (have_rows('gallery_grid')) : the_row();
                        $class_item = get_row_layout();
                        $target = get_sub_field('on_click_target');
                        $project_id = get_sub_field('project');
                        $project_image = get_sub_field('image');
                        if($class_item == 'wide_box'){
                            $project_mobile_image = get_sub_field('mobile_image');
                        }
                        $short_title = get_sub_field('short_title');
                        $company_name = get_sub_field('company_name');
                        $lightBox_tags = get_sub_field('tags');
                        $sixth_item1_target = get_sub_field('on_click_first_box_target');
                        $sixth_item2_target = get_sub_field('on_click_second_box_target');
                        $sixth_item1_project_id = get_sub_field('project_1');
                        $sixth_item2_project_id = get_sub_field('project_2');
                        $sixth_item1_image = get_sub_field('image_1');
                        $sixth_item2_image = get_sub_field('image_2');
                        $sixth_item1_short_title = get_sub_field('short_title_1');
                        $sixth_item2_short_title = get_sub_field('short_title_2');
                        $sixth_item1_company_name = get_sub_field('company_name_1');
                        $sixth_item2_company_name = get_sub_field('company_name_2');
                        $sixth_item1_lightBox_tags = get_sub_field('tags_1');
                        $sixth_item2_lightBox_tags = get_sub_field('tags_2');
                        $lightBox_title = '<span>' . $company_name . '</span>' . $short_title;
                        $sixth_item1_lightBox_title = '<span>' . $sixth_item1_company_name . '</span>' . $sixth_item1_short_title;
                        $sixth_item2_lightBox_title = '<span>' . $sixth_item2_company_name . '</span>' . $sixth_item2_short_title;
                ?>

                        <?php if ($class_item == 'sixth_box') { ?>
                            <div class="one_third_box sixth-parent">
                                <div class="sixth_item news-item">
                                    <img src="<?php echo $sixth_item1_image; ?>">
                                    <div class="news-item__hover">
                                        <div class="news-item__text">
                                            <?php if ($sixth_item1_short_title) { ?>
                                                <p><?php echo $sixth_item1_short_title; ?></p>
                                                <p><?php echo $sixth_item1_company_name; ?></p>
                                            <?php } else { ?>
                                                <p><?= get_the_title($sixth_item1_project_id); ?></p>
                                                <p><?= get_field('company_name', $sixth_item1_project_id); ?></p>
                                            <?php } ?>
                                        </div>
                                        <?php
                                        $hashtags = get_field('hashtags', $sixth_item1_project_id);
                                        if ($hashtags) : ?>
                                            <ul class="news-item__tags">
                                                <?php
                                                $i = 0;
                                                foreach ($hashtags as $post) :
                                                    setup_postdata($post); ?>
                                                    <li><a href="<?php the_permalink(); ?>" class="btn">#<?php the_title(); ?></a></li>
                                                <?php
                                                    if (++$i == 3) break;
                                                endforeach; ?>
                                            </ul>
                                            <?php
                                            wp_reset_postdata(); ?>
                                        <?php endif; ?>

                                        <?php
                                        if ($sixth_item1_lightBox_tags) : ?>
                                            <ul class="news-item__tags">
                                                <?php foreach ($sixth_item1_lightBox_tags as $post) :
                                                    setup_postdata($post); ?>
                                                    <li><a href="<?php the_permalink(); ?>" class="btn">#<?php the_title(); ?></a></li>
                                                <?php endforeach; ?>
                                            </ul>
                                            <?php
                                            wp_reset_postdata(); ?>
                                        <?php endif; ?>

                                        <?php if ($sixth_item1_target == 'light_box') { ?>
                                            <a data-caption="<?php echo $sixth_item1_lightBox_title; ?> " href="<?php echo $sixth_item1_image; ?>" class="fancybox news-item__absolute-link"></a>
                                        <?php } else { ?>
                                            <a class="news-item__absolute-link" href="<?= get_the_permalink($sixth_item1_project_id) ?>"></a>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="sixth_item news-item">
                                    <img src="<?php echo $sixth_item2_image; ?>">
                                    <div class="news-item__hover">
                                        <div class="news-item__text">
                                            <?php if ($sixth_item2_short_title) { ?>
                                                <p><?php echo $sixth_item2_short_title; ?></p>
                                                <p><?php echo $sixth_item2_company_name; ?></p>
                                            <?php } else { ?>
                                                <p><?= get_the_title($sixth_item2_project_id); ?></p>
                                                <p><?= get_field('company_name', $sixth_item2_project_id); ?></p>
                                            <?php } ?>
                                        </div>
                                        <?php
                                        $hashtags = get_field('hashtags', $sixth_item2_project_id);
                                        if ($hashtags) : ?>
                                            <ul class="news-item__tags">
                                                <?php
                                                $i = 0;
                                                foreach ($hashtags as $post) :
                                                    setup_postdata($post); ?>
                                                    <li><a href="<?php the_permalink(); ?>" class="btn">#<?php the_title(); ?></a></li>
                                                <?php
                                                    if (++$i == 3) break;
                                                endforeach; ?>
                                            </ul>
                                            <?php
                                            wp_reset_postdata(); ?>
                                        <?php endif; ?>
                                        <?php
                                        if ($sixth_item2_lightBox_tags) : ?>
                                            <ul class="news-item__tags">
                                                <?php foreach ($sixth_item2_lightBox_tags as $post) :
                                                    setup_postdata($post); ?>
                                                    <li><a href="<?php the_permalink(); ?>" class="btn">#<?php the_title(); ?></a></li>
                                                <?php endforeach; ?>
                                            </ul>
                                            <?php
                                            wp_reset_postdata(); ?>
                                        <?php endif; ?>
                                        <?php if ($sixth_item2_target == 'light_box') { ?>
                                            <a data-caption="<?php echo $sixth_item2_lightBox_title; ?> " href="<?php echo $sixth_item2_image; ?>" class="fancybox news-item__absolute-link"></a>
                                        <?php } else { ?>
                                            <a class="news-item__absolute-link" href="<?= get_the_permalink($sixth_item2_project_id) ?>"></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                        <?php } elseif ($class_item == 'text_box') { ?>
                            <div class="one_third_box text-box">
                                <div class="news__inner__block">
                                    <div class="news__inner__content">
                                        <?php the_sub_field('content'); ?>
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="<?php echo $class_item; ?> news-item">
                                <?php if ($class_item == 'wide_box') { ?>
                                    <div class="wide__box__content wide_box_desktop">
                                        <?php the_sub_field('content'); ?>
                                </div>
                                <?php } ?>
                                <img src="<?php echo $project_image; ?>" class="wide_box_desktop" />

                                <?php if($class_item == 'wide_box'){ ?>
                                    <img src="<?php echo $project_mobile_image; ?>" class="wide_box_mobile" />
                                <?php } ?>
                                    
                                <div class="news-item__hover">
                                    <?php if ($class_item != 'wide_box') { ?>
                                        
                                        <div class="news-item__text">
                                            <?php if ($short_title) { ?>
                                                <p><?= $short_title; ?></p>
                                                <p><?= $company_name; ?></p>
                                            <?php } else { ?>
                                                <p><?= get_the_title($project_id); ?></p>
                                                <p><?= get_field('company_name', $project_id); ?></p>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                    <?php
                                    $hashtags = get_field('hashtags', $project_id);
                                    if ($hashtags && $class_item != 'wide_box') : ?>
                                        <ul class="news-item__tags">
                                            <?php foreach ($hashtags as $post) :
                                                setup_postdata($post); ?>
                                                <li><a href="<?php the_permalink(); ?>" class="btn">#<?php the_title(); ?></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <?php
                                        wp_reset_postdata(); ?>
                                    <?php endif; ?>

                                    <?php
                                    if ($lightBox_tags) : ?>
                                        <ul class="news-item__tags">
                                            <?php foreach ($lightBox_tags as $post) :
                                                setup_postdata($post); ?>
                                                <li><a href="<?php the_permalink(); ?>" class="btn">#<?php the_title(); ?></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <?php
                                        wp_reset_postdata(); ?>
                                    <?php endif; ?>

                                    <?php if ($target == 'light_box') { ?>
                                        <a data-caption="<?php echo $lightBox_title; ?> " href="<?php echo $project_image; ?>" class="fancybox news-item__absolute-link"></a>
                                    <?php } else { ?>
                                        <a class="news-item__absolute-link" href="<?= get_the_permalink($project_id) ?>"></a>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                <?php
                    endwhile;
                endif;
                ?>
                <button class="more-galleries btn mobile">See more</button>
            </div>
        </div>
    </section>

    <?php get_template_part('template-parts/work', 'more'); ?>
<?php
get_footer();
