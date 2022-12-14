<?php
$video_url = get_field( 'video_url' );
preg_match( "#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $video_url, $matches );
$video_id   = $matches[0];
$add_text   = get_field( 'add_text' );
$title      = get_field( 'title' );
$paragraphs = get_field( 'paragraphs' );
$link       = get_field( 'link' );
?>
<div class="container about-city">
	<?php if ( $add_text ): ?>
        <div class="about-city__add-text">
            <p><?php echo $add_text; ?></p>
        </div>
	<?php endif; ?>
    <div class="about-city__wrapper">
        <div class="about-city__info">
			<?php if ( $title ): ?>
                <h2 class="about-city__title"><?php echo $title; ?></h2>
			<?php endif; ?>
			<?php if ( $paragraphs ): ?>
                <div class="about-city__text">
					<?php echo $paragraphs; ?>
                </div>
			<?php
			endif;
			if ( !empty($link['url']) ):
				?>
                <a class="about-city__btn btn btn--primary" href="<?php echo $link['url']['url']; ?>"
                   target="<?php echo $link['url']['target']; ?>">
					<?php echo $link['url']['title']; ?>
                    <img src="<?php echo $link['img']['url']; ?>" alt="<?php echo $link['img']['alt']; ?>">
                </a>
			<?php endif; ?>
        </div>
        <div class="about-city__video">
            <div class="video">
                <a class="video__link" href="<?php echo 'https://youtu.be/' . $video_id ?>">
                    <img class="video__media" src="https://i.ytimg.com/vi/<?php echo $video_id ?>/maxresdefault.jpg"
                         alt="video thumbnail">
                </a>
                <button class="video__button" aria-label="Запустить видео">
                    <svg width="68" height="48" viewBox="0 0 68 48">
                        <path class="video__button-shape"
                              d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z"></path>
                        <path class="video__button-icon" d="M 45,24 27,14 27,34"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!--
		<ul class="about-city__list">
			<li class="about-city__item" style="background-image: url('./images/about-city/photo-1.jpg')">
				<p>Цікава інформація про місто та його бізнес №1</p>
			</li>
			<li class="about-city__item" style="background-image: url('./images/about-city/photo-2.jpg')">
				<p>Не коротка цікава інформація про місто №2</p>
			</li>
			<li class="about-city__item" style="background-image: url('./images/about-city/photo-3.jpg')">
				<p>Доволі довга цікава інформація про місто чи особливості #3</p>
			</li>
			<li class="about-city__item" style="background-image: url('./images/about-city/photo-4.jpg')">
				<p>Доволі довга цікава інформація про місто чи особливості #4</p>
			</li>
		</ul>
		-->
    </div>
</div>
