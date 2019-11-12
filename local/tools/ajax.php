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
            dump($arProduct['PROPS']);
            ?>
            <section class="popup popup-product-card popup--active">
                <div class="popup-product-card__inner">
                    <h2 class="popup-product-card__title section-title"><?=$arProduct['NAME']?></h2>

                    <div class="popup-product-card__image-wrapper">
                        <?if ($arProduct['PREVIEW_PICTURE']) {?>
                            <img class="popup-product-card__image-left" src="<?=$arProduct['PREVIEW_PICTURE']['SRC']?>" alt="">
                        <?}?>
                        <?if ($arProduct['DETAIL_PICTURE']) {?>
                            <img class="popup-product-card__image-right" src="<?=$arProduct['DETAIL_PICTURE']['SRC']?>" alt="">
                        <?}?>
                    </div>

                    <div class="popup-product-card__middle">
                        <p class="popup-product-card__price">552 000 ₽</p>
                        <?if ($arProduct['PROPS']['COLLECTION']) {?>
                        <a class="popup-product-card__collection" href="<?=$arProduct['PROPS']['COLLECTION']['DETAIL_PAGE_URL']?>"><?=$arProduct['PROPS']['COLLECTION']['NAME']?></a>
                <?}?>
                        <a class="popup-product-card__to-favorites <?=isFavorites($arProduct['ID'])?> js-init-add-favorites" href="#">
                            <?=GetContentSvgIcon('favorites')?>
                        </a>
                    </div>

                    <table class="characteristics">
                        <caption class="characteristics__caption">Характеристики</caption>
                        <tbody><tr class="characteristics__row">
                            <td class="characteristics__col">Total number of pixels</td>
                            <td class="characteristics__col">18.7 million</td>
                        </tr>
                        <tr class="characteristics__row">
                            <td class="characteristics__col">Effective Pixels</td>
                            <td class="characteristics__col">18 million</td>
                        </tr>
                        <tr class="characteristics__row">
                            <td class="characteristics__col">The size</td>
                            <td class="characteristics__col">APS-C (22.3 x 14.9 mm)</td>
                        </tr>
                        <tr class="characteristics__row">
                            <td class="characteristics__col">Crop factor</td>
                            <td class="characteristics__col">1.6</td>
                        </tr>
                        </tbody></table>

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
    die();
}
?>


