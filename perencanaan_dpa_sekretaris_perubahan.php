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
var filter = {
	type:"clean",
	rows:[
		{
			view:"form",
			borderless:true,
			elementsConfig:{
				paddingY:0, paddingX:0
			},
			elements:[
				{
					rows:[
						{
							cols:[
								{width:570},
								{},
								// {view:"checkbox", label:"PAGU TAHUN 1", id:"PAGU TAHUN 1CB", labelWidth:140, width:170},
								// {view:"text", id:"PAGU TAHUN 1TXT", width:400}
							],
						},
						{
							cols:[
								{view:"checkbox", label:"URUSAN", id:"URUSAN_CB", labelWidth:140, width:170},
								{view:"text", id:"URUSAN_TXT", width:400}, {},
								// {view:"checkbox", label:"PAGU TAHUN 2", id:"PAGU TAHUN 2CB", labelWidth:140, width:170},
								// {view:"text", id:"PAGU TAHUN 2TXT", width:400}
							],
						},
						{
							cols:[
								{view:"checkbox", label:"OPD", id:"OPDCB", labelWidth:140, width:170},
								{view:"text", id:"OPDTXT", width:400}, {},
								// {view:"checkbox", label:"PAGU TAHUN 3", id:"PAGU TAHUN 3CB", labelWidth:140, width:170},
								// {view:"text", id:"PAGU TAHUN 3TXT", width:400}
							],
						},
						{
							cols:[
								{view:"checkbox", label:"PROGRAM", id:"PROGRAM_CB", labelWidth:140, width:170},
								{view:"text", id:"PROGRAM_TXT", width:400}, {},
								// {view:"checkbox", label:"PAGU TAHUN 4", id:"PAGU TAHUN 4CB", labelWidth:140, width:170},
								// {view:"text", id:"PAGU TAHUN 4TXT", width:400}
							],
						},
						{
							cols:[
								{view:"checkbox", label:"STATUS", id:"STATUSCB", labelWidth:140, width:170},
								{view:"text", id:"STATUSTXT", width:400}, {},
								// {view:"checkbox", label:"PAGU TAHUN 5", id:"PAGU TAHUN 5CB", labelWidth:140, width:170},
								// {view:"text", id:"PAGU TAHUN 5TXT", width:400}
							],
						},
					],
				},
			]
		}
	]
};

var nav_program = {
	//type:"clean",
	view:"toolbar",
	css:"highlighted_header header",
	paddingX:2,
	paddingY:2,
	height:35,
	cols:[
		{
			template:"<span class='webix_icon fa-table'></span>PROGRAM",
			css:"sub_title2", borderless:true
		}, 
		//{view:"button", type:"iconButton", icon:"plus-circle", label:"TAMBAH", autowidth:true, click:"addData1()"},
		{view:"button", type:"iconButton", icon:"edit", label:"TAMBAH CATATAN", autowidth:true, click:"editData1()"},
		//{view:"button", type:"iconButton", icon:"trash-o", label:"DELETE", autowidth:true, click:"deleteData1()"},
	]
};
var program = {
	view:"datatable", id:"DATATABLE_USER",
	select:true, css:"datatable_column", height:300,
	columns:[
		{header:"#", 													id:"ID", 				hidden:true},
		
		{header:"No", 												id:"NO", 									width:35, 	css:{'text-align':'right'}},
		{header:"OPD", 												id:"KODE", 								width:200, 	css:{'text-align':'left'}},
		{header:"BIDANG", 										id:"DESKRIPSI", 					width:200, 	css:{'text-align':'left'}},
		{header:"URUSAN", 										id:"PAGU1", 							width:200, 	css:{'text-align':'left'}},
		{header:"PROGRAM", 										id:"PAGU2", 							width:200, 	css:{'text-align':'left'}},
		{header:"INDIKATOR PERANGKAT DAERAH", id:"PAGU3", 							width:200, 	css:{'text-align':'left'}},
		{header:"JUMLAH", 											id:"PAGU4", 							width:200, 	css:{'text-align':'left'}},
		
		{header:"&nbsp;", 										id:"EDIT", 							width:37, 	template:"<span style='cursor:pointer;' class='webix_icon fa-edit'></span>", 	tooltip:"Edit"},
		{header:"&nbsp;", 										id:"DELETE", 						width:35, 	template:"<span style='cursor:pointer;' class='webix_icon fa-trash-o'></span>", 	tooltip:"Hapus"}
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
		"fa-edit":function(e,id){
			
		},
		"fa-trash-o":function(e,id){
			
		}
	},
	fixedRowHeight:false,
	scroll:true,
	animate:{type:"slide", subtype:"together"},
	tooltip:true,
	hover:"my_hover",
	datatype:"json",
};
var nav_indikator_program = {
	//type:"clean",
	view:"toolbar",
	css:"highlighted_header header",
	paddingX:2,
	paddingY:2,
	height:35,
	cols:[
		{
			template:"<span class='webix_icon fa-table'></span>INDIKATOR PROGRAM",
			css:"sub_title2", borderless:true
		}, 
		//{view:"button", type:"iconButton", icon:"plus-circle", label:"TAMBAH", autowidth:true, click:"addData11()"},
		{view:"button", type:"iconButton", icon:"edit", label:"TAMBAH CATATAN", autowidth:true, click:"editData11()"},
		//{view:"button", type:"iconButton", icon:"trash-o", label:"DELETE", autowidth:true, click:"deleteData11()"},
	]
};
var indikator_program = {
	view:"datatable", id:"DATATABLE_USER",
	select:true, css:"datatable_column", 
	columns:[
		{header:"#", 													id:"ID", 				hidden:true},
		
		{header:"No", 												id:"NO", 									width:35, 	css:{'text-align':'right'}},
		{header:"INDIKATOR PROGRAM", 					id:"KODE", 								width:200, 	css:{'text-align':'left'}},
		{header:"SATUAN INDIKATOR", 					id:"INDIKATOR DAERAH", 		width:200, 	css:{'text-align':'left'}},
		{header:"TARGET KINERJA", 						id:"TARGET KINERJA", 			width:200, 	css:{'text-align':'left'}},
		
		{header:"&nbsp;", 										id:"EDIT", 							width:37, 	template:"<span style='cursor:pointer;' class='webix_icon fa-edit'></span>", 	tooltip:"Edit"},
		{header:"&nbsp;", 										id:"DELETE", 						width:35, 	template:"<span style='cursor:pointer;' class='webix_icon fa-trash-o'></span>", 	tooltip:"Hapus"}
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
		"fa-edit":function(e,id){
			
		},
		"fa-trash-o":function(e,id){
			
		}
	},
	fixedRowHeight:false,
	scroll:true,
	animate:{type:"slide", subtype:"together"},
	tooltip:true,
	hover:"my_hover",
	datatype:"json",
};

var nav_kegiatan = {
	//type:"clean",
	view:"toolbar",
	css:"highlighted_header header",
	paddingX:2,
	paddingY:2,
	height:35,
	cols:[
		{
			template:"<span class='webix_icon fa-table'></span>KEGIATAN",
			css:"sub_title2", borderless:true
		}, 
		//{view:"button", type:"iconButton", icon:"plus-circle", label:"TAMBAH", autowidth:true, click:"addData2()"},
		{view:"button", type:"iconButton", icon:"edit", label:"TAMBAH CATATAN", autowidth:true, click:"editData2()"},
		//{view:"button", type:"iconButton", icon:"trash-o", label:"DELETE", autowidth:true, click:"deleteData2()"},
	]
};
var kegiatan = {
	view:"datatable", id:"DATATABLE_USER",
	select:true, css:"datatable_column", height:300,
	columns:[
		{header:"#", 													id:"ID", 				hidden:true},
		
		{header:"No", 												id:"NO", 									width:35, 	css:{'text-align':'right'}},
		{header:"OPD", 												id:"KODE", 								width:200, 	css:{'text-align':'left'}},
		{header:"BIDANG", 										id:"DESKRIPSI", 					width:200, 	css:{'text-align':'left'}},
		{header:"URUSAN", 										id:"PAGU1", 							width:200, 	css:{'text-align':'left'}},
		{header:"PROGRAM", 										id:"PAGU2", 							width:200, 	css:{'text-align':'left'}},
		{header:"KEGIATAN",										id:"PAGU3", 							width:200, 	css:{'text-align':'left'}},
		{header:"JUMLAH", 											id:"PAGU4", 							width:200, 	css:{'text-align':'left'}},
		
		{header:"&nbsp;", 										id:"EDIT", 							width:37, 	template:"<span style='cursor:pointer;' class='webix_icon fa-edit'></span>", 	tooltip:"Edit"},
		{header:"&nbsp;", 										id:"DELETE", 						width:35, 	template:"<span style='cursor:pointer;' class='webix_icon fa-trash-o'></span>", 	tooltip:"Hapus"}
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
		"fa-edit":function(e,id){
			
		},
		"fa-trash-o":function(e,id){
			
		}
	},
	fixedRowHeight:false,
	scroll:true,
	animate:{type:"slide", subtype:"together"},
	tooltip:true,
	hover:"my_hover",
	datatype:"json",
};
var nav_indikator_kegiatan = {
	//type:"clean",
	view:"toolbar",
	css:"highlighted_header header",
	paddingX:2,
	paddingY:2,
	height:35,
	cols:[
		{
			template:"<span class='webix_icon fa-table'></span>INDIKATOR KEGIATAN",
			css:"sub_title2", borderless:true
		}, 
		//{view:"button", type:"iconButton", icon:"plus-circle", label:"TAMBAH", autowidth:true, click:"addData21()"},
		{view:"button", type:"iconButton", icon:"edit", label:"TAMBAH CATATAN", autowidth:true, click:"editData21()"},
		//{view:"button", type:"iconButton", icon:"trash-o", label:"DELETE", autowidth:true, click:"deleteData21()"},
	]
};
var indikator_kegiatan = {
	view:"datatable", id:"DATATABLE_USER",
	select:true, css:"datatable_column", 
	columns:[
		{header:"#", 													id:"ID", 				hidden:true},
		
		{header:"No", 												id:"NO", 									width:35, 	css:{'text-align':'right'}},
		{header:"INDIKATOR KEGIATAN", 				id:"KODE", 								width:200, 	css:{'text-align':'left'}},
		{header:"SATUAN INDIKATOR", 					id:"INDIKATOR DAERAH", 		width:200, 	css:{'text-align':'left'}},
		{header:"TARGET KINERJA", 						id:"TARGET KINERJA", 			width:200, 	css:{'text-align':'left'}},
		
		{header:"&nbsp;", 										id:"EDIT", 							width:37, 	template:"<span style='cursor:pointer;' class='webix_icon fa-edit'></span>", 	tooltip:"Edit"},
		{header:"&nbsp;", 										id:"DELETE", 						width:35, 	template:"<span style='cursor:pointer;' class='webix_icon fa-trash-o'></span>", 	tooltip:"Hapus"}
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
		"fa-edit":function(e,id){
			
		},
		"fa-trash-o":function(e,id){
			
		}
	},
	fixedRowHeight:false,
	scroll:true,
	animate:{type:"slide", subtype:"together"},
	tooltip:true,
	hover:"my_hover",
	datatype:"json",
};

var nav_subkegiatan = {
	//type:"clean",
	view:"toolbar",
	css:"highlighted_header header",
	paddingX:2,
	paddingY:2,
	height:35,
	cols:[
		{
			template:"<span class='webix_icon fa-table'></span>SUB KEGIATAN",
			css:"sub_title2", borderless:true
		}, 
		//{view:"button", type:"iconButton", icon:"plus-circle", label:"TAMBAH", autowidth:true, click:"addData3()"},
		{view:"button", type:"iconButton", icon:"edit", label:"TAMBAH CATATAN", autowidth:true, click:"editData3()"},
		//{view:"button", type:"iconButton", icon:"trash-o", label:"DELETE", autowidth:true, click:"deleteData3()"},
	]
};
var subkegiatan = {
	view:"datatable", id:"DATATABLE_USER",
	select:true, css:"datatable_column", height:300,
	columns:[
		{header:"#", 													id:"ID", 				hidden:true},
		
		{header:"No", 												id:"NO", 									width:35, 	css:{'text-align':'right'}},
		{header:"OPD", 												id:"KODE", 								width:200, 	css:{'text-align':'left'}},
		{header:"BIDANG", 										id:"DESKRIPSI", 					width:200, 	css:{'text-align':'left'}},
		{header:"URUSAN", 										id:"PAGU1", 							width:200, 	css:{'text-align':'left'}},
		{header:"PROGRAM", 										id:"PAGU2", 							width:200, 	css:{'text-align':'left'}},
		{header:"KEGIATAN",										id:"PAGU3", 							width:200, 	css:{'text-align':'left'}},
		{header:"SUB KEGIATAN",								id:"PAGU3", 							width:200, 	css:{'text-align':'left'}},
		{header:"JUMLAH", 											id:"PAGU4", 							width:200, 	css:{'text-align':'left'}},
		
		{header:"&nbsp;", 										id:"EDIT", 							width:37, 	template:"<span style='cursor:pointer;' class='webix_icon fa-edit'></span>", 	tooltip:"Edit"},
		{header:"&nbsp;", 										id:"DELETE", 						width:35, 	template:"<span style='cursor:pointer;' class='webix_icon fa-trash-o'></span>", 	tooltip:"Hapus"}
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
		"fa-edit":function(e,id){
			
		},
		"fa-trash-o":function(e,id){
			
		}
	},
	fixedRowHeight:false,
	scroll:true,
	animate:{type:"slide", subtype:"together"},
	tooltip:true,
	hover:"my_hover",
	datatype:"json",
};
var nav_indikator_subkegiatan = {
	//type:"clean",
	view:"toolbar",
	css:"highlighted_header header",
	paddingX:2,
	paddingY:2,
	height:35,
	cols:[
		{
			template:"<span class='webix_icon fa-table'></span>INDIKATOR SUB KEGIATAN",
			css:"sub_title2", borderless:true
		}, 
		//{view:"button", type:"iconButton", icon:"plus-circle", label:"TAMBAH", autowidth:true, click:"addData31()"},
		{view:"button", type:"iconButton", icon:"edit", label:"TAMBAH CATATAN", autowidth:true, click:"editData31()"},
		//{view:"button", type:"iconButton", icon:"trash-o", label:"DELETE", autowidth:true, click:"deleteData31()"},
	]
};
var indikator_subkegiatan = {
	view:"datatable", id:"DATATABLE_USER",
	select:true, css:"datatable_column", 
	columns:[
		{header:"#", 													id:"ID", 				hidden:true},
		
		{header:"No", 												id:"NO", 									width:35, 	css:{'text-align':'right'}},
		{header:"INDIKATOR SUB KEGIATAN", 		id:"KODE", 								width:200, 	css:{'text-align':'left'}},
		{header:"SATUAN INDIKATOR", 					id:"INDIKATOR DAERAH", 		width:200, 	css:{'text-align':'left'}},
		{header:"TARGET KINERJA", 						id:"TARGET KINERJA", 			width:200, 	css:{'text-align':'left'}},
		
		{header:"&nbsp;", 										id:"EDIT", 							width:37, 	template:"<span style='cursor:pointer;' class='webix_icon fa-edit'></span>", 	tooltip:"Edit"},
		{header:"&nbsp;", 										id:"DELETE", 						width:35, 	template:"<span style='cursor:pointer;' class='webix_icon fa-trash-o'></span>", 	tooltip:"Hapus"}
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
		"fa-edit":function(e,id){
			
		},
		"fa-trash-o":function(e,id){
			
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
	view:"scrollview",
	scroll:"native-y",
	body:{
		//type:"space",
		rows:[
			{type:"space", cols:[filter]}, 
			{type:"space", cols:[
				{rows:[nav_program, program]}, 
				{rows:[nav_indikator_program, indikator_program]}, 
			]},
			{type:"space", cols:[
				{rows:[nav_kegiatan, kegiatan]}, 
				{rows:[nav_indikator_kegiatan, indikator_kegiatan]}, 
			]},
			{type:"space", cols:[
				{rows:[nav_subkegiatan, subkegiatan]}, 
				{rows:[nav_indikator_subkegiatan, indikator_subkegiatan]}, 
			]},
			{height:30},
			// {cols:[
				// {width:20},
				// {view:"checkbox", label:"", id:"CATATAN REJECT", labelWidth:110, width:22},
				// {view:"label", label:"TAMPILKAN DATA YANG ADA CATATAN REJECT"},
				// {}
			// ]}, 
			{cols:[
				{},
				{view:"button", 	label:"APPROVE", type:"form", align:"center", width:150, height:40},
				{width:20},
				{view:"button", 	label:"REJECT", type:"", align:"center", width:150, height:40},
				// {width:20},
				// {view:"button", 	label:"CANCEL REQUEST", type:"", align:"center", width:150, height:40},
				{}
			]}, 
			{height:50},
		],
	}
};

webix.ready(function(){
	webix.ui(ui);
	
	webix.ui({
		view:"window", id:"WIN_DATA1_ADD",
		width:500, //height:410,
		move:true, modal:true,
		position:"center",
		head:{
			view:"toolbar", margin:-5, cols:[
				{view:"label", label:"<span class='webix_icon fa-plus-circle'></span>TAMBAH"},
				{view:"icon", icon:"times-circle", click:"$$('WIN_DATA1_ADD').hide();", tooltip:"Close"},
				{width:10},
			]
		},
		body:webix.copy(FORM_DATA1_ADD)
	});
	
	webix.ui({
		view:"window", id:"WIN_DATA11_ADD",
		width:500, //height:410,
		move:true, modal:true,
		position:"center",
		head:{
			view:"toolbar", margin:-5, cols:[
				{view:"label", label:"<span class='webix_icon fa-plus-circle'></span>TAMBAH"},
				{view:"icon", icon:"times-circle", click:"$$('WIN_DATA11_ADD').hide();", tooltip:"Close"},
				{width:10},
			]
		},
		body:webix.copy(FORM_DATA11_ADD)
	});
	
	webix.ui({
		view:"window", id:"WIN_DATA2_ADD",
		width:500, //height:410,
		move:true, modal:true,
		position:"center",
		head:{
			view:"toolbar", margin:-5, cols:[
				{view:"label", label:"<span class='webix_icon fa-plus-circle'></span>TAMBAH"},
				{view:"icon", icon:"times-circle", click:"$$('WIN_DATA2_ADD').hide();", tooltip:"Close"},
				{width:10},
			]
		},
		body:webix.copy(FORM_DATA2_ADD)
	});
	
	webix.ui({
		view:"window", id:"WIN_DATA21_ADD",
		width:500, //height:410,
		move:true, modal:true,
		position:"center",
		head:{
			view:"toolbar", margin:-5, cols:[
				{view:"label", label:"<span class='webix_icon fa-plus-circle'></span>TAMBAH"},
				{view:"icon", icon:"times-circle", click:"$$('WIN_DATA21_ADD').hide();", tooltip:"Close"},
				{width:10},
			]
		},
		body:webix.copy(FORM_DATA21_ADD)
	});
		
	webix.ui({
		view:"window", id:"WIN_DATA3_ADD",
		width:500, //height:410,
		move:true, modal:true,
		position:"center",
		head:{
			view:"toolbar", margin:-5, cols:[
				{view:"label", label:"<span class='webix_icon fa-plus-circle'></span>TAMBAH"},
				{view:"icon", icon:"times-circle", click:"$$('WIN_DATA3_ADD').hide();", tooltip:"Close"},
				{width:10},
			]
		},
		body:webix.copy(FORM_DATA3_ADD)
	});
	
	webix.ui({
		view:"window", id:"WIN_DATA31_ADD",
		width:500, //height:410,
		move:true, modal:true,
		position:"center",
		head:{
			view:"toolbar", margin:-5, cols:[
				{view:"label", label:"<span class='webix_icon fa-plus-circle'></span>TAMBAH"},
				{view:"icon", icon:"times-circle", click:"$$('WIN_DATA31_ADD').hide();", tooltip:"Close"},
				{width:10},
			]
		},
		body:webix.copy(FORM_DATA31_ADD)
	});
	
	
	webix.ui({
		view:"window", id:"WIN_DATA1_EDIT",
		width:500, //height:410,
		move:true, modal:true,
		position:"center",
		head:{
			view:"toolbar", margin:-5, cols:[
				{view:"label", label:"<span class='webix_icon fa-edit'></span>EDIT"},
				{view:"icon", icon:"times-circle", click:"$$('WIN_DATA1_EDIT').hide();", tooltip:"Close"},
				{width:10},
			]
		},
		body:webix.copy(FORM_DATA1_EDIT),
	});
	
	webix.ui({
		view:"window", id:"WIN_DATA11_EDIT",
		width:500, //height:410,
		move:true, modal:true,
		position:"center",
		head:{
			view:"toolbar", margin:-5, cols:[
				{view:"label", label:"<span class='webix_icon fa-edit'></span>EDIT"},
				{view:"icon", icon:"times-circle", click:"$$('WIN_DATA11_EDIT').hide();", tooltip:"Close"},
				{width:10},
			]
		},
		body:webix.copy(FORM_DATA11_EDIT),
	});
	
	webix.ui({
		view:"window", id:"WIN_DATA2_EDIT",
		width:500, //height:410,
		move:true, modal:true,
		position:"center",
		head:{
			view:"toolbar", margin:-5, cols:[
				{view:"label", label:"<span class='webix_icon fa-edit'></span>EDIT"},
				{view:"icon", icon:"times-circle", click:"$$('WIN_DATA2_EDIT').hide();", tooltip:"Close"},
				{width:10},
			]
		},
		body:webix.copy(FORM_DATA2_EDIT),
	});
	
	webix.ui({
		view:"window", id:"WIN_DATA21_EDIT",
		width:500, //height:410,
		move:true, modal:true,
		position:"center",
		head:{
			view:"toolbar", margin:-5, cols:[
				{view:"label", label:"<span class='webix_icon fa-edit'></span>EDIT"},
				{view:"icon", icon:"times-circle", click:"$$('WIN_DATA21_EDIT').hide();", tooltip:"Close"},
				{width:10},
			]
		},
		body:webix.copy(FORM_DATA21_EDIT),
	});
	
	webix.ui({
		view:"window", id:"WIN_DATA3_EDIT",
		width:500, //height:410,
		move:true, modal:true,
		position:"center",
		head:{
			view:"toolbar", margin:-5, cols:[
				{view:"label", label:"<span class='webix_icon fa-edit'></span>EDIT"},
				{view:"icon", icon:"times-circle", click:"$$('WIN_DATA3_EDIT').hide();", tooltip:"Close"},
				{width:10},
			]
		},
		body:webix.copy(FORM_DATA3_EDIT),
	});
	
	webix.ui({
		view:"window", id:"WIN_DATA31_EDIT",
		width:500, //height:410,
		move:true, modal:true,
		position:"center",
		head:{
			view:"toolbar", margin:-5, cols:[
				{view:"label", label:"<span class='webix_icon fa-edit'></span>EDIT"},
				{view:"icon", icon:"times-circle", click:"$$('WIN_DATA31_EDIT').hide();", tooltip:"Close"},
				{width:10},
			]
		},
		body:webix.copy(FORM_DATA31_EDIT),
	});
	
	
		webix.ui({
		view:"window", id:"WIN_DATA1_DELETE",
		width:500, //height:410,
		move:true, modal:true,
		position:"center",
		head:{
			view:"toolbar", margin:-5, cols:[
				{view:"label", label:"<span class='webix_icon fa-trash-o'></span>DELETE"},
				{view:"icon", icon:"times-circle", click:"$$('WIN_DATA1_DELETE').hide();", tooltip:"Close"},
				{width:10},
			]
		},
		body:webix.copy(FORM_DATA1_DELETE)
	});
	
	webix.ui({
		view:"window", id:"WIN_DATA11_DELETE",
		width:500, //height:410,
		move:true, modal:true,
		position:"center",
		head:{
			view:"toolbar", margin:-5, cols:[
				{view:"label", label:"<span class='webix_icon fa-trash-o'></span>DELETE"},
				{view:"icon", icon:"times-circle", click:"$$('WIN_DATA11_DELETE').hide();", tooltip:"Close"},
				{width:10},
			]
		},
		body:webix.copy(FORM_DATA11_DELETE)
	});
	
	webix.ui({
		view:"window", id:"WIN_DATA2_DELETE",
		width:500, //height:410,
		move:true, modal:true,
		position:"center",
		head:{
			view:"toolbar", margin:-5, cols:[
				{view:"label", label:"<span class='webix_icon fa-trash-o'></span>DELETE"},
				{view:"icon", icon:"times-circle", click:"$$('WIN_DATA2_DELETE').hide();", tooltip:"Close"},
				{width:10},
			]
		},
		body:webix.copy(FORM_DATA2_DELETE)
	});
	
	webix.ui({
		view:"window", id:"WIN_DATA21_DELETE",
		width:500, //height:410,
		move:true, modal:true,
		position:"center",
		head:{
			view:"toolbar", margin:-5, cols:[
				{view:"label", label:"<span class='webix_icon fa-trash-o'></span>DELETE"},
				{view:"icon", icon:"times-circle", click:"$$('WIN_DATA21_DELETE').hide();", tooltip:"Close"},
				{width:10},
			]
		},
		body:webix.copy(FORM_DATA21_DELETE)
	});
		
	webix.ui({
		view:"window", id:"WIN_DATA3_DELETE",
		width:500, //height:410,
		move:true, modal:true,
		position:"center",
		head:{
			view:"toolbar", margin:-5, cols:[
				{view:"label", label:"<span class='webix_icon fa-trash-o'></span>DELETE"},
				{view:"icon", icon:"times-circle", click:"$$('WIN_DATA3_DELETE').hide();", tooltip:"Close"},
				{width:10},
			]
		},
		body:webix.copy(FORM_DATA3_DELETE)
	});
	
	webix.ui({
		view:"window", id:"WIN_DATA31_DELETE",
		width:500, //height:410,
		move:true, modal:true,
		position:"center",
		head:{
			view:"toolbar", margin:-5, cols:[
				{view:"label", label:"<span class='webix_icon fa-trash-o'></span>DELETE"},
				{view:"icon", icon:"times-circle", click:"$$('WIN_DATA31_DELETE').hide();", tooltip:"Close"},
				{width:10},
			]
		},
		body:webix.copy(FORM_DATA31_DELETE)
	});
	
});


var FORM_DATA1_ADD = {
	view:"form",
	borderless:true,
	// scroll:"xy",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements:[
		
		{view:"text", 			label:"OPD", 											id:"1OPD", 							labelWidth:180},
		{view:"text", 			label:"BIDANG",										id:"1BIDANG", 						labelWidth:180},
		{view:"text", 			label:"URUSAN", 									id:"1URUSAN", 						labelWidth:180},
		{view:"richselect", label:"PROGRAM", 									id:"1PROGRAM", 					labelWidth:180, options:[{id:"Admin", value:""},{id:"", value:""},]},
		{view:"richselect", label:"INDIKATOR PD", 						id:"1INDIKATOR PD", 			labelWidth:180, options:[{id:"Admin", value:""},{id:"", value:""},]},
		{view:"text", 			label:"TOTAL PAGU AKHIR PERIODE",	id:"1TOTAL PAGU", 				labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-1",					id:"1PAGU-1", 						labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-2",					id:"1PAGU-2", 						labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-3",					id:"1PAGU-3", 						labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-4",					id:"1PAGU-4", 						labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-5",					id:"1PAGU-5", 						labelWidth:180},
		{
			margin:5,
			cols:[
				{width:126},
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

var FORM_DATA11_ADD = {
	view:"form",
	borderless:true,
	// scroll:"xy",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements:[
		
		{view:"text", 			label:"INDIKATOR PROGRAM", 					id:"11INDIKATOR PROGRAM",			labelWidth:180},
		{view:"text", 			label:"SATUAN INDIKATOR",						id:"11SATUAN INDIKATOR", 			labelWidth:180},
		{view:"text", 			label:"KINERJA AWAL", 							id:"11KINERJA AWAL", 					labelWidth:180},
		{view:"text", 			label:"TARGET KINERJA AKHIR",				id:"11TARGET KINERJA AKHIR",	labelWidth:180},
		{view:"text", 			label:"TARGET KINERJA TAHUN KE-1",	id:"11TARGET KINERJA-1", 			labelWidth:180},
		{view:"text", 			label:"TARGET KINERJA TAHUN KE-2",	id:"11TARGET KINERJA-2", 			labelWidth:180},
		{view:"text", 			label:"TARGET KINERJA TAHUN KE-3",	id:"11TARGET KINERJA-3", 			labelWidth:180},
		{view:"text", 			label:"TARGET KINERJA TAHUN KE-4",	id:"11TARGET KINERJA-4", 			labelWidth:180},
		{view:"text", 			label:"TARGET KINERJA TAHUN KE-5",	id:"11TARGET KINERJA-5", 			labelWidth:180},
		{
			margin:5,
			cols:[
				{width:126},
				{view:"button", label:"Simpan", type:"form", align:"center", width:100, click:function(){
					dataAdd();
				}},
				{view:"button", label:"Cancel", align:"center", width:100, click:function(){
					$$("WIN_DATA11_ADD").hide();
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
	elements:[
		
		{view:"text", 			label:"OPD", 											id:"2OPD", 							labelWidth:180},
		{view:"text", 			label:"BIDANG",										id:"2BIDANG", 						labelWidth:180},
		{view:"text", 			label:"URUSAN", 									id:"2URUSAN", 						labelWidth:180},
		{view:"richselect", label:"PROGRAM", 									id:"2PROGRAM", 					labelWidth:180, options:[{id:"Admin", value:""},{id:"", value:""},]},
		{view:"richselect", label:"KEGIATAN", 								id:"2KEGIATAN", 					labelWidth:180, options:[{id:"Admin", value:""},{id:"", value:""},]},
		{view:"text", 			label:"TOTAL PAGU AKHIR PERIODE",	id:"2TOTAL PAGU", 				labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-1",					id:"2PAGU-1", 						labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-2",					id:"2PAGU-2", 						labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-3",					id:"2PAGU-3", 						labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-4",					id:"2PAGU-4", 						labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-5",					id:"2PAGU-5", 						labelWidth:180},
		{
			margin:5,
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

var FORM_DATA21_ADD = {
	view:"form",
	borderless:true,
	// scroll:"xy",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements:[
		
		{view:"text", 			label:"INDIKATOR PROGRAM", 					id:"21INDIKATOR PROGRAM",			labelWidth:180},
		{view:"text", 			label:"SATUAN INDIKATOR",						id:"21SATUAN INDIKATOR", 			labelWidth:180},
		{view:"text", 			label:"KINERJA AWAL", 							id:"21KINERJA AWAL", 					labelWidth:180},
		{view:"text", 			label:"TARGET KINERJA AKHIR",				id:"21TARGET KINERJA AKHIR",	labelWidth:180},
		{view:"text", 			label:"TARGET KINERJA TAHUN KE-1",	id:"21TARGET KINERJA-1", 			labelWidth:180},
		{view:"text", 			label:"TARGET KINERJA TAHUN KE-2",	id:"21TARGET KINERJA-2", 			labelWidth:180},
		{view:"text", 			label:"TARGET KINERJA TAHUN KE-3",	id:"21TARGET KINERJA-3", 			labelWidth:180},
		{view:"text", 			label:"TARGET KINERJA TAHUN KE-4",	id:"21TARGET KINERJA-4", 			labelWidth:180},
		{view:"text", 			label:"TARGET KINERJA TAHUN KE-5",	id:"21TARGET KINERJA-5", 			labelWidth:180},
		{
			margin:5,
			cols:[
				{width:126},
				{view:"button", label:"Simpan", type:"form", align:"center", width:100, click:function(){
					dataAdd();
				}},
				{view:"button", label:"Cancel", align:"center", width:100, click:function(){
					$$("WIN_DATA21_ADD").hide();
				}},
				{}
			]
		}
	]
};

var FORM_DATA3_ADD = {
	view:"form",
	borderless:true,
	// scroll:"xy",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements:[
		
		{view:"text", 			label:"OPD", 											id:"3OPD", 							labelWidth:180},
		{view:"text", 			label:"BIDANG",										id:"3BIDANG", 						labelWidth:180},
		{view:"text", 			label:"URUSAN", 									id:"3URUSAN", 						labelWidth:180},
		{view:"richselect", label:"PROGRAM", 									id:"3PROGRAM", 					labelWidth:180, options:[{id:"Admin", value:""},{id:"", value:""},]},
		{view:"richselect", label:"KEGIATAN", 								id:"3KEGIATAN", 					labelWidth:180, options:[{id:"Admin", value:""},{id:"", value:""},]},
		{view:"richselect", label:"SUB KEGIATAN", 						id:"3SUB KEGIATAN", 			labelWidth:180, options:[{id:"Admin", value:""},{id:"", value:""},]},
		{view:"text", 			label:"TOTAL PAGU AKHIR PERIODE",	id:"3TOTAL PAGU", 				labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-1",					id:"3PAGU-1", 						labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-2",					id:"3PAGU-2", 						labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-3",					id:"3PAGU-3", 						labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-4",					id:"3PAGU-4", 						labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-5",					id:"3PAGU-5", 						labelWidth:180},
		{
			margin:5,
			cols:[
				{width:126},
				{view:"button", label:"Simpan", type:"form", align:"center", width:100, click:function(){
					dataAdd();
				}},
				{view:"button", label:"Cancel", align:"center", width:100, click:function(){
					$$("WIN_DATA3_ADD").hide();
				}},
				{}
			]
		}
	]
};

var FORM_DATA31_ADD = {
	view:"form",
	borderless:true,
	// scroll:"xy",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements:[
		
		{view:"text", 			label:"INDIKATOR PROGRAM", 					id:"31INDIKATOR PROGRAM",			labelWidth:180},
		{view:"text", 			label:"SATUAN INDIKATOR",						id:"31SATUAN INDIKATOR", 			labelWidth:180},
		{view:"text", 			label:"KINERJA AWAL", 							id:"31KINERJA AWAL", 					labelWidth:180},
		{view:"text", 			label:"TARGET KINERJA AKHIR",				id:"31TARGET KINERJA AKHIR",	labelWidth:180},
		{view:"text", 			label:"TARGET KINERJA TAHUN KE-1",	id:"31TARGET KINERJA-1", 			labelWidth:180},
		{view:"text", 			label:"TARGET KINERJA TAHUN KE-2",	id:"31TARGET KINERJA-2", 			labelWidth:180},
		{view:"text", 			label:"TARGET KINERJA TAHUN KE-3",	id:"31TARGET KINERJA-3", 			labelWidth:180},
		{view:"text", 			label:"TARGET KINERJA TAHUN KE-4",	id:"31TARGET KINERJA-4", 			labelWidth:180},
		{view:"text", 			label:"TARGET KINERJA TAHUN KE-5",	id:"31TARGET KINERJA-5", 			labelWidth:180},
		{
			margin:5,
			cols:[
				{width:126},
				{view:"button", label:"Simpan", type:"form", align:"center", width:100, click:function(){
					dataAdd();
				}},
				{view:"button", label:"Cancel", align:"center", width:100, click:function(){
					$$("WIN_DATA31_ADD").hide();
				}},
				{}
			]
		}
	]
};



var FORM_DATA1_EDIT = {
	view:"form",
	borderless:true,
	// scroll:"xy",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements:[
		{view:"text", 			label:"OPD", 											id:"1E-OPD", 								labelWidth:180},
		{view:"text", 			label:"BIDANG",										id:"1E-BIDANG", 						labelWidth:180},
		{view:"text", 			label:"URUSAN", 									id:"1E-URUSAN", 						labelWidth:180},
		{view:"richselect", label:"PROGRAM", 									id:"1E-PROGRAM", 						labelWidth:180, options:[{id:"Admin", value:""},{id:"", value:""},]},
		{view:"richselect", label:"INDIKATOR PD", 						id:"1E-INDIKATOR PD", 			labelWidth:180, options:[{id:"Admin", value:""},{id:"", value:""},]},
		{view:"text", 			label:"JUMLAH",											id:"1E-TOTAL PAGU", 				labelWidth:180},
		// {view:"text", 			label:"TOTAL PAGU AKHIR PERIODE",	id:"1E-TOTAL PAGU", 				labelWidth:180},
		// {view:"text", 			label:"PAGU TAHUN KE-1",					id:"1E-PAGU-1", 						labelWidth:180},
		// {view:"text", 			label:"PAGU TAHUN KE-2",					id:"1E-PAGU-2", 						labelWidth:180},
		// {view:"text", 			label:"PAGU TAHUN KE-3",					id:"1E-PAGU-3", 						labelWidth:180},
		// {view:"text", 			label:"PAGU TAHUN KE-4",					id:"1E-PAGU-4", 						labelWidth:180},
		// {view:"text", 			label:"PAGU TAHUN KE-5",					id:"1E-PAGU-5", 						labelWidth:180},
		{view:"text", 			label:"CATATAN REJECT",						id:"1E-CATATAN REJECT", 		labelWidth:180},
		{
			margin:5,
			cols:[
				{width:116},
				{view:"button", label:"Simpan", type:"form", align:"center", width:100, click:function(){
					dataEdit();
				}},
				{view:"button", label:"Cancel", align:"center", width:100, click:function(){
					$$("WIN_DATA1_EDIT").hide();
				}},
				{}
			]
		}
	]
};

var FORM_DATA11_EDIT = {
	view:"form",
	borderless:true,
	// scroll:"xy",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements:[
		{view:"text", 			label:"INDIKATOR PROGRAM", 					id:"11E-INDIKATOR PROGRAM",			labelWidth:180},
		{view:"text", 			label:"SATUAN INDIKATOR",						id:"11E-SATUAN INDIKATOR", 			labelWidth:180},
		{view:"text", 			label:"TARGET KINERJA", 						id:"11E-KINERJA AWAL", 					labelWidth:180},
		// {view:"text", 			label:"KINERJA AWAL", 							id:"11E-KINERJA AWAL", 					labelWidth:180},
		// {view:"text", 			label:"TARGET KINERJA AKHIR",				id:"11E-TARGET KINERJA AKHIR",	labelWidth:180},
		// {view:"text", 			label:"TARGET KINERJA TAHUN KE-1",	id:"11E-TARGET KINERJA-1", 			labelWidth:180},
		// {view:"text", 			label:"TARGET KINERJA TAHUN KE-2",	id:"11E-TARGET KINERJA-2", 			labelWidth:180},
		// {view:"text", 			label:"TARGET KINERJA TAHUN KE-3",	id:"11E-TARGET KINERJA-3", 			labelWidth:180},
		// {view:"text", 			label:"TARGET KINERJA TAHUN KE-4",	id:"11E-TARGET KINERJA-4", 			labelWidth:180},
		// {view:"text", 			label:"TARGET KINERJA TAHUN KE-5",	id:"11E-TARGET KINERJA-5", 			labelWidth:180},
		{view:"text", 			label:"CATATAN REJECT",							id:"11E-CATATAN REJECT", 				labelWidth:180},
		{
			margin:5,
			cols:[
				{width:116},
				{view:"button", label:"Simpan", type:"form", align:"center", width:100, click:function(){
					dataEdit();
				}},
				{view:"button", label:"Cancel", align:"center", width:100, click:function(){
					$$("WIN_DATA11_EDIT").hide();
				}},
				{}
			]
		}
	]
};

var FORM_DATA2_EDIT = {
	view:"form",
	borderless:true,
	// scroll:"xy",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements:[
		{view:"text", 			label:"OPD", 											id:"2E-OPD", 							labelWidth:180},
		{view:"text", 			label:"BIDANG",										id:"2E-BIDANG", 						labelWidth:180},
		{view:"text", 			label:"URUSAN", 									id:"2E-URUSAN", 						labelWidth:180},
		{view:"richselect", label:"PROGRAM", 									id:"2E-PROGRAM", 					labelWidth:180, options:[{id:"Admin", value:""},{id:"", value:""},]},
		{view:"richselect", label:"KEGIATAN", 								id:"2E-KEGIATAN", 					labelWidth:180, options:[{id:"Admin", value:""},{id:"", value:""},]},
		{view:"text", 			label:"JUMLAH",											id:"2E-TOTAL PAGU", 				labelWidth:180},
		// {view:"text", 			label:"TOTAL PAGU AKHIR PERIODE",	id:"2E-TOTAL PAGU", 				labelWidth:180},
		// {view:"text", 			label:"PAGU TAHUN KE-1",					id:"2E-PAGU-1", 						labelWidth:180},
		// {view:"text", 			label:"PAGU TAHUN KE-2",					id:"2E-PAGU-2", 						labelWidth:180},
		// {view:"text", 			label:"PAGU TAHUN KE-3",					id:"2E-PAGU-3", 						labelWidth:180},
		// {view:"text", 			label:"PAGU TAHUN KE-4",					id:"2E-PAGU-4", 						labelWidth:180},
		// {view:"text", 			label:"PAGU TAHUN KE-5",					id:"2E-PAGU-5", 						labelWidth:180},
		{view:"text", 			label:"CATATAN REJECT",						id:"2E-CATATAN REJECT", 		labelWidth:180},
		{
			margin:5,
			cols:[
				{width:116},
				{view:"button", label:"Simpan", type:"form", align:"center", width:100, click:function(){
					dataEdit();
				}},
				{view:"button", label:"Cancel", align:"center", width:100, click:function(){
					$$("WIN_DATA2_EDIT").hide();
				}},
				{}
			]
		}
	]
};

var FORM_DATA21_EDIT = {
	view:"form",
	borderless:true,
	// scroll:"xy",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements:[
		{view:"text", 			label:"INDIKATOR PROGRAM", 					id:"21E-INDIKATOR PROGRAM",			labelWidth:180},
		{view:"text", 			label:"SATUAN INDIKATOR",						id:"21E-SATUAN INDIKATOR", 			labelWidth:180},
		{view:"text", 			label:"TARGET KINERJA", 						id:"21E-KINERJA AWAL", 					labelWidth:180},
		// {view:"text", 			label:"KINERJA AWAL", 							id:"21E-KINERJA AWAL", 					labelWidth:180},
		// {view:"text", 			label:"TARGET KINERJA AKHIR",				id:"21E-TARGET KINERJA AKHIR",	labelWidth:180},
		// {view:"text", 			label:"TARGET KINERJA TAHUN KE-1",	id:"21E-TARGET KINERJA-1", 			labelWidth:180},
		// {view:"text", 			label:"TARGET KINERJA TAHUN KE-2",	id:"21E-TARGET KINERJA-2", 			labelWidth:180},
		// {view:"text", 			label:"TARGET KINERJA TAHUN KE-3",	id:"21E-TARGET KINERJA-3", 			labelWidth:180},
		// {view:"text", 			label:"TARGET KINERJA TAHUN KE-4",	id:"21E-TARGET KINERJA-4", 			labelWidth:180},
		// {view:"text", 			label:"TARGET KINERJA TAHUN KE-5",	id:"21E-TARGET KINERJA-5", 			labelWidth:180},
		{view:"text", 			label:"CATATAN REJECT",							id:"21E-CATATAN REJECT", 				labelWidth:180},
		{
			margin:5,
			cols:[
				{width:116},
				{view:"button", label:"Simpan", type:"form", align:"center", width:100, click:function(){
					dataEdit();
				}},
				{view:"button", label:"Cancel", align:"center", width:100, click:function(){
					$$("WIN_DATA21_EDIT").hide();
				}},
				{}
			]
		}
	]
};

var FORM_DATA3_EDIT = {
	view:"form",
	borderless:true,
	// scroll:"xy",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements:[
		{view:"text", 			label:"OPD", 											id:"3E-OPD", 							labelWidth:180},
		{view:"text", 			label:"BIDANG",										id:"3E-BIDANG", 						labelWidth:180},
		{view:"text", 			label:"URUSAN", 									id:"3E-URUSAN", 						labelWidth:180},
		{view:"richselect", label:"PROGRAM", 									id:"3E-PROGRAM", 					labelWidth:180, options:[{id:"Admin", value:""},{id:"", value:""},]},
		{view:"richselect", label:"KEGIATAN", 								id:"3E-KEGIATAN", 					labelWidth:180, options:[{id:"Admin", value:""},{id:"", value:""},]},
		{view:"richselect", label:"SUB KEGIATAN", 						id:"3E-SUB KEGIATAN", 			labelWidth:180, options:[{id:"Admin", value:""},{id:"", value:""},]},
		{view:"text", 			label:"JUMLAH",											id:"3E-TOTAL PAGU", 				labelWidth:180},
		// {view:"text", 			label:"TOTAL PAGU AKHIR PERIODE",	id:"3E-TOTAL PAGU", 				labelWidth:180},
		// {view:"text", 			label:"PAGU TAHUN KE-1",					id:"3E-PAGU-1", 						labelWidth:180},
		// {view:"text", 			label:"PAGU TAHUN KE-2",					id:"3E-PAGU-2", 						labelWidth:180},
		// {view:"text", 			label:"PAGU TAHUN KE-3",					id:"3E-PAGU-3", 						labelWidth:180},
		// {view:"text", 			label:"PAGU TAHUN KE-4",					id:"3E-PAGU-4", 						labelWidth:180},
		// {view:"text", 			label:"PAGU TAHUN KE-5",					id:"3E-PAGU-5", 						labelWidth:180},
		{view:"text", 			label:"CATATAN REJECT",						id:"3E-CATATAN REJECT", 		labelWidth:180},
		{
			margin:5,
			cols:[
				{width:116},
				{view:"button", label:"Simpan", type:"form", align:"center", width:100, click:function(){
					dataEdit();
				}},
				{view:"button", label:"Cancel", align:"center", width:100, click:function(){
					$$("WIN_DATA3_EDIT").hide();
				}},
				{}
			]
		}
	]
};

var FORM_DATA31_EDIT = {
	view:"form",
	borderless:true,
	// scroll:"xy",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements:[
		{view:"text", 			label:"INDIKATOR PROGRAM", 					id:"31E-INDIKATOR PROGRAM",			labelWidth:180},
		{view:"text", 			label:"SATUAN INDIKATOR",						id:"31E-SATUAN INDIKATOR", 			labelWidth:180},
		{view:"text", 			label:"TARGET KINERJA", 						id:"31E-KINERJA AWAL", 					labelWidth:180},
		// {view:"text", 			label:"KINERJA AWAL", 							id:"31E-KINERJA AWAL", 					labelWidth:180},
		// {view:"text", 			label:"TARGET KINERJA AKHIR",				id:"31E-TARGET KINERJA AKHIR",	labelWidth:180},
		// {view:"text", 			label:"TARGET KINERJA TAHUN KE-1",	id:"31E-TARGET KINERJA-1", 			labelWidth:180},
		// {view:"text", 			label:"TARGET KINERJA TAHUN KE-2",	id:"31E-TARGET KINERJA-2", 			labelWidth:180},
		// {view:"text", 			label:"TARGET KINERJA TAHUN KE-3",	id:"31E-TARGET KINERJA-3", 			labelWidth:180},
		// {view:"text", 			label:"TARGET KINERJA TAHUN KE-4",	id:"31E-TARGET KINERJA-4", 			labelWidth:180},
		// {view:"text", 			label:"TARGET KINERJA TAHUN KE-5",	id:"31E-TARGET KINERJA-5", 			labelWidth:180},
		{view:"text", 			label:"CATATAN REJECT",							id:"31E-CATATAN REJECT", 				labelWidth:180},
		{
			margin:5,
			cols:[
				{width:116},
				{view:"button", label:"Simpan", type:"form", align:"center", width:100, click:function(){
					dataEdit();
				}},
				{view:"button", label:"Cancel", align:"center", width:100, click:function(){
					$$("WIN_DATA31_EDIT").hide();
				}},
				{}
			]
		}
	]
};


var FORM_DATA1_DELETE = {
	view:"form",
	borderless:true,
	// scroll:"xy",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements:[
		
		{view:"text", 			label:"OPD", 											id:"1D-OPD", 							labelWidth:180},
		{view:"text", 			label:"BIDANG",										id:"1D-BIDANG", 						labelWidth:180},
		{view:"text", 			label:"URUSAN", 									id:"1D-URUSAN", 						labelWidth:180},
		{view:"richselect", label:"PROGRAM", 									id:"1D-PROGRAM", 					labelWidth:180, options:[{id:"Admin", value:""},{id:"", value:""},]},
		{view:"richselect", label:"INDIKATOR PD", 						id:"1D-INDIKATOR PD", 			labelWidth:180, options:[{id:"Admin", value:""},{id:"", value:""},]},
		{view:"text", 			label:"TOTAL PAGU AKHIR PERIODE",	id:"1D-TOTAL PAGU", 				labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-1",					id:"1D-PAGU-1", 						labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-2",					id:"1D-PAGU-2", 						labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-3",					id:"1D-PAGU-3", 						labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-4",					id:"1D-PAGU-4", 						labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-5",					id:"1D-PAGU-5", 						labelWidth:180},
		{
			margin:5,
			cols:[
				{width:126},
				{view:"button", label:"Delete", type:"form", align:"center", width:100, click:function(){
					dataAdd();
				}},
				{view:"button", label:"Cancel", align:"center", width:100, click:function(){
					$$("WIN_DATA1_DELETE").hide();
				}},
				{}
			]
		}
	]
};

var FORM_DATA11_DELETE = {
	view:"form",
	borderless:true,
	// scroll:"xy",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements:[
		
		{view:"text", 			label:"INDIKATOR PROGRAM", 					id:"11D-INDIKATOR PROGRAM",			labelWidth:180},
		{view:"text", 			label:"SATUAN INDIKATOR",						id:"11D-SATUAN INDIKATOR", 			labelWidth:180},
		{view:"text", 			label:"KINERJA AWAL", 							id:"11D-KINERJA AWAL", 					labelWidth:180},
		{view:"text", 			label:"TARGET KINERJA AKHIR",				id:"11D-TARGET KINERJA AKHIR",	labelWidth:180},
		{view:"text", 			label:"TARGET KINERJA TAHUN KE-1",	id:"11D-TARGET KINERJA-1", 			labelWidth:180},
		{view:"text", 			label:"TARGET KINERJA TAHUN KE-2",	id:"11D-TARGET KINERJA-2", 			labelWidth:180},
		{view:"text", 			label:"TARGET KINERJA TAHUN KE-3",	id:"11D-TARGET KINERJA-3", 			labelWidth:180},
		{view:"text", 			label:"TARGET KINERJA TAHUN KE-4",	id:"11D-TARGET KINERJA-4", 			labelWidth:180},
		{view:"text", 			label:"TARGET KINERJA TAHUN KE-5",	id:"11D-TARGET KINERJA-5", 			labelWidth:180},
		{
			margin:5,
			cols:[
				{width:126},
				{view:"button", label:"Delete", type:"form", align:"center", width:100, click:function(){
					dataAdd();
				}},
				{view:"button", label:"Cancel", align:"center", width:100, click:function(){
					$$("WIN_DATA11_DELETE").hide();
				}},
				{}
			]
		}
	]
};

var FORM_DATA2_DELETE = {
	view:"form",
	borderless:true,
	// scroll:"xy",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements:[
		
		{view:"text", 			label:"OPD", 											id:"2D-OPD", 							labelWidth:180},
		{view:"text", 			label:"BIDANG",										id:"2D-BIDANG", 						labelWidth:180},
		{view:"text", 			label:"URUSAN", 									id:"2D-URUSAN", 						labelWidth:180},
		{view:"richselect", label:"PROGRAM", 									id:"2D-PROGRAM", 					labelWidth:180, options:[{id:"Admin", value:""},{id:"", value:""},]},
		{view:"richselect", label:"KEGIATAN", 								id:"2D-KEGIATAN", 					labelWidth:180, options:[{id:"Admin", value:""},{id:"", value:""},]},
		{view:"text", 			label:"TOTAL PAGU AKHIR PERIODE",	id:"2D-TOTAL PAGU", 				labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-1",					id:"2D-PAGU-1", 						labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-2",					id:"2D-PAGU-2", 						labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-3",					id:"2D-PAGU-3", 						labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-4",					id:"2D-PAGU-4", 						labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-5",					id:"2D-PAGU-5", 						labelWidth:180},
		{
			margin:5,
			cols:[
				{width:126},
				{view:"button", label:"Delete", type:"form", align:"center", width:100, click:function(){
					dataAdd();
				}},
				{view:"button", label:"Cancel", align:"center", width:100, click:function(){
					$$("WIN_DATA2_DELETE").hide();
				}},
				{}
			]
		}
	]
};

var FORM_DATA21_DELETE = {
	view:"form",
	borderless:true,
	// scroll:"xy",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements:[
		
		{view:"text", 			label:"INDIKATOR PROGRAM", 					id:"21D-INDIKATOR PROGRAM",			labelWidth:180},
		{view:"text", 			label:"SATUAN INDIKATOR",						id:"21D-SATUAN INDIKATOR", 			labelWidth:180},
		{view:"text", 			label:"KINERJA AWAL", 							id:"21D-KINERJA AWAL", 					labelWidth:180},
		{view:"text", 			label:"TARGET KINERJA AKHIR",				id:"21D-TARGET KINERJA AKHIR",	labelWidth:180},
		{view:"text", 			label:"TARGET KINERJA TAHUN KE-1",	id:"21D-TARGET KINERJA-1", 			labelWidth:180},
		{view:"text", 			label:"TARGET KINERJA TAHUN KE-2",	id:"21D-TARGET KINERJA-2", 			labelWidth:180},
		{view:"text", 			label:"TARGET KINERJA TAHUN KE-3",	id:"21D-TARGET KINERJA-3", 			labelWidth:180},
		{view:"text", 			label:"TARGET KINERJA TAHUN KE-4",	id:"21D-TARGET KINERJA-4", 			labelWidth:180},
		{view:"text", 			label:"TARGET KINERJA TAHUN KE-5",	id:"21D-TARGET KINERJA-5", 			labelWidth:180},
		{
			margin:5,
			cols:[
				{width:126},
				{view:"button", label:"Delete", type:"form", align:"center", width:100, click:function(){
					dataAdd();
				}},
				{view:"button", label:"Cancel", align:"center", width:100, click:function(){
					$$("WIN_DATA21_DELETE").hide();
				}},
				{}
			]
		}
	]
};

var FORM_DATA3_DELETE = {
	view:"form",
	borderless:true,
	// scroll:"xy",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements:[
		
		{view:"text", 			label:"OPD", 											id:"3D-OPD", 							labelWidth:180},
		{view:"text", 			label:"BIDANG",										id:"3D-BIDANG", 						labelWidth:180},
		{view:"text", 			label:"URUSAN", 									id:"3D-URUSAN", 						labelWidth:180},
		{view:"richselect", label:"PROGRAM", 									id:"3D-PROGRAM", 					labelWidth:180, options:[{id:"Admin", value:""},{id:"", value:""},]},
		{view:"richselect", label:"KEGIATAN", 								id:"3D-KEGIATAN", 					labelWidth:180, options:[{id:"Admin", value:""},{id:"", value:""},]},
		{view:"richselect", label:"SUB KEGIATAN", 						id:"3D-SUB KEGIATAN", 			labelWidth:180, options:[{id:"Admin", value:""},{id:"", value:""},]},
		{view:"text", 			label:"TOTAL PAGU AKHIR PERIODE",	id:"3D-TOTAL PAGU", 				labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-1",					id:"3D-PAGU-1", 						labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-2",					id:"3D-PAGU-2", 						labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-3",					id:"3D-PAGU-3", 						labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-4",					id:"3D-PAGU-4", 						labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-5",					id:"3D-PAGU-5", 						labelWidth:180},
		{
			margin:5,
			cols:[
				{width:126},
				{view:"button", label:"Delete", type:"form", align:"center", width:100, click:function(){
					dataAdd();
				}},
				{view:"button", label:"Cancel", align:"center", width:100, click:function(){
					$$("WIN_DATA3_DELETE").hide();
				}},
				{}
			]
		}
	]
};

var FORM_DATA31_DELETE = {
	view:"form",
	borderless:true,
	// scroll:"xy",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements:[
		
		{view:"text", 			label:"INDIKATOR PROGRAM", 					id:"31D-INDIKATOR PROGRAM",			labelWidth:180},
		{view:"text", 			label:"SATUAN INDIKATOR",						id:"31D-SATUAN INDIKATOR", 			labelWidth:180},
		{view:"text", 			label:"KINERJA AWAL", 							id:"31D-KINERJA AWAL", 					labelWidth:180},
		{view:"text", 			label:"TARGET KINERJA AKHIR",				id:"31D-TARGET KINERJA AKHIR",	labelWidth:180},
		{view:"text", 			label:"TARGET KINERJA TAHUN KE-1",	id:"31D-TARGET KINERJA-1", 			labelWidth:180},
		{view:"text", 			label:"TARGET KINERJA TAHUN KE-2",	id:"31D-TARGET KINERJA-2", 			labelWidth:180},
		{view:"text", 			label:"TARGET KINERJA TAHUN KE-3",	id:"31D-TARGET KINERJA-3", 			labelWidth:180},
		{view:"text", 			label:"TARGET KINERJA TAHUN KE-4",	id:"31D-TARGET KINERJA-4", 			labelWidth:180},
		{view:"text", 			label:"TARGET KINERJA TAHUN KE-5",	id:"31D-TARGET KINERJA-5", 			labelWidth:180},
		{
			margin:5,
			cols:[
				{width:126},
				{view:"button", label:"Delete", type:"form", align:"center", width:100, click:function(){
					dataAdd();
				}},
				{view:"button", label:"Cancel", align:"center", width:100, click:function(){
					$$("WIN_DATA31_DELETE").hide();
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
function addData11(){
	showWindow("WIN_DATA11_ADD");
}
function addData2(){
	showWindow("WIN_DATA2_ADD");
}
function addData21(){
	showWindow("WIN_DATA21_ADD");
}
function addData3(){
	showWindow("WIN_DATA3_ADD");
}
function addData31(){
	showWindow("WIN_DATA31_ADD");
}


function editData1(){
	showWindow("WIN_DATA1_EDIT");
}
function editData11(){
	showWindow("WIN_DATA11_EDIT");
}
function editData2(){
	showWindow("WIN_DATA2_EDIT");
}
function editData21(){
	showWindow("WIN_DATA21_EDIT");
}
function editData3(){
	showWindow("WIN_DATA3_EDIT");
}
function editData31(){
	showWindow("WIN_DATA31_EDIT");
}


function deleteData1(){
	showWindow("WIN_DATA1_DELETE");
}
function deleteData11(){
	showWindow("WIN_DATA11_DELETE");
}
function deleteData2(){
	showWindow("WIN_DATA2_DELETE");
}
function deleteData21(){
	showWindow("WIN_DATA21_DELETE");
}
function deleteData3(){
	showWindow("WIN_DATA3_DELETE");
}
function addData31(){
	showWindow("WIN_DATA31_DELETE");
}


</script>

</body>
</html>