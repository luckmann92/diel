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
        $rs = CIBlockElement::GetList(
            array(),
            array('ID' => $_REQUEST['ID']),
            false,
            false,
            array(
                'ID', 'IBLOCK_ID', 'PREVIEW_PICTURE', 'DETAIL_PICTURE', 'DETAIL_PAGE_URL', 'NAME', 'PROPERTY_*')
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
            $arProduct['PROPS'] = $ar->GetProperties();

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
                    <h2 class="popup-product-card__title section-title"><?=$arProduct['NAME']?></h2>

                    <div class="popup-product-card__image-wrapper">
                        <?if ($arProduct['PREVIEW_PICTURE']) {?>
                            <img class="popup-product-card__image-left" src="<?=$arProduct['PREVIEW_PICTURE']['SRC']?>" alt="">
                        <?}?>
                        <!-- <?if ($arProduct['DETAIL_PICTURE']) {?>
                            <img class="popup-product-card__image-right" src="<?=$arProduct['DETAIL_PICTURE']['SRC']?>" alt="">
                        <?}?> -->
                    </div>

                    <div class="popup-product-card__middle">
                        <?if ($price) {?>
                        <p class="popup-product-card__price">от <?=number_format($price, 0, '', ' ')?> ₽</p>
                <?}?>
                        <?if ($arProduct['PROPS']['COLLECTION']) {?>
                        <a class="popup-product-card__collection" href="<?=$arProduct['PROPS']['COLLECTION']['DETAIL_PAGE_URL']?>"><?=$arProduct['PROPS']['COLLECTION']['NAME']?></a>
                <?}?>
            <? if ($arProduct['PROPS']['IS_NEW']['VALUE']) { ?>
                        <span class="popup-product-card__novelty">Новинка</span>
                <?}?>
                        <a data-product-id="<?=$arProduct['ID']?>" class="popup-product-card__to-favorites icon-favorites <?=isFavorites($arProduct['ID'])?> js-init-add-favorites" href="#">
                            <?=GetContentSvgIcon('favorites')?>
                        </a>
                    </div>
<?if ($arProduct['PROPS']) {?>
                    <table class="characteristics">
                        <caption class="characteristics__caption">Характеристики</caption>
                        <tbody>
                        <?foreach ($arProduct['PROPS'] as $CODE => $arProp) {?>
                            <?if (stripos($CODE, 'OPTIONS_') !== false && $arProp['VALUE'] && !is_array($arProp['VALUE'])) {?>
                        <tr class="characteristics__row">
                            <td class="characteristics__col"><?=$arProp['NAME']?></td>
                            <td class="characteristics__col"><?=$arProp['VALUE']?></td>
                        </tr>
                        <?}?>
                    <?}?>

                        </tbody></table>
<?}?>
                    <a class="popup-product-card__link-detail link-detail" href="<?=$arProduct['DETAIL_PAGE_URL']?>">Подробнее
                        <?=GetContentSvgIcon('arrow-long')?>
                    </a>

                    <button class="popup-product-card__close popup__close js-init-form-close">
                        <?=GetContentSvgIcon('close')?>
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
    </script>
<?
    die();
}
?>


