<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */
?>
<? if ($arResult['ITEMS']) { ?>
    <section class="stocks">
        <h2 class="stocks__title section-title">команда</h2>

        <div class="stocks__slider-wrapper">
            <ul class="stocks__slider stocks-slider">
                <? foreach ($arResult['ITEMS'] as $arItem) { ?>
                    <li class="stocks-slider__item">
                        <div class="stocks-slider__inner">
                            <div class="stocks-slider__image-wrapper">
                                <img class="stocks-slider__image" src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>"
                                     alt="<?= $arItem['PREVIEW_PICTURE']['ALT'] ?>">
                            </div>

                            <div class="stocks-slider__text">
                                <h3 class="stocks-slider__title"><?= $arItem['NAME'] ?></h3>

                                <p class="stocks-slider__description"><?= $arItem['PREVIEW_TEXT'] ?></p>

                                <a style="display: none;" class="stocks-slider__link-detail link-detail" href="#">Подробнее
                                    <?= GetContentSvgIcon('arrow-long') ?>
                                </a>
                            </div>
                        </div>
                    </li>
                <? } ?>
            </ul>

            <div class="stocks__slider-options stocks-slider-options">
                <svg xmlns="http://www.w3.org/2000/svg" width="1601" height="70" viewBox="0 0 1601 17" fill="none">
                    <line x1="16" y1="8.5" x2="1601" y2="8.5" stroke="#F1C9B3" stroke-opacity="0.37"/>

                    <line class="stocks-slider-options__line" x1="16" y1="8.5" x2="16" y2="8.5" stroke="#AF6A4D"
                          stroke-width="3">
                        <animate class="stocks-slider-options__animate" attributeName="x2" from="16" to="808" dur="1s"
                                 fill="freeze" begin="indefinite"></animate>
                    </line>
                    <g class="stocks-slider-options__nav">
                        <g class="stocks-slider-options__item">
                            <rect x="0" y="0" width="60" height="60" fill="rgba(0,0,0,.001)"></rect>
                            <circle cx="8" cy="8.5" r="4.5" fill="#765B4A"/>
                            <circle cx="8" cy="8.5" r="8" stroke-opacity="0.8"/>
                            <text class="stocks-slider-options__item-text" x="0" y="40">01</text>
                        </g>

                        <g class="stocks-slider-options__item">
                            <rect x="378" y="0" width="60" height="60" fill="rgba(0,0,0,.001)"></rect>
                            <circle cx="408" cy="8.5" r="5.5" fill="#765B4A"/>
                            <circle cx="408" cy="8.5" r="8" stroke-opacity="0.8"/>
                            <text class="stocks-slider-options__item-text" x="400" y="40">02</text>
                        </g>

                        <g class="stocks-slider-options__item">
                            <rect x="778" y="0" width="60" height="60" fill="rgba(0,0,0,.001)"></rect>
                            <circle cx="808" cy="8.5" r="5.5" fill="#765B4A"/>
                            <circle cx="808" cy="8.5" r="8" stroke-opacity="0.8"/>
                            <text class="stocks-slider-options__item-text" x="800" y="40">03</text>
                        </g>
                    </g>
                    <!-- <g class="jumping-slider-options__item">
                      <rect x="1178" y="0" width="60" height="60" fill="rgba(0,0,0,.001)"></rect>
                      <circle cx="1208" cy="8.5" r="5.5" fill="#765B4A"/>
                      <circle cx="1208" cy="8.5" r="8" stroke-opacity="0.8"/>
                      <text class="jumping-slider-options__item-text" x="1200" y="40">04</text>
                    </g> -->


                    <!-- AF6A4D -->
                </svg>
            </div>
        </div>

        <!-- <a class="stocks__button-transition button-transition" href="/about/team.php">
            О нашей команде
            <?=GetContentSvgIcon('arrow-long')?>
        </a> -->
    </section>
<? } ?>