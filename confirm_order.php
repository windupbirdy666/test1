<?php
require_once "config.php";
$pixel_id = "";
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$_SERVER['HTTP_HOST']?> - Confirmed!</title>

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
	<section>
		<h3>Congratulations!</h3>
		<p><?=$_POST["clientname"]?>, order <b><?=hexdec($_POST["phonenumber"]) ?></b> is confirmed!</p>
	</section>
</body>
</html>