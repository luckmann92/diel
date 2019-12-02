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

    <button class="company__button-up button-up">
        <svg class="button-up__image" width="24" height="46" viewBox="0 0 24 46" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 11.4985L1.76204 13.0061C1.76204 13.0061 8.10627 6.65469 10.5731 3.93394C10.4755 13.4878 10.5731 46 10.5731 46H12.6885C12.6885 46 12.6112 13.4789 12.6885 3.93394C15.5077 6.65469 21.8519 13.0061 21.8519 13.0061L23.9664 11.4985L11.6277 0L0 11.4985Z" fill="white" fill-opacity="0.5"/>
        </svg>
    </button>
</section>
