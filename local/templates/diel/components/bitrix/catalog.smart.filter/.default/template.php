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
    <section class="filter" style="z-index:100;display: none;">
        <form class="filter__form filter-form" action="<?= POST_FORM_ACTION_URI ?>">
            <h2 class="filter__title">Фильтр</h2>
            <input type="hidden" name="set_filter" value="y"/>
            <button class="filter__close">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20 0.908974L19.091 0L10 9.09103L0.908974 0L0 0.908974L9.09103 10L0 19.091L0.908974 20L10 10.909L19.091 20L20 19.091L10.909 10L20 0.908974Z"
                          fill="rgba(255, 255, 255, 0.5)"/>
                </svg>
            </button>

            <div class="filter__section filter__section-reset">
                <button class="filter__reset" type="reset">Сбросить фильтр</button>
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
                                        <input type="text"
                                               data-<?= mb_strtolower($code) ?>="<?= $value['VALUE'] ?>"
                                               name="<?= $value['CONTROL_NAME'] ?>"
                                               class="filter__price-<?= strtolower($code) ?>"
                                               id="<?= $value['CONTROL_ID'] ?>"
                                               value="<?= $value['HTML_VALUE'] ?: $value['VALUE'] ?>">
                                        <?= $code == 'MIN' ? '<span>-</span>' : '' ?>
                                        <?
                                    } ?>
                                </div>
                                <?
                                break;
                            case 'P': //dropdown
                                ?>
                                <div class="diel-select">
                                    <select name="<?= $arParams["FILTER_NAME"] ?>_<?= $arFilterItem["ID"] ?>"
                                            id="<?= $arParams["FILTER_NAME"] ?>_<?= $arFilterItem["ID"] ?>">
                                        <?
                                        $isChecked = false;
                                        foreach ($arFilterItem['VALUES'] as $value) { ?>
                                            <option id="<?= $value['CONTROL_ID'] ?>"
                                                    value="<?= ($value['HTML_VALUE_ALT']) ?>"
                                                <?= $value['CHECKED'] ? 'selected' : '' ?>><?= $value['VALUE'] ?></option>
                                            <? if (isset($value['CHECKED'])) {
                                                $isChecked = true;
                                            }
                                        } ?>
                                        <option <?= !$isChecked ? 'selected' : '' ?> disabled>Не выбрано</option>
                                    </select>
                                </div>
                                <?
                                break;
                            case 'F': //checkbox
                                foreach ($arFilterItem['VALUES'] as $value) {
                                    ?>
                                    <label class="filter__section-checkbox">
                                        <input class="input-checkbox"
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
                                        <input id="<?= $value['CONTROL_ID'] ?>"
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