<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

if ($arResult['ITEMS']) { ?>
    <section class="banner" data-time-autoplay="<?= $arParams['AUTOPLAY_TIME'] ?>">
        <ul class="banner__list js-init-home-slider">
            <? foreach ($arResult['ITEMS'] as $key => $arItem) { ?>
                <li class="banner__item banner__item--slide-<?= $key ?>">
                    <img class="banner__item-bg" src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="">

                    <div class="banner__item-inner">
                        <h2 class="banner__title banner-title"><?= $arItem['NAME'] ?>
                            <? if ($arItem['PROPERTIES']['SUBTITLE']['VALUE']) { ?>
                                <span class="banner-title__bigger"><?= $arItem['PROPERTIES']['SUBTITLE']['VALUE'] ?></span>
                            <? } ?>
                        </h2>
                        <? if ($arItem['PREVIEW_TEXT'] || $arItem['PROPERTIES']['LINK']['VALUE']) { ?>
                            <div class="banner__description banner-description">
                                <? if ($arItem['PREVIEW_TEXT']) { ?>
                                    <p class="banner-description__text"><?= $arItem['PREVIEW_TEXT'] ?></p>
                                <? } ?>
                                <? if ($arItem['PROPERTIES']['LINK']['VALUE']) { ?>
                                    <a class="banner-description__button link-detail"
                                       href="<?= $arItem['PROPERTIES']['LINK']['VALUE'] ?>">
                                        <?= Loc::getMessage('HOME_SLIDER_BTN_READ_MORE') ?>
                                        <?= GetContentSvgIcon('arrow-long') ?>
                                    </a>
                                <? } ?>
                            </div>
                        <? } ?>
                    </div>
                </li>
            <? } ?>
        </ul>

        <div class="banner__options banner-options">
            <div class="banner-menu-diamond">
                <? foreach ($arResult['ITEMS'] as $key => $arItem) { ?>
                    <button class="banner-menu-diamond__button <?= $key == 0 ? 'banner-menu-diamond__button--active' : '' ?>"
                            data-slide-index="<?= $key ?>">
                        <?= GetContentSvgIcon('diamond') ?>
                    </button>
                <? } ?>
            </div>
            <div class="banner-menu-circle">
                <div class="banner-menu-circle__box">
                    <div class="banner-menu-circle__progress"></div>
                    <div class="banner-menu-circle__circle"></div>
                    <div class="banner-menu-circle__list">
                        <? foreach ($arResult['ITEMS'] as $key => $arItem) { ?>
                            <? $index = $key < 10 ? '0' . ++$key : ++$key ?>
                            <div class="dot__item" data-slide-index="<?= $key ?>"><span></span><?= $index ?></div>
                        <? } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<? } ?>