<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

?>
<? if ($arResult["ITEMS"]) { ?>
    <section class="popup popup-smart-filter filter filter-vertical" style="display: block;">
        <form class="filter__form filter-form" action="<?= POST_FORM_ACTION_URI ?>" data-url="<?=$APPLICATION->GetCurPage()?>" id="popupSmartFilter">
            <h2 class="filter__title">Фильтр</h2>
            <input type="hidden" name="set_filter" value="y"/>
            <button class="popup__close filter__close js-init-close-menu" type="button">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20 0.908974L19.091 0L10 9.09103L0.908974 0L0 0.908974L9.09103 10L0 19.091L0.908974 20L10 10.909L19.091 20L20 19.091L10.909 10L20 0.908974Z"
                          fill="rgba(255, 255, 255, 0.5)"/>
                </svg>
            </button>

            <div class="filter__section filter__section-reset">
                <a href="<?=$APPLICATION->GetCurPage()?>" style="display: inline-block;text-decoration: none" class="filter__reset" type="reset">Сбросить фильтр</a>
            </div>
            <? foreach ($arResult["ITEMS"] as $k => $arFilterItem) {
                if ($arFilterItem['VALUES']) { ?>
                    <div class="filter__section">
                        <h3 class="filter__section-title"><?= $arFilterItem['NAME'] ?></h3>
                        <? switch ($arFilterItem['DISPLAY_TYPE']) {
                            case 'A':
                                ?>
                                <div class="filter__price-wrapper">
                                    <?
                                    foreach ($arFilterItem['VALUES'] as $code => $value) { ?>
                                        <input type="number"
                                               data-<?= mb_strtolower($code) ?>="<?= round($value['VALUE']) ?>"
                                               name="<?= $value['CONTROL_NAME'] ?>"
                                               class="filter__price-<?= strtolower($code) ?> js-init-filter filter__price-input"
                                               id="<?= $value['CONTROL_ID'] ?>"
                                               value="<?= $value['HTML_VALUE'] ? round($value['HTML_VALUE']) : round($value['VALUE']) ?>">
                                        <?= $code == 'MIN' ? '<span>-</span>' : '' ?>
                                        <? } ?>
                                </div>
                                <div class="filter__price-slider-container">
                                    <div id="polzunok"></div>
                                </div>
                                <?
                                break;
                            case 'P': //dropdown
                                ?>
                                <div class="diel-select">
                                    <button class="diel-select__button" type="button">
                                        <span class="diel-select__button-text">Не выбрано</span>
                                    </button>
                                    <ol class="diel-select__list diel-select-list"></ol>

                                    <select class="filter__diel-js js-init-filter" name="<?= $arParams["FILTER_NAME"] ?>_<?= $arFilterItem["ID"] ?>"
                                            id="<?= $arParams["FILTER_NAME"] ?>_<?= $arFilterItem["ID"] ?>" hidden>
                                        <?
                                        $isChecked = false;
                                        foreach ($arFilterItem['VALUES'] as $value) { ?>
                                            <option class="filter__diel-option-js" id="<?= $value['CONTROL_ID'] ?>"
                                                    value="<?= ($value['HTML_VALUE_ALT']) ?>"
                                                <?= $value['CHECKED'] ? 'selected' : '' ?>><?= $value['VALUE'] ?></option>
                                            <? if (isset($value['CHECKED'])) {
                                                $isChecked = true;
                                            }
                                        } ?>
                                        <option class="filter__diel-option-js" <?= !$isChecked ? 'selected' : '' ?> disabled>Не выбрано</option>
                                    </select>
                                </div>
                                <?
                                break;
                            case 'F': //checkbox
                                foreach ($arFilterItem['VALUES'] as $value) {
                                    ?>
                                    <label class="filter__section-checkbox">
                                        <input class="input-checkbox js-init-filter"
                                               name="<?= $value['CONTROL_NAME'] ?>"
                                               id="<?= $value['CONTROL_ID'] ?>"
                                               value="<?= $value['HTML_VALUE'] ?>"
                                               type="checkbox" <?= $value['CHECKED'] ? 'checked="checked"' : '' ?>><?= $value['VALUE'] ?>
                                    </label>
                                    <?
                                }
                                break;
                            case 'K': //radio buttons
                                //dump($value);
                                foreach ($arFilterItem['VALUES'] as $value) { ?>
                                    <label class="filter__section-radio" for="<?= $value['CONTROL_ID'] ?>">
                                        <input id="<?= $value['CONTROL_ID'] ?> js-init-filter"
                                               class="input-radio"
                                               type="radio"
                                               value="<?= $value['HTML_VALUE'] ?>"
                                               name="<?= $value["CONTROL_NAME"] ?>"
                                               id="<?= $value['CONTROL_ID'] ?>"
                                            <?= $value['CHECKED'] ? 'checked="checked"' : '' ?>><?= $value['VALUE'] ?>
                                    </label>
                                    <?
                                }
                                break;
                        } ?>


                    </div>
                <? } ?>
            <? } ?>
            <div class="filter__section filter__section-submit ">
                <button class="filter__reset" type="submit">Применить фильтр</button>
            </div>
        </form>
    </section>
<? } ?>