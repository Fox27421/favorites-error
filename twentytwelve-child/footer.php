<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
if (session_status() === PHP_SESSION_ACTIVE) {
    if(!str_contains(".js", $_SERVER['REQUEST_URI']))
        $_SESSION['current_page'] = $_SERVER['REQUEST_URI'];



  // echo wp_date( DATE_RFC3339 ) . '<br/>';
  // echo current_time( 'timestamp' );
}
?>
	</div><!-- #main .wrapper -->
	<footer id="colophon" role="contentinfo">
    <div class="footer__container">
      <div class="site-info">
  <p> 
  &copy; 2010-<?php echo date("Y"); ?> «АБ-Экспресс» — журнал для налогоплательщиков. Издательство АБ-Экспресс. Все права на материалы сайта принадлежат ООО "Академия Бизнеса Экспресс" и защищены в соответствии с разделом VII части четвертой Гражданского кодекса РФ. Никакая часть материалов сайта не может быть воспроизведена в какой бы то ни было форме. Вопросы по сайту: adm@ab-express.ru</p>
        
  <a style="color: #fff; text-decoration: none;" href="/politika-konfidentsialnosti/">Политика конфиденциальности</a>	
        
        
      </div><!-- .site-info -->
      <div class="footer__social-networks">
            <a class="footer__social-network" target="_blank" href="https://vk.com/journal_dlya_nalogoplatelshchika"><svg
                xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                <path
                  d="M20 0C16.0444 0 12.1776 1.17298 8.8886 3.37061C5.59962 5.56823 3.03617 8.69181 1.52242 12.3463C0.00866575 16.0009 -0.387401 20.0222 0.384303 23.9018C1.15601 27.7814 3.06082 31.3451 5.85787 34.1421C8.65492 36.9392 12.2186 38.844 16.0982 39.6157C19.9778 40.3874 23.9991 39.9913 27.6537 38.4776C31.3082 36.9638 34.4318 34.4004 36.6294 31.1114C38.827 27.8224 40 23.9556 40 20C40 14.6957 37.8929 9.60859 34.1421 5.85786C30.3914 2.10714 25.3043 0 20 0ZM31.5273 27.8273C30.9455 27.9091 28.1 27.8273 27.9523 27.8273C27.2167 27.8369 26.507 27.556 25.9773 27.0455C25.3773 26.4659 24.8409 25.8295 24.2545 25.2273C24.0818 25.0424 23.894 24.8721 23.6932 24.7182C23.225 24.3591 22.7614 24.4386 22.5409 24.9932C22.3688 25.59 22.2486 26.2006 22.1818 26.8182C22.1432 27.3773 21.7886 27.7273 21.1614 27.7659C20.7727 27.7864 20.3841 27.7955 20 27.7841C18.6001 27.7764 17.222 27.436 15.9795 26.7909C14.6348 26.0423 13.4631 25.0185 12.5409 23.7864C11.025 21.85 9.81364 19.7227 8.73182 17.5295C8.67501 17.4182 7.56592 15.0591 7.53864 14.9477C7.43864 14.5773 7.53864 14.2205 7.84546 14.0955C8.04092 14.0205 11.6955 14.0955 11.7568 14.0955C12.0287 14.0936 12.2941 14.1783 12.5148 14.3372C12.7354 14.4961 12.8997 14.7211 12.9841 14.9795C13.6603 16.7091 14.5852 18.3307 15.7296 19.7932C15.8899 19.988 16.0774 20.1587 16.2864 20.3C16.5841 20.5045 16.8659 20.4341 16.9886 20.0886C17.1343 19.6125 17.2198 19.1201 17.2432 18.6227C17.2636 17.6364 17.2432 16.9886 17.1886 16.0023C17.1523 15.3705 16.9296 14.8182 15.9977 14.6386C15.7114 14.5864 15.6864 14.35 15.8705 14.1136C16.2546 13.625 16.7796 13.5455 17.3682 13.5159C18.2455 13.4659 19.1227 13.5 20 13.5159H20.1909C20.5727 13.5145 20.9536 13.5534 21.3273 13.6318C21.5483 13.6769 21.749 13.7922 21.8992 13.9605C22.0495 14.1288 22.1415 14.3412 22.1614 14.5659C22.2065 14.8148 22.2255 15.0676 22.2182 15.3205C22.1955 16.3955 22.1432 17.4727 22.1318 18.5477C22.1213 18.9743 22.1601 19.4006 22.2477 19.8182C22.3727 20.3909 22.7659 20.5341 23.1568 20.1205C23.6634 19.5869 24.1277 19.0147 24.5455 18.4091C25.2859 17.3052 25.896 16.1192 26.3636 14.875C26.6182 14.2364 26.8182 14.0955 27.5 14.0955H31.3773C31.6078 14.0914 31.8377 14.1221 32.0591 14.1864C32.1375 14.207 32.2107 14.2435 32.2743 14.2937C32.3379 14.344 32.3905 14.4068 32.4287 14.4783C32.4668 14.5497 32.4899 14.6283 32.4963 14.7091C32.5027 14.7899 32.4924 14.8711 32.4659 14.9477C32.275 15.7977 31.8159 16.5227 31.3295 17.2205C30.5409 18.3364 29.7091 19.425 28.9023 20.5273C28.8052 20.6698 28.7164 20.8177 28.6364 20.9704C28.3318 21.5205 28.3545 21.8273 28.7955 22.2818C29.5 23.0068 30.2523 23.6841 30.9318 24.4295C31.4302 24.9719 31.8804 25.5567 32.2773 26.1773C32.7614 26.9591 32.4545 27.6954 31.5273 27.8273Z"
                  fill="white" fill-opacity="0.24" />
              </svg></a>
            <a class="footer__social-network-2" target="_blank" href="https://dzen.ru/abexpress?utm_referrer=ab-express.ru">
              <svg fill="#FFFFFF" fill-opacity="0.24"
                viewBox="0 0 50 50" width="40px" height="40px">
                <path
                  d="M46.894 23.986c.004 0 .007 0 .011 0 .279 0 .545-.117.734-.322.192-.208.287-.487.262-.769C46.897 11.852 38.154 3.106 27.11 2.1c-.28-.022-.562.069-.77.262-.208.192-.324.463-.321.746C26.193 17.784 28.129 23.781 46.894 23.986zM46.894 26.014c-18.765.205-20.7 6.202-20.874 20.878-.003.283.113.554.321.746.186.171.429.266.679.266.03 0 .061-.001.091-.004 11.044-1.006 19.787-9.751 20.79-20.795.025-.282-.069-.561-.262-.769C47.446 26.128 47.177 26.025 46.894 26.014zM22.823 2.105C11.814 3.14 3.099 11.884 2.1 22.897c-.025.282.069.561.262.769.189.205.456.321.734.321.004 0 .008 0 .012 0 18.703-.215 20.634-6.209 20.81-20.875.003-.283-.114-.555-.322-.747C23.386 2.173 23.105 2.079 22.823 2.105zM3.107 26.013c-.311-.035-.555.113-.746.321-.192.208-.287.487-.262.769.999 11.013 9.715 19.757 20.724 20.792.031.003.063.004.094.004.25 0 .492-.094.678-.265.208-.192.325-.464.322-.747C23.741 32.222 21.811 26.228 3.107 26.013z" />
              </svg>
              </svg>
            </a>
            <a class="footer__social-network-3" target="_blank" href="https://www.youtube.com/channel/UCcW4Gps57I6yE6-sWFpQ5xQ">
                        <svg width="40px" height="40px" viewBox="0 -3 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <title>youtube [#168]</title>
                <desc>Created with Sketch.</desc>
                <defs>

            </defs>
                <g id="Page-1" fill="#FFFFFF" fill-opacity="0.24">
                    <g id="Dribbble-Light-Preview" transform="translate(-300.000000, -7442.000000)" fill="#000000">
                        <g id="icons" transform="translate(56.000000, 160.000000)">
                            <path d="M251.988432,7291.58588 L251.988432,7285.97425 C253.980638,7286.91168 255.523602,7287.8172 257.348463,7288.79353 C255.843351,7289.62824 253.980638,7290.56468 251.988432,7291.58588 M263.090998,7283.18289 C262.747343,7282.73013 262.161634,7282.37809 261.538073,7282.26141 C259.705243,7281.91336 248.270974,7281.91237 246.439141,7282.26141 C245.939097,7282.35515 245.493839,7282.58153 245.111335,7282.93357 C243.49964,7284.42947 244.004664,7292.45151 244.393145,7293.75096 C244.556505,7294.31342 244.767679,7294.71931 245.033639,7294.98558 C245.376298,7295.33761 245.845463,7295.57995 246.384355,7295.68865 C247.893451,7296.0008 255.668037,7296.17532 261.506198,7295.73552 C262.044094,7295.64178 262.520231,7295.39147 262.895762,7295.02447 C264.385932,7293.53455 264.28433,7285.06174 263.090998,7283.18289" id="youtube-[#168]">

            </path>
                        </g>
                    </g>
                </g>
            </svg>
            </a>
            <a class="footer__social-network-4" target="_blank" href="https://t.me/abexpressru">
                        <svg width="40px" height="40px" viewBox="0 0 256 256" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid">
                <g>
                    <path class="path-1" d="M128,0 C57.307,0 0,57.307 0,128 L0,128 C0,198.693 57.307,256 128,256 L128,256 C198.693,256 256,198.693 256,128 L256,128 C256,57.307 198.693,0 128,0 L128,0 Z" fill="#40B3E0">
            </path>
                    <path class="path-2" d="M190.2826,73.6308 L167.4206,188.8978 C167.4206,188.8978 164.2236,196.8918 155.4306,193.0548 L102.6726,152.6068 L83.4886,143.3348 L51.1946,132.4628 C51.1946,132.4628 46.2386,130.7048 45.7586,126.8678 C45.2796,123.0308 51.3546,120.9528 51.3546,120.9528 L179.7306,70.5928 C179.7306,70.5928 190.2826,65.9568 190.2826,73.6308" fill="#FFFFFF">
            </path>
                    <path class="path-3" d="M98.6178,187.6035 C98.6178,187.6035 97.0778,187.4595 95.1588,181.3835 C93.2408,175.3085 83.4888,143.3345 83.4888,143.3345 L161.0258,94.0945 C161.0258,94.0945 165.5028,91.3765 165.3428,94.0945 C165.3428,94.0945 166.1418,94.5735 163.7438,96.8115 C161.3458,99.0505 102.8328,151.6475 102.8328,151.6475" fill="#D2E5F1">
            </path>
                    <path class="path-4" d="M122.9015,168.1154 L102.0335,187.1414 C102.0335,187.1414 100.4025,188.3794 98.6175,187.6034 L102.6135,152.2624" fill="#B5CFE4">
            </path>
                </g>
            </svg>
            </a>
        </div>
      </div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">


<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(64684504, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>

<noscript><div><img src="https://mc.yandex.ru/watch/64684504" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

</div>
</body>
</html>