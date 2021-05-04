<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=8" />
	<meta name = "viewport" content = "initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no">
	<link rel="icon" type="image/vnd.microsoft.icon" href="img/logo_36.png" /> 
	<link rel="shortcut icon" type="image/x-icon" href="img/logo_36.png" /> 
	<title>:: MONEV - PEMERINTAHAN KOTA PANGKALPINANG ::</title>
	<link rel="stylesheet" href="codebase/skins/compact.css" type="text/css" media="screen" charset="utf-8">
	<script src="codebase/webix.js" type="text/javascript" charset="utf-8"></script>
</head>
<body background="img/bg1.png">

<script type="text/javascript">
var layout = {
	rows:[
		{},
		{
			cols:[
				{width:120},
				{
					view: "form",
					borderless: true,
					elements:[
						{view: "label", label: '<center><b style="font-size:16px">ON CLICK BUTTON</b></center>'},
						{view:"combo", label:"OPD", id:"OPD1", labelWidth:50, options:[{id:"", value:""},]},
						{view: "button", label: "SET VALUE", height: 35, click:funcOpd1},
					],
				},
				{width:20},
				{
					view: "form",
					borderless: true,
					elements:[
						{view: "label", label: '<center><b style="font-size:16px">ON CHANGE COMBO</b></center>'},
						{view:"combo", label:"OPD", 		id:"OPD2",			labelWidth:70, options:[{id:"", value:""},], on: {"onChange": function(newv, oldv){ getSubOpd2(); }}},
						{view:"combo", label:"SUB OPD", id:"SUB_OPD2", 	labelWidth:70, options:[{id:"", value:""},]},
					],
				},
				{width:120},
			]
		},
		{},
		{height:50},
	]
};

webix.ready(function(){
	webix.ui(layout);
	getOpd1();
	getOpd2();
});
var i = 0;

function funcOpd1(){
	if (i==0) 
		getOpd1();
	else
		getSubOpd1();
}

function getOpd1(){
	webix.ajax().post("common_action.php?what=GET_OPD1", function(text, data){
		//webix.message(data.json()[0].id);
		$$("OPD1").define("options", data.json());
		$$("OPD1").refresh();
		$$("OPD1").setValue(data.json()[0].id);
		i++;
	});
}
function getSubOpd1(){
	var opd = $$("OPD1").getValue(); 		//alert(opd); return;
	webix.ajax().post("common_action.php?what=GET_SUB_OPD1&opd="+opd, function(text, data){
		//webix.message(data.json()[0].id);
		$$("OPD1").define("options", data.json());
		$$("OPD1").refresh();
		$$("OPD1").setValue(data.json()[0].id);
		i--;
	});
}

function getOpd2(){
	webix.ajax().post("common_action.php?what=GET_OPD2", function(text, data){
		//webix.message(data.json()[0].id);
		$$("OPD2").define("options", data.json());
		$$("OPD2").refresh();
		$$("OPD2").setValue(data.json()[0].id);
	});
}

function getSubOpd2(){
	var opd = $$("OPD2").getValue(); 		//alert(opd); return;
	webix.ajax().post("common_action.php?what=GET_SUB_OPD2&opd="+opd, function(text, data){
		// webix.message(data.json()[0].id);
		$$("SUB_OPD2").define("options", data.json());
		$$("SUB_OPD2").refresh();
		$$("SUB_OPD2").setValue(data.json()[0].id);
	});
}

</script>

</body>
</html>