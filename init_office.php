<?php
	// D6 eco home diagnosis system
	//
	// for office setting 
	//
	$title = $lang["office_title"];
	
	// 1 original js
function getlogiclistoffice( $area )  {
	return '
	<script src="'.$area.'/areaset/accons.js" type="text/javascript"></script>
	<script src="'.$area.'/areaset/acload.js" type="text/javascript"></script>
	<script src="'.$area.'/areaset/acadd.js" type="text/javascript"></script>
	<script src="'.$area.'/areaset/area.js" type="text/javascript"></script>
	<script src="'.$area.'/areaset/unit.js" type="text/javascript"></script>

	<script src="'.$area.'/office/scenarioset.js" type="text/javascript"></script>
	<script src="'.$area.'/office/scenariofix.js" type="text/javascript"></script>
	<script src="'.$area.'/office/consEnergy.js" type="text/javascript"></script>
	<script src="'.$area.'/office/consTOTAL.js" type="text/javascript"></script>
	<script src="'.$area.'/office/consMonth.js" type="text/javascript"></script>
	<script src="'.$area.'/office/consSeason.js" type="text/javascript"></script>
	<script src="'.$area.'/office/consRM.js" type="text/javascript"></script>
	<script src="'.$area.'/office/consHWsum.js" type="text/javascript"></script>
	<script src="'.$area.'/office/consCOsum.js" type="text/javascript"></script>
	<script src="'.$area.'/office/consCO.js" type="text/javascript"></script>
	<script src="'.$area.'/office/consHTsum.js" type="text/javascript"></script>
	<script src="'.$area.'/office/consHT.js" type="text/javascript"></script>
	<script src="'.$area.'/office/consACsum.js" type="text/javascript"></script>
	<script src="'.$area.'/office/consAC.js" type="text/javascript"></script>
	<script src="'.$area.'/office/consRFsum.js" type="text/javascript"></script>
	<script src="'.$area.'/office/consRF.js" type="text/javascript"></script>
	<script src="'.$area.'/office/consLIsum.js" type="text/javascript"></script>
	<script src="'.$area.'/office/consLI.js" type="text/javascript"></script>
	<script src="'.$area.'/office/consOAsum.js" type="text/javascript"></script>
	<script src="'.$area.'/office/consOTsum.js" type="text/javascript"></script>
	<script src="'.$area.'/office/consOT.js" type="text/javascript"></script>
	<script src="'.$area.'/office/consCRsum.js" type="text/javascript"></script>
	<script src="'.$area.'/office/consCR.js" type="text/javascript"></script>
	<script src="'.$area.'/office/consCRtrip.js" type="text/javascript"></script>
	<script src="'.$area.'/office/consCKsum.js" type="text/javascript"></script>

	';
}
	$includeeachjs = $include_common . getlogiclistoffice( "d6" ) . getlogiclistoffice($lang["d6folder"] );

	$includesumjs_direct  = 'd6logic_develop/d6office_' . $lang["localizeCode"] . '.js';
	$includeminjs_direct  = 'd6logic_release/d6office_' . $lang["localizeCode"] . '.min.js';

	$includesumcorejs  ='d6logic_develop/d6office_core.js';
	$includemincorejs  ='d6logic_release/d6office_core.min.js';

