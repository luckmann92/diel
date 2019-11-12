<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

if ($arResult['ITEMS']) { ?>
    <section class="banner">
        <ul class="banner__list">
            <? foreach ($arResult['ITEMS'] as $key => $arItem) { ?>
                <li class="banner__item banner__item--slide-<?= $key ?>">
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
            <div class="banner__options banner-options">
                <div class="banner-menu-diamond">
                    <? foreach ($arResult['ITEMS'] as $key => $arItem) { ?>
                        <button class="banner-menu-diamond__button <?= $key == 0 ? 'banner-menu-diamond__button--active' : '' ?>">
                            <?= GetContentSvgIcon('diamond') ?>
                        </button>
                    <? } ?>
                </div>
                <div class="banner-menu-circle">
                    <svg width="1041" height="964" viewBox="0 0 1041 964" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <circle cx="559" cy="482" r="480" stroke="#F1C9B3" stroke-opacity="0.3" stroke-width="4"/>

                        <clipPath id="transition-svg">
                            <circle cx="94" cy="361" r="0">
                                <animate attributeName="r" fill="freeze" from="0" to="390" dur="20s"
                                         begin="indefinite"/>
                            </circle>
                        </clipPath>

                        <path d="M94 361 A 460 480 0 0 1 339 55" stroke="#AF6A4D" stroke-width="4.5"
                              clip-path="url(#transition-svg)"/>

                        <g class="banner-menu-circle__nav">
                            <g class="banner-menu-circle__nav-btn banner-menu-circle__nav-btn--active">
                                <rect x="8" y="335" width="100" height="50" fill="rgba(0,0,0,.001)"/>

                                <circle cx="94.5" cy="361.5" r="4" fill="#765B4A" fill-opacity="0.8"/>
                                <circle cx="94.5" cy="361.5" r="6.5" stroke="#765B4A" stroke-opacity="0.8"/>
                                <line x1="42" y1="360.5" x2="76" y2="360.5" stroke="#765B4A" stroke-opacity="0.8"/>
                                <text class="banner-menu-circle__nav-text" x="10" y="365">01</text>
                            </g>

                            <g class="banner-menu-circle__nav-btn">
                                <rect x="100" y="160" width="100" height="50" fill="rgba(0,0,0,.001)"/>

                                <circle cx="181" cy="185" r="4.52941" fill="#765B4A" fill-opacity="0.8"/>
                                <circle cx="181" cy="185" r="6.5" stroke="#765B4A" stroke-opacity="0.8"/>
                                <line x1="135" y1="185" x2="160" y2="185" stroke="#765B4A" stroke-opacity="0.8"/>
                                <text class="banner-menu-circle__nav-text" x="100" y="190">02</text>
                            </g>

                            <g class="banner-menu-circle__nav-btn">
                                <rect x="250" y="30" width="100" height="50" fill="rgba(0,0,0,.001)"/>

                                <circle cx="339.002" cy="55.0001" r="4.52941" fill="#765B4A" fill-opacity="0.8"/>
                                <circle cx="339" cy="55" r="6.5" stroke="#765B4A" stroke-opacity="0.8"/>
                                <line x1="297" y1="54.5" x2="321" y2="54.5" stroke="#765B4A" stroke-opacity="0.8"/>
                                <text class="banner-menu-circle__nav-text" x="260" y="60">03</text>
                            </g>
                        </g>
                    </svg>
                </div>
            </div>
    </section>
<? } ?>