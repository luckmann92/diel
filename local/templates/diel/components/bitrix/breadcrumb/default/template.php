<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */

if (empty($arResult)) {
    return;
}
ob_start();

if ($arResult) {?>

<nav class="page__breadcrumbs">
    <ul class="breadcrumbs">
        <?foreach ($arResult as $key => $arLink) { ?>
            <li class="breadcrumbs__item">
                <?
                if ($key == count($arResult) - 1) { ?>
                    <span class="breadcrumbs__link"><?= $arLink["TITLE"] ?></span>
                <? } else { ?>
                    <a class="breadcrumbs__link" href="<?= $arLink["LINK"] ?>"><?= $arLink["TITLE"] ?></a>
                <? } ?>
            </li>
        <?}?>
    </ul>
</nav>
<?}
return ob_get_clean(); ?>
