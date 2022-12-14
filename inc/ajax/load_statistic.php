<?php
function splitter_ajax_load_statistic() {
    check_ajax_referer( 'load_statistic' );

    get_template_part( 'template-parts/personal-info/brand_statistic', '', array('period' => $_POST['period'] ?? 1 ) );
}