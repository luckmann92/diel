<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<?if ($arResult['ITEMS']) {?>
<ul class="all-collections__list all-collections-list">
    <?foreach ($arResult['ITEMS'] as $k => $arItem) {?>
    <li class="all-collections__item all-collections-item <?=$k == 0 ? 'section-skew' : ''?>">
        <div class="all-collections-item__inner">
            <div class="all-collections-item__description">
                <p class="all-collections-item__p"><?=$arItem['PREVIEW_TEXT']?></p>

                <a class="all-collections-item__button-detail link-detail" href="<?=$arItem['DETAIL_PAGE_URL']?>">Подробнее
                    <?=GetContentSvgIcon('arrow-long')?>
                </a>

                <h3 class="all-collections-item__title">
                    <span><?=$arItem['NAME']?></span>
                    <?if ($arItem['PROPERTIES']['SUBTITLE']['VALUE']) {?>
                    <span class="all-collections-item__title-bigger"><?=$arItem['PROPERTIES']['SUBTITLE']['VALUE']?></span>
                    <?}?>
                </h3>
            </div>
    <?if ($arItem['PREVIEW_PICTURE']) {?>
            <div class="all-collections-item__image-wrapper">
                <img class="all-collections-item__image" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>">
            </div>
            <?}?>
        </div>
    </li>
    <?}?>
</ul>
<?}?>
<?=$arResult["NAV_STRING"]?>

