<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */
?>
<section class="company">
    <h2 class="company__title section-title"><?=$arParams['BLOCK_TITLE']?></h2>

    <?if ($arParams['BLOCK_IMG']) {?>
    <img class="company__image" src="<?=$arParams['BLOCK_IMG']?>" alt="diel">
    <?}?>
    <b class="company__year-foundation"><?=$arParams['BLOCK_YEAR']?></b>

    <div class="company__description">
        <?$APPLICATION->IncludeFile("/include/home/about-desc.php",
            array(), array(
                "SHOW_BORDER" => true,
                "MODE" => "text"
            )
        );?>
        </div>

    <a class="company__link-detail link-detail" href="<?=SITE_DIR?>about/"><?=$arParams['BLOCK_LINK']?>
        <svg class="link-detail__image" width="34" height="11" viewBox="0 0 34 11" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M28.763 9.9L29.537 10.533L33.587 5.583C33.737 5.399 33.737 5.134 33.587 4.95L29.537 0L28.763 0.632L32.145 4.766H0V5.766H32.145L28.763 9.9Z" fill="#E08B66"></path>
        </svg>
    </a>
</section>
