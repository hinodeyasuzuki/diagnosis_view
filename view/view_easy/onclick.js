/**
 * Home-Eco Diagnosis for JavaScript
 *
 * onlick.js: key input for PC system
 *
 *
 * @author SUZUKI Yasufumi	Hinodeya Insititute for Ecolife.co.ltd. 2016/12/13
 *
 */

// call startCalc in main.js , in order to execute D6.workercalc in d6facade.js
// result is dealed in main.js

//------- view depend action ---------------
var detailNextDiagnosisCode = 2;

//================ button action ===================================

//inchange(id) -----------------------------------------------
// 		set input value and calculate
// parameters
//		id : input ID, "i" + 3-5 number
// set
//		in other page, execute inchange
var inchange = function(id) {
	var param = {};
	param.id = id;
	param.val = escapeHtml($("#" + id).val());
	if (param.val == -1 || param.val === "") {
		$("#" + id).removeClass("written");
	} else {
		$("#" + id).addClass("written");
	}
	startCalc("inchange", param);
};

//graphChange() -----------------------------------------
// 		change graph type
var graphChange = function() {
	var param = {};
	param.graph = $("#graphChange").val();
	graphNow = param.graph;
	startCalc("graphchange", param);
};

//dataSave() -------------------------------------------
//		save input data
var dataSave = function() {
	var param = {};
	startCalc("save", param);
};

//dataClear() ------------------------------------------
//		clear saved data, after confirm
var dataClear = function() {
	if (confirm(lang.dataClear)) {
		localStorage.removeItem("sindan" + targetMode);
		location.reload();
	}
};

// detail step
var saveandgo = function() {
	var param = {};
	startCalc("saveandgo", param);
};

//show next one measure by click
var measuredisp = 0;
var measurenext = function() {
	var param = {};
	if (measuredisp == 0) {
		$("#measure").show();
		$("#totalReduceComment").hide();
		$("table#itemize tr").hide();
		$("table#itemize tr:nth-child(1)").show();
	}
	measuredisp++;
	$(".notfirst").show();
	$("table#itemize tr:nth-child(" + (measuredisp + 1) + ")").show();
	$("#mesnextbtn").text(lang.home_easy_measure_show(measuredisp + 1));
	$("#mesnextbtn2").text(lang.home_easy_measure_show(measuredisp + 1)); //in modal
	var link = $(
		"table#itemize tr:nth-child(" + (measuredisp + 1) + ") td.conscolor a"
	);

	//activate modal
	if (/*@cc_on ! @*/ false) {
		// IEの場合
		link.fireEvent("onclick"); //これでclickイベントが発火する
	} else {
		// それ以外の場合
		var event = document.createEvent("MouseEvents"); // イベントオブジェクトを作成
		event.initEvent("click", false, true); // イベントの内容を設定
		link[0].dispatchEvent(event); // イベントを発火させる
	}

	if (measuredisp == 1) {
		$("#totalReduceComment").show();
	}
	if (measuredisp == 2) {
		$(".onlyfirst").hide();
	}
	if (measuredisp == messhownumber) {
		//end
		$("#mesnextbtn").hide();
		$("#mesnextbtn2").hide();
		$("#lastbtns").show();
		$(".show7").show();
	}

	param.mid = $("table#itemize tr:nth-child(" + (measuredisp + 1) + ")")
		.prop("id")
		.substring(5, 13);
	startCalc("measureadd_comment", param);
};

//================ after D6 calculation action ===================================

//modeChange(id) -------------------------------------------------
//		change display mode for smartphone
// parameters
//		id : code "m1" to "m5" (string)
var modeChange = function(id) {
	var param = {};

	$(".page").hide();
	$("#p" + id.substrig(1, 10)).show();
	$("#top").hide();

	switch (id) {
	case "m2":
		//result page table
		param.id = "i001";
		param.val = escapeHtml($("#i001").val());
		$("#step button").removeClass("already");
		$("#s2").addClass("already");
		startCalc("inchange", param);
		break;
	case "m3":
		//result page graph
		param.consName = tabNowName;
		param.subName = tabSubNowName;
		$("#step button").removeClass("already");
		$("#s3").addClass("already");
		startCalc("tabclick", param);
		break;
	case "m4":
		//measures calculation
		param.id = "i010";
		param.val = "4";
		measuredisp = 0;
		$("#step button").removeClass("already");
		$("#s4").addClass("already");
		$("#totalReduceComment").hide();
		$(".show7").hide();
		$("#measure").hide();
		$(".onlyfirst").show();
		$("#mesnextbtn").text(lang.home_easy_p4_button_next);
		$("table#itemize tr").hide();
		startCalc("inchange", param);
		break;
	case "m5":
		// consumption list to select and add
		$("#step button").removeClass("already");
		$("#s1").addClass("already");
		break;
	case "m6":
		break;
	case "m7":
		break;
	case "m8":
		break;
	case "m9":
		break;
	case "m10":
		//about this system
		break;
	default:
		break;
	}
};
