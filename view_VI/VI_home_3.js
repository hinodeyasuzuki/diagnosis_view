/* diagnosis design setting focus on questions and measures
 */

//prohibit questions numbers as array i***
var prohibitQuestions = [];

//allow questions numbers. use this setting when prohibitQuestions is null.
var allowedQuestions = [
	"i021",
	"i001",
	"i002",
	"i061",
	"i063",
	"i075",
	"i202",
	"i205"
];

//prohibit measures codes as array m*****
//var prohibitMeasures = ["mTOsolar"];	//example
var prohibitMeasures = ["mHWshowerTime30", "mTVradio"];

//allow measures codes. use this setting when prohibitMeasures is null.
var allowedMeasures = [];

//fix in D6.setscenario, just after setDefs
var defInput = [];

//global
var showMeasureTable_Max = 7; //createpage.js showMeasureTable() max result
