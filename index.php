<?php echo '<?xml version="1.0" encoding="UTF-8"?>'."\n" ?>
<!DOCTYPE html>
<?php
	$url = "https://pman-tokyo.com/";
	//$url = "http://pman.flattaildesign.comm/";

	$insta_media_limit = '25';
	
	$insta_business_id = '17841443836644947';
	$insta_access_token = 'EAAHvVuWNTjIBAEO7H6MpZBNmZA9dZC8K1ugUvO0ZCB4y7AylunoQk5EpsUau5oZC61fPITZCweO2HDO9lPnPGqQ9Xmx30q4ErcJnfoyNl5hW23II3lJK4kdfc96WaJZBvjt1fja0IjxomuP7pivdWFQctheFNXJ8jRO0lZCEZBqoSozIU0r2MEZCct';

	$json = file_get_contents("https://graph.facebook.com/v6.0/{$insta_business_id}?fields=name%2Cmedia.limit({$insta_media_limit})%7Bcaption%2Cmedia_url%2Cthumbnail_url%2Cpermalink%2Cmedia_type%7D&access_token={$insta_access_token}");

	$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
	$obj = json_decode($json, true);

	$insta = []; $monthlyhours = []; $count = 0; $n = 0;

	foreach ($obj['media']['data'] as $k => $v) {
		if ($v['thumbnail_url']) {
			$data = [
				'img' => $v['thumbnail_url'],
				'caption' => $v['caption'],
				'link' => $v['permalink'],
			];
		} else {
			$data = [
				'img' => $v['media_url'],
				'caption' => $v['caption'],
				'link' => $v['permalink'],
			];
		}

		if (strpos($v['caption'], '#ピーマン営業日のお知らせ') !== false) {
			if($count == 0){
				$monthlyhours[] = $data;
			}
			
			$count++;
		}else if($v['media_type'] === 'IMAGE'){
			$insta[] = $data;
			$n++;
		}

		if($n == 12){
			break;
		}
	}
?>
<html lang="ja">
<head>
	<title>IZAKAYA P/man｜渋谷 居酒屋ピーマン</title>
	<meta property="og:title" content="IZAKAYA P/man｜渋谷 居酒屋ピーマン" />
	<meta property="og:type" content="website" />
	<meta charset="utf-8">
	<meta http-equiv=cache-control content=no-cache>
	<meta http-equiv=expires content=0>
	<meta name="viewport" content="width=device-width,initial-scale=1"/>
	<!--meta name="format-detection" content="telephone=no" /-->
	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />

	<meta name="keywords" content="渋谷,熟成肉,隠れ家,居酒屋,宮崎牛,国産豚,P/man,居酒屋ピーマン" /><!-- Keywordsの入力 -->
	<meta name="description" content="店内の熟成庫で1ヶ月寝かせた熟成肉が自慢！人に教えたくなる隠れ家居酒屋。渋谷からすぐの場所にありながら、隠れ家的な雰囲気も漂う。店内の熟成庫でじっくり寝かせた宮崎牛や国産豚をリーズナブルにご提供しております。そのほか、ジャンルにとらわれない居酒屋メニュー、季節の素材を使った月替りメニューなど、バラエティ豊かなお料理をご用意！" />
	<link rel="canonical" href="<?= $url ?>" / >
	<!-- OG -->
	<meta property="og:description" content="店内の熟成庫で1ヶ月寝かせた熟成肉が自慢！人に教えたくなる隠れ家居酒屋。渋谷からすぐの場所にありながら、隠れ家的な雰囲気も漂う。店内の熟成庫でじっくり寝かせた宮崎牛や国産豚をリーズナブルにご提供しております。そのほか、ジャンルにとらわれない居酒屋メニュー、季節の素材を使った月替りメニューなど、バラエティ豊かなお料理をご用意！" />
	<meta property="og:url" content="https://pman-tokyo.com/"/ >
	<!-- OG END -->
	
	<!-- OG 共通 -->
	<!-- サイト名をcontentに記載 -->
	<meta property="og:site_name" content="IZAKAYA P/man｜渋谷 居酒屋ピーマン" />
	<!-- ogiimage(リンクで使うイメージ)を更新する -->
	<meta property="og:image" content="<?= $url ?>/_common/img/ogimage.jpg" />
	<!-- OG 共通 -->
	
	<!-- 共通CSS -->
	<link rel="stylesheet" href="/_common/css/common.min.css">
	<link rel="stylesheet" href="/_common/css/pc_responsive.css?<?= date('Ymd') ?>" media="screen and (min-width: 901px)">
	<link rel="stylesheet" href="/_common/css/sp_responsive.css?<?= date('Ymd') ?>" media="screen and (max-width: 900px)">

	<!-- favicon -->
	<link rel="shortcut icon" href="/_common/img/favicon.ico" type="image/vnd.microsoft.icon">
	<link rel="icon" href="/_commo/img/favicon.ico" type="image/vnd.microsoft.icon">

	<link rel="canonical" href="<?= $url; ?>" / >
	
	<!-- SCRIPT -->
	<script src="/_common/js/jquery-3.6.0.min.js"></script>
	<script src="/_common/js/slick.min.js"></script>

	<script id="defer-js" src="https://cdn.jsdelivr.net/npm/@shinsenter/defer.js@3.1.0/dist/defer.min.js"></script>
	
	<script>
		var ua = navigator.userAgent;
		var getDevice = (function(){
			var viewportContent;
			var w = window.outerWidth;
			if( ((ua.indexOf('Android') > 0 && ua.indexOf('Mobile') == -1) || ua.indexOf('iPad') > 0 || ua.indexOf('Kindle') > 0 || ua.indexOf('Silk') > 0) && w > 767 ){
					viewportContent = "width=1200";
			}else{
					viewportContent = "width=device-width,initial-scale=1.0";
			}
			document.querySelector("meta[name='viewport']").setAttribute("content", viewportContent);
		})();
	</script>

	<script src="/_common/js/common.min.js?<?= date('Ymd') ?>"></script>
	<script src="/_common/js/loading.min.js?<?= date('Ymd') ?>"></script>
	
	<!--script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	
	<link rel="preload" href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700;900&display=swap" as="style">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700;900&display=swap" media="print" onload="this.media='all'"-->
	
	<!--link rel="stylesheet" href="https://use.typekit.net/zzp8dwb.css"-->

	<!--script src="https://kit.fontawesome.com/442a7fe5fc.js" crossorigin="anonymous"></script-->

	<link rel="stylesheet" href="/_common/css/lib/fontawesome/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="/_common/css/lib/slick-theme.css" media="all"> 
	<link rel="stylesheet" type="text/css" href="/_common/css/lib/slick.css" media="all">
</head>
<body>
	<div id="wrapper">
		<?php include($_SERVER['DOCUMENT_ROOT'] . "/_common/tag/header.php"); //ヘッダー　グロナビ ?>
		<?php include($_SERVER['DOCUMENT_ROOT'] . "/_common/tag/keyvisual.php"); //メインビジュアル ?>
		<section id="sec1">
			<div class="main_container">
				<ul class="insta_list">
					<?php
						foreach ($insta as $k => $v) {
							echo '<li class="scroll-fade anmt_b2t"><a href="' . $v['link'] . '" target="new"><img src="' . $v['img'] . '"></a></li>';
						}
					?>
				</ul>
				
				<h3 class="scroll-fade anmt_b2t top">渋谷駅 新南口 徒歩2分<br class="spOnly">隠れ家のような居酒屋</h3>
				<p class="scroll-fade anmt_b2t">
					店内の熟成庫で丁寧に<br class="spOnly">寝かせた熟成肉をはじめ、<br>
					宮崎牛や国産豚が<br class="spOnly">リーズナブルな価格で堪能できます。<br>
					その他、旬の食材を<br class="spOnly">使用した創作料理など<br>
					多種多彩なメニューをご用意<br class="spOnly">おしゃれな空間で楽しい時間を♪
					
					<!--お一人様でも団体様でも、ちょい飲みでも。<br>
					
					大勢集まるパーティーでも、<br class="spOnly">気軽にまた行きたくなるお店。<br>
					肩を寄せ合いながらアットホームな<br class="spOnly">雰囲気を楽しんで。<br>
					座りながら語らったり、<br class="spOnly">立ち飲みパーティーで盛り上がって！<br><br>-->
				</p>
				
				<h3 class="scroll-fade anmt_b2t">こだわりの肉料理が<br class="spOnly">堪能できます</h3>
				<p class="scroll-fade anmt_b2t">
					お酒がススム豊富なメニューを<br class="spOnly">お得価格で楽しめる隠れ居酒屋！<br>
					必ず食べてほしいのが『熟成肉 宮崎牛グリル焼』<br> 店内の熟成庫で30日熟成させた自慢の一品。
				</p>	
			</div>	
		</section>
		<section id="sec2">
			<div class="main_container">
				<h2 class="scroll-fade anmt_b2t">Food Menu</h3>
				<h4 class="scroll-fade anmt_b2t noMargin">フードメニュー</h4>
								
				<div class="boxContainer">
					<p class="comment scroll-fade anmt_b2t">※価格は税込表示になります。</p>
					
					<div class="menu_title scroll-fade anmt_b2t"><span>牛・熟成肉</span></div>
					
					<div class="menuMedium scroll-fade anmt_b2t">
						<div class="menu_box">
							<img src="/_common/img/menu/menu01.jpg">
							<div class="menu_info">
								<div class="menu_name">宮崎牛グリル焼き</div>
								<hr>
								<div class="menu_price">
									<div class="menu_threecontents">
										<span>100ｇ</span>
										<span class="menu_red">1,870</span>
										<span>円(税込)</span>
									</div>
								</div>
							</div>	
						</div>	
					</div>
					
					<div class="menu_title scroll-fade anmt_b2t"><span>豚・熟成肉</span></div>
					
					<div class="menuMedium scroll-fade anmt_b2t">
						<div class="menu_box">
							<img src="/_common/img/menu/menu02.jpg">
							<div class="menu_info">
								<div class="menu_name"> 国産豚グリル焼き</div>
								<hr>
								<div class="menu_price">
									<div class="menu_threecontents">
										<span>150ｇ</span>
										<span class="menu_red">1,430</span>
										<span>円(税込)</span>
									</div>
								</div>
							</div>	
						</div>	
					</div>
										
					<div class="menu_title scroll-fade anmt_b2t"><span>名物</span></div>
					
					<div class="menuLarge scroll-fade anmt_b2t">
						<div class="menu_box">
							<img src="/_common/img/menu/menu03.jpg">
							<div class="menu_info">
								<div class="menu_name">自家製ソーセージ＆チョリソー</div>
								<hr>
								<div class="menu_price">
									<div>
										<span class="menu_red">935</span>
										<span>円(税込)</span>
									</div>
								</div>
							</div>
						</div>
						<div class="menu_box">
							<img src="/_common/img/menu/menu04.jpg">
							<div class="menu_info">
								<div class="menu_name">熟成肉盛り合わせ</div>
								<hr>
								<div class="menu_price">
									<div class="menu_threecontents">
										<span>2人前</span>
										<span class="menu_red">3,327</span>
										<span>円(税込)</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="menuLarge scroll-fade anmt_b2t">
						<div class="menu_box">
							<img src="/_common/img/menu/menu05.jpg">
							<div class="menu_info">
								<div class="menu_name">宮崎牛 ローストビーフ</div>
								<hr>
								<div class="menu_price">
									<div>
										<span class="menu_red">1,320</span>
										<span>円(税込)</span>
									</div>
								</div>
							</div>
						</div>
						<div class="menu_box">
							<img src="/_common/img/menu/menu07.jpg">
							<div class="menu_info">
								<div class="menu_name">宮崎牛 牛たたきのカルパッチョ</div>
								<hr>
								<div class="menu_price">
									<div>
										<span class="menu_red">935</span>
										<span>円(税込)</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="menuLarge scroll-fade anmt_b2t">
						<div class="menu_box">
							<img src="/_common/img/menu/menu08.jpg">
							<div class="menu_info">
								<div class="menu_name">宮崎牛メンチカツ</div>
								<hr>
								<div class="menu_price">
									<div>
										<span class="menu_red">660</span>
										<span>円(税込)</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					
					<div class="menuSmall mt20 scroll-fade anmt_b2t">
						<div class="menu_box menu_rank">
							<img src="/_common/img/menu/menu09.jpg">
							<div class="menu_info">
								<div class="menu_name">川エビとパクチーのサラダ</div>
								<hr>
								<div class="menu_price">
									<div>
										<span class="menu_red">935</span>
										<span>円(税込)</span>
									</div>
								</div>	
							</div>	
						</div>
						<div class="menu_box menu_rank">
							<img src="/_common/img/menu/menu10.jpg">
							<div class="menu_info">
								<div class="menu_name">鶏レバーの胡麻オイル漬</div>
								<hr>
								<div class="menu_price">
									<div>
										<span class="menu_red">715</span>
										<span>円(税込)</span>
									</div>
								</div>	
							</div>	
						</div>
						<div class="menu_box menu_rank">
							<img src="/_common/img/menu/menu06.jpg">
							<div class="menu_info">
								<div class="menu_name">揚げトウモロコシ</div>
								<hr>
								<div class="menu_price">
									<div>
										<span class="menu_red">660</span>
										<span>円(税込)</span>
									</div>
								</div>	
							</div>	
						</div>
						<div class="menu_option_long">他にも色々ございます</div>
					</div>
					
					<!--div class="menu_title"><span>人気ものTOP５</span></div>
					
					<div class="menuLarge">
						<div class="menu_box menu_rank rank1">
							<img src="/_common/img/menu/menu05.jpg">
							<div class="menu_info">
								<div class="menu_name">宮崎牛もも肉 ローストビーフ</div>
								<hr>
								<div class="menu_price">
									<div>
										<span class="menu_red">950</span>
										<span>円</span>
									</div>
								</div>
							</div>
						</div>
						<div class="menu_box menu_rank rank2">
							<img src="/_common/img/menu/menu06.jpg">
							<div class="menu_info">
								<div class="menu_name">揚げトウモロコシ</div>
								<hr>
								<div class="menu_price">
									<div>
										<span class="menu_red">550</span>
										<span>円</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="menuSmall">
						<div class="menu_box menu_rank rank3">
							<img src="/_common/img/menu/menu07.jpg">
							<div class="menu_info">
								<div class="menu_name">牛たたきのカルパッチョ</div>
								<hr>
								<div class="menu_price">
									<div>
										<span class="menu_red">780</span>
										<span>円〜</span>
									</div>
								</div>	
							</div>	
						</div>
						<div class="menu_box menu_rank rank4">
							<img src="/_common/img/menu/menu08.jpg">
							<div class="menu_info">
								<div class="menu_name">宮崎牛メンチカツ</div>
								<hr>
								<div class="menu_price">
									<div>
										<span class="menu_red">580</span>
										<span>円〜</span>
									</div>
								</div>	
							</div>	
						</div>
						<div class="menu_box menu_rank rank5">
							<img src="/_common/img/menu/menu09.jpg">
							<div class="menu_info">
								<div class="menu_name">川エビとパクチーのサラダ</div>
								<hr>
								<div class="menu_price">
									<div>
										<span class="menu_red">780</span>
										<span>円〜</span>
									</div>
								</div>	
							</div>	
						</div>
					</div-->
					
					<!--div class="menu_title"><span>その他</span></div-->
					<!--div class="menu_options">
						<div class="menu_option">
							しらすと白ネギ青ねぎサラダ<br>
							15種類の野菜サラダ<br>
							燻製卵のポテトサラダ<br>
							ねぎとろアボカド<br>
							豚シャブと茄子のおろしポン酢<br>
							山芋塩辛バター<br>
							イワシとトマトの缶詰め焼き<br>
							チーズ豆腐
						</div>
						<div class="menu_option">
							ピリ辛 マーボ茄子<br>
							ジャーマンポテト<br>
							宮崎牛トロトロ赤ワイン煮<br>
							炙り3点盛り<br>
							色々チーズとサラミの盛合せ<br>
							おつまみ揚げギョーザ<br>
							カマンベールフライ
						</div>
						<div class="menu_option">
							フィッシュ&amp;チップス<br>
							鶏レバーの胡麻オイル<br>
							宮崎牛トロトロ赤ワイン煮<br>
							炙り3点盛り<br>
							色々チーズとサラミの盛合せ<br>
							おつまみ揚げギョーザ<br>
							カマンベールフライ
						</div>
					</div-->
					
					<div class="menu_title scroll-fade anmt_b2t"><span>お飲み物</span></div>
					
					<div class="menu_drinks">
						<div class="menu_drink menu_long scroll-fade anmt_b2t">
							<div class="menu_name">ビール</div>
							<hr>
							<div class="menu_price menu_threeline">
								<div>
									<span>YEBISU 生</span>
									<span class="menu_red">660</span>
									<span>円(税込)</span>
								</div>
								<div>
									<span>YEBISU 小生</span>
									<span class="menu_red">495</span>
									<span>円(税込)</span>
								</div>
								<div>
									<span>YEBISU 黒生</span>
									<span class="menu_red">660</span>
									<span>円(税込)</span>
								</div>
							</div>
						</div>
						<div class="menu_drink scroll-fade anmt_b2t">
							<div class="menu_name">果実酢サワー</div>
							<hr>
							<div class="menu_price">
								<div>
									<span>各種</span>
									<span class="menu_red">605</span>
									<span>円(税込)</span>
								</div>
							</div>	
						</div>
						<div class="menu_drink menu_medium scroll-fade anmt_b2t">
							<div class="menu_name">ワイン</div>
							<hr>
							<div class="menu_price menu_twoline">
								<div>
									<span>グラス赤白</span>
									<span class="menu_red">495</span>
									<span>円(税込)</span>
								</div>
								<div>
									<span>ボトル赤白泡</span>
									<span class="menu_red">3300</span>
									<span>円(税込)〜</span>
								</div>
							</div>
						</div>
						<div class="menu_drink scroll-fade anmt_b2t">
							<div class="menu_name">ハイボール</div>
							<hr>
							<div class="menu_price">
								<div>
									<span>各種</span>
									<span class="menu_red">495</span>
									<span>円(税込)〜</span>
								</div>
							</div>	
						</div>
						<div class="menu_drink scroll-fade anmt_b2t">
							<div class="menu_name">本格焼酎</div>
							<hr>
							<div class="menu_price">
								<div>
									<span>芋・麦・黒糖など</span>
									<span class="menu_red">495</span>
									<span>円(税込)</span>
								</div>
							</div>	
						</div>
						<div class="menu_drink scroll-fade anmt_b2t">
							<div class="menu_name brMargin">お茶割</div>
							<hr>
							<div class="menu_price">
								<div>
									<span>ウーロン茶割・<br class="pcOnly">コウバシ緑茶割</span>
									<span class="menu_red">495</span>
									<span>円(税込)</span>
								</div>
							</div>	
						</div>
						<div class="menu_drink scroll-fade anmt_b2t">
							<div class="menu_name">ソフトドリンク</div>
							<hr>
							<div class="menu_price">
								<div>
									<span>各種</span>
									<span class="menu_red">495</span>
									<span>円(税込)</span>
								</div>
							</div>	
						</div>
						<div class="menu_option_long scroll-fade anmt_b2t">他にも色々ございます</div>
					</div>
				</div>	
			</div>
			<!-- 
				メニュー				
			-->
		</section>
		<section id="sec3">
			<div class="main_container">
				<h2 class="scroll-fade anmt_b2t">Course</h3>
				<h4 class="scroll-fade anmt_b2t noMargin">コース</h4>
				
				<div class="boxContainer">
					<!--p class="comment red scroll-fade anmt_b2t">※メニューは仕入れ状況により変更になります。</p-->
					<div class="courseBox"> 
						<div class="courseTitle scroll-fade anmt_b2t">
							<span>【19:30までの予約限定コース】</span>熟成肉の国産和牛<br class="pcOnly">グリル焼きコース
						</div>
						<img class="scroll-fade anmt_b2t" src="/_common/img/course/course1.jpg">
						
						<table class="scroll-fade anmt_b2t">
						<tr>
							<th>コース料金</th>
							<td class="lrgTxt">
								<span>現金</span>
								<div>5,100<small> 円 (税込)</small></div>
								<span class="mt5">カード決済時</span>
								<div>5,610<small> 円 (税込)</small></div>
							</td>
						</tr>	
						<tr>
							<th>利用可能時間</th>
							<td>2.5時間<br> (〜19:30)</td>
						</tr>
						<tr>
							<th>予約可能人数</th>
							<td>2名様～ </td>
						</tr>
						<tr>
							<th>飲み放題</th>
							<td>2.5時間</td>
						</tr>
						<tr>
							<th>コース内容例<br>(12品)</th>
							<td>
								<ul class="menuList">
									<li>半熟卵アンチョビマヨソース</li>
									<li>しらすとねぎのサラダ</li>
									<li>揚げトウモロコシ</li>
									<li>燻製卵のポテトサラダ</li>
									<li>ねぎとろアボカド</li>
									<li>メンチカツ</li>
									<li>自家製ソーセージ＆チョリソー</li>
									<li>熟成豚グリル焼</li>
									<li>熟成宮崎牛グリル焼</li>
									<li>タコ丸</li>
									<li>山芋塩辛バター</li>
									<li>デザート</li>
								</ul>	
							</td>
						</tr>	
						</table>
					</div>
					<div class="courseBox"> 
						<div class="courseTitle scroll-fade anmt_b2t">
							<span>【19:30からの予約限定コース】</span>熟成肉の国産和牛<br class="pcOnly">グリル焼きコース
						</div>
						<img class="scroll-fade anmt_b2t" src="/_common/img/course/course1.jpg">
						
						<table class="scroll-fade anmt_b2t">
						<tr>
							<th>コース料金</th>
							<td class="lrgTxt">
								<span>現金</span>
								<div>5,600<small> 円 (税込)</small></div>
								<span class="mt5">カード決済時</span>
								<div>6,160<small> 円 (税込)</small></div>
							</td>
						</tr>	
						<tr>
							<th>利用可能時間</th>
							<td>2.5時間<br>(19:30〜)</td>
						</tr>
						<tr>
							<th>予約可能人数</th>
							<td>2名様～ </td>
						</tr>
						<tr>
							<th>飲み放題</th>
							<td>2.5時間</td>
						</tr>
						<tr>
							<th>コース内容例<br>(12品)</th>
							<td>
								<ul class="menuList">
									<li>半熟卵アンチョビマヨソース</li>
									<li>しらすとねぎのサラダ</li>
									<li>揚げトウモロコシ</li>
									<li>燻製卵のポテトサラダ</li>
									<li>ねぎとろアボカド</li>
									<li>メンチカツ</li>
									<li>自家製ソーセージ＆チョリソー</li>
									<li>熟成豚グリル焼</li>
									<li>熟成宮崎牛グリル焼</li>
									<li>タコ丸</li>
									<li>山芋塩辛バター</li>
									<li>デザート</li>
								</ul>	
							</td>
						</tr>	
						</table>
					</div>
					<div class="courseBox"> 
						<div class="courseTitle scroll-fade anmt_b2t">
							<span>【予約限定コース】</span>熟成肉宮崎牛グリル焼＆<br>宮崎牛ローストビーフコース
						</div>
						<img class="scroll-fade anmt_b2t" src="/_common/img/course/course2.jpg">
						
						<table class="scroll-fade anmt_b2t">
						<tr>
							<th>コース料金</th>
							<td class="lrgTxt">
								<span>現金</span>
								<div>6,600<small> 円 (税込)</small></div>
								<span class="mt5">カード決済時</span>
								<div>7,260<small> 円 (税込)</small></div>
							</td>
						</tr>	
						<tr>
							<th>利用可能時間</th>
							<td>3時間</td>
						</tr>
						<tr>
							<th>予約可能人数</th>
							<td>2名様～ </td>
						</tr>
						<tr>
							<th>飲み放題</th>
							<td>3時間</td>
						</tr>
						<tr>
							<th>コース内容例<br>(13品)</th>
							<td>
								<ul class="menuList">
									<li>半熟卵アンチョビマヨソース</li>
									<li>色々野菜のサラダ</li>
									<li>揚げトウモロコシ</li>
									<li>宮崎牛ローストビーフ</li>
									<li>鶏レバーの胡麻オイル漬</li>
									<li>ねぎとろアボカド</li>
									<li>自家製ソーセージ＆チョリソー</li>
									<li>熟成豚グリル焼</li>
									<li>熟成宮崎牛グリル焼</li>
									<li>メンチカツ</li>
									<li>しらすアヒージョ</li>
									<li>タコ丸</li>
									<li>デザート</li>
								</ul>
							</td>
						</tr>	
						</table>
					</div>
				</div>
				<div class="menu_option_long scroll-fade anmt_b2t">仕入などによりメニューが<br class="spOnly"/><span>予告なく</span>変更になる事があります。</div>
				<a><!-- 電話番号 --></a>
			</div>
			<!--
				コース　予約（電話）
			-->
		</section>
		<section id="sec4">
			<div class="main_container">
				<h2 class="scroll-fade anmt_b2t">Info</h3>
				<h4 class="scroll-fade anmt_b2t">店舗情報</h4>
				
				<table class="scroll-fade anmt_l2r">
				<tr>
					<th>店名</th>
					<td>IZAKAYA P/man<br class="spOnly">（居酒屋ピーマン）</td>
				</tr>
				<tr>
					<th>予約・<br class="spOnly">お問い合わせ</th>
					<td><a href="tel:03-3797-0744" class="tel" onclick="gtag('event', 'tel-tap',{'event_category': 'engagement','event_label': 'Tel'});">03-3797-0744</a></td>
				</tr>	
				<tr>
					<th>営業時間</th>
					<td>
						17:00〜24:00<br>
						フードラストオーダー　22:30<br>
						ドリンクラストオーダー　23:30
					</td>
				</tr>
				<tr>
					<th>定休日</th>
					<td>日曜日定休<br>※連休の時は営業　<br class="spOnly">翌月曜日が定休日</td>
				</tr>	
				<tr>
					<th>予算</th>
					<td>￥4,000～￥4,999</td>
				</tr>	
				<tr>
					<th>座席</th>
					<td>60席</td>
				</tr>
				<tr>
					<th>支払い方法</th>
					<td>
						カード可（ビザ　マスター）<br>
						電子マネー（ペイペイ）
					</td>
				</tr>
				<tr>
					<th>個室</th>
					<td>半個室あり</td>
				</tr>
				<tr>
					<th>禁煙・喫煙</th>
					<td>全席喫煙可</td>
				</tr>
				</table>
				
				<div class="timeline scroll-fade anmt_r2l">
					<blockquote class="twitter-tweet">
					<a class="twitter-timeline" data-width="100%" data-height="500" href="https://twitter.com/pman0744?ref_src=twsrc%5Etfw">Tweets by pman0744</a> <!--script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script-->
					</blockquote>	
				</div>	
				<!--a href="https://mobile.twitter.com/pman0744" target="new" class="timeline scroll-fade anmt_r2l">
					※最新情報はこちらのリンクからTwitterでご確認ください。<br><br>
					<img src="/_common/img/twitter.jpg">
				</a-->
			</div>
			<!--
				営業時間 定休日　注意事項
			-->
		</section>
		
		<!--section id="sec7">
			<div class="main_container">
				<div id="movies">
					<div class="movBox scroll-fade anmt_b2t anmt_delay1">
						<div>ヒレ肉の解体している<br>ところを撮影しました</div>

						<video style="background: #000;" controls width="100%" height="300px">
							<source src="/_common/mov/v1.mp4" type="video/mp4" width="100%">
							<a src="/_common/mov/v1.mp4" width="100%">動画を再生</a>
						</video>
					</div>

					<div class="movBox scroll-fade anmt_b2t anmt_delay2">
						<div>塊肉の焼き方を<br>撮影しました</div>

						<video style="background: #000;" controls width="100%" height="300px">
							<source src="/_common/mov/v2.mp4" type="video/mp4" width="100%">
							<a src="/_common/mov/v2.mp4" width="100%">動画を再生</a>
						</video>
					</div>
				</div>	
			</div>	
		</section-->
		
		<section id="sec5">
			<div class="main_container">
				<h2 class="scroll-fade anmt_b2t">Access</h3>
				<h4 class="scroll-fade anmt_b2t">アクセス</h4>
				
				<div class="accessLeft scroll-fade anmt_l2r">
					渋谷駅東口恵比寿方面に徒歩3分<br>
					渋谷ストリーム隣！<br>
					新南口からは徒歩2分！！
				</div>	
				<div class="accessRight scroll-fade anmt_r2l">
					東京都渋谷区渋谷3-22-11 1F・2F<br>
					<span>駅からのアクセス</span>
					JR山手線 ／ 渋谷駅 徒歩5分（390m）<br>
					東急東横線 ／ 代官山駅 徒歩12分（950m）<br>
					京王井の頭線 ／ 神泉駅 徒歩15分（1.1km）
				</div>
				<iframe class="scroll-fade anmt_b2t" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3241.824682319935!2d139.7017510150673!3d35.65669083892529!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188b597f5fb2a3%3A0xd8ff152d0de15c28!2zUC9tYW4mSGkgUC9tYW4gKOODlOODvOODnuODsyk!5e0!3m2!1sja!2sjp!4v1660998260407!5m2!1sja!2sjp" width="98%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
			</div>
			<!--
				アクセス
				交通手段
				google map
			-->
		</section>
		
		<!--section id="sec6">
			<div class="main_container">
				<h2 class="scroll-fade anmt_b2t">SNS</h3>
				<h4 class="scroll-fade anmt_b2t">ソーシャル</h4>
				
				
			</div>
			<!--
				SNS ソーシャル
				
				お客様のtwitter instagramm #居酒屋pman + 住所 = QRコード
			-->
		<!--/section-->
		
		<?php include($_SERVER['DOCUMENT_ROOT'] . "/_common/tag/footer.php"); //ヘッダ ?>
	</div>	
</body>	
<script>
	const twitterEmbed = document.getElementsByClassName('twitter-tweet');
	const instaEmbed = document.getElementsByClassName('instagram-media');
	try {
		if (twitterEmbed.length !== 0) Defer.js('//platform.twitter.com/widgets.js','widgets-js',1000);
		if (instaEmbed.length !== 0) Defer.js('//www.instagram.com/embed.js','embed-js',1000);
	} catch (error) {
		console.log(error)
	}
</script>	
</html>	