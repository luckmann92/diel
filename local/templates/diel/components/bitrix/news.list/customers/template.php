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
        <img class="for-buyer__image" src="/local/templates/diel/frontend/img/advantages_img_1.png" alt="">
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
        </li>
    </ul>
</section>

<?if ($arResult['ITEMS']) {?>
<section class="page-for-buyer__section-faq section-faq">
    <h2 class="section-faq__title section-title">частые вопросы</h2>

    <div class="section-faq__slider-wrapper">
        <ul class="section-faq__slider jumping-slider">
            <?foreach ($arResult['ITEMS'] as $arItem) {?>
            <li class="jumping-slider__item">
                <div class="jumping-slider__image-wrapper">
                    <img class="jumping-slider__image" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>">
                </div>

                <div class="jumping-slider__text">
                    <h3 class="jumping-slider__title"><?=$arItem['NAME']?></h3>

                    <p class="jumping-slider__description"><?=$arItem['PREVIEW_TEXT']?></p>
                </div>
            </li>
<?}?>
        </ul>

        <div class="section-faq__slider-options jumping-slider-options">
            <svg xmlns="http://www.w3.org/2000/svg" width="1601" height="70" viewBox="0 0 1601 17" fill="none">
                <line x1="16" y1="8.5" x2="1601" y2="8.5" stroke="#F1C9B3" stroke-opacity="0.37"></line>

                <line class="jumping-line" x1="16" y1="8.5" x2="16" y2="8.5" stroke="#AF6A4D" stroke-width="3">
                    <animate class="jumping-animate" attributeName="x2" from="16" to="808" dur="1s" fill="freeze" begin="indefinite"></animate>
                </line>
                <g class="section-faq__slider-options__nav jumping-slider-options__nav">
                    <g class="jumping-slider-options__item">
                        <rect x="0" y="0" width="60" height="60" fill="rgba(0,0,0,.001)"></rect>
                        <circle cx="8" cy="8.5" r="4.5" fill="#765B4A"></circle>
                        <circle cx="8" cy="8.5" r="8" stroke-opacity="0.8"></circle>
                        <text class="jumping-slider-options__item-text" x="0" y="40">01</text>
                    </g>

                    <g class="jumping-slider-options__item">
                        <rect x="378" y="0" width="60" height="60" fill="rgba(0,0,0,.001)"></rect>
                        <circle cx="408" cy="8.5" r="5.5" fill="#765B4A"></circle>
                        <circle cx="408" cy="8.5" r="8" stroke-opacity="0.8"></circle>
                        <text class="jumping-slider-options__item-text" x="400" y="40">02</text>
                    </g>

                    <g class="jumping-slider-options__item">
                        <rect x="778" y="0" width="60" height="60" fill="rgba(0,0,0,.001)"></rect>
                        <circle cx="808" cy="8.5" r="5.5" fill="#765B4A"></circle>
                        <circle cx="808" cy="8.5" r="8" stroke-opacity="0.8"></circle>
                        <text class="jumping-slider-options__item-text" x="800" y="40">03</text>
                    </g>
                </g>
                <!-- <g class="jumping-slider-options__item">
                  <rect x="1178" y="0" width="60" height="60" fill="rgba(0,0,0,.001)"></rect>
                  <circle cx="1208" cy="8.5" r="5.5" fill="#765B4A"/>
                  <circle cx="1208" cy="8.5" r="8" stroke-opacity="0.8"/>
                  <text class="jumping-slider-options__item-text" x="1200" y="40">04</text>
                </g> -->


                <!-- AF6A4D -->
            </svg>
        </div>
    </div>
</section>

<?}?>