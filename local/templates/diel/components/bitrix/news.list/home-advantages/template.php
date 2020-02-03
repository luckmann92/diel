<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
if ($arResult['ITEMS']) { ?>
    <section class="advantages">
        <div class="advantages-title-wrapper">
            <h2 class="advantages__title section-title"><?= $arParams['BLOCK_TITLE'] ?></h2>
            <button class="advantages__button-next button-next js-init-home-slider-advantages__next">
                <?=GetContentSvgIcon('button-next-big')?>
            </button>
        </div>

        <ul class="advantages__list advantages-list js-init-home-slider-advantages">
            <? foreach ($arResult['ITEMS'] as $key => $arItem) { ?>
                <li class="advantages-list__item advantages-article <?=$key%2?'even':'odd'?>">
                    <div class="advantages-article__inner">
                        <a class="advantages-article__image-wrapper" href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
                            <? if ($arItem['PREVIEW_PICTURE']) { ?>
                                <img class="advantages-article__image"
                                     src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>"
                                     alt="<?= $arItem['PREVIEW_PICTURE']['ALT'] ?>">
                            <? } ?>
                            <div class="advantages-article__image-mask"></div>
                            <button class="advantages-article__button-prev">
                                <?= GetContentSvgIcon('button-prev') ?>
                            </button>
                            <button class="advantages-article__button-next">
                                <?= GetContentSvgIcon('button-next') ?>
                            </button>
                        </a>

                        <h3 class="advantages-article__title"><?= $arItem['NAME'] ?></h3>
                        <? if ($arItem['PREVIEW_TEXT']) { ?>
                            <p class="advantages-article__text"><?= $arItem['PREVIEW_TEXT'] ?></p>
                        <? } ?>
                        <a class="advantages-article__button link-detail" href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
                            <?= Loc::getMessage('HOME_ADVANTAGES_BTN_READ_MORE') ?>
                            <?= GetContentSvgIcon('arrow-long') ?>
                        </a>
                    </div>
                </li>
            <? } ?>
        </ul>
    </section>
<? } ?>