<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */
?>
<? if ($arResult['ITEMS']) { ?>
    <?if ($arParams['TYPE_PAGE'] == 'about') {?>
    <section class="all-collections all-collections--block">
        <h2 class="all-collections__title section-title">Новости</h2>
<?}?>
        <ul class="all-collections__list all-collections-list">
            <? foreach ($arResult['ITEMS'] as $arItem) { ?>
                <li class="all-collections__item all-collections-item">
                    <div class="all-collections-item__inner">

                        <div class="all-collections-item__description">
                            <p class="news__date"><?= $arItem['DISPLAY_ACTIVE_FROM'] ?></p>
                            <p class="all-collections-item__p"><?= $arItem['PREVIEW_TEXT'] ?></p>

                            <a class="all-collections-item__button-detail link-detail"
                            href="<?= $arItem['DETAIL_PAGE_URL'] ?>">Подробнее
                                <?= GetContentSvgIcon('arrow-long') ?>
                            </a>

                            <h3 class="all-collections-item__title">
                                <span><?= $arItem['PROPERTIES']['TITLE']['VALUE'] ?></span>
                                <span class="all-collections-item__title-bigger"><?= $arItem['PROPERTIES']['SUBTITLE']['VALUE'] ?></span>
                            </h3>
                        </div>

                        <div class="all-collections-item__image-wrapper">
                            <img class="all-collections-item__image" src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $arItem['PREVIEW_PICTURE']['ALT'] ?>">
                        </div>
                    </div>
                </li>
            <? } ?>
        </ul>
    <?if ($arParams['TYPE_PAGE'] == 'about') {?>
    </section>
<? } ?>
<? } ?>