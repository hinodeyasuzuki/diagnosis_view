/* diagnosis design setting focus on questions and measures
 */

//prohibit questions numbers as array i***
var prohibitQuestions = [];

//allow questions numbers. use this setting when prohibitQuestions is null.
var allowedQuestions = [
	"i021",
	"i001",
	"i002",
	"i009",
	"i041",
	"i042",
	"i052",
	"i061",
	"i063",
	"i083",
	"i093",
	"i101",
	"i102",
	"i103",
	"i104",
	"i105",
	"i107",
	"i116",
	"i117",
	"i201",
	"i202",
	"i204",
	"i205",
	"i206",
	"i214"
];

//prohibit measures codes as array m*****
//var prohibitMeasures = ["mTOsolar"];	//example
//var prohibitMeasures = ["mHWshowerTime30", "mTVradio"];

//allow measures codes. use this setting when prohibitMeasures is null.
var allowedMeasures = ["mHWecocute","mHWecojoze","mHWenefarm","mHWsolarHeater","mHWsolarSystem","mHWshowerHead","mHWshowerTime","mHWinsulation", "mHWonlyShower","mHWtap","mACreplace", "mACreplaceHeat", "mHTdouble", "mHTlowe","mHTuchimado", "mHTdanran", "mHTbiomass"  ];

//fix in D6.setscenario, just after setDefs
/*
var defInput = [];
defInput[0] = ["i002", "title", "戸建てですか集合住宅ですか"];
defInput[1] = ["i061", "title", "月平均の電気代"];
defInput[2] = ["i063", "title", "月平均のガス＋灯油代"];
defInput[3] = [
	"i063",
	"text",
	"1ヶ月あたりのガスと灯油代の合計額を記入してください。"
];
defInput[4] = ["i075", "title", "月平均のガソリン代"];
*/
//global
var showMeasureTable_Max = 10; //createpage.js showMeasureTable() max result

tabNowName = "easy01";
tabSubNowName = "easy01";
