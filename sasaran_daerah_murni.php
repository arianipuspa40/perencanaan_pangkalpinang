<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=8" />
	<meta name = "viewport" content = "initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no">
	<link rel="icon" type="image/vnd.microsoft.icon" href="img/logo_36.png" /> 
	<link rel="shortcut icon" type="image/x-icon" href="img/logo_36.png" /> 
	<title>:: MONEV - PEMERINTAHAN KOTA PANGKALPINANG ::</title>
	<link rel="stylesheet" href="codebase/skins/compact.css" type="text/css" media="screen" charset="utf-8">
	<link rel="stylesheet" href="css/app.less" type="text/css" media="screen" charset="utf-8">
	<script src="codebase/webix.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>

<script type="text/javascript">
var data_filter = {
	type: "clean",
	rows: [
		{
			view: "form",
			borderless: true,
			elementsConfig: {
				paddingY: 0, paddingX: 0
			},
			elements: [
				{	
					cols: [
						{view: "checkbox", label: "URUSAN", id: "URUSAN_CB", labelWidth:140, width:170},
						{view: "text", id: "URUSAN_TXT", }, {}
					],
				},
				{
					cols: [
						{view: "checkbox", label: "URS_ID", id: "URS_ID_CB", labelWidth:140, width:170},
						{view: "text", id: "URS_ID_TXT", }, {}
					],
				},
				{
					cols: [
						{view: "checkbox", label: "PROGRAM", id: "PROGRAM_CB", labelWidth:140, width:170},
						{view: "text", id: "PROGRAM_TXT", }, {}
					],
				},
				{
					cols: [
						{view: "checkbox", label: "INDIKATOR DAERAH", id: "INDIKATOR_DAERAH_CB", labelWidth:140, width:170},
						{view: "text", id: "INDIKATOR_DAERAH_TXT", }, {}
					],
				},
			]
		}
	]
};

var data_nav_sasaran_daerah = {
	//type: "clean",
	view: "toolbar",
	css: "highlighted_header header",
	paddingX: 2,
	paddingY: 2,
	height: 35,
	cols: [
		{
			template: "<span class='webix_icon fa-table'></span>SASARAN DAERAH",
			css: "sub_title2", borderless: true
		}, 
		{view:"button", type:"icon", icon:"plus", label:"TAMBAH", autowidth:true, click:"addData1()"},
	]
};

var data_sasaran_daerah = {
	view:"datatable", id:"DATATABLE_USER",
	select:true, css:"datatable_column", 
	columns:[
		{header:"#", 													id:"ID", 				hidden:true},
		
		{header:"No", 												id:"NO", 									width:35, 	css:{'text-align':'right'}},
		{header:"NO SASARAN DAERAH", 					id:"NO SASARAN DAERAH", 	width:200, 	css:{'text-align':'left'}, fillspace:true},
		{header:"SASARAN DAERAH", 						id:"SASARAN DAERAH", 			width:200, 	css:{'text-align':'left'}, fillspace:true},
		
		{header: "&nbsp;", 										id: "EDIT", 							width: 37, 	template: "<span style='cursor:pointer;' class='webix_icon fa-pencil'></span>", 	tooltip: "Edit"},
		{header: "&nbsp;", 										id: "DELETE", 						width: 35, 	template: "<span style='cursor:pointer;' class='webix_icon fa-trash-o'></span>", 	tooltip: "Hapus"}
	],
	on:{
		"onBeforeLoad":function(){
			this.showOverlay("Loading...");
		},
		"onAfterLoad":function(){
			this.hideOverlay();
		},
		"onItemDblClick":function(id,e,node){
			
		},
	},
	onClick:{
		"fa-pencil":function(e,id){
			
		},
		"fa-trash-o": function(e,id){
			
		}
	},
	fixedRowHeight:false,
	scroll:true,
	animate:{type:"slide", subtype:"together"},
	tooltip:true,
	hover:"my_hover",
	datatype:"json",
};

var data_nav_indikator_daerah = {
	//type: "clean",
	view: "toolbar",
	css: "highlighted_header header",
	paddingX: 2,
	paddingY: 2,
	height: 35,
	cols: [
		{
			template: "<span class='webix_icon fa-table'></span>INDIKATOR DAERAH",
			css: "sub_title2", borderless: true
		}, 
		{view:"button", type:"icon", icon:"plus", label:"TAMBAH", autowidth:true, click:"addData2()"},
	]
};

var data_indikator_daerah = {
	view:"datatable", id:"DATATABLE_USER",
	select:true, css:"datatable_column", 
	columns:[
		{header:"#", 													id:"ID", 				hidden:true},
		
		{header:"No", 												id:"NO", 									width:35, 	css:{'text-align':'right'}},
		{header:"SASARAN DAERAH", 						id:"SASARAN DAERAH", 			width:200, 	css:{'text-align':'left'}, fillspace:true},
		{header:"INDIKATOR DAERAH", 					id:"INDIKATOR DAERAH", 		width:200, 	css:{'text-align':'left'}, fillspace:true},
		{header:"SATUAN", 										id:"SATUAN", 							width:100, 	css:{'text-align':'left'}, fillspace:true},
		{header:"TARGET KINERJA", 						id:"TARGET KINERJA", 			width:100, 	css:{'text-align':'left'}, fillspace:true},
		{header:"KINERJA AWAL", 							id:"KINERJA AWAL", 				width:100, 	css:{'text-align':'left'}, fillspace:true},
		
		{header: "&nbsp;", 										id: "EDIT", 							width: 37, 	template: "<span style='cursor:pointer;' class='webix_icon fa-pencil'></span>", 	tooltip: "Edit"},
		{header: "&nbsp;", 										id: "DELETE", 						width: 35, 	template: "<span style='cursor:pointer;' class='webix_icon fa-trash-o'></span>", 	tooltip: "Hapus"}
	],
	on:{
		"onBeforeLoad":function(){
			this.showOverlay("Loading...");
		},
		"onAfterLoad":function(){
			this.hideOverlay();
		},
		"onItemDblClick":function(id,e,node){
			
		},
	},
	onClick:{
		"fa-pencil":function(e,id){
			
		},
		"fa-trash-o": function(e,id){
			
		}
	},
	fixedRowHeight:false,
	scroll:true,
	animate:{type:"slide", subtype:"together"},
	tooltip:true,
	hover:"my_hover",
	datatype:"json",
};

var ui = {
	rows:[data_nav_sasaran_daerah, data_sasaran_daerah, data_nav_indikator_daerah, data_indikator_daerah],
};

webix.ready(function(){
	webix.ui(ui);
	webix.ui({
		view:"window", id:"WIN_DATA1_ADD",
		width:410, height:410,
		move:true, modal:true,
		position:"center",
		head:{
			view:"toolbar", margin:-5, cols:[
				{view:"label", label:"<span class='webix_icon fa-plus-circle'></span>Tambah Data"},
				{view:"icon", icon:"times-circle", click:"$$('WIN_DATA1_ADD').hide();", tooltip:"Close"},
				{width: 10},
			]
		},
		body: webix.copy(FORM_DATA1_ADD)
	});
	webix.ui({
		view:"window", id:"WIN_DATA2_ADD",
		width:410, height:410,
		move:true, modal:true,
		position:"center",
		head:{
			view:"toolbar", margin:-5, cols:[
				{view:"label", label:"<span class='webix_icon fa-plus-circle'></span>Tambah Data"},
				{view:"icon", icon:"times-circle", click:"$$('WIN_DATA2_ADD').hide();", tooltip:"Close"},
				{width: 10},
			]
		},
		body: webix.copy(FORM_DATA2_ADD)
	});

});

var FORM_DATA1_ADD = {
	view:"form",
	borderless:true,
	// scroll:"xy",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements: [
		{view:"text", 			label:"NO SASARAN DAERAH", 						id:"NO SASARAN DAERAH",	 labelWidth: 150},
		{view:"text", 			label:"INDIKATOR DAERAH", 						id:"INDIKATOR DAERAH1", 	labelWidth: 150},
		{
			margin: 5,
			cols:[
				{width:146},
				{view:"button", label:"Simpan", type:"form", align:"center", width:100, click:function(){
					dataAdd();
				}},
				{view:"button", label:"Cancel", align:"center", width:100, click:function(){
					$$("WIN_DATA1_ADD").hide();
				}},
				{}
			]
		}
	]
};


var FORM_DATA2_ADD = {
	view:"form",
	borderless:true,
	// scroll:"xy",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements: [
		{view:"text", 			label:"SASARAN DAERAH", 							id:"SASARAN DAERAH", 		labelWidth: 130},
		{view:"text", 			label:"INDIKATOR DAERAH", 						id:"INDIKATOR DAERAH", 	labelWidth: 130},
		{view:"text", 			label:"SATUAN",												id:"SATUAN", 						labelWidth: 130},
		{view:"text", 			label:"TARGET KINERJA",			 					id:"TARGET KINERJA", 		labelWidth: 130},
		{view:"text", 			label:"KINERJA AWAL", 								id:"KINERJA AWAL", 			labelWidth: 130},
		{
			margin: 5,
			cols:[
				{width:126},
				{view:"button", label:"Simpan", type:"form", align:"center", width:100, click:function(){
					dataAdd();
				}},
				{view:"button", label:"Cancel", align:"center", width:100, click:function(){
					$$("WIN_DATA2_ADD").hide();
				}},
				{}
			]
		}
	]
};


function showWindow(winId, node){
	$$(winId).getBody().clear();
	$$(winId).show(node);
	$$(winId).getBody().focus();
}

function addData1(){
	showWindow("WIN_DATA1_ADD");
}
function addData2(){
	showWindow("WIN_DATA2_ADD");
}
</script>

</body>
</html>