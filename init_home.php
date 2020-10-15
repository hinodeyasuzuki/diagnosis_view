<?php
/* D6 eco home diagnosis system
 *
 * for home setting 
 */

// for home
$title = $lang["home_title"];

// 1 original js
function getlogiclist( $area )  {
	return '
	<script src="'.$area.'/areaset/accons.js" type="text/javascript"></script>
	<script src="'.$area.'/areaset/acload.js" type="text/javascript"></script>
	<script src="'.$area.'/areaset/acadd.js" type="text/javascript"></script>
	<script src="'.$area.'/areaset/area.js" type="text/javascript"></script>
	<script src="'.$area.'/areaset/unit.js" type="text/javascript"></script>

	<script src="'.$area.'/home/scenarioset.js" type="text/javascript"></script>
	<script src="'.$area.'/home/scenariofix.js" type="text/javascript"></script>
	<script src="'.$area.'/home/consEnergy.js" type="text/javascript"></script>
	<script src="'.$area.'/home/consSeason.js" type="text/javascript"></script>
	<script src="'.$area.'/home/consTOTAL.js" type="text/javascript"></script>
	<script src="'.$area.'/home/consHWsum.js" type="text/javascript"></script>
	<script src="'.$area.'/home/consHWshower.js" type="text/javascript"></script>
	<script src="'.$area.'/home/consHWtub.js" type="text/javascript"></script>
	<script src="'.$area.'/home/consHWdresser.js" type="text/javascript"></script>
	<script src="'.$area.'/home/consHWdishwash.js" type="text/javascript"></script>
	<script src="'.$area.'/home/consHWtoilet.js" type="text/javascript"></script>
	<script src="'.$area.'/home/consCOsum.js" type="text/javascript"></script>
	<script src="'.$area.'/home/consACcool.js" type="text/javascript"></script>
	<script src="'.$area.'/home/consHTsum.js" type="text/javascript"></script>
	<script src="'.$area.'/home/consHTcold.js" type="text/javascript"></script>
	<script src="'.$area.'/home/consACheat.js" type="text/javascript"></script>
	<script src="'.$area.'/home/consAC.js" type="text/javascript"></script>
	<script src="'.$area.'/home/consRFsum.js" type="text/javascript"></script>
	<script src="'.$area.'/home/consRF.js" type="text/javascript"></script>
	<script src="'.$area.'/home/consLIsum.js" type="text/javascript"></script>
	<script src="'.$area.'/home/consLI.js" type="text/javascript"></script>
	<script src="'.$area.'/home/consTVsum.js" type="text/javascript"></script>
	<script src="'.$area.'/home/consTV.js" type="text/javascript"></script>
	<script src="'.$area.'/home/consDRsum.js" type="text/javascript"></script>
	<script src="'.$area.'/home/consCRsum.js" type="text/javascript"></script>
	<script src="'.$area.'/home/consCR.js" type="text/javascript"></script>
	<script src="'.$area.'/home/consCRtrip.js" type="text/javascript"></script>
	<script src="'.$area.'/home/consCKsum.js" type="text/javascript"></script>
	<script src="'.$area.'/home/consCKpot.js" type="text/javascript"></script>
	<script src="'.$area.'/home/consCKrice.js" type="text/javascript"></script>
	<script src="'.$area.'/home/consCKcook.js" type="text/javascript"></script>
	<script src="'.$area.'/home/consOTother.js" type="text/javascript"></script>
	';
}

$include_logic = getlogiclist( "logic" );
$include_logic .= getlogiclist( $lang["d6folder"] );

$includeeachjs = $include_common . $include_logic;

$includesumjs_direct  = 'develop/d6home_' . $lang["localizeCode"] . '.js';
$includeminjs_direct  = 'dist/d6home_' . $lang["localizeCode"] . '.min.js';

$includesumcorejs  ='develop/d6home_core.js';
$includemincorejs  ='dist/d6home_core.min.js';

	
