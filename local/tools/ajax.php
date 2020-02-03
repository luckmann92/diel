<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */
define('STOP_STATISTICS', true);
define('NO_KEEP_STATISTIC', 'Y');
define('NO_AGENT_STATISTIC', 'Y');
define('DisableEventsCheck', true);
define('BX_SECURITY_SHOW_MESSAGE', true);
define('XHR_REQUEST', true);

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

\Bitrix\Main\Loader::includeModule('iblock');

if ($_REQUEST['ACTION']) {
    $APPLICATION->RestartBuffer();
    if ($_REQUEST['ACTION'] == 'fast_show' && $_REQUEST['ID'] > 0) {
        $arProduct = array();
        $arFilter = array(
            'ID' => $_REQUEST['ID']
        );
        if ($_REQUEST['PROPS']) {
            $arProps = unserialize(str_replace("'", '"', $_REQUEST['PROPS']));
        }
        $rs = CIBlockElement::GetList(
            array(),
            $arFilter,
            false,
            false,
            array(
                'ID', 'IBLOCK_ID', 'PREVIEW_PICTURE', 'DETAIL_PICTURE', 'DETAIL_PAGE_URL', 'NAME', 'PROPERTY_*', 'PROPERTY_MORE_IMAGES')
        );
        while ($ar = $rs->GetNextElement()) {
            $arProduct = $ar->GetFields();
            if ($arProduct['PREVIEW_PICTURE']) {
                $arProduct['PREVIEW_PICTURE'] = array(
                    'SRC' => CFile::GetPath($arProduct['PREVIEW_PICTURE'])
                );
                $arProduct['DETAIL_PICTURE'] = array(
                    'SRC' => CFile::GetPath($arProduct['DETAIL_PICTURE'])
                );
            }
            $arProperties = $ar->GetProperties();
            $arProduct['PROPERTIES'] = $arProperties;

            $arProduct['PROPS'] = array();

            if (is_array($arProps) && count($arProps) > 0) {
                foreach ($arProps as $CODE) {
                    $arProduct['PROPS'][$CODE] = $arProperties[$CODE];
                }
            } else {
                $arProduct['PROPS'] = $arProperties;
            }

            $rsCollection = CIBlockElement::GetList(
                array(),
                array('IBLOCK_ID' => 5, '=PROPERTY_PRODUCTS.ID' => $arProduct['ID']),
                false,
                false,
                array('ID', 'IBLOCK_ID', 'NAME', 'DETAIL_PAGE_URL')
            );
            $arProduct['PROPS']['COLLECTION'] = $rsCollection->GetNext();
        }
        if ($arProduct) {
            $price = CPrice::GetBasePrice($arProduct['ID'])['PRICE'];
            ?>
            <section class="popup popup-product-card popup--active">
                <div class="popup-product-card__inner">
                    <h2 class="popup-product-card__title section-title"><?= $arProduct['NAME'] ?></h2>
                    <div class="popup-product-slider__cont">
                        <ul class="different-slider__list js-init-slider-catalog-fast-show">
                            <li class="different-slider__item <?= $k % 2 ? 'even' : 'odd' ?>">
                                <div class="slider__item"
                                     style="background-image: url(<?= $arProduct["PREVIEW_PICTURE"]['SRC'] ?>);">
                                </div>
                            </li>
                            <? foreach ($arProduct['PROPERTIES']['MORE_IMAGES']['VALUE'] as $arItem) { ?>
                                <li class="different-slider__item <?= $k % 2 ? 'even' : 'odd' ?>">
                                    <div class="slider__item"
                                         style="background-image: url(<?= CFile::GetPath($arItem) ?>);">
                                    </div>
                                </li>
                            <? } ?>
                        </ul>
                    </div>
                    <script>
                        $(document).ready(function () {
                            let collection_slider = $('.js-init-slider-catalog-fast-show');
                            setSlider(collection_slider, true);
                        });
                    </script>

                    <div class="popup-product-card__middle">
                        <?
                        if ($price) { ?>
                            <p class="popup-product-card__price">от <?= number_format($price, 0, '', ' ') ?> ₽</p>
                        <?
                        } ?>
                        <?
                        if ($arProduct['PROPS']['COLLECTION']) { ?>
                            <a class="popup-product-card__collection"
                               href="<?= $arProduct['PROPS']['COLLECTION']['DETAIL_PAGE_URL'] ?>"><?= $arProduct['PROPS']['COLLECTION']['NAME'] ?></a>
                        <?
                        } ?>
                        <? if ($arProduct['PROPS']['IS_NEW']['VALUE']) { ?>
                            <span class="popup-product-card__novelty">Новинка</span>
                        <?
                        } ?>
                        <a data-product-id="<?= $arProduct['ID'] ?>"
                           class="popup-product-card__to-favorites icon-favorites <?= isFavorites($arProduct['ID']) ?> js-init-add-favorites"
                           href="#">
                            <?= GetContentSvgIcon('favorites') ?>
                        </a>
                    </div>
                    <?
                    if ($arProduct['PROPS']) { ?>
                        <table class="characteristics">
                            <caption class="characteristics__caption">Характеристики</caption>
                            <tbody>
                            <?
                            foreach ($arProduct['PROPS'] as $CODE => $arProp) {
                                if (!is_array($arProp['VALUE']) && !empty($arProp['VALUE'])) { ?>

                                    <tr class="characteristics__row">
                                        <td class="characteristics__col"><?= $arProp['NAME'] ?></td>
                                        <td class="characteristics__col"><?= $arProp['VALUE'] ?></td>
                                    </tr>
                                <?
                                } ?>
                            <?
                            } ?>

                            </tbody>
                        </table>
                    <?
                    } ?>
                    <a class="popup-product-card__link-detail link-detail" href="<?= $arProduct['DETAIL_PAGE_URL'] ?>">Подробнее
                        <?= GetContentSvgIcon('arrow-long') ?>
                    </a>

                    <button class="popup-product-card__close popup__close js-init-form-close">
                        <?= GetContentSvgIcon('close') ?>
                    </button>
                </div>
            </section>
            <?
        }
    }
    ?>
    <script>
        let addFavorites = $('.js-init-add-favorites');

        addFavorites.on('click', function (e) {
            e.preventDefault();
            let data = {},
                product_id = $(this).attr('data-product-id'),
                type = '';

            if ($(this).hasClass('product-card__to-favorites--active')) {
                data = {
                    'del_favorites': 'Y',
                    'product_id': product_id
                };
                type = 'del';
            } else {
                data = {
                    'add_favorites': 'Y',
                    'product_id': product_id
                };
                type = 'add';
            }

            e.preventDefault();
            $.ajax({
                method: 'get',
                data: data,
                url: '/',
                dataType: 'json',
                success: function (response) {
                    let btn = $('[data-product-id="' + product_id + '"]');
                    if (response.result == 'true') {
                        if (type == 'del') {
                            btn.removeClass('product-card__to-favorites--active');
                        } else {
                            btn.addClass('product-card__to-favorites--active');
                        }
                    }
                }
            });
            return false;
        });


        $(document).ready(function () {
            let slider = $('.product-slider');
            slider.slick({
                dots: false,
                arrows: false,
                variableWidth: true,
                infinite: false,
                speed: 500
            });

            $(document).on('click', function (e) {
                let target = $(e.target),
                    prevArrow = $('.prev'),
                    nextArrow = $('.next');

                if (target.is(prevArrow)) {
                    slider.slick('slickPrev');
                }
                if (target.is(nextArrow)) {
                    slider.slick('slickNext');
                }
            });

            slider.on('afterChange', function () {
                $('.product-slide.slick-current').children().append('<div class="prev"></div><div class="next"></div>')
            });

            slider.on('beforeChange', function () {
                $('.next').remove();
                $('.prev').remove();
            });
        });

    </script>
    <?
    die();
}
?>


