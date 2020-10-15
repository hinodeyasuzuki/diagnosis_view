# d62 home eco diagnosis Ver6.rev.2

温暖化対策計算ソフトの画面・操作部分です。

ロジックのd62の結果（日本語）を dist/にコピーしてあり、実際の診断の動作テストができます。ロジックの開発は d62 で行います。


## Demo
https://www.hinodeya-ecolife.com/diagnosis/?lang=ja	Japanese Default

You can design visual and diagnosis flow. such as...

https://www.hinodeya-ecolife.com/diagnosis/?v=0&lang=en　detail diagnosis(english)

https://www.hinodeya-ecolife.com/diagnosis/?v=1&lang=en　button desgin

https://www.hinodeya-ecolife.com/diagnosis/?v=2&lang=en　one page diagnosis

https://www.hinodeya-ecolife.com/diagnosis/?v=3&lang=en　easy desgin

https://www.hinodeya-ecolife.com/diagnosis/?v=4&lang=en　information about diagnosis


## Install develop environment
In order to pack js files, you need commandline PHP

php files are used as parameters set, if you want to execute listricted pattern of diagnosis, you can save as .html file.

## folder and files
index.php   access file in oder to manage develop/release, language, etc.

init_home.php, init_office.php  parameters set for home/office

parameters.php  default parameters set

/logic/      main logic files, commonly used for each language / views

/logic_JP/  localized files set in this folder to config diagnosis system

now prepareing EN, FR, KO, CN, VI language and area.


## making your area/language system 

### step1)EXCEL setting
The base advice algolism is set for Japan. 

You can fill efficent equipment, price, adive message, subsidy information, question text, select options, in order to fit your area and language. And also set messages in your language.

### step2)copy excel sheet to /logic_**/home/senario_fix.js

 ** is your country code and language code. Please copy code from excel to program files.

### step3)configure parameter.php

 add new language code if you need. 

### step4) access and check



## logig priority

### measure

1. modified in logic_JP/home/senariofix.js, which is defined in Excel file
		- set measure name as #, which means do not show
2. modified in logic_JP/home/cons**.js calcMeasure() function
		- override or add calculation functions
		- set another prohibit status
3. see calculation funciton in common function d6/home/calc**.js

## Third party tools
* jQuery JavaScript Library: Copyright 2005, 2013 jQuery Foundation, Inc. and other contributors
* leanModal v1.1 by Ray Stone - http://finelysliced.com.au
* jQuery Cookie Plugin v1.4.1: Copyright 2006, 2014 Klaus Hartl
* Chart.js http://chartjs.org/ Version: 2.0.2: Copyright 2016 Nick Downie
* d3/d3.js Copyright 2010-2017 Mike Bostock
* PMSI-AlignAlytics/dimple: Copyright 2015 AlignAlytics http://www.align-alytics.com
* php-packer: originally created by Dean Edwards, ported to PHP by Nicolas Martin. Packed for composer and slightly extended by Thomas Lutz.
* intro.js : introjs.com
 

## copyright
Copyright 2011－2020（C） Yasufumi Suzuki, Hinodeya Insititute for Ecolife co.Ltd.

Released under the MIT license








.
