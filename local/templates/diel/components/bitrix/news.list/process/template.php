<section class="page-for-buyer__work-process work-process">
    <h2 class="work-process__title section-title">процесс работы</h2>

    <div class="work-process__slider-wrapper">
        <ul class="work-process__slider jumping-slider">
            <?foreach ($arResult['ITEMS'] as $k => $arItem) {?>
            <li class="jumping-slider__item">
                <div class="jumping-slider__image-wrapper">
                    <img class="jumping-slider__image" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>">
                </div>

                <div class="jumping-slider__text">
                    <h3 class="jumping-slider__title"><?=$arItem['NAME']?></h3>

                    <p class="jumping-slider__description"><?=$arItem['PREVIEW_TEXT']?></p>
                </div>
            </li>
<?}?>
        </ul>

        <div class="work-process__slider-options jumping-slider-options">
            <svg xmlns="http://www.w3.org/2000/svg" width="1601" height="70" viewBox="0 0 1601 17" fill="none">
                <line x1="16" y1="8.5" x2="1601" y2="8.5" stroke="#F1C9B3" stroke-opacity="0.37"/>

                <line class="jumping-line" x1="16" y1="8.5" x2="16" y2="8.5" stroke="#AF6A4D" stroke-width="3">
                    <animate class="jumping-animate" attributeName="x2" from="16" to="808" dur="1s" fill="freeze" begin="indefinite"></animate>
                </line>
                <g class="jumping-slider-options__nav">
                    <g class="jumping-slider-options__item">
                        <rect x="0" y="0" width="60" height="60" fill="rgba(0,0,0,.001)"></rect>
                        <circle cx="8" cy="8.5" r="4.5" fill="#765B4A"/>
                        <circle cx="8" cy="8.5" r="8" stroke-opacity="0.8"/>
                        <text class="jumping-slider-options__item-text" x="0" y="40">01</text>
                    </g>

                    <g class="jumping-slider-options__item">
                        <rect x="378" y="0" width="60" height="60" fill="rgba(0,0,0,.001)"></rect>
                        <circle cx="408" cy="8.5" r="5.5" fill="#765B4A"/>
                        <circle cx="408" cy="8.5" r="8" stroke-opacity="0.8"/>
                        <text class="jumping-slider-options__item-text" x="400" y="40">02</text>
                    </g>

                    <g class="jumping-slider-options__item">
                        <rect x="778" y="0" width="60" height="60" fill="rgba(0,0,0,.001)"></rect>
                        <circle cx="808" cy="8.5" r="5.5" fill="#765B4A"/>
                        <circle cx="808" cy="8.5" r="8" stroke-opacity="0.8"/>
                        <text class="jumping-slider-options__item-text" x="800" y="40">03</text>
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
</section>