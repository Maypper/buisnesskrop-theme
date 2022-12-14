<?php
/*
Template Name: Персональний кабінет (Статистика брендів/бізнесів)
Template Post Type: page
*/
get_header('personal-info');
get_template_part('template-parts/breadcrumbs');
?>


    <div class="container personal__content">
        <div class="d-lg-flex d-block justify-content-between align-items-center personal__title position-relative">
            <h1 class="text-left"><?php _e('Personal account', 'krop'); ?></h1>
            <?php get_template_part('template-parts/personal-info/messages'); ?>
        </div>
        <div class="personal__content">
            <div class="row">
                <div class="col-lg-4 col-12">
                    <div class="personal__content__left d-lg-block d-md-flex d-block justify-content-between">
                        <?php get_template_part('template-parts/personal-info/menu-business'); ?>
                        <?php get_template_part('template-parts/personal-info/menu-account'); ?>
                    </div>
                </div>
                <div class="col-lg-8 col-12">
                    <div class="personal__content__right">
                        <div class="personal__content__title">
                            <div class="personal__content__title__text"><?php _e('Brands/businesses statistics', 'krop'); ?></div>
                            <div class="amount personal__content__choices">
                                <select id="filter-brand-statistics" name="filter-brand-statistics"
                                        class="init-virtual-select custom-select personal__content__choices visible"
                                        placeholder="<?php _e('Select the period', 'krop'); ?>">
                                    <option value="1" selected><?php _e('Per month', 'krop');?></option>
                                    <option value="3"><?php _e('For 3 months', 'krop'); ?></option>
                                    <option value="6"><?php _e('For 6 months', 'krop'); ?></option>
                                    <option value="12"><?php _e('For a year', 'krop');?></option>
                                </select>
                            </div>
                        </div>
                        <div class="statistic-wrapper">
                            <?php get_template_part('template-parts/personal-info/brand_statistic'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php
get_template_part('template-parts/modals/alert/reload');
get_template_part('template-parts/modals/overlay');

get_footer();