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
var nav_sasaran_pd = {
	//type: "clean",
	view: "toolbar",
	css: "highlighted_header header",
	paddingX: 2,
	paddingY: 2,
	height: 35,
	cols: [
		{
			template: "<span class='webix_icon fa-table'></span>SASARAN PERANGKAT DAERAH",
			css: "sub_title2", borderless: true
		}, 
		{view:"button", type:"iconButton", icon:"plus-circle", label:"TAMBAH", autowidth:true, click:"addData()"},
		{view:"button", type:"iconButton", icon:"edit", label:"EDIT", autowidth:true, click:"editData()"},
		{view:"button", type:"iconButton", icon:"trash-o", label:"DELETE", autowidth:true, click:"deleteData()"},
	]
};

var sasaran_pd = {
	view:"datatable", id:"DATATABLE_SPD",
	select:true, css:"datatable_column", 
	columns:[
		{header:"#", 														id:"ID", 				hidden:true},
		
		{header:"No", 													id:"NO", 							width:35, 	css:{'text-align':'right'}},
		{header:"NO SASARAN PERANGKAT DAERAH", 	id:"NO SASARAN PD", 	width:200, 	css:{'text-align':'left'}, fillspace:true},
		{header:"SASARAN PERANGKAT DAERAH", 		id:"SASARAN_PD", 			width:200, 	css:{'text-align':'left'}, fillspace:true},
		
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
	rows:[nav_sasaran_pd, sasaran_pd],
};

webix.ready(function(){
	webix.ui(ui);
});


// ADD DATA
function addData(){
	showWindow("WIN_DATA_ADD");
}
webix.ready(function(){
	webix.ui({
		view:"window", id:"WIN_DATA_ADD",
		width:410, height:410,
		move:true, modal:true,
		position:"center",
		head:{
			view:"toolbar", margin:-5, cols:[
				{view:"label", label:"<span class='webix_icon fa-plus-circle'></span>Tambah Data"},
				{view:"icon", icon:"times-circle", click:"$$('WIN_DATA_ADD').hide();", tooltip:"Close"},
				{width: 10},
			]
		},
		body: webix.copy(FORM_DATA_ADD)
	});
});
var FORM_DATA_ADD = {
	view:"form",
	borderless:true,
	// scroll:"xy",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements: [
		{view:"text", 			label:"NO SASARAN DAERAH", 						id:"ADD_NO_SASARAN_DAERAH",	 	labelWidth: 150},
		{view:"text", 			label:"INDIKATOR DAERAH", 						id:"ADD_INDIKATOR_DAERAH1", 	labelWidth: 150},
		{
			margin: 5,
			cols:[
				{width:146},
				{view:"button", label:"Simpan", type:"form", align:"center", width:100, click:function(){
					dataAdd();
				}},
				{view:"button", label:"Cancel", align:"center", width:100, click:function(){
					$$("WIN_DATA_ADD").hide();
				}},
				{}
			]
		}
	]
};



// EDIT DATA
function editData(){
	showWindow("WIN_DATA_EDIT");
}
webix.ready(function(){
	webix.ui({
		view:"window", id:"WIN_DATA_EDIT",
		width:410, height:410,
		move:true, modal:true,
		position:"center",
		head:{
			view:"toolbar", margin:-5, cols:[
				{view:"label", label:"<span class='webix_icon fa-edit'></span>Edit Data"},
				{view:"icon", icon:"times-circle", click:"$$('WIN_DATA_EDIT').hide();", tooltip:"Close"},
				{width: 10},
			]
		},
		body: webix.copy(FORM_DATA_EDIT)
	});
});
var FORM_DATA_EDIT = {
	view:"form",
	borderless:true,
	// scroll:"xy",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements: [
		{view:"text", 			label:"NO SASARAN DAERAH", 						id:"EDIT_NO_SASARAN_DAERAH",	 	labelWidth: 150},
		{view:"text", 			label:"INDIKATOR DAERAH", 						id:"EDIT_INDIKATOR_DAERAH1", 		labelWidth: 150},
		{
			margin: 5,
			cols:[
				{width:146},
				{view:"button", label:"Simpan", type:"form", align:"center", width:100, click:function(){
					editAdd();
				}},
				{view:"button", label:"Cancel", align:"center", width:100, click:function(){
					$$("WIN_DATA_EDIT").hide();
				}},
				{}
			]
		}
	]
};


// DELETE DATA
function deleteData(){
	showWindow("WIN_DATA_DELETE");
}
webix.ready(function(){
	webix.ui({
		view:"window", id:"WIN_DATA_DELETE",
		width:410, height:410,
		move:true, modal:true,
		position:"center",
		head:{
			view:"toolbar", margin:-5, cols:[
				{view:"label", label:"<span class='webix_icon fa-trash-o'></span>Hapus Data"},
				{view:"icon", icon:"times-circle", click:"$$('WIN_DATA_DELETE').hide();", tooltip:"Close"},
				{width: 10},
			]
		},
		body: webix.copy(FORM_DATA_DELETE)
	});
});
var FORM_DATA_DELETE = {
	view:"form",
	borderless:true,
	// scroll:"xy",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements: [
		{view:"text", 			label:"NO SASARAN DAERAH", 						id:"DELETE_NO_SASARAN_DAERAH",	 	labelWidth: 150},
		{view:"text", 			label:"INDIKATOR DAERAH", 						id:"DELETE_INDIKATOR_DAERAH1", 		labelWidth: 150},
		{
			margin: 5,
			cols:[
				{width:146},
				{view:"button", label:"Simpan", type:"form", align:"center", width:100, click:function(){
					editAdd();
				}},
				{view:"button", label:"Cancel", align:"center", width:100, click:function(){
					$$("WIN_DATA_DELETE").hide();
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
</script>

</body>
</html>