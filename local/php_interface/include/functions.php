<?php
/**
 * @author Lukmanov Mikhail <lukmanof92@gmail.com>
 */


/**
 * Получение запрошенного PROPERTY_ID раздела, включая родительский раздел, если не указан у текущего
 *
 * @param $PROPERTY_ID
 * @param bool $default_value
 * @return bool
 */
function AppGetCascadeDirProperties($PROPERTY_ID, $default_value = false)
{
    global $APPLICATION;
    $pathMap = explode("/", trim(substr($APPLICATION->GetCurDir(), strlen(SITE_DIR)), "/"));
    do {
        $path = SITE_DIR . implode("/", $pathMap);
        $propertyValue = $APPLICATION->GetDirProperty($PROPERTY_ID, $path, false);
        if ($propertyValue !== false) {
            break;
        }
        array_pop($pathMap);
    } while (!empty($pathMap));

    return $propertyValue === false ? $default_value : $propertyValue;
}

/**
 * Получение кода SVG изображения
 *
 * @param $filename
 * @return bool|false|mixed|string
 */
function GetContentSvgIcon($filename)
{
    $iconPath = $_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/frontend/img/svg/' . $filename . '.svg';
    if (file_exists($iconPath)) {
        return file_get_contents($iconPath);
    }
}

/**
 * @param      $dirPath
 *
 * @return string
 */
function GetCurDir($dirPath)
{
    if (!$dirPath) {
        return false;
    }
    $path = str_replace($_SERVER['DOCUMENT_ROOT'], '', str_replace('\\', '/', $dirPath));
    return substr($path, 0, 1) == '/' ? $path : '/' . $path;
}

/**
 * Получение изображения noPhoto
 *
 * @return string
 */
function GetNoPhoto()
{
    return SITE_TEMPLATE_PATH . '/frontend/img/noPhoto.png';
    //return 1;
}

/**
 * Получение строки из переданного массива, исходя из кол-ва
 *
 * @param      $number
 * @param      $titles
 * @param bool $appendNumber
 *
 * @return string
 */
function NumPluralForm($number, $titles, $appendNumber = false)
{
    $cases = array(2, 0, 1, 1, 1, 2);

    return ($appendNumber ? ($number . " ") : "") . $titles[($number % 100 > 4
            && $number % 100 < 20) ? 2 : $cases[min($number
            % 10, 5)]];
}

/**
 * Dump переменой, с дополнительной стилизацией
 *
 * @param $var
 */
function dump($var)
{
    echo '<pre style="background:#fff;color:#000;">';
    var_dump($var);
    echo '</pre>';
}

/**
 * Получение информации по основному филиалу
 */
function GetCurrentFilial()
{
    $arFilial = array();
    if (\Bitrix\Main\Loader::includeModule('iblock')) {
        $rs = CIBlockElement::GetList(
            array(),
            array('IBLOCK_ID' => 9, '!PROPERTY_DEFAULT_VALUE' => false),
            false,
            false,
            array('ID', 'IBLOCK_ID', 'PROPERTY_*')
        );
        while ($ar = $rs->GetNextElement()) {
            $arFilial = $ar->GetFields();
            $arFilial['PROPS'] = $ar->GetProperties();
        }
    }
    return $arFilial;
}

/**
 * Получение списка соц. сетей
 */
function GetSocialList()
{
    $arSocials = array();
    if (\Bitrix\Main\Loader::includeModule('iblock')) {
        $rs = CIBlockElement::GetList(
            array(),
            array('IBLOCK_CODE' => 'social'),
            false,
            false,
            array('ID', 'IBLOCK_ID', 'NAME', 'PROPERTY_*')
        );
        while ($ar = $rs->GetNextElement()) {
            $arSocial = $ar->GetFields();
            $arSocial['PROPS'] = $ar->GetProperties();
            $arSocials[] = $arSocial;
        }
    }
    return $arSocials;
}

/**
 * Получение баннера
 */
function GetBanner($urlPage = '')
{
    global $APPLICATION;
    $arBanner = array();
    if (\Bitrix\Main\Loader::includeModule('iblock')) {
        $url =  $urlPage ?: $APPLICATION->GetCurPage();
        $res = getBannerElement($url);
        if ($res['ID']) {
            return $res;
        } else {
            return getBannerElement($url, false);
        }

    }
    return getBannerElement($urlPage);
}

function getBannerElement($url, $isDefault = false) {
    $arBanner = array();

    $arFilter['IBLOCK_CODE'] = 'banners';
    $arFilter['=PROPERTY_URL'] = $url;

    $rs = CIBlockElement::GetList(
        array(),
        $arFilter,
        false,
        false,
        array('ID', 'IBLOCK_ID', 'NAME', 'PREVIEW_PICTURE', 'PREVIEW_TEXT', 'PROPERTY_*')
    );
    while ($ar = $rs->GetNextElement()) {
        $arBanner = $ar->GetFields();
        if ($arBanner['PREVIEW_PICTURE']) {
            $arBanner['PREVIEW_PICTURE'] = CFile::GetPath($arBanner['PREVIEW_PICTURE']);
        }
        $arBanner['PROPS'] = $ar->GetProperties();
    }
    if (count($arBanner) == 0) {
        unset($arFilter['?PROPERTY_URL']);
        $arFilter['PROPERTY_DEFAULT.ID'] = 7;

        $rs = CIBlockElement::GetList(
            array(),
            $arFilter,
            false,
            false,
            array('ID', 'IBLOCK_ID', 'NAME', 'PREVIEW_PICTURE', 'PREVIEW_TEXT', 'PROPERTY_*')
        );
        while ($ar = $rs->GetNextElement()) {
            $arBanner = $ar->GetFields();
            if ($arBanner['PREVIEW_PICTURE']) {
                $arBanner['PREVIEW_PICTURE'] = CFile::GetPath($arBanner['PREVIEW_PICTURE']);
            }
            $arBanner['PROPS'] = $ar->GetProperties();
        }
    }

    return $arBanner;
}

function cleanArray($array) {
    $result = array();
    foreach ($array as $k => $vl) {
        if (strlen($vl) > 0) {
            $result[] = $vl;
        }
    }
    return $result;
}

/**
 * Очистка строки от символов
 *
 * @param $text
 * @param string $search
 * @return mixed|string|string[]|null
 */
function prepareText($text, $search = '')
{
    $text = preg_replace("/(?![.=$'€%-])\p{P}/u", "", $text);
    $text = str_replace('.', ' ', $text);
    $text = str_replace(',', ' ', $text);
    $text = str_replace(' ', '', $text);
    $text = str_replace('-', '', $text);
    $text = str_replace('+', '', $text);
    if ($search) {
        $text = str_replace($search, ' ', $text);
    }
    return $text;
}

/**
 * Добавляем баннер в контент, по текущему адресу, view = banner
 *
 * @param string $urlPage
 */
function addBannerInContent($urlPage = '')
{
    global $APPLICATION;
    $arBanner = GetBanner($urlPage);
;
    if ($arBanner) {
        ob_start(); ?>
        <section class="new-design">
            <div class="new-design__inner">
                <h2 class="new-design__title"><?= $arBanner['PROPS']['SUBTITLE']['VALUE'] ?>
                    <? if ($arBanner['NAME']) { ?>
                        <span class="new-design__title-bigger"><?= $arBanner['NAME'] ?></span>
                    <? } ?>
                </h2>

                <div class="new-design__description-wrapper">
                    <p><?= htmlspecialchars_decode($arBanner['PREVIEW_TEXT']) ?></p>
                    <!-- <? if ($arBanner['PROPS']['LINK']['VALUE']) { ?>
                        <a class="new-design__link-detail link-detail"
                            href="<?= $arBanner['PROPS']['LINK']['VALUE'] ?>">
                            Подробнее
                            <?=GetContentSvgIcon('arrow-long')?>
                        </a>
                    <? } ?> -->
                </div>

                <div class="new-design__image-wrapper">
                    <?if ($arBanner['PREVIEW_PICTURE']) {?>
                        <img class="new-design__image" src="<?=$arBanner['PREVIEW_PICTURE']?>">
                    <?}?>
                </div>
                
            </div>
        </section>
        <?
        $content = ob_get_clean();
        $APPLICATION->AddViewContent('banner', $content);
    }
}

function isFavorites($productID)
{
    if (isset($_COOKIE['favorites']) && isset($_COOKIE['favorites'][$productID]) && $_COOKIE['favorites'][$productID] == $productID) {
        return 'product-card__to-favorites--active';
    }
    return '';
}

if (isset($_REQUEST['add_favorites']) && $_REQUEST['add_favorites'] == 'Y') {
    $result = array();
    if ($_REQUEST['product_id']) {
        if (isset($_COOKIE['favorites'][$_REQUEST['product_id']]) && $_COOKIE['favorites'][$_REQUEST['product_id']] == $_REQUEST['product_id']) {
            $result['message'] = 'Товар был ранее добавлен';
            $result['result'] = 'false';
        } else {
            setcookie('favorites[' .$_REQUEST['product_id'].']', $_REQUEST['product_id']);
            $result['message'] = 'Товар успешно добавлен';
            $result['result'] = 'true';
        }
    }
    $APPLICATION->RestartBuffer();
    echo json_encode($result);
    die();
}

if (isset($_REQUEST['del_favorites']) && $_REQUEST['del_favorites'] == 'Y') {

    $result = array();

    if ($_REQUEST['product_id']) {
        if (isset($_COOKIE['favorites'][$_REQUEST['product_id']]) && $_COOKIE['favorites'][$_REQUEST['product_id']] == $_REQUEST['product_id']) {
            unset($_COOKIE['favorites'][$_COOKIE['product_id']]);
            setcookie('favorites[' .$_REQUEST['product_id'].']', '');
            $result['message'] = 'Товар был удален из избранного';
            $result['result'] = 'true';
        } else {
            $result['message'] = 'Товара нет в избранном';
            $result['result'] = 'false';
        }
    }
    $APPLICATION->RestartBuffer();
    echo json_encode($result);
    die();
}

if ($_COOKIE['favorites']) {
    $_SESSION['favorites'] = $_COOKIE['favorites'];
}