<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */
?>


    <?$this->SetViewTarget('head-block')?>
    <div class="for-buyer__text-box">
        <? $APPLICATION->IncludeFile("/include/customers/description.php",
            array(),
            array(
                "SHOW_BORDER" => true,
                "MODE" => "html"
            )
        ); ?>

    </div>

    <div class="for-buyer__image-wrapper">
        <?if ($arParams['BLOCK_IMG']) {?>
        <img class="for-buyer__image" src="<?=$arParams['BLOCK_IMG']?>" alt="">
    <?}?>
        <h3 class="for-buyer__image-title"><? $APPLICATION->IncludeFile("/include/customers/faq_title.php",
                array(),
                array(
                    "SHOW_BORDER" => true,
                    "MODE" => "text"
                )
            ); ?></h3>
    </div>

    <div class="for-buyer__information">
        <? $APPLICATION->IncludeFile("/include/customers/description_2.php",
            array(),
            array(
                "SHOW_BORDER" => true,
                "MODE" => "html"
            )
        ); ?>
    </div>
    <?$this->EndViewTarget()?>

<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"process", 
	array(
		"COMPONENT_TEMPLATE" => "process",
		"IBLOCK_TYPE" => "content",
		"IBLOCK_ID" => "18",
		"NEWS_COUNT" => "20",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"STRICT_SECTION_CHECK" => "N",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
);?>


<section class="page-for-buyer__all all-collections section-skew" style="display: none;">

    <ul class="all-collections__list all-collections-list">
        <li class="all-collections__item all-collections-item">
            <div class="all-collections-item__inner">
                <div class="all-collections-item__description">
                    <p class="all-collections-item__p">Почти четверть века бренд входит в топ-10 лидеров российского ювелирного рынка. В багаже бренда – свидетельство клуба российской ювелирной торговли «Лидер отраслевого движения», награда «За высокое качество и современный дизайн»</p>
                    <p class="all-collections-item__p">Приз в номинации «Заслуга» (Merit Award) на престижной международной премии в области ювелирного искусства International Design Jewellery Excellence Award и другие дипломы крупнейших отраслевых и международных выставок.</p>

                    <a class="all-collections-item__button-detail link-detail" href="#">Подробнее
                        <svg class="link-detail__image" width="34" height="11" viewBox="0 0 34 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M28.763 9.9L29.537 10.533L33.587 5.583C33.737 5.399 33.737 5.134 33.587 4.95L29.537 0L28.763 0.632L32.145 4.766H0V5.766H32.145L28.763 9.9Z" fill="#E08B66"></path>
                        </svg>
                    </a>
                </div>

                <div class="all-collections-item__image-wrapper">
                    <img class="all-collections-item__image" src="./img/collections_3.png" alt="">

                    <h3 class="all-collections-item__title">
                        <span>искусственный интеллект</span>
                        <span class="all-collections-item__title-bigger">флирта</span>
                    </h3>
                </div>
            </div>
        </li>
    </ul>
</section>

<?if ($arResult['ITEMS']) {?>
<section class="page-for-buyer__section-faq section-faq">
    <h2 class="section-faq__title section-title">частые вопросы</h2>

    <div class="section-faq__slider-wrapper jumping-slider__slider-wrapper-faq">
        <ul class="different-slider__list js-init-slider-faq">
            <? foreach ($arResult['ITEMS'] as $arItem) { ?>
                <li class="different-slider__item">
                    <div class="slider__item" style="background-image: url(<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>);min-height:<?= $arItem['PREVIEW_PICTURE']['HEIGHT'] ?>px">
                        <div class="slider__item-desc">
                            <h3 class="slider__item-desc-title"><?= $arItem['NAME'] ?></h3>
                            <? if ($arItem['PREVIEW_TEXT']) { ?>
                                <div class="slider__item-desc-content"><?= $arItem['PREVIEW_TEXT'] ?></div>
                            <? } ?>
                        </div>
                    </div>
                </li>
            <? } ?>
        </ul>

        <div class="different-slider__nav">
            <div class="slider__nav-list"></div>
            <div class="slider__nav-progress"></div>
        </div>
    </div>
</section>

<?}?>