<?php
get_header();
get_template_part( 'template-parts/breadcrumbs' );
global $post, $wp_query;
$archive_post_id = $post->ID;
$post_type       = get_queried_object();
?>

    <section class="useful-links-content">
        <div class="container">
            <h1><?php echo single_term_title(); ?></h1>

            <div class="news-content__search">
                <div class="search-block search-block--news">

                    <div class="search-block__wrap" id="body-block-bottom">
                        <div class="search-block__tabs">
                            <div class="tab-content search-news__wrap">
                                <div class="tab-content__item">
                                    <p><?php _e( 'Filters', 'krop' ); ?></p>
                                    <div class="tab-content__item-wrap">
                                        <div class="search-block__select-list">
                                            <div class="custom-select custom-select-single"
                                                 id="news-announcement"></div>
                                            <div class="custom-select custom-select-single" id="news-category"></div>
                                            <div class="calendar-select" id="calendar-select">
                                                <!-- начало календаря -->
                                                <input id="datepicker" class="datepicker" readonly=""
                                                       placeholder="Період або дата">
                                                <button>
                                                    <svg width="16" height="16" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                                d="M14.667 9.507v-6.84c0-.736-.599-1.334-1.334-1.334h-2v-1a.333.333 0 1 0-.666 0v1h-6v-1a.333.333 0 1 0-.667 0v1H1.333C.598 1.333 0 1.931 0 2.667v10.666c0 .736.598 1.334 1.333 1.334h8.174A3.661 3.661 0 0 0 12.333 16 3.671 3.671 0 0 0 16 12.333a3.66 3.66 0 0 0-1.333-2.826Zm-14-6.84c0-.368.298-.667.666-.667H4v.667a.667.667 0 1 0 .667.666V2h6v.667a.667.667 0 1 0 .666.666V2h2c.368 0 .667.3.667.667v2H.667v-2ZM1.333 14a.667.667 0 0 1-.666-.667v-8H14v3.739a3.64 3.64 0 0 0-1.667-.405 3.67 3.67 0 0 0-3.666 3.666c0 .6.148 1.166.405 1.667H1.333Zm11 1.333c-1.654 0-3-1.345-3-3 0-1.654 1.346-3 3-3 1.655 0 3 1.346 3 3 0 1.655-1.345 3-3 3Z"
                                                                fill="#fff"/>
                                                        <path
                                                                d="M13.666 12h-1v-1A.333.333 0 1 0 12 11v1h-1a.333.333 0 1 0 0 .667h1v1a.333.333 0 1 0 .666 0v-1h1a.333.333 0 1 0 0-.667Z"
                                                                fill="#fff"/>
                                                    </svg>
                                                </button>
                                            </div> <!-- конец календаря -->
                                        </div>
                                    </div>
                                    <div class="search-block__chips chips">
                                        <div class="chips__item">
                                            <p class="text">text</p>
                                            <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                        d="M10.243 10.243 6 6m0 0L1.757 1.757M6 6l4.243-4.243M6 6l-4.243 4.243"
                                                        stroke="#6B2A14" stroke-width="2" stroke-linecap="round"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="amount">
                                    <p><?php _e( 'Quantity', 'krop' ); ?></p>
                                    <div class="custom-select" id="news-amount"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row useful-links-content__links-wrapper">

				<?php
				if ( have_posts() ) {
					?>

					<?php
					while ( have_posts() ) {
						the_post();
						get_template_part( 'template-parts/single-items/link-box', 'news' );
					}
				} ?>

				<?php wp_reset_postdata(); ?>

            </div>
        </div>
        <div class="container">

			<?php crop_blog_pagination( $wp_query ); ?>

        </div>
    </section>

<?php
if ( get_field( splitter_lang_condition( array('ukr' => 'seo_tekst', 'eng' => 'seo_tekst_eng' ) ), 'options' ) ): ?>
    <div class="container">
        <div class="text-bottom divider">
			<?php the_field( splitter_lang_condition( array('ukr' => 'seo_tekst', 'eng' => 'seo_tekst_eng' ) ), 'options' ); ?>
        </div>
    </div>
<?php
endif; ?>

    <script>
        document.addEventListener("DOMContentLoaded", function (event) {
            document.querySelector("#news-amount").addEventListener("change", function () {
                let count = this.value;
                let announcement = document.querySelector('#news-announcement').value;
                let category = document.querySelector('#news-category').value;

                let announcementRequest = '';
                let categoryRequest = '';

                if (announcement) {
                    announcementRequest = '&announcement=' + announcement;
                }

                if (category) {
                    categoryRequest = '&category=' + category;
                }

                window.location.assign('<?= get_permalink();?>?filter_count=' + count +
                    announcementRequest +
                    categoryRequest);

            });

            document.querySelector("#news-announcement").addEventListener("change", function () {
                let announcement = this.value;
                let count = document.querySelector('#news-amount').value;
                let category = document.querySelector('#news-category').value;

                let countRequest = '';
                let categoryRequest = '';
                let announcementRequest = "?"

                if (count) {
                    countRequest = '&filter_count=' + count;
                }

                if (category) {
                    categoryRequest = '&category=' + category;
                }

                if (announcement) {
                    announcementRequest = '?announcement=' + announcement;
                }

                if (!count && !category && !announcement) {
                    window.location.assign('<?= get_permalink();?>');
                } else {

                    window.location.assign(
                        '<?= get_permalink();?>' + announcementRequest + countRequest + categoryRequest);
                }

            });

            document.querySelector("#news-category").addEventListener("change", function () {
                let category = this.value;
                let count = document.querySelector('#news-amount').value;
                let announcement = document.querySelector('#news-announcement').value;

                let countRequest = '';
                let announcementRequest = '';
                let categoryRequest = '?';

                if (count) {
                    countRequest = '&filter_count=' + count;
                }

                if (announcement) {
                    announcementRequest = '&announcement=' + announcement;
                }

                if (category) {
                    categoryRequest = '?category=' + category;
                }

                window.location.assign('<?= get_permalink();?>?category=' + category + countRequest +
                    announcementRequest);

                if (!count && !category && !announcement) {
                    window.location.assign('<?= get_permalink();?>');
                } else {

                    window.location.assign('<?= get_permalink();?>' + categoryRequest + countRequest +
                        announcementRequest);
                }

            });

        });
    </script>

<?php get_footer();