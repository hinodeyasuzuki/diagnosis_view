<?php
/** D6 eco home diagnosis system
 *
 *   compile valiable system with HTML, JavaScript files
 *
 *   original 2016/04/12 Yasufumi Suzuki, Hinodeya Insitetute for Ecolife co.
 *
 *  2016/12/13		devide logic and view
 *  2016/12/18		combine home and office in same index.php
 *  2016/12/19		for smart phone mode
 *  2020/10/10		open as d62
 *
 */

//develop mode parameters  =======================================================
session_start();
date_default_timezone_set("Asia/Tokyo");

//display mode setting by get parameters ===========================================
//languageMode: ja, cn 2charactor ,  use as folder name
$languageMode 	= ( isset($_GET["lang"]) ? substr($_GET["lang"], 0, 2) : 
						( isset($_SESSION["language"]) ? $_SESSION["language"] :"ja" ) );

//targetMode: 1 home, 2 office
$targetMode 	=  isset($_GET["t"]) ? (int)($_GET["t"]) : 1;

// select view  0 PC, 1 smart phone,  2 PC focus design,  3 easy 4 about....
$viewMode 		= (isset($_GET["v"]) ? $_GET["v"]*1 : 4 );

// focusmode number include [languageMode]_focus[taretMode]_[focusMode].js
// policy 1:full vertion - 2:ordinal - 3:easy version
$focusMode 	= ( isset($_GET["f"]) ? $_GET["f"]*1 : ( isset($_GET["v"]) ? $_GET["v"]*1 : 0  ));

// show introduction : 0:not  1:show introduction (Japanese)
$introMode 		= ( isset($_GET["intro"]) ? (int)($_GET["intro"]) : 0 );		

// google translation : 0:not  1:google translation(default)
$translateMode 	= ( isset($_GET["translate"]) ? (int)($_GET["translate"]) : 0 );

// forcemode set developlevel
$forceMode 		= ( isset($_GET["fm"]) ? (int)($_GET["fm"]) : 4 );

$forceModeDefs = [
	//useCode, debugMode, useWorker
	1 => [ 1, "true" ,"false" ],		//develop mode
	2 => [ 2, "true" ,"false" ],		//packed check
//	3 => [ 2, "true" ,"true"  ],	//worker check
	4 => [ 3, "false" ,"false" ],		//compressed release
//	5 => [ 3, "false" ,"true" ]		// worker version
];

list( $useCode, $debugMode, $useWorker ) =  $forceModeDefs[$forceMode];

// initial data set
$data 			= ( isset($_GET["data"]) ? strip_tags($_GET["data"]) : "" );

// dont show average
$hideAverage 	= ( isset($_GET["hideaverage"]) ? $_GET["hideaverage"]*1 : 0 );

// dont show price/cost
$hidePrice 	= ( isset($_GET["hideprice"]) ? $_GET["hideprice"]*1 : 0 );

// measure show number
$messhownumber 	= ( isset($_GET["messhownumber"]) ? $_GET["messhownumber"]*1 : 7 );


//parameters set =======================================================
include "parameters.php";


//language set =======================================================
//language and country white list
$countryList = [];
$countryList["ja"] = "JP";
$countryList["zh"] = "CN";
$countryList["en"] = "JP";
$countryList["fr"] = "FR";
$countryList["ko"] = "KR";
$countryList["vi"] = "VI";

if (! isset($countryList[$languageMode]) ) {
	//default setting
	$languageMode = $defaultLanguage;
}

//country
$countryMode = ( isset($_GET["c"]) ? substr($_GET["c"], 0, 2) : $countryList[$languageMode]);

//language settings
$lang = [];		
if ( $countryMode ==  $countryList[$languageMode] && $languageMode != "en" ) {
	$lang["d6folder"] = "./logic_" . $countryMode;
	$lang["viewfolder"] = "./view_" . $countryMode;
	$lang["localizeCode"] = $countryMode;
} else {
	$lang["d6folder"] = "./logic_" . $countryMode ."_" . $languageMode;
	$lang["viewfolder"] = "./view_" . $countryMode ."_" . $languageMode;
	$lang["localizeCode"] =  $countryMode ."_" . $languageMode;
}

$_SESSION["language"] = $languageMode;
$lang["pageLanguage"] = $countryMode ."_" . $languageMode;

include_once( $lang["viewfolder"] . "/language_set.php" );

$lang["co2unitperyear"] = $lang['co2unit'] .'/' . $lang['yearunit'];
$lang["co2unitpermonth"] = $lang['co2unit'] .'/' . $lang['monthunit'];
$lang["feeunitperyear"] = $lang['priceunit'] .'/' . $lang['yearunit'];
$lang["feeunitpermonth"] = $lang['priceunit'] .'/' . $lang['monthunit'];
$lang["energyunitperyear"] = $lang['energyunit'] .'/' . $lang['yearunit'];
$lang["energyunitpermonth"] = $lang['energyunit'] .'/' . $lang['monthunit'];


//alternate list
$alternate = "";
if ( !$oneAreaRelease ) {
	foreach ( $countryList as $code => $val  ){
		$alternate .= "\t<link rel='alternate' hreflang='".$code."' href='./?lang=".$code.
				"&v=".$viewMode.
				( $targetMode==2 ? "&t=2" : "" ) . "' />\n";
	}
}


//pickup javascripts ==============================================================
//
//
//
//javascripts files to design system ---------------------------------------------
$scripts = "";

//base D6 scripts (common) in case useCode==1
$include_common  ='
	<script src="logic/d6facade.js" type="text/javascript"></script>
	<script src="logic/base/objectcreate.js" type="text/javascript"></script>
	<script src="logic/base/energy.js" type="text/javascript"></script>
	<script src="logic/base/consbase.js" type="text/javascript"></script>
	<script src="logic/base/measurebase.js" type="text/javascript"></script>
	<script src="logic/base/doc.js" type="text/javascript"></script>
	<script src="logic/base/d6.js" type="text/javascript"></script>
	<script src="logic/base/d6_calcmonthly.js" type="text/javascript"></script>
	<script src="logic/base/d6_get.js" type="text/javascript"></script>
	<script src="logic/base/d6_getinput.js" type="text/javascript"></script>
	<script src="logic/base/d6_getmeasure.js" type="text/javascript"></script>
	<script src="logic/base/d6_getdemand.js" type="text/javascript"></script>
	<script src="logic/base/d6_getevaluateaxis.js" type="text/javascript"></script>
	<script src="logic/base/d6_construct.js" type="text/javascript"></script>
	<script src="logic/base/d6_calccons.js" type="text/javascript"></script>
	<script src="logic/base/d6_calcaverage.js" type="text/javascript"></script>
	<script src="logic/base/d6_calcmeasures.js" type="text/javascript"></script>
	<script src="logic/base/d6_setvalue.js" type="text/javascript"></script>
	<script src="logic/base/d6_tools.js" type="text/javascript"></script>
	
';


// fix for office ------------------------------------------------------
if ( $targetMode == 1 ){
	require_once( "init_home.php" );
} else {
	require_once( "init_office.php" );
}


//set common parameters and javascript files------------------------------
$jssets = "<script>var targetMode=" . $targetMode 
			. ";var debugMode=" . $debugMode 
			. ";var viewMode=" . $viewMode 
			. ";var languageMode='" . $languageMode . "'"
			. ";var focusMode=" . $focusMode 
			. ";var useWorker=" . $useWorker 
			. ";var useCode=" . $useCode 
			. ";var messhownumber=" . $messhownumber 
			. ";var hideAverage='" . $hideAverage . "'" 
			. ";var hidePrice='" . $hidePrice . "'" 
			. ";var includemincore='" . $includemincorejs . "'"
			. ";var lang={};\n" ;
foreach ( $lang as $param => $value ) {
	//copy Language set to javascript with easy encode
	if ( substr($value,0,5) == "funct" ) {
		$jssets .= "lang.".$param."=" . str_replace( "'", "\\'",$value ) .";\n";
	} else {
		$jssets .= "lang.".$param."='" . str_replace( "'", "\\'",$value ) ."';\n";
		// semi crypt of js code
		//$jssets .= "lang.".$param."='q@" . str_rot13(base64_encode(str_replace( "'", "\\'",str_replace( "\"", "\\\"", $value )))) ."';\n";
	}
}
$jssets .= "</script>";

if ( $forceMode == 5) {
	$jssets .="
		<!--[if IE 9]><script>var a=location.search.substring(1);location.href='./?fm=4&'+a;</script><![endif]-->
	";
}

// google translate-----------------------------------
if ( $translateMode == 0 ) {
	$jsgoogle = "";
} else {
	$jsgoogle = "
	<div style='text-align:right;' id='google_translate_element'></div>
	<script type='text/javascript'>
		function googleTranslateElementInit() {
			new google.translate.TranslateElement({pageLanguage: '".$lang["pageLanguage"]."', includedLanguages: 'de,en,es,fr,ja,ko,ru,th,vi,ja', layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL, autoDisplay: false}, 'google_translate_element');
		}
	</script>
	<script type='text/javascript' src='//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit'>
	</script>\n";
}


// google analytics-----------------------------------
if ( $lang["pageLanguage"] == "zh-CN" || strcmp($_SERVER['HTTP_HOST'] , 'localhost') == 0 ) {
	//for China not use Google
	$jsgoogle_analytics = "";	
} else {
	$jsgoogle_analytics = "
		<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
	  ga('create', 'UA-96438552-5', 'auto');
	  ga('send', 'pageview');
		</script>\n";
}


//design base scripts -----------------------------------------
/*
//use local
$scripts  .='
	<script src="view/lib/jquery/jquery.min.js" type="text/javascript"></script>
	<script src="view/lib/leanModal/jquery.leanModal.min.js" type="text/javascript"></script>
	<script src="view/lib/jquery.cookie/jquery.cookie.js" type="text/javascript"></script>
	<script src="view/main.js" type="text/javascript"></script>
	<script src="view/createpage.js" type="text/javascript"></script>
	<script src="view/graph.js" type="text/javascript"></script>
	<script src="view/lib/D3/d3.min.js"></script>
	<script src="view/lib/dimple-js/dimple.v2.3.0.min.js"></script>
	<!--[if lte IE 10]><script>alert("Sorry, this page does not work under IE8, and too slow under IE10.\n Please use IE11 up, chrome, Edge, Firefox or safari.");</script><![endif]-->';

*/

$scripts  .='
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" type="text/javascript"></script>
	<script src="view/js/leanModal/jquery.leanModal.min.js" type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js" type="text/javascript"></script>
	<script src="view/main.js" type="text/javascript"></script>
	<script src="view/createpage.js" type="text/javascript"></script>
	<script src="view/graph.js" type="text/javascript"></script>
	<script src="https://d3js.org/d3.v6.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/dimple/2.3.0/dimple.latest.min.js"></script>
	<!--[if lte IE 10]><script>alert("Sorry, this page does not work under IE8, and too slow under IE10.\n Please use IE11 up, chrome, Edge, Firefox or safari.");</script><![endif]-->';

// question fix --------------------------------------------------------
$targetModeName = array( 1=>"home", 2=>"office" );
$scripts .= "<script src='" . $lang["viewfolder"] . "/" . $countryMode . "_" . $targetModeName[$targetMode] . "_" . $focusMode . ".js' type='text/javascript'></script>";


// code minimumization/worker type --------------------------------------------------------
if ( $useCode==1 ) {
	$scripts .= $includeeachjs;
} else if ( $useCode==2 && $useWorker =="false" ) {
	$scripts .= "\n<script src='" .$includesumcorejs . "' type='text/javascript'></script>";
	$scripts .= "<script src='" .$includesumjs_direct . "' type='text/javascript'></script>";
} else if ( $useCode==3 && $useWorker =="false") {
	$scripts .= "\n<script src='" .$includemincorejs . "' type='text/javascript'></script>";
	$scripts .= "<script src='" .$includeminjs_direct . "' type='text/javascript'></script>";
}
//in case of worker, no need to include in html.


// show introduction/tutorial  --------------------------------------------------
if ( $introMode == 1 ) {
	//show tutorial
	$scripts .="\n
	<link href='view/lib/intro.js/introjs.min.css' rel='stylesheet' type='text/css' />\n
	<script src='view/lib/intro.js/intro.min.js' type='text/javascript'></script>\n
	<script>
	window.onload = function(){
		introJs().start();
	};
	</script>\n";
} else if ( $introMode == -1 || $targetMode == 2 ) {
	//not show introduction
} else {
	//not show introduction page
	$scripts .="\n
	<script>
	window.onload = function(){
		$('#top').show();
		$('#divco2').hide();
	};
	</script>\n";
	
}

// load dataset --------------------------------------------------
if ( $data ) {
	$scripts .= "	<script>paramdata='".$data."';</script>";
} else {
	$scripts .= "	<script>paramdata='';</script>";
}


//templates ==============================================================

//templates depend on displayMode =====================================================
switch( $viewMode ) {
	case 0:
		//PC full diagnosis
		include "view/view_base/template-base.html";
		break;

	case 1:
		//smart phone
		include "view/view_button/template-button.html";
		break;

	case 2:
		//focus diagnosis in one page
		include "view/view_focus/template-focus.html";
		break;

	case 3:
		// easy , single question
		include "view/view_easy/template-easy.html";
		break;

	case 4:
		//about
		include "view/view_about/template-about.html";
		break;
		
	case 5:
		//maintenance
		include "view/view_maintenance/template-maintenance.html";
		break;
		
	case 6:
		//action
		include "view/view_action/template-action.html";
		break;
		
	case 7:
		//lifegame
		include "view/view_lifegame/template-lifegame.html";
		break;
		
	case 8:
		//uchieco
		include "view/view_uchieco/template-uchieco.html";
		break;
		
	case 9:
		//develop
		include "view/view_develop/template-develop.html";
		break;

	case 99:
		//measure list
		include "view/view_list/template-list.html";
		break;

	default:
		//about
		include "view/view_about/template-about.html";
		break;
}


//access log =======================================================
$fp = fopen("./logindex.log", "a");
fwrite($fp, 
	date("Y-m-d H:i:s") . ", " .
	gethostbyaddr($_SERVER['REMOTE_ADDR']) . ", ".
	( isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "" ) . "\n"
);
fclose($fp);


?>