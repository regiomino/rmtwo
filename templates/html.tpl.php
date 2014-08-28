<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie ie9" lang="<?php print $language->language; ?>"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8 ie9" lang="<?php print $language->language; ?>"> <![endif]-->
<!--[if (gte IE 10)|!(IE)]><!--><html class="no-js" lang="<?php print $language->language; ?>"> <!--<![endif]-->

<head profile="<?php print $grddl_profile; ?>">
    <?php print $head; ?>
    <title><?php print $head_title; ?></title>
    <?php print $styles; ?>
    <?php print $scripts; ?>

    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>

<body class="<?php print $classes; ?>" <?php print $attributes;?>>

		<script>

			// Set to the same value as the web property used on the site
			var gaProperty = 'UA-40144139-1';

			// Disable tracking if the opt-out cookie exists.
			var disableStr = 'ga-disable-' + gaProperty;
			if (document.cookie.indexOf(disableStr + '=true') > -1) {
				window[disableStr] = true;
			}

			// Opt-out function
			function gaOptout() {
				document.cookie = disableStr + '=true; expires=Thu, 31 Dec 2099 23:59:59 UTC; path=/';
				window[disableStr] = true;
				alert('In Ihrem Browser wurde ein Cookie für die aktuelle Domain gesetzt, der in Zukunft das Tracking via Google Analytics verhindert. Bitte beachten Sie, dass dieser Cookie nur für die aktuelle Domain gesetzt wurde und nicht für etwaige andere Subdomains von Regiomino. Wenn Sie sicherstellen wollen, dass Ihr Webseitenbesuch ohne weitere Maßnahmen auf keiner Internetpräsenz von Regiomino analysiert wird, installieren Sie bitte den Google Browser Plugin unter http://tools.google.com/dlpage/gaoptout?hl=de');
			}

			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-40144139-1', 'auto');
			ga('send', 'pageview');

		</script>

    <?php print $page_top; ?>
    <?php print $page; ?>
    <?php print $page_bottom; ?>
    <script>
       
				(function () {
						var _tsid = 'X9FF4FD2592B5BFA727E6480148224623';
						_tsConfig = {
								'yOffset': '0', //offset from page bottom
								'variant': 'reviews' //text, default, small, reviews
						};
						var _ts = document.createElement('script');
						_ts.type = 'text/javascript';
						_ts.charset = 'utf-8';
						_ts.src = '//widgets.trustedshops.com/js/' + _tsid + '.js';
						var __ts = document.getElementsByTagName('script')[0];
						__ts.parentNode.insertBefore(_ts, __ts);
				})();
                                
                                <?php if (drupal_is_front_page()) { ?>
                                
                                  /*Counter
                             (function ($) {     
                            $("ul.countdown").jCounter({
                                date: "28 august 2014 13:00:00",
                                timezone: "Europe/Berlin",
                                format: "dd:hh:mm:ss",
                                twoDigits: 'on',
                                dateSource: 'remote',
                                serverDateSource : 'https://www.regiomino.de/dateandtime.php'
                            });
                            
                             })(jQuery);*/
                                <?php } ?>
    </script>
    
    <script type="text/javascript">
var fby = fby || [];
fby.push(['showTab', {id: '7820', position: 'left', color: '#95BC0D'}]);
(function () {
    var f = document.createElement('script'); f.type = 'text/javascript'; f.async = true;
    f.src = '//cdn.feedbackify.com/f.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(f, s);
})();
</script>

</body>
</html>
