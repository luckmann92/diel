<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */
?>

<?if ($arResult['SECTIONS']) {?>
<ul class="filter__tag-list filter-tag-list">
    <?foreach ($arResult['SECTIONS'] as $arSection) {?>
    <li class="filter-tag-list__item">
        <a class="filter-tag-list__link" href="<?=$arSection['SECTION_PAGE_URL']?>"><?=$arSection['NAME']?></a>
    </li>
    <?}?>
</ul>
<?}?>