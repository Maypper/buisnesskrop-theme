<?php
global $wp;
?>
<div class="personal__content__block">
    <div class="personal__content__block__title d-flex justify-content-between swapper-list-item"
         data-swapper-select="block1,block2"
         data-swapper-class="hidden-mob,personal__content__block__title__icon">
        <div class="d-flex align-items-center">
            <svg width="24" height="20" viewBox="0 0 24 20" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path
                        d="M22 3.00004H17V2.00001C17 0.896999 16.1031 0 15 0H9C7.89698 0 6.99998 0.896952 6.99998 2.00001V3H2.00002C0.896953 3.00004 0 3.897 0 5.00001V18C0 19.103 0.896953 20 2.00002 20H22C23.103 20 24 19.103 24 18V5.00001C24 3.897 23.103 3.00004 22 3.00004ZM8.00002 2.00001C8.00002 1.44876 8.44875 1.00003 9 1.00003H15C15.5513 1.00003 16 1.44876 16 2.00001V3H8.00002V2.00001ZM23 18C23 18.5513 22.5513 19 22 19H2.00002C1.44877 19 1.00003 18.5513 1.00003 18V10.7219C1.29539 10.8941 1.63411 11.0001 2.00002 11.0001H10V12.5001C10 12.7764 10.2237 13.0001 10.5 13.0001H13.5C13.7764 13.0001 14.0001 12.7764 14.0001 12.5001V11.0001H22.0001C22.366 11.0001 22.7048 10.8942 23.0001 10.7219V18H23ZM11 12V10H13V12H11ZM23 9.00004C23 9.55129 22.5513 10 22 10H14V9.50001C14 9.22363 13.7764 8.99999 13.5 8.99999H10.5C10.2236 8.99999 9.99998 9.22363 9.99998 9.50001V10H2.00002C1.44877 10 1.00003 9.55129 1.00003 9.00004V5.00006C1.00003 4.44881 1.44877 4.00008 2.00002 4.00008H22C22.5513 4.00008 23 4.44881 23 5.00006V9.00004Z"
                        fill="#E8BA06"/>
            </svg>
            <div class="personal__content__block__title__text"><?php _e( 'My brands/businesses', 'krop' ); ?></div>
        </div>
        <div class="d-md-none d-block">
            <svg data-swapper="block2" width="14" height="11" viewBox="0 0 14 11" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path
                        d="M6.4522 10.0459C6.51336 10.1347 6.5952 10.2074 6.69066 10.2576C6.78613 10.3077 6.89236 10.3339 7.0002 10.3339C7.10805 10.3339 7.21428 10.3077 7.30974 10.2576C7.40521 10.2074 7.48704 10.1347 7.5482 10.0459L13.5482 1.37925C13.6177 1.27929 13.6584 1.16221 13.666 1.04072C13.6735 0.919239 13.6477 0.798001 13.5912 0.690181C13.5347 0.582362 13.4498 0.492084 13.3456 0.429157C13.2414 0.366231 13.1219 0.333061 13.0002 0.333253H1.0002C0.878764 0.333754 0.759761 0.367351 0.655989 0.430428C0.552217 0.493506 0.467604 0.583678 0.411248 0.691248C0.354892 0.798818 0.328925 0.919716 0.336141 1.04094C0.343357 1.16216 0.383483 1.27913 0.452202 1.37925L6.4522 10.0459Z"
                        fill="#6B2A14"/>
            </svg>
        </div>
    </div>
    <div class="d-block" data-swapper="block1">
        <?php $is_brand_list = home_url( splitter_lang_condition( array('ukr' => '/brands-settings/', 'eng' => '/eng/brands-setting/' ) ) ) === trailingslashit(home_url( $wp->request )); ?>
        <a href="<?php echo home_url( splitter_lang_condition( array('ukr' => '/brands-settings/', 'eng' => '/eng/brands-setting/' ) ) ); ?>"
           class="personal__content__block__settings personal__content__block__settings justify-content-between">
            <div class="personal__content__block__settings__text <?php echo $is_brand_list ? 'personal__content__block__link--active' : ''; ?>">
                <?php _e( 'Brands/businesses settings', 'krop' ); ?>
            </div>
            <div class="personal__content__block__settings__number <?php echo $is_brand_list ? 'd-block' : '';?>">0</div>
        </a>
        <a href="<?php echo home_url( splitter_lang_condition( array('ukr' => '/brand-statistic/', 'eng' => '/eng/brand-statistics/' ) ) ); ?>"
           class="personal__content__block__text <?php echo home_url( splitter_lang_condition( array('ukr' => '/brand-statistic/', 'eng' => '/eng/brand-statistics/' ) ) ) === trailingslashit(home_url( $wp->request )) ? 'personal__content__block__link--active' : ''; ?>"><?php _e( 'Brands/businesses statistics', 'krop' ); ?></a>
        <a href="<?php echo home_url( splitter_lang_condition( array('ukr' => '/add-brand/', 'eng' => '/eng/add-brands/' ) ) ); ?>"
           class="d-block text-white personal__content__block__btn"><?php _e( 'Add brand/business', 'krop' ); ?></a>
    </div>
</div>