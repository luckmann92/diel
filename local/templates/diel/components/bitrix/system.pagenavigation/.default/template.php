<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @author Danil Syromolotov <ds@itex.ru>
 */
/**
 * @var CBitrixComponent $component
 * @var CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 */

if ($arResult["nEndPage"] == $arResult["nStartPage"]) {
    return;
}
$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"] . "&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?" . $arResult["NavQueryString"] : "");

?>
<nav class="page__pagination">
    <ul class="pagination">
        <? for ($curPage = $arResult["nStartPage"]; $curPage <= $arResult["nEndPage"]; $curPage++): ?>
        <li class="pagination__item">
            <a class="pagination__link" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $curPage ?>"><?= $curPage; ?></a>
        </li>
        <? endfor; ?>
        <? if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]) { ?>
        <li class="pagination__item">
            <a class="pagination__link pagination__link-next" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="41" height="16" viewBox="0 0 41 16" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M33.6888 0.18457L32.0195 1.94707L37.4418 7.68457L32.0195 13.4221L33.6888 15.1846L40.7923 7.68457L33.6888 0.18457Z" fill="white"></path>
                    <path d="M38.3142 7.68542H1" stroke="white" stroke-width="2" stroke-linecap="square"></path>
                </svg>
            </a>
        </li>
        <? } ?>
    </ul>
</nav>