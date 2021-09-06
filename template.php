<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
use \Bitrix\Main\Localization\Loc;
/**
* @global CMain $APPLICATION
* @var array $arParams
* @var array $arResult
* @var CatalogSectionComponent $component
* @var CBitrixComponentTemplate $this
* @var string $templateName
* @var string $componentPath
* @var string $templateFolder
*/
$this->setFrameMode(true);?>
<?if($arResult['PROPERTIES']['YA_GOAL_ID']['VALUE']):?>
  <?$dataYaGoalId = ' data-yagoalid="' . $arResult['PROPERTIES']['YA_GOAL_ID']['VALUE'] . '"';?>
<?endif;?>
<?if($arResult['PROPERTIES']['YA_GOAL_ID2']['VALUE']):?>
  <?$dataYaGoalId2 = ' data-yagoalid="' . $arResult['PROPERTIES']['YA_GOAL_ID2']['VALUE'] . '"';?>
<?endif;?>

<div class="dserv__wrap uslug_wrap">

  <?if(is_array($arResult['PROPERTIES']['SLIDER_GALLERY']['VALUE'])):?>
    <?/* SLIDER */?>
    <div class="head-slides">
      <?foreach ($arResult['PROPERTIES']['SLIDER_GALLERY']['VALUE'] as $slide):?>
        <div class="head-slide head-slides-item" style="background-image: url(<?=CFile::GetPath($slide);?>);">
          <div class="block-content container">
            <h1 class="head"><?=$arResult['NAME'];?></h1>
          </div>
        </div>
      <?endforeach;?>
    </div>
    <?if(count($arResult['PROPERTIES']['SLIDER_GALLERY']['VALUE'] > 1)):?>
      <script>
        $(document).ready(function() {
          $('.head-slides').owlCarousel({
            loop: false,
            margin:0,
            items: 1,
            nav:true,
            dots:true,
            navText:['<div class="head-slides__left"></div>', '<div class="head-slides__right"></div>'],
          });
        });
      </script>
    <?endif;?>
  <?elseif ($arResult['PROPERTIES']['FULL_WIDTH_BANNER']['VALUE_XML_ID'] == "Y"):?>
    <?/* FULL BABBER */?>
    <style>
      .breadcrumb  {display: none }
      .head-slide .breadcrumb { display:block; }
    </style>

    <div class="head-slide" style="background-image: url(<?=$arResult['DETAIL_PICTURE']['SRC'];?>);">
      <div class="block-content container">
        <?$APPLICATION->IncludeComponent(
          "bitrix:breadcrumb", 
          "clinic", 
          array(
            "START_FROM" => "0",
            "PATH" => "",
            "SITE_ID" => "s1",
            "COMPONENT_TEMPLATE" => "clinic",
            "COMPOSITE_FRAME_MODE" => "A",
            "COMPOSITE_FRAME_TYPE" => "AUTO"
          ),
          false
        );?>
        <h1 class="head"><?=$arResult['NAME'];?></h1>
        <p class="content"><?=$arResult['DETAIL_TEXT'];?></p>
        <a href="javascript:void(0);" class="btn phone_in" data-yagoalid="perezvonitemne">Получить консультацию</a>
      </div>
    </div>
  <?else:?>
    <div class="container">
      <h1 class="title_big_lb">
        <span><?=$arResult['NAME'];?></span>
      </h1>
      <?php /* -------------------------- ФОРМА С ТЕКСТОМ -------------------------- */ ?>
      <div class="alc-head clearfix">
        <div class="alc-head__left">
          <div class="alc-head-desc" style="background-image: url(<?=$arResult['DETAIL_PICTURE']['SRC'];?>);">
            <?if($arResult['DETAIL_TEXT'] != ''):?>
              <div class="alc-head-desc__text">
                <?=$arResult['DETAIL_TEXT'];?>
              </div>
            <?endif;?>
          </div>
        </div>
        <div class="alc-head__right">
          <div class="admission__form admission__form--100p">
            <form class="ajax-form"<?=$dataYaGoalId;?><?=$dataYaGoalId2;?>>
              <div class="one_et">
                <div class="admission__form_title">Запись на первичный прием</div>
                <input type="text" placeholder="Как к Вам обращаться" class="input_t form__name">
                <input type="text" placeholder="Ваш номер телефона" class="input_t form__phone">
                <button type="button" class="btn white sign_up">Записаться</button>
                <div class="check_r">
                  <div class="check">
                    <label class="clearfix">
                      <span class="check_ch">
                        <input type="checkbox" name="sog">
                        <span class="check_bt">
                          <i class="fa fa-check" aria-hidden="true"></i>
                        </span>
                      </span>
                      <span class="check_t">Я согласен, на обработку персональных данных</span>
                    </label>
                  </div>
                </div>
              </div>
              <div class="two_et">
                <div class="admission__form_title">Когда вам позвонить?</div>
                <div class="but_obr">
                  <button type="button" date_now="Позвонить сейчас" class="btn white now">Сейчас</button>
                  <button type="button" class="btn white chengtime">Выбрать время</button>
                </div>
              </div>
              <div class="three_et">
                <div class="admission__form_title">Когда вам позвонить?</div>
                <div class="but_obr">
                  <input class="input_t date" type="date" value="<?=date('Y-m-d');?>">
                  <input class="input_t time" type="time" value="<?=date('H:i');?>">
                </div>
                <button type="button" date_now="Позвонить в другое время" class="btn white done">Готово</button>
              </div>
              <div class="four_et"><img src="/bitrix/templates/clinic/images/blag.png" alt=""></div>
            </form>
          </div>
        </div>
      </div>
      <?php /* -------------------------- ФОРМА С ТЕКСТОМ -------------------------- */ ?>
    </div>
  <?endif;?>
    
  <?/* <noscript id="seomodule-aftr-bnnr"></noscript> */?>
    
  <div class="container">

    <?php /* -------------------------- ТЕКСТ -------------------------- */ ?>
    <? if (!empty ($arResult['PROPERTIES']['TEXT_DOP_PRICE']['VALUE']['TEXT'])):?>
      <div class="text dop-text-price detail-service-text">
        <?if($arResult['PROPERTIES']['TEXT_DOP_PRICE']['VALUE']['TYPE'] == "TEXT"):?>
          <?=$arResult['PROPERTIES']['TEXT_DOP_PRICE']['VALUE']['TEXT'];?>
        <?else:?>
          <?=$arResult['PROPERTIES']['TEXT_DOP_PRICE']['~VALUE']['TEXT'];?>
        <?endif;?>
      </div>
    <?endif;?>
    <?php /* -------------------------- ТЕКСТ -------------------------- */ ?>

    <?php /* -------------------------- СТОИМОСТЬ УСЛУГ -------------------------- */ ?>
    <?if(!empty($arResult['PROPERTIES']['SRV_VARIANTS']['VALUE'])):?>
      <div class="price-variants">
        <div class="price-variants__caption">
          <?if(!empty($arResult['PROPERTIES']['SRV_VARIANTS_CAPTION']['VALUE'])):?>
            <?=$arResult['PROPERTIES']['SRV_VARIANTS_CAPTION']['VALUE']?>
          <?else:?>
            СТОИМОСТЬ УСЛУГ
          <?endif;?>
        </div>
        <div class='price-variants__container'>
          <?foreach($arResult['PROPERTIES']['SRV_VARIANTS']['VALUE'] as $iVar => $arVar): ?>
            <div class="price-variants__item">
              <div class="price-variants__name">
                <?if(!empty($arVar['SUB_VALUES']['SYSTEM_HREF_TO_PAGE']['VALUE'])):?>
                  <a href="<?=$arVar['SUB_VALUES']['SYSTEM_HREF_TO_PAGE']['VALUE'];?>">
                    <?=$arVar['SUB_VALUES']['SYSTEM_VAR_TITLE']['VALUE'];?>
                  </a>
                <?else:?>
                  <?=$arVar['SUB_VALUES']['SYSTEM_VAR_TITLE']['VALUE'];?>
                <?endif;?>
              </div>
              <div class="price-variants__description">
                <?if($arVar['SUB_VALUES']['SYSTEM_VAR_DESC']['~VALUE']['TEXT']):?>
                  <?=$arVar['SUB_VALUES']['SYSTEM_VAR_DESC']['~VALUE']['TEXT'];?>
                <?endif;?>
              </div>

              <div class="price-variants__time">
                <?if($arVar['SUB_VALUES']['PROCEDURE_TIME']['VALUE']):?>
                  <span><?=$arVar['SUB_VALUES']['PROCEDURE_TIME']['VALUE'];?></span>
                <?endif;?>
              </div>

              <div class="price-variants__price">
                <?if($arVar['SUB_VALUES']['SYSTEM_VAR_COST']['VALUE']):?>
                  <span><?=$arVar['SUB_VALUES']['SYSTEM_VAR_COST']['VALUE'];?></span> 
                <?endif;?>
              </div>
            </div>
          <? endforeach; ?>
        </div>
      </div>
    <?endif;?>
    <?php /* -------------------------- СТОИМОСТЬ УСЛУГ -------------------------- */ ?>
    
    <?/* <noscript id="seomodule-do-blokov"></noscript> */?>

  </div>
</div>


<?php /* -------------------------- УСЛУГИ -------------------------- */ ?>
<?if($arResult['DOP_SERVICES']):?>
  <div class="uslugi container" id="uslugi">
    <div class="sssmb_clr"></div>
    <div class="sssmb_articles">
      <div class="sssmb_h2 sssmb_h2_cols">
        <div class="col">
          <h2>Статьи</h2>
        </div>
        <div class="col rght">
          <a href="/stati/">Все статьи</a>
        </div>
      </div>
      
      <?foreach($arResult['DOP_SERVICES'] as $dopService):?>
        <div class="sssmba_itm">
          <div class="sssmba_tit">
            <? $arrHref = explode("/", $dopService['DETAIL_PAGE_URL']); $href = "/";?>
            <?foreach($arrHref as $step => $hrefStep):?>
              <?if($step > 1):?>
                <?if($hrefStep != ""):?>
                  <? $href .= $hrefStep . "/";?>
                <?endif;?>
              <?endif;?>
            <?endforeach;?>
            <a href="<?=$href;?>"><?=$dopService['NAME'];?></a>
          </div>
          <div class="sssmba_text-img">
            <div class="sssmba_img">
              <img itemprop="image" src="<?=$dopService['PREVIEW_PICTURE_SRC'];?>" alt="<?=$dopService['NAME'];?>">
            </div>
            <div class="sssmba_inf">
              <div class="sssmba_txt"><?=$dopService['PREVIEW_TEXT'];?></div>
              <div class="sssmba_href"><a href="/<?=$dopService['CODE'];?>/">Подробнее...</a></div>
            </div>
          </div>
        </div>
        
      <?endforeach;?>
      
    </div>
    
    <div class="sssmb_clr"></div>

  </div>
<?endif;?>
<?php /* -------------------------- УСЛУГИ -------------------------- */ ?>


<?php /* -------------------------- О КОМПАНИИ -------------------------- */ ?>
<div class='about-clinics'>
  <section class="s_about">
    <div class="container clearfix">
      <?php if (
        count($arResult['PROPERTIES']['GALLERY']['VALUE']) > 0 &&
        $arResult['PROPERTIES']['GALLERY_HEAD']['VALUE'] != ''
      ) { ?>
        <h2><?php echo $arResult['PROPERTIES']['GALLERY_HEAD']['~VALUE']?></h2>
        <div class='about-clinics-slider'>
          <div class='about-clinics-sliders__slider-big'>
            <div class='about-clinics-sliders__slider'>
              <?php foreach ($arResult['PROPERTIES']['GALLERY']['VALUE'] as $imgID) { ?>
                <div class="about-clinics-sliders__item" style="background-image: url('<?=CFile::GetPath($imgID)?>')"></div>
              <?php } ?>
            </div>
            <div class="owl-dots"></div>
            <div class="navigation arrows"></div>
          </div>
          <div class='about-clinics-sliders__slider-mini'>
            <div class='about-clinics-sliders__slider'>
              <?php foreach ($arResult['PROPERTIES']['GALLERY']['VALUE'] as $imgID) { ?>
                <div class="about-clinics-sliders__item" style="background-image: url('<?=CFile::GetPath($imgID)?>')"><div class='shadow'></div></div>
              <?php } ?>
            </div>
          </div>
        </div>
      <?php } ?>
      <div class="s_about__left right">
        <div class="s_license">
          <div class="title_middle">Лицензии</div>

          <?$APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "homelicensies",
            Array(
              "ACTIVE_DATE_FORMAT" => "d.m.Y",
              "ADD_SECTIONS_CHAIN" => "N",
              "ADD_ELEMENT_CHAIN" => "N",
              "AJAX_MODE" => "N",
              "AJAX_OPTION_ADDITIONAL" => "",
              "AJAX_OPTION_HISTORY" => "N",
              "AJAX_OPTION_JUMP" => "N",
              "AJAX_OPTION_STYLE" => "Y",
              "CACHE_FILTER" => "N",
              "CACHE_GROUPS" => "Y",
              "CACHE_TIME" => "36000000",
              "CACHE_TYPE" => "A",
              "CHECK_DATES" => "Y",
              "DETAIL_URL" => "",
              "DISPLAY_BOTTOM_PAGER" => "Y",
              "DISPLAY_DATE" => "Y",
              "DISPLAY_NAME" => "Y",
              "DISPLAY_PICTURE" => "Y",
              "DISPLAY_PREVIEW_TEXT" => "Y",
              "DISPLAY_TOP_PAGER" => "N",
              "FIELD_CODE" => array("DETAIL_PICTURE", ""),
              "FILTER_NAME" => "",
              "HIDE_LINK_WHEN_NO_DETAIL" => "N",
              "IBLOCK_ID" => "6",
              "IBLOCK_TYPE" => "content",
              "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
              "INCLUDE_SUBSECTIONS" => "Y",
              "MESSAGE_404" => "",
              "NEWS_COUNT" => "15",
              "PAGER_BASE_LINK_ENABLE" => "N",
              "PAGER_DESC_NUMBERING" => "N",
              "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
              "PAGER_SHOW_ALL" => "N",
              "PAGER_SHOW_ALWAYS" => "N",
              "PAGER_TEMPLATE" => ".default",
              "PAGER_TITLE" => "Новости",
              "PARENT_SECTION" => "",
              "PARENT_SECTION_CODE" => "",
              "PREVIEW_TRUNCATE_LEN" => "",
              "PROPERTY_CODE" => array(),
              "SET_BROWSER_TITLE" => "Y",
              "SET_LAST_MODIFIED" => "N",
              "SET_META_DESCRIPTION" => "Y",
              "SET_META_KEYWORDS" => "Y",
              "SET_STATUS_404" => "N",
              "SET_TITLE" => "Y",
              "SHOW_404" => "N",
              "SORT_BY1" => "ACTIVE_FROM",
              "SORT_BY2" => "SORT",
              "SORT_ORDER1" => "DESC",
              "SORT_ORDER2" => "ASC",
              "STRICT_SECTION_CHECK" => "N"
            )
          );?>
        </div>
      </div>
      
      <div class="s_about__right left">
        <div class="about__block">
          <div class="about__block_desc">
            <?$APPLICATION->IncludeFile( SITE_DIR."include/home_about.php", Array(), Array("MODE"=>"html") );?>
          </div>
          <div class="about__block_btn">
            <a href="/about/" class="btn">Читать полностью</a>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php /* -------------------------- О КОМПАНИИ -------------------------- */ ?>


<?php /* -------------------------- ФОРМА КОНСУЛЬТАЦИИ -------------------------- */ ?>
<section class="cause cause-middle cause-new" id="cause-new">
  <div class="container">
    <div class="cause__wrap d-flex d-550-block clearfix">
      <div class="cause__left cause__left--img left">
        <div class="cause-left-text-wrap">
          <?$APPLICATION->IncludeFile( SITE_DIR."include/block_services_text.php", Array(), Array("MODE"=>"html") );?>
        </div>
      </div>
      <div class="cause__right right">
        <div class="st_form">
          <form class="ajax-form"<?=$dataYaGoalId?><?=$dataYaGoalId2?>>
            <div class="one_et">
              <input type="text" placeholder="Как к Вам обращаться" class="input_t form__name">
              <input type="text" placeholder="Ваш номер телефона" class="input_t form__phone">
              <div class="st_form__nav">
                <button type="button" class="btn white sign_up">Заказать консультацию</button>
                <div class="check">
                  <label class="clearfix">
                    <span class="check_ch">
                      <input type="checkbox" name="sog">
                      <span class="check_bt"><i class="fa fa-check" aria-hidden="true"></i></span>
                    </span>
                    <span class="check_t">Я согласен, на обработку персональных данных</span>
                  </label>
                </div>
              </div>
            </div>
            <div class="two_et">
              <div class="admission__form_title">Когда вам позвонить?</div>
              <div class="but_obr">
                <button type="button" date_now="Позвонить сейчас" class="btn white now">Сейчас</button>
                <button type="button" class="btn white chengtime">Выбрать время</button>
              </div>
            </div>
            <div class="three_et">
              <div class="admission__form_title">Когда вам позвонить?</div>
              <div class="but_obr">
                <input class="input_t date" type="date" value="<?php echo date('Y-m-d');?>">
                <input class="input_t time" type="time" value="<?php echo date('H:i');?>">
              </div>
              <button type="button" date_now="Позвонить в другое время" class="btn white done">Готово</button>
            </div>
            <div class="four_et"><img src="/bitrix/templates/clinic/images/blag.png" alt=""></div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<?php /* -------------------------- ФОРМА КОНСУЛЬТАЦИИ -------------------------- */ ?>


<?php /* -------------------------- ТЕКСТ -------------------------- */ ?>

<div class="uslug_wrap" id="about__uslugi_production">
  <div class="container">
    <? if (!empty ($arResult['PROPERTIES']['TEXT_DOP_PRICE2']['VALUE']['TEXT'])):?>
      <div class="text dop-text-price detail-service-text">
        <?if($arResult['PROPERTIES']['TEXT_DOP_PRICE2']['VALUE']['TYPE'] == "TEXT"):?>
          <?=$arResult['PROPERTIES']['TEXT_DOP_PRICE2']['VALUE']['TEXT'];?>
        <?else:?>
          <?=$arResult['PROPERTIES']['TEXT_DOP_PRICE2']['~VALUE']['TEXT'];?>
        <?endif;?>
      </div>
    <?endif;?>
  </div>
</div>

<?php /* -------------------------- ТЕКСТ -------------------------- */ ?>


<?php /* -------------------------- ВИДЕО 1 -------------------------- */ ?>
<? $videoitems = array();?>
<?if($arResult['PROPERTIES']['VIDEO']['VALUE']):?>
  <?foreach($arResult['PROPERTIES']['VIDEO']['VALUE'] AS $row):?>
    <?$img = CFile::GetPath($row['SUB_VALUES']['SYSTEM_VIDEO_PREVW']['VALUE']);
    $hrefVideo = $row['SUB_VALUES']['SYSTEM_VIDEO_LINK']['VALUE'];
    if (preg_match('/^https:\/\/youtu.be\/(.*)$/', $hrefVideo)):
      $hrefVideo = str_replace('https://youtu.be/','https://www.youtube.com/embed/', $hrefVideo);
    endif;
    $p = '<div class="video-itm" data-vl="'.$hrefVideo.'">
      <!--div class="backgr" style="background-image:url('.$img.');" -->
      <img src="'.$img.'">
      <div class="video-name">' . $row['SUB_VALUES']['SYSTEM_VIDEO_NAME']['VALUE'] . '</div>
    </div>';
    $videoitems[$row['SUB_VALUES']['SYSTEM_VIDEO_BLNUM']['VALUE']] .= $p;?>
  <?endforeach;?>
<?endif;?>
<?if($videoitems[1]):?>
  <div class="video-wrp doctors-slider">
    <div class="container">
      <div class="title-doctors"><span>Видео из отделения реабилитации</span></div>
      <div class="video-itms">
        <?=$videoitems[1];?>
      </div>
    </div>
  </div>
<?endif;?>

<script>
  (function($){
    $(document).ready(function(){
      $('.video-wrp .video-itms .video-itm').on('click',function(){
        var el = $(this);
        var vl = el.data('vl');
        var pp = $('.modal__wrap.video-popup');
        pp.find('.modal iframe').attr('src',vl);
        pp.show();
      });
      $('.video-itms').owlCarousel({
        loop: false,
        margin:52,
        items: 3,
        autoHeight:true,
        nav:true,
        dots:false,
        navText:['<div class="doctors-slider__left video"></div>', '<div class="doctors-slider__right video"></div>'],
        });
    });
  })(jQuery);
</script>

<?php /* -------------------------- ВИДЕО 1 -------------------------- */ ?>



<?php /* -------------------------- ВРАЧИ -------------------------- */ ?>
<? if(count($arResult['DOCTORS']) > 0): ?>
    <div class="doctors-slider">
      <div class="container">
        <h2>Наши специалисты</h2>
        <div class="doctors-slider__slider-container">
          <?foreach ($arResult['DOCTORS'] as $arDoctor): ?>
            <div class="doctors-slider__item doctors-item">
              <div class="doctors-item__image" style="background-image: url('<?=$arDoctor['IMG_SRC']?>');"></div>
              <div class="doctors-item__text-container">

                <div class="doctors-item__name"><?=$arDoctor['NAME']?></div>
                <div class="doctors-item__profession"><?=$arDoctor['PROPS']['DR_SUBTITLE']['VALUE']?></div>
                <?if ($arDoctor['PROPS']['DR_WORK_EXPERIENCE']['VALUE'] != ''):?>
                  <div class="doctors-item__experience">Стаж работы: <span><?=$arDoctor['PROPS']['DR_WORK_EXPERIENCE']['VALUE']?></span></div>
                <?endif;?>
                <div class="doctors-item__text">
                  <div class="doctors-item__text-caption">Работает с проблемами</div>
                  <div class="doctors-item__text-description">
                    <ul>
                      <?foreach($arDoctor['PROPS']['DR_PROBLEMS']['VALUE_ENUM'] as $key => $valueProblem):?>
                        <li class="doctors-item__working-with">
                          <?=$valueProblem;?>
                        </li>
                      <?endforeach;?>
                    </ul>
                  </div>
                  <div class="doctors-item__text-advanatges">
                    <?foreach($arDoctor['PROPS']['DR_SERVICES_YEAR']['VALUE'] as $key => $valueServYear):?>
                      <div class="year-advantages-item">
                        <div class="year-advantages-item__number">
                          <?=$valueServYear['SUB_VALUES']['SYSTEM_YEAR_NUMBER']['VALUE'];?>
                        </div>
                        <div class="year-advantages-item__description">
                          <?=$valueServYear['SUB_VALUES']['SYSTEM_YEAR_DESCRIPTION']['VALUE'];?>
                        </div>
                      </div>
                    <?endforeach;?>
                  </div>
                </div>
                <a href="<?=$arDoctor['DETAIL_PAGE_URL']?>" class="doctors-item__href">ЗАПИСАТЬСЯ НА ПРИЕМ</a>
              </div>
            </div>
          <?endforeach;?>
        </div>
      </div>
    </div>
<?endif;?>

<script>
  $(document).ready(function() {
    $('.doctors-slider__slider-container').owlCarousel({
      loop: false,
      margin:32,
      items: 1,
      autoHeight:true,
      nav:true,
      dots:false,
      navText:['<div class="doctors-slider__left"></div>', '<div class="doctors-slider__right"></div>'],
    });
  });
</script>
<?php /* -------------------------- ВРАЧИ -------------------------- */ ?>


<?php /* -------------------------- ВИДЕО 2 -------------------------- */ ?>
<?if($videoitems[2]):?>
  <div class="video-wrp doctors-slider">
    <div class="container">
      <div class="title-doctors"><span>Видео с нашими пациентами</span></div>
      <div class="video-itms">
        <?=$videoitems[2];?>
      </div>
    </div>
  </div>
<?endif;?>
<script>
  (function($){
    $(document).ready(function(){
      $('.video-wrp .video-itms .video-itm').on('click',function(){
        var el = $(this);
        var vl = el.data('vl');
        var pp = $('.modal__wrap.video-popup');
        pp.find('.modal iframe').attr('src',vl);
        pp.show();
      });
      $('.video-itms').owlCarousel({
        loop: false,
        margin:52,
        items: 3,
        autoHeight:true,
        nav:true,
        dots:false,
        navText:['<div class="doctors-slider__left video"></div>', '<div class="doctors-slider__right video"></div>'],
      });
    });
  })(jQuery);
</script>
<?php /* -------------------------- ВИДЕО 2 -------------------------- */ ?>


<div class="dserv__wrap">
  <div class="container">

  <?php /* -------------------------- ОТЗЫВЫ -------------------------- */ ?>
  <?if($arResult['REVIEWS']):?>
    <script>
      $(document).ready(function() {
        $('.reviews-slider').owlCarousel({
          loop:false,
          margin:32,
          nav:false,
          dots:true,
          autoWidth:false,
          responsive:{
            0:{ items:1 },
            600:{ items:2 },
            1100:{ items:2 }
          }
        });
      });
    </script>
    
    <div class="reviews-slider-wrap">
      <h2><?=$arResult['PROPERTIES']['REVIEWS']['NAME']?></h2>
      <br><br>
      <div class="owl-carousel owl-theme reviews-slider">
        <?foreach($arResult['REVIEWS'] as $arReview):?>
          <div class="review-item">
            <div class="review-item__name"><?=$arReview['NAME'];?></div>
            <div class="review-item__subtitle"><?=$arReview['SUBTITLE'];?></div>
            <br>
            <div class="review-item__text"><?=$arReview['PREVIEW_TEXT'];?></div>
            <div class="review-item__stars">
              <? for ($i=1; $i < 6; $i++): ?>
                <? if($i > $arReview['STARS']): ?>
                  <i class="fa fa-star" style="color: #d7dcd2"></i>
                <? else: ?>
                  <i class="fa fa-star" style="color:#80ba25" ></i>
                <? endif; ?>
              <? endfor; ?>
            </div>
          </div>
        <?endforeach;?>
      </div>
    </div>
  <?endif;?>
  <?php /* -------------------------- ОТЗЫВЫ -------------------------- */ ?>


  <?php /* -------------------------- FAQ -------------------------- */ ?>
  <?if($arResult['PROPERTIES']['FAQ']['VALUE']):?>
    <div class="alc-prices">
      <div class="alc-prices__title"><?=$arResult['PROPERTIES']['FAQ']['NAME'];?></div>
      <? foreach ($arResult['PROPERTIES']['FAQ']['VALUE'] as $arFaqItem): ?>
        <div class="alc-spoiler-secion">
          <div class="alc-spoiler-section__name js-spoiler">
            <span class="text-pad-chevron"><?=$arFaqItem['SUB_VALUES']['SYSTEM_FAQ_QUEST']['VALUE'];?></span>
          </div>
          <div class="alc-spoiler-section__content js-spoiler-content" style="display:none;">
            <div class="spoiler-content-pad"><?=$arFaqItem['SUB_VALUES']['SYSTEM_FAQ_ANSWER']['~VALUE']['TEXT'];?></div>
          </div>
        </div>
      <? endforeach; ?>
    </div>
  <?endif;?>
  <?php /* -------------------------- FAQ -------------------------- */ ?>
  
  
  <?php /* -------------------------- ЦЕНЫ -------------------------- */ ?>
  <?/*if(!empty($arResult['PROPERTIES']['SRV_VARIANTS']['VALUE'])):?>
    <? if($arResult['PROPERTIES']['HIDE_VARIANT_BLOCK_TITLE']['VALUE'] != "Y"): ?>
      <div class="title_big_l">Стоимость услуги <?=$arResult['NAME']?><span></span></div>
    <? endif; ?>
    <div class="alc-variants-row">
      <? foreach ($arResult['PROPERTIES']['SRV_VARIANTS']['VALUE'] as $iVar => $arVar): ?>
        <div class="alc-variants-row__item">
          <div class="alc-variant <? if($iVar == 1) echo('alc-variant--active'); ?>">
            <div class="alc-variant__title">
              <?=$arVar['SUB_VALUES']['SYSTEM_VAR_TITLE']['VALUE'];?>
            </div>
            <? if($arVar['SUB_VALUES']['SYSTEM_VAR_COST']['VALUE']): ?>
              <div class="alc-variant__price">
                <span><?=$arVar['SUB_VALUES']['SYSTEM_VAR_COST']['VALUE'];?></span> руб.
              </div>
              <br>
            <? endif; ?>
            <? if($arVar['SUB_VALUES']['SYSTEM_VAR_DESC']['~VALUE']['TEXT']): ?>
              <div class="alc-variant__desc">
                <?=$arVar['SUB_VALUES']['SYSTEM_VAR_DESC']['~VALUE']['TEXT'];?>
              </div>
              <br>
            <? endif; ?>
            <? if($arVar['SUB_VALUES']['SYSTEM_VAR_ADV_TITLE']['VALUE']): ?>
              <div class="alc-variant__list-title"><?=$arVar['SUB_VALUES']['SYSTEM_VAR_ADV_TITLE']['VALUE'];?></div>
            <? else: ?>
              <div class="alc-variant__list-title"><?=$arVar['SUB_VALUES']['SYSTEM_VAR_ADV']['NAME'];?></div>
            <? endif; ?>
            <? if($arVar['SUB_VALUES']['SYSTEM_VAR_ADV']['~VALUE']['TEXT']): ?>
              <div class="alc-variant__list">
                <?=$arVar['SUB_VALUES']['SYSTEM_VAR_ADV']['~VALUE']['TEXT'];?>
              </div>
            <? endif; ?>
          </div>
        </div>
      <? endforeach; ?>
    </div>
  <?endif;*/?>
  
  <?php /* -------------------------- СТОИМОСТЬ УСЛУГ ПО ПОЗИЦИЯМ -------------------------- */ ?>
  <?if($arResult['PROPERTIES']['COSTS_LIST']['VALUE']):?>
    <div class="alc-prices">
      <div class="alc-prices__title"><?=$arResult['PROPERTIES']['COSTS_LIST']['NAME'];?></div>
      <? foreach ($arResult['COSTS_SECTIONS'] as $costSectionId => $arCostSection): ?>
        <div class="alc-spoiler-secion">
          <div class="alc-spoiler-section__name js-spoiler">
            <span class="text-pad-chevron"><?=$arCostSection['NAME'];?></span>
          </div>
          <div class="alc-spoiler-section__content js-spoiler-content" style="display:none;">
            <div class="alc-pricelist">
              <? foreach ($arCostSection['ITEMS'] as $arCostItem): ?>
                <div class="alc-pricelist-item">
                  <div class="alc-pricelist-item__name"><?=$arCostItem['TITLE'];?></div>
                  <div class="alc-pricelist-item__cost"><b><?=$arCostItem['COST'];?></b> руб.</div>
                </div>
              <? endforeach; ?>
            </div>
          </div>
        </div>
      <? endforeach; ?>
    </div>
  <?endif;?>
  <?php /* -------------------------- СТОИМОСТЬ УСЛУГ ПО ПОЗИЦИЯМ -------------------------- */ ?>



  <?php /* -------------------------- SALES -------------------------- */ ?>
  <?if($arResult['SALES']):?>
    <div class="title_big_l">
      <?=$arResult['PROPERTIES']['SALES']['NAME']?><span></span>
    </div>
    <div class="alc-sales">
      <? foreach ($arResult['SALES'] as $arSale): ?>
        <div class="alc-sales__item">
          <div class="alc-sale">
            <div class="alc-sale__img">
              <img src="<?=$arSale['IMG_SRC']?>" alt="">
            </div>
            <div class="alc-sale__text">
              <?=$arSale['TEXT']?>
            </div>
          </div>
        </div>
      <? endforeach; ?>
    </div>
  <?endif;?>
  <?php /* -------------------------- SALES -------------------------- */ ?>
  
  <?/* <noscript id="seomodule-vkonce"></noscript> */?>

  </div>
</div>

<?//$APPLICATION->IncludeFile( SITE_DIR."include/block_advantages.php", Array(), Array("MODE"=>"html") );?>
<?//$APPLICATION->IncludeFile( SITE_DIR."include/block_bottom_form.php", Array(), Array("MODE"=>"html") );?>