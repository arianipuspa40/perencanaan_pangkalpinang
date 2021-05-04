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
<style>
	.highlight{
		background-color:#FFAAAA;
	}
</style>

<script type="text/javascript">

//form filter
var filter = {
	type:"clean",
	rows:[
		{
			view:"form",
			id:"FORM_FILTER",
			borderless:true,
			elementsConfig:{
				paddingY:0, paddingX:0
			},
			elements:[
				{
					rows:[
						{
							cols:[
								{view:"checkbox", label:"URUSAN", id:"URUSAN_CB", labelWidth:140, width:170, click:"filterData()"},
								{view:"text", id:"URUSAN_TXT", name:"URUSAN_TXT", width:400}, {},
								{view:"checkbox", label:"PAGU RENJA", id:"PAGU_RENJA_CB", labelWidth:200, width:230},
								{view:"text", id:"PAGU_RENJA_TXT", name:"PAGU_RENJA_TXT", width:400}
							],
						},
						{
							cols:[
								{view:"checkbox", label:"BIDANG URUSAN", id:"BIDANG_URUSAN_CB", labelWidth:140, width:170, click:"filterData()"},
								{view:"text", id:"BIDANG_URUSAN_TXT", name:"BIDANG_URUSAN_TXT", width:400}, {},
								{view:"checkbox", label:"REALISASI ANGGARAN BLN 1", id:"REALISASI_BLN1_CB", labelWidth:200, width:230},
								{view:"text", id:"REALISASI_BLN1_TXT", name:"REALISASI_BLN1_TXT", width:400}
							],
						},
						{
							cols:[
								{view:"checkbox", label:"OPD", id:"OPD_CB", labelWidth:140, width:170, click:"filterData()"},
								{view:"text", id:"OPD_TXT", name:"OPD_TXT", width:400}, {},
								{view:"checkbox", label:"REALISASI ANGGARAN BLN 2", id:"REALISASI_BLN2_CB", labelWidth:200, width:230},
								{view:"text", id:"REALISASI_BLN2_TXT",name:"REALISASI_BLN2_TXT", width:400}
							],
						},						
						{
							cols:[
								{view:"checkbox", label:"SUB OPD", id:"SUBOPD_CB", labelWidth:140, width:170, click:"filterData()"},
								{view:"text", id:"SUBOPD_TXT", name:"SUBOPD_TXT", width:400}, {},
								{view:"checkbox", label:"REALISASI ANGGARAN BLN 3", id:"REALISASI_BLN3_CB", labelWidth:200, width:230},
								{view:"text", id:"REALISASI_BLN3_TXT",name:"REALISASI_BLN3_TXT", width:400}
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
		//{view:"button", type:"iconButton", icon:"edit", label:"ENTRI REALISASI", autowidth:true, click:"editData1()"},
		//{view:"button", type:"iconButton", icon:"trash-o", label:"DELETE", autowidth:true, click:"deleteData1()"},
	]
};

// tabel program
var program = {
	view:"datatable", id:"DTRealisasiEntriProgTw1", resizeColumn:true, navigation:true,
	select:true, css:"datatable_column", height:300,
	scheme:{
		$change:function(item){
			if (item.CATATAN_REJECT.trim().length > 1)
				item.$css = "highlight";
		}
	},
	columns:[
		{header:"#", 	id:"ROW_ID", 				hidden:true},
		
		{header:"No", 		id:"NO", 			width:35, 	css:{'text-align':'right'}},
		{header:"KODE", 	id:"PROG_KODE_LENGKAP", 						width:70, 	css:{'text-align':'left'}},
		{header:"PROGRAM", 	id:"DESKRIPSI", 								width:400, 	css:{'text-align':'left'}},
		{header:"JUMLAH REALISASI", 			id:"REALISASI_JUMLAH", 		width:150, 	css:{'text-align':'left'}},		
		{header:"PAGU DPA",   id:"TARGET_PAGU_PROG_DPA", 		width:150, 	css:{'text-align':'left'}},
		{header:"PAGU RENJA", id:"TARGET_PAGU_PROG_RENJA", 		width:150, 	css:{'text-align':'left'}},
		{header:"OPD", 		id:"OPD_ID",	 	width:200, 	css:{'text-align':'left'}},
		{header:"SUB OPD", 	id:"SUB_OPD_ID", 	width:200, 	css:{'text-align':'left'}},
		{header:"BIDANG",  	id:"BIDANG_OPD_ID",	width:200, 	css:{'text-align':'left'}},
		{header:"REALISASI BLN 1", 				id:"REALISASI_JUMLAH_BLN1", width:120, 	css:{'text-align':'left'}},
		{header:"REALISASI BLN 2", 				id:"REALISASI_JUMLAH_BLN2", width:120, 	css:{'text-align':'left'}},
		{header:"REALISASI BLN 3", 				id:"REALISASI_JUMLAH_BLN3", width:120, 	css:{'text-align':'left'}},
		{header:"REALISASI BLN 4", 				id:"REALISASI_JUMLAH_BLN4", width:120, 	css:{'text-align':'left'}},
		{header:"REALISASI BLN 5", 				id:"REALISASI_JUMLAH_BLN5", width:120, 	css:{'text-align':'left'}},
		{header:"REALISASI BLN 6", 				id:"REALISASI_JUMLAH_BLN6", width:120, 	css:{'text-align':'left'}},
		{header:"REALISASI BLN 7", 				id:"REALISASI_JUMLAH_BLN7", width:120, 	css:{'text-align':'left'}},
		{header:"REALISASI BLN 8", 				id:"REALISASI_JUMLAH_BLN8", width:120, 	css:{'text-align':'left'}},
		{header:"REALISASI BLN 9", 				id:"REALISASI_JUMLAH_BLN9", width:120, 	css:{'text-align':'left'}},
		{header:"REALISASI BLN 10", 			id:"REALISASI_JUMLAH_BLN10", width:130, 	css:{'text-align':'left'}},
		{header:"REALISASI BLN 11", 			id:"REALISASI_JUMLAH_BLN11", width:130, 	css:{'text-align':'left'}},
		{header:"REALISASI BLN 12", 			id:"REALISASI_JUMLAH_BLN12", width:130, 	css:{'text-align':'left'}},
		{header:"CATATAN REJECT", 			id:"CATATAN_REJECT", width:300, 	css:{'text-align':'left'}},
		
		{header:"&nbsp;", 										id:"EDIT", 							width:37, 	template:"<span style='cursor:pointer;' class='webix_icon fa-edit'></span>", 	tooltip:"Edit"},
		{header:"&nbsp;", 										id:"DELETE", 						width:35, 	template:"<span style='cursor:pointer;' class='webix_icon fa-trash-o'></span>", 	tooltip:"Hapus"}
	],
	on:{
		"onBeforeLoad":function(){
			this.showOverlay("Loading...");
		},
		"onAfterLoad":function(){
			this.hideOverlay();
			// this.select(this.getFirstId());
			
		},
		"onAfterSelect":function(id){
			id_opd = id;
			var item = $$("DTRealisasiEntriProgTw1").getItem(id);
			// console.log(id);
			// console.log(item);
			$$('URUSAN_TXT').setValue(item.URS_ID);
			$$('BIDANG_URUSAN_TXT').setValue(item.BID_URS_ID);
			$$('OPD_TXT').setValue(item.OPD_ID);
			$$('SUBOPD_TXT').setValue(item.SUB_OPD_ID);
			$$('PAGU_RENJA_TXT').setValue(item.TARGET_PAGU_PROG_RENJA);
			$$('REALISASI_BLN1_TXT').setValue(item.REALISASI_JUMLAH_BLN1);
			$$('REALISASI_BLN2_TXT').setValue(item.REALISASI_JUMLAH_BLN2);
			$$('REALISASI_BLN3_TXT').setValue(item.REALISASI_JUMLAH_BLN3);

			var prg_rowid =item.ROW_ID;
			// console.log(prg_rowid);

			// get data indikator program
			$$("DTRealisasiEntriIndiProgTw1").clearAll();
			$$("DTRealisasiEntriIndiProgTw1").load(function(){
			    return webix.ajax().post("evaluasi_realisasi_entri_realisasi_t1_data_child.php?lvl=indiprog",{rowid:prg_rowid},function(text, data){
			    	// console.log(data.json().id);
			    	// console.log(data.json().numrows);
			    	// console.log(data.json());
			    })
			});
			// akhir get data indikator program

			// get data kegiatan
			$$("DTRealisasiEntriKegTw1").clearAll();
			$$("DTRealisasiEntriKegTw1").load(function(){
			    return webix.ajax().post("evaluasi_realisasi_entri_realisasi_t1_data_child.php?lvl=kegiatan",{rowid:prg_rowid},function(text, data){
			    	// console.log(data.json().id);
			    	// console.log(data.json().numrows);
			    	// console.log(data.json().KEG_NO);
			    	// console.log(data.json());
			    })
			});
			// akhir get data kegiatan
			
		},
		"onItemDblClick":function(id,e,node){
			
		},
		"onItemClick":function(id,e,node){
			id_opd = id;			
			
		},
	},
	onClick:{
		"fa-edit":function(e,id){
			id_opd = id;
		},
		"fa-trash-o":function(e,id){
			id_opd = id;
		}
	},
	fixedRowHeight:false,
	scroll:true,
	animate:{type:"slide", subtype:"together"},
	tooltip:true,
	hover:"my_hover",
	datatype:"json",
	// url:"load_realisasi_entri_t1.php",
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
		{view:"button", type:"iconButton", icon:"edit", label:"ENTRI REALISASI", autowidth:true, click:"editData11()"},
		//{view:"button", type:"iconButton", icon:"trash-o", label:"DELETE", autowidth:true, click:"deleteData11()"},
	]
};

// tabel indikator program
var indikator_program = {
	view:"datatable", id:"DTRealisasiEntriIndiProgTw1",resizeColumn:true, navigation:true,
	select:true, css:"datatable_column", 
	columns:[
		{header:"#", 							id:"ID", 				hidden:true},		
		{header:"No", 							id:"INDIPROG_NO", 							width:35, 	css:{'text-align':'right'}},
		{header:"INDIKATOR PROGRAM", 			id:"INDIPROG_INDIKATOR_PROGRAM", 			width:400, 	css:{'text-align':'left'}},
		{header:"SATUAN INDIKATOR", 			id:"INDIPROG_SATUAN_INDIKATOR_PROGRAM", 	width:220, 	css:{'text-align':'left'}},

		{header:"TARGET KINERJA DPA", 			id:"INDIPROG_KINERJA_DPA_PROG", 			width:150, 	css:{'text-align':'left'}},
		{header:"TARGET KINERJA RENJA", 		id:"INDIPROG_KINERJA_RENJA_PROG", width:180, 	css:{'text-align':'left'}},

		{header:"REALISASI KINERJA BLN 1", 		id:"INDIPROG_REALISASI_KINERJA_BLN1", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI FISIK BLN 1", 		id:"INDIPROG_REALISASI_FISIK_BLN1", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI KINERJA BLN 2", 		id:"INDIPROG_REALISASI_KINERJA_BLN2", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI FISIK BLN 2", 		id:"INDIPROG_REALISASI_FISIK_BLN1", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI KINERJA BLN 3", 		id:"INDIPROG_REALISASI_KINERJA_BLN3", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI FISIK BLN 3", 		id:"INDIPROG_REALISASI_FISIK_BLN1", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI KINERJA BLN 4", 		id:"INDIPROG_REALISASI_KINERJA_BLN4", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI FISIK BLN 4", 		id:"INDIPROG_REALISASI_FISIK_BLN1", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI KINERJA BLN 5", 		id:"INDIPROG_REALISASI_KINERJA_BLN5", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI FISIK BLN 5", 		id:"INDIPROG_REALISASI_FISIK_BLN1", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI KINERJA BLN 6", 		id:"INDIPROG_REALISASI_KINERJA_BLN6", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI FISIK BLN 6", 		id:"INDIPROG_REALISASI_FISIK_BLN1", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI KINERJA BLN 7", 		id:"INDIPROG_REALISASI_KINERJA_BLN7", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI FISIK BLN 7", 		id:"INDIPROG_REALISASI_FISIK_BLN1", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI KINERJA BLN 8", 		id:"INDIPROG_REALISASI_KINERJA_BLN8", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI FISIK BLN 8", 		id:"INDIPROG_REALISASI_FISIK_BLN1", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI KINERJA BLN 9", 		id:"INDIPROG_REALISASI_KINERJA_BLN9", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI FISIK BLN 9", 		id:"INDIPROG_REALISASI_FISIK_BLN1", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI KINERJA BLN 10", 	id:"INDIPROG_REALISASI_KINERJA_BLN10", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI FISIK BLN 10", 		id:"INDIPROG_REALISASI_FISIK_BLN1", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI KINERJA BLN 11", 	id:"INDIPROG_REALISASI_KINERJA_BLN11", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI FISIK BLN 11", 		id:"INDIPROG_REALISASI_FISIK_BLN1", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI KINERJA BLN 12", 	id:"INDIPROG_REALISASI_KINERJA_BLN12", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI FISIK BLN 12", 		id:"INDIPROG_REALISASI_FISIK_BLN1", 		width:180, 	css:{'text-align':'left'}},
		
		{header:"&nbsp;", 										id:"EDIT", 							width:37, 	template:"<span style='cursor:pointer;' class='webix_icon fa-edit'></span>", 	tooltip:"Edit"},
		{header:"&nbsp;", 										id:"DELETE", 						width:35, 	template:"<span style='cursor:pointer;' class='webix_icon fa-trash-o'></span>", 	tooltip:"Hapus"}
	],
	on:{
		"onBeforeLoad":function(){
			this.showOverlay("Loading...");
		},
		"onAfterLoad":function(){
			this.hideOverlay();
			this.select(this.getFirstId());
		},
		"onItemDblClick":function(id,e,node){
			editData11();
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
		//{view:"button", type:"iconButton", icon:"edit", label:"ENTRI REALISASI", autowidth:true, click:"editData2()"},
		//{view:"button", type:"iconButton", icon:"trash-o", label:"DELETE", autowidth:true, click:"deleteData2()"},
	]
};
var kegiatan = {
	view:"datatable", id:"DTRealisasiEntriKegTw1",resizeColumn:true, navigation:true,
	select:true, css:"datatable_column", height:300,
	columns:[
		{header:"#", 													id:"KEG_ROW_ID", 				hidden:true},

		{header:"No", 		id:"KEG_NO", 			width:35, 	css:{'text-align':'right'}},
		{header:"KODE", 	id:"KEG_KODE_LENGKAP", 						width:90, 	css:{'text-align':'left'}},
		{header:"KEGIATAN", id:"KEG_DESKRIPSI", 								width:380, 	css:{'text-align':'left'}},
		{header:"JUMLAH REALISASI", 			id:"KEG_REALISASI_JUMLAH", 		width:150, 	css:{'text-align':'left'}},		
		{header:"PAGU DPA",   id:"KEG_TARGET_PAGU_KEG_DPA", 		width:150, 	css:{'text-align':'left'}},
		{header:"PAGU RENJA", id:"KEG_TARGET_PAGU_KEG_RENJA", 		width:150, 	css:{'text-align':'left'}},
		{header:"OPD", 		id:"KEG_OPD_ID",	 	width:200, 	css:{'text-align':'left'}},
		{header:"SUB OPD", 	id:"KEG_SUB_OPD_ID", 	width:200, 	css:{'text-align':'left'}},
		{header:"BIDANG",  	id:"KEG_BIDANG_OPD_ID",	width:200, 	css:{'text-align':'left'}},
		{header:"REALISASI BLN 1", 				id:"KEG_REALISASI_JUMLAH_BLN1", width:120, 	css:{'text-align':'left'}},
		{header:"REALISASI BLN 2", 				id:"KEG_REALISASI_JUMLAH_BLN2", width:120, 	css:{'text-align':'left'}},
		{header:"REALISASI BLN 3", 				id:"KEG_REALISASI_JUMLAH_BLN3", width:120, 	css:{'text-align':'left'}},
		{header:"REALISASI BLN 4", 				id:"KEG_REALISASI_JUMLAH_BLN4", width:120, 	css:{'text-align':'left'}},
		{header:"REALISASI BLN 5", 				id:"KEG_REALISASI_JUMLAH_BLN5", width:120, 	css:{'text-align':'left'}},
		{header:"REALISASI BLN 6", 				id:"KEG_REALISASI_JUMLAH_BLN6", width:120, 	css:{'text-align':'left'}},
		{header:"REALISASI BLN 7", 				id:"KEG_REALISASI_JUMLAH_BLN7", width:120, 	css:{'text-align':'left'}},
		{header:"REALISASI BLN 8", 				id:"KEG_REALISASI_JUMLAH_BLN8", width:120, 	css:{'text-align':'left'}},
		{header:"REALISASI BLN 9", 				id:"KEG_REALISASI_JUMLAH_BLN9", width:120, 	css:{'text-align':'left'}},
		{header:"REALISASI BLN 10", 			id:"KEG_REALISASI_JUMLAH_BLN10", width:130, 	css:{'text-align':'left'}},
		{header:"REALISASI BLN 11", 			id:"KEG_REALISASI_JUMLAH_BLN11", width:130, 	css:{'text-align':'left'}},
		{header:"REALISASI BLN 12", 			id:"KEG_REALISASI_JUMLAH_BLN12", width:130, 	css:{'text-align':'left'}},
		
		{header:"&nbsp;", 										id:"EDIT", 							width:37, 	template:"<span style='cursor:pointer;' class='webix_icon fa-edit'></span>", 	tooltip:"Edit"},
		{header:"&nbsp;", 										id:"DELETE", 						width:35, 	template:"<span style='cursor:pointer;' class='webix_icon fa-trash-o'></span>", 	tooltip:"Hapus"}
	],
	on:{
		"onBeforeLoad":function(){
			this.showOverlay("Loading...");
		},
		"onAfterLoad":function(){
			this.hideOverlay();
			this.select(this.getFirstId());
		},
		"onAfterSelect":function(id){
			
			var item = $$("DTRealisasiEntriKegTw1").getItem(id);			
			// console.log(item.KEG_ROW_ID);
			var keg_rowid =item.KEG_ROW_ID;
		
			// get data indikator kegiatan
			$$("DTRealisasiEntriIndiKegTw1").clearAll();
			$$("DTRealisasiEntriIndiKegTw1").load(function(){
			    return webix.ajax().post("evaluasi_realisasi_entri_realisasi_t1_data_child.php?lvl=indikeg",{rowid:keg_rowid},function(text, data){
			    	// console.log(data.json().numrows);
			    	// console.log(data.json());
			    })
			});
			// akhir get data indikator program

			// // get data sub kegiatan
			$$("DTRealisasiEntriSubkegTw1").clearAll();
			$$("DTRealisasiEntriSubkegTw1").load(function(){
			    return webix.ajax().post("evaluasi_realisasi_entri_realisasi_t1_data_child.php?lvl=subkegiatan",{rowid:keg_rowid},function(text, data){
			    	// console.log(data.json().lvl);
			    })
			});
			// // akhir get data sub kegiatan
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
		{view:"button", type:"iconButton", icon:"edit", label:"ENTRI REALISASI", autowidth:true, click:"editData21()"},
		//{view:"button", type:"iconButton", icon:"trash-o", label:"DELETE", autowidth:true, click:"deleteData21()"},
	]
};
var indikator_kegiatan = {
	view:"datatable", id:"DTRealisasiEntriIndiKegTw1",resizeColumn:true, navigation:true,
	select:true, css:"datatable_column", 
	columns:[
		{header:"#", 							id:"INDIKEG_ROW_ID", 				hidden:true},
		
		{header:"No", 							id:"INDIKEG_NO", 							width:35, 	css:{'text-align':'right'}},
		{header:"INDIKATOR KEGIATAN", 			id:"INDIKEG_INDIKATOR_KEGIATAN", 			width:400, 	css:{'text-align':'left'}},
		{header:"SATUAN INDIKATOR", 			id:"INDIKEG_SATUAN_INDIKATOR_KEGIATAN", 	width:220, 	css:{'text-align':'left'}},

		{header:"TARGET KINERJA DPA", 			id:"INDIKEG_KINERJA_DPA_KEG", 			width:150, 	css:{'text-align':'left'}},
		{header:"TARGET KINERJA RENJA", 		id:"INDIKEG_KINERJA_RENJA_KEG", width:180, 	css:{'text-align':'left'}},

		{header:"REALISASI KINERJA BLN 1", 		id:"INDIKEG_REALISASI_KINERJA_BLN1", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI FISIK BLN 1", 		id:"INDIKEG_REALISASI_FISIK_BLN1", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI KINERJA BLN 2", 		id:"INDIKEG_REALISASI_KINERJA_BLN2", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI FISIK BLN 2", 		id:"INDIKEG_REALISASI_FISIK_BLN1", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI KINERJA BLN 3", 		id:"INDIKEG_REALISASI_KINERJA_BLN3", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI FISIK BLN 3", 		id:"INDIKEG_REALISASI_FISIK_BLN1", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI KINERJA BLN 4", 		id:"INDIKEG_REALISASI_KINERJA_BLN4", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI FISIK BLN 4", 		id:"INDIKEG_REALISASI_FISIK_BLN1", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI KINERJA BLN 5", 		id:"INDIKEG_REALISASI_KINERJA_BLN5", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI FISIK BLN 5", 		id:"INDIKEG_REALISASI_FISIK_BLN1", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI KINERJA BLN 6", 		id:"INDIKEG_REALISASI_KINERJA_BLN6", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI FISIK BLN 6", 		id:"INDIKEG_REALISASI_FISIK_BLN1", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI KINERJA BLN 7", 		id:"INDIKEG_REALISASI_KINERJA_BLN7", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI FISIK BLN 7", 		id:"INDIKEG_REALISASI_FISIK_BLN1", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI KINERJA BLN 8", 		id:"INDIKEG_REALISASI_KINERJA_BLN8", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI FISIK BLN 8", 		id:"INDIKEG_REALISASI_FISIK_BLN1", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI KINERJA BLN 9", 		id:"INDIKEG_REALISASI_KINERJA_BLN9", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI FISIK BLN 9", 		id:"INDIKEG_REALISASI_FISIK_BLN1", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI KINERJA BLN 10", 	id:"INDIKEG_REALISASI_KINERJA_BLN10", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI FISIK BLN 10", 		id:"INDIKEG_REALISASI_FISIK_BLN1", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI KINERJA BLN 11", 	id:"INDIKEG_REALISASI_KINERJA_BLN11", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI FISIK BLN 11", 		id:"INDIKEG_REALISASI_FISIK_BLN1", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI KINERJA BLN 12", 	id:"INDIKEG_REALISASI_KINERJA_BLN12", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI FISIK BLN 12", 		id:"INDIKEG_REALISASI_FISIK_BLN1", 		width:180, 	css:{'text-align':'left'}},
		
		{header:"&nbsp;", 										id:"EDIT", 							width:37, 	template:"<span style='cursor:pointer;' class='webix_icon fa-edit'></span>", 	tooltip:"Edit"},
		{header:"&nbsp;", 										id:"DELETE", 						width:35, 	template:"<span style='cursor:pointer;' class='webix_icon fa-trash-o'></span>", 	tooltip:"Hapus"}
	],
	on:{
		"onBeforeLoad":function(){
			this.showOverlay("Loading...");
		},
		"onAfterLoad":function(){
			this.hideOverlay();
			this.select(this.getFirstId());
		},
		"onItemDblClick":function(id,e,node){
			editData21();
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
		{view:"button", type:"iconButton", icon:"edit", label:"ENTRI REALISASI", autowidth:true, click:"editData3()"},
		//{view:"button", type:"iconButton", icon:"trash-o", label:"DELETE", autowidth:true, click:"deleteData3()"},
	]
};
var subkegiatan = {
	view:"datatable", id:"DTRealisasiEntriSubkegTw1",resizeColumn:true, navigation:true,
	select:true, css:"datatable_column", height:300,
	columns:[
		{header:"#", 													id:"SUBKEG_NO", 				hidden:true},
		
		{header:"No", 		id:"SUBKEG_NO", 			width:35, 	css:{'text-align':'right'}},
		{header:"KODE", 	id:"SUBKEG_KODE_LENGKAP", 						width:110, 	css:{'text-align':'left'}},
		{header:"SUB KEGIATAN", 	id:"SUBKEG_DESKRIPSI", 								width:360, 	css:{'text-align':'left'}},
		{header:"JUMLAH REALISASI", id:"SUBKEG_REALISASI_JUMLAH", 		width:150, 	css:{'text-align':'left'}},		
		{header:"PAGU DPA",   		id:"SUBKEG_TARGET_PAGU_SUBKEG_DPA", 		width:150, 	css:{'text-align':'left'}},
		// {header:"PAGU RENJA",		id:"SUBKEG_TARGET_PAGU_SUBKEG_RENJA", 		width:150, 	css:{'text-align':'left'},format:webix.i18n.numberFormat },
		{header:"PAGU RENJA",		id:"SUBKEG_TARGET_PAGU_SUBKEG_RENJA", 		width:150, 	css:{'text-align':'left'},format:webix.Number.numToStr({groupDelimiter:".", groupSize:3,decimalDelimiter:",",decimalSize:2}) },
		{header:"OPD", 				id:"SUBKEG_OPD_ID",	 	width:200, 	css:{'text-align':'left'}},
		{header:"SUB OPD", 			id:"SUBKEG_SUB_OPD_ID", 	width:200, 	css:{'text-align':'left'}},
		{header:"BIDANG",  			id:"SUBKEG_BIDANG_OPD_ID",	width:200, 	css:{'text-align':'left'}},
		{header:"REALISASI BLN 1", 				id:"SUBKEG_REALISASI_JUMLAH_BLN1", width:120, 	css:{'text-align':'left'}},
		{header:"REALISASI BLN 2", 				id:"SUBKEG_REALISASI_JUMLAH_BLN2", width:120, 	css:{'text-align':'left'}},
		{header:"REALISASI BLN 3", 				id:"SUBKEG_REALISASI_JUMLAH_BLN3", width:120, 	css:{'text-align':'left'}},
		{header:"REALISASI BLN 4", 				id:"SUBKEG_REALISASI_JUMLAH_BLN4", width:120, 	css:{'text-align':'left'}},
		{header:"REALISASI BLN 5", 				id:"SUBKEG_REALISASI_JUMLAH_BLN5", width:120, 	css:{'text-align':'left'}},
		{header:"REALISASI BLN 6", 				id:"SUBKEG_REALISASI_JUMLAH_BLN6", width:120, 	css:{'text-align':'left'}},
		{header:"REALISASI BLN 7", 				id:"SUBKEG_REALISASI_JUMLAH_BLN7", width:120, 	css:{'text-align':'left'}},
		{header:"REALISASI BLN 8", 				id:"SUBKEG_REALISASI_JUMLAH_BLN8", width:120, 	css:{'text-align':'left'}},
		{header:"REALISASI BLN 9", 				id:"SUBKEG_REALISASI_JUMLAH_BLN9", width:120, 	css:{'text-align':'left'}},
		{header:"REALISASI BLN 10", 			id:"SUBKEG_REALISASI_JUMLAH_BLN10", width:130, 	css:{'text-align':'left'}},
		{header:"REALISASI BLN 11", 			id:"SUBKEG_REALISASI_JUMLAH_BLN11", width:130, 	css:{'text-align':'left'}},
		{header:"REALISASI BLN 12", 			id:"SUBKEG_REALISASI_JUMLAH_BLN12", width:130, 	css:{'text-align':'left'}},
		
		{header:"&nbsp;", 										id:"EDIT", 							width:37, 	template:"<span style='cursor:pointer;' class='webix_icon fa-edit'></span>", 	tooltip:"Edit"},
		{header:"&nbsp;", 										id:"DELETE", 						width:35, 	template:"<span style='cursor:pointer;' class='webix_icon fa-trash-o'></span>", 	tooltip:"Hapus"}
	],
	on:{
		"onBeforeLoad":function(){
			this.showOverlay("Loading...");
		},
		"onAfterLoad":function(){
			this.hideOverlay();
			this.select(this.getFirstId());
		},
		"onAfterSelect":function(id){
			var item = $$("DTRealisasiEntriSubkegTw1").getItem(id);			
			var subkeg_rowid =item.SUBKEG_ROW_ID;
			// console.log(subkeg_rowid);	
		
			// get data indikator sub kegiatan
			$$("DTRealisasiEntriIndiSubKegTw1").clearAll();
			$$("DTRealisasiEntriIndiSubKegTw1").load(function(){
			    return webix.ajax().post("evaluasi_realisasi_entri_realisasi_t1_data_child.php?lvl=indisubkeg",{rowid:subkeg_rowid},function(text, data){
			    	// console.log(data.json().status);
			    })
			});
			// akhir get data indikator sub kegiatan
		},
		"onItemDblClick":function(id,e,node){
			editData3()
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
		{view:"button", type:"iconButton", icon:"edit", label:"ENTRI REALISASI", autowidth:true, click:"editData31()"},
		//{view:"button", type:"iconButton", icon:"trash-o", label:"DELETE", autowidth:true, click:"deleteData31()"},
	]
};

var indikator_subkegiatan = {
	view:"datatable", id:"DTRealisasiEntriIndiSubKegTw1",resizeColumn:true, navigation:true,
	select:true, css:"datatable_column", 
	columns:[
		{header:"#", 							id:"INDISUBKEG_ROW_ID", 				hidden:true},
		
		{header:"No", 							id:"INDISUBKEG_NO", 							width:35, 	css:{'text-align':'right'}},
		{header:"INDIKATOR SUB KEGIATAN", 		id:"INDISUBKEG_INDIKATOR_SUBKEGIATAN", 			width:400, 	css:{'text-align':'left'}},
		{header:"SATUAN INDIKATOR", 			id:"INDISUBKEG_SATUAN_INDIKATOR_SUBKEGIATAN", 	width:220, 	css:{'text-align':'left'}},

		{header:"TARGET KINERJA DPA", 			id:"INDISUBKEG_KINERJA_DPA_SUBKEG", 			width:150, 	css:{'text-align':'left'}},
		{header:"TARGET KINERJA RENJA", 		id:"INDISUBKEG_KINERJA_RENJA_SUBKEG", width:180, 	css:{'text-align':'left'}},

		{header:"REALISASI KINERJA BLN 1", 		id:"INDISUBKEG_REALISASI_KINERJA_BLN1", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI FISIK BLN 1", 		id:"INDISUBKEG_REALISASI_FISIK_BLN1", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI KINERJA BLN 2", 		id:"INDISUBKEG_REALISASI_KINERJA_BLN2", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI FISIK BLN 2", 		id:"INDISUBKEG_REALISASI_FISIK_BLN1", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI KINERJA BLN 3", 		id:"INDISUBKEG_REALISASI_KINERJA_BLN3", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI FISIK BLN 3", 		id:"INDISUBKEG_REALISASI_FISIK_BLN1", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI KINERJA BLN 4", 		id:"INDISUBKEG_REALISASI_KINERJA_BLN4", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI FISIK BLN 4", 		id:"INDISUBKEG_REALISASI_FISIK_BLN1", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI KINERJA BLN 5", 		id:"INDISUBKEG_REALISASI_KINERJA_BLN5", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI FISIK BLN 5", 		id:"INDISUBKEG_REALISASI_FISIK_BLN1", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI KINERJA BLN 6", 		id:"INDISUBKEG_REALISASI_KINERJA_BLN6", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI FISIK BLN 6", 		id:"INDISUBKEG_REALISASI_FISIK_BLN1", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI KINERJA BLN 7", 		id:"INDISUBKEG_REALISASI_KINERJA_BLN7", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI FISIK BLN 7", 		id:"INDISUBKEG_REALISASI_FISIK_BLN1", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI KINERJA BLN 8", 		id:"INDISUBKEG_REALISASI_KINERJA_BLN8", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI FISIK BLN 8", 		id:"INDISUBKEG_REALISASI_FISIK_BLN1", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI KINERJA BLN 9", 		id:"INDISUBKEG_REALISASI_KINERJA_BLN9", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI FISIK BLN 9", 		id:"INDISUBKEG_REALISASI_FISIK_BLN1", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI KINERJA BLN 10", 	id:"INDISUBKEG_REALISASI_KINERJA_BLN10", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI FISIK BLN 10", 		id:"INDISUBKEG_REALISASI_FISIK_BLN1", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI KINERJA BLN 11", 	id:"INDISUBKEG_REALISASI_KINERJA_BLN11", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI FISIK BLN 11", 		id:"INDISUBKEG_REALISASI_FISIK_BLN1", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI KINERJA BLN 12", 	id:"INDISUBKEG_REALISASI_KINERJA_BLN12", 		width:180, 	css:{'text-align':'left'}},
		{header:"REALISASI FISIK BLN 12", 		id:"INDISUBKEG_REALISASI_FISIK_BLN1", 		width:180, 	css:{'text-align':'left'}},
		
		
		{header:"&nbsp;", 										id:"EDIT", 							width:37, 	template:"<span style='cursor:pointer;' class='webix_icon fa-edit'></span>", 	tooltip:"Edit"},
		{header:"&nbsp;", 										id:"DELETE", 						width:35, 	template:"<span style='cursor:pointer;' class='webix_icon fa-trash-o'></span>", 	tooltip:"Hapus"}
	],
	on:{
		"onBeforeLoad":function(){
			this.showOverlay("Loading...");
		},
		"onAfterLoad":function(){
			this.hideOverlay();
			this.select(this.getFirstId());
		},
		"onItemDblClick":function(id,e,node){
			editData31()
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


var paging_realisasi = {
	//type:"clean",
	view:"toolbar",
	css:"highlighted_header header",
	paddingX:2,
	paddingY:2,
	height:35,
	cols:[
		{	view:"pager", id:"PAGER_REALISASI", master:false, borderless:true,
			size:10, group:5, count:90, template:"{common.first()}{common.prev()}{common.pages()}{common.next()}{common.last()} <text style='color:white;'> {common.page()} / #limit# Halaman </text>", 
			on:{
				onItemClick: function(id, e, node) {
					//webix.message("ID: "+id);
					if (id=="first") {
						from = 0;
						getData();
					} else if (id=="prev") {
						var pfrom = from - perp;
						if (pfrom>=0) {
							from = pfrom;
							getData();
						}
					} else if (id=="next") {
						var nfrom = from + perp;
						var lfrom = (page-1) * perp;
						if (nfrom<=lfrom) {
							from = nfrom;
							getData();
						}
					} else if (id=="last") {
						from = (page-1) * perp;
						getData();
					} else {
						from = id * perp;
						getData();
					}
				}
			},
		},
		{view:"label", id:"PAGER_INFO", label:"<text style='font-size:13px; float:right;'>1.000 - 30.000 / 100.000 Data </text>", width:250},
	]
};

var ui = {
	view:"scrollview",
	scroll:"native-y",
	body:{
		//type:"space",
		rows:[
			{type:"space", cols:[filter]}, 
			{type:"space", cols:[
				{rows:[nav_program, program,paging_realisasi]}, 
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
			{height:10},
			{cols:[
				{width:20},
				// {view:"checkbox", label:"", id:"CATATAN REJECT", labelWidth:110, width:22},
				// {view:"label", label:"TAMPILKAN DATA YANG ADA CATATAN REJECT"},
				{}
			]}, 
			{cols:[
				{},
				{view:"button", 	label:"PENGAJUAN", type:"form", align:"center", width:150, height:40},
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
		width:500, height:500,
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
		width:500, height:500,
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
		width:500, height:500,
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
		width:500, height:500,
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

	getData();
	bindProgFormEdit();
	// $$('FORM_FILTER').bind('DTRealisasiEntriProgTw1');
	
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
		{view:"text", 			label:"TOTAL PAGU AKHIR PERIODE",	id:"1E-TOTAL PAGU", 				labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-1",					id:"1E-PAGU-1", 						labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-2",					id:"1E-PAGU-2", 						labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-3",					id:"1E-PAGU-3", 						labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-4",					id:"1E-PAGU-4", 						labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-5",					id:"1E-PAGU-5", 						labelWidth:180},
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


// form entri realisasi indikator program
var FORM_DATA11_EDIT = {
	view:"form",
	id:"FORM_ENTRY_INDI_PROG",
	borderless:true,
	scroll:"auto",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements:[
		// {view:"text", 			label:"OPD", 	 id:"INDIPROG_SUB_OPD_ID", name:"INDIPROG_SUB_OPD_ID",	labelWidth:180, disabled:true},
		// {view:"richselect", 	label:"PROGRAM", 	id:"11E-PROGRAM", 	labelWidth:180, disabled:true, options:[{id:"Admin", value:""},{id:"", value:""},]},
		{view:"textarea",	label:"INDIKATOR PROGRAM", 	id:"INDIPROG_INDIKATOR_PROGRAM", name:"INDIPROG_INDIKATOR_PROGRAM",	labelWidth:180, disabled:true},
		{view:"text", 	 	label:"SATUAN INDIKATOR",	id:"INDIPROG_SATUAN_INDIKATOR_PROGRAM", name:"INDIPROG_SATUAN_INDIKATOR_PROGRAM", labelWidth:180, disabled:true},
		{view:"text", 		label:"TARGET KINERJA DPA", id:"INDIPROG_KINERJA_DPA_PROG", name:"INDIPROG_KINERJA_DPA_PROG", labelWidth:180, disabled:true},
		{view:"text", 		label:"TARGET KINERJA RENJA", id:"INDIPROG_KINERJA_RENJA_PROG", name:"INDIPROG_KINERJA_RENJA_PROG", labelWidth:180, disabled:true},
		// {view:"text", 		label:"REALISASI KINERJA",					id:"11E-TREALISASI ANGGARAN", 			labelWidth:180},
		{view:"text", label:"REALISASI KINERJA BLN 1", name:"INDIPROG_REALISASI_KINERJA_BLN1",		id:"INDIPROG_REALISASI_KINERJA_BLN1", labelWidth:180},
		{view:"text", label:"REALISASI FISIK BLN 1", name:"INDIPROG_REALISASI_FISIK_BLN1",		id:"INDIPROG_REALISASI_FISIK_BLN1", labelWidth:180},
		{view:"text", label:"REALISASI KINERJA BLN 2", name:"INDIPROG_REALISASI_KINERJA_BLN2",		id:"INDIPROG_REALISASI_KINERJA_BLN2", labelWidth:180},
		{view:"text", label:"REALISASI FISIK BLN 2", name:"INDIPROG_REALISASI_FISIK_BLN2",		id:"INDIPROG_REALISASI_FISIK_BLN2", labelWidth:180},
		{view:"text", label:"REALISASI KINERJA BLN 3", name:"INDIPROG_REALISASI_KINERJA_BLN3",		id:"INDIPROG_REALISASI_KINERJA_BLN3", labelWidth:180},
		{view:"text", label:"REALISASI FISIK BLN 3", name:"INDIPROG_REALISASI_FISIK_BLN3",		id:"INDIPROG_REALISASI_FISIK_BLN3", labelWidth:180},
		{view:"text", label:"REALISASI KINERJA BLN 4", name:"INDIPROG_REALISASI_KINERJA_BLN4",		id:"INDIPROG_REALISASI_KINERJA_BLN4", labelWidth:180},
		{view:"text", label:"REALISASI FISIK BLN 4", name:"INDIPROG_REALISASI_FISIK_BLN4",		id:"INDIPROG_REALISASI_FISIK_BLN4", labelWidth:180},
		{view:"text", label:"REALISASI KINERJA BLN 5", name:"INDIPROG_REALISASI_KINERJA_BLN5",		id:"INDIPROG_REALISASI_KINERJA_BLN5", labelWidth:180},
		{view:"text", label:"REALISASI FISIK BLN 5", name:"INDIPROG_REALISASI_FISIK_BLN5",		id:"INDIPROG_REALISASI_FISIK_BLN5", labelWidth:180},
		{view:"text", label:"REALISASI KINERJA BLN 6", name:"INDIPROG_REALISASI_KINERJA_BLN6",		id:"INDIPROG_REALISASI_KINERJA_BLN6", labelWidth:180},
		{view:"text", label:"REALISASI FISIK BLN 6", name:"INDIPROG_REALISASI_FISIK_BLN6",		id:"INDIPROG_REALISASI_FISIK_BLN6", labelWidth:180},
		{view:"text", label:"REALISASI KINERJA BLN 7", name:"INDIPROG_REALISASI_KINERJA_BLN7",		id:"INDIPROG_REALISASI_KINERJA_BLN7", labelWidth:180},
		{view:"text", label:"REALISASI FISIK BLN 7", name:"INDIPROG_REALISASI_FISIK_BLN7",		id:"INDIPROG_REALISASI_FISIK_BLN7", labelWidth:180},
		{view:"text", label:"REALISASI KINERJA BLN 8", name:"INDIPROG_REALISASI_KINERJA_BLN8",		id:"INDIPROG_REALISASI_KINERJA_BLN8", labelWidth:180},
		{view:"text", label:"REALISASI FISIK BLN 8", name:"INDIPROG_REALISASI_FISIK_BLN8",		id:"INDIPROG_REALISASI_FISIK_BLN8", labelWidth:180},
		{view:"text", label:"REALISASI KINERJA BLN 9", name:"INDIPROG_REALISASI_KINERJA_BLN9",		id:"INDIPROG_REALISASI_KINERJA_BLN9", labelWidth:180},
		{view:"text", label:"REALISASI FISIK BLN 9", name:"INDIPROG_REALISASI_FISIK_BLN9",		id:"INDIPROG_REALISASI_FISIK_BLN9", labelWidth:180},
		{view:"text", label:"REALISASI KINERJA BLN 10", name:"INDIPROG_REALISASI_KINERJA_BLN10",	id:"INDIPROG_REALISASI_KINERJA_BLN10", labelWidth:180},
		{view:"text", label:"REALISASI FISIK BLN 10", name:"INDIPROG_REALISASI_FISIK_BLN10",		id:"INDIPROG_REALISASI_FISIK_BLN10", labelWidth:180},
		{view:"text", label:"REALISASI KINERJA BLN 11",	name:"INDIPROG_REALISASI_KINERJA_BLN11",	id:"INDIPROG_REALISASI_KINERJA_BLN11", labelWidth:180},
		{view:"text", label:"REALISASI FISIK BLN 11", name:"INDIPROG_REALISASI_FISIK_BLN11",		id:"INDIPROG_REALISASI_FISIK_BLN11", labelWidth:180},
		{view:"text", label:"REALISASI KINERJA BLN 12",	name:"INDIPROG_REALISASI_KINERJA_BLN12",	id:"INDIPROG_REALISASI_KINERJA_BLN12", labelWidth:180},
		{view:"text", label:"REALISASI FISIK BLN 12", name:"INDIPROG_REALISASI_FISIK_BLN12",		id:"INDIPROG_REALISASI_FISIK_BLN12", labelWidth:180},
		{view:"text", label:"CATATAN REJECT",	id:"INDIPROG_CATATAN_REJECT", name:"INDIPROG_CATATAN_REJECT",	labelWidth:180, disabled:true},
		{
			margin:5,
			cols:[
				{width:116},
				{view:"button", label:"Simpan", type:"form", align:"center", width:100, click:function(){					
					dataEditIndiProg();
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
		{view:"text", 			label:"TOTAL PAGU AKHIR PERIODE",	id:"2E-TOTAL PAGU", 				labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-1",					id:"2E-PAGU-1", 						labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-2",					id:"2E-PAGU-2", 						labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-3",					id:"2E-PAGU-3", 						labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-4",					id:"2E-PAGU-4", 						labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-5",					id:"2E-PAGU-5", 						labelWidth:180},
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

// form entri indikator kegiatan
var FORM_DATA21_EDIT = {
	view:"form",
	id:"FORM_ENTRY_INDI_KEG",
	borderless:true,
	scroll:"auto",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements:[
		{view:"textarea",	label:"INDIKATOR KEGIATAN", 	id:"INDIKEG_INDIKATOR_KEGIATAN", name:"INDIKEG_INDIKATOR_KEGIATAN",	labelWidth:180, disabled:true},
		{view:"text", 	 	label:"SATUAN INDIKATOR",	id:"INDIKEG_SATUAN_INDIKATOR_KEGIATAN", name:"INDIKEG_SATUAN_INDIKATOR_KEGIATAN", labelWidth:180, disabled:true},
		{view:"text", 		label:"TARGET KINERJA DPA", id:"INDIKEG_KINERJA_DPA_KEG", name:"INDIKEG_KINERJA_DPA_KEG", labelWidth:180, disabled:true},
		{view:"text", 		label:"TARGET KINERJA RENJA", id:"INDIKEG_KINERJA_RENJA_KEG", name:"INDIKEG_KINERJA_RENJA_KEG", labelWidth:180, disabled:true},

		{view:"text", label:"REALISASI KINERJA BLN 1", name:"INDIKEG_REALISASI_KINERJA_BLN1",		id:"INDIKEG_REALISASI_KINERJA_BLN1", labelWidth:180},
		{view:"text", label:"REALISASI FISIK BLN 1", name:"INDIKEG_REALISASI_FISIK_BLN1",		id:"INDIKEG_REALISASI_FISIK_BLN1", labelWidth:180},
		{view:"text", label:"REALISASI KINERJA BLN 2", name:"INDIKEG_REALISASI_KINERJA_BLN2",		id:"INDIKEG_REALISASI_KINERJA_BLN2", labelWidth:180},
		{view:"text", label:"REALISASI FISIK BLN 2", name:"INDIKEG_REALISASI_FISIK_BLN2",		id:"INDIKEG_REALISASI_FISIK_BLN2", labelWidth:180},
		{view:"text", label:"REALISASI KINERJA BLN 3", name:"INDIKEG_REALISASI_KINERJA_BLN3",		id:"INDIKEG_REALISASI_KINERJA_BLN3", labelWidth:180},
		{view:"text", label:"REALISASI FISIK BLN 3", name:"INDIKEG_REALISASI_FISIK_BLN3",		id:"INDIKEG_REALISASI_FISIK_BLN3", labelWidth:180},
		{view:"text", label:"REALISASI KINERJA BLN 4", name:"INDIKEG_REALISASI_KINERJA_BLN4",		id:"INDIKEG_REALISASI_KINERJA_BLN4", labelWidth:180},
		{view:"text", label:"REALISASI FISIK BLN 4", name:"INDIKEG_REALISASI_FISIK_BLN4",		id:"INDIKEG_REALISASI_FISIK_BLN4", labelWidth:180},
		{view:"text", label:"REALISASI KINERJA BLN 5", name:"INDIKEG_REALISASI_KINERJA_BLN5",		id:"INDIKEG_REALISASI_KINERJA_BLN5", labelWidth:180},
		{view:"text", label:"REALISASI FISIK BLN 5", name:"INDIKEG_REALISASI_FISIK_BLN5",		id:"INDIKEG_REALISASI_FISIK_BLN5", labelWidth:180},
		{view:"text", label:"REALISASI KINERJA BLN 6", name:"INDIKEG_REALISASI_KINERJA_BLN6",		id:"INDIKEG_REALISASI_KINERJA_BLN6", labelWidth:180},
		{view:"text", label:"REALISASI FISIK BLN 6", name:"INDIKEG_REALISASI_FISIK_BLN6",		id:"INDIKEG_REALISASI_FISIK_BLN6", labelWidth:180},
		{view:"text", label:"REALISASI KINERJA BLN 7", name:"INDIKEG_REALISASI_KINERJA_BLN7",		id:"INDIKEG_REALISASI_KINERJA_BLN7", labelWidth:180},
		{view:"text", label:"REALISASI FISIK BLN 7", name:"INDIKEG_REALISASI_FISIK_BLN7",		id:"INDIKEG_REALISASI_FISIK_BLN7", labelWidth:180},
		{view:"text", label:"REALISASI KINERJA BLN 8", name:"INDIKEG_REALISASI_KINERJA_BLN8",		id:"INDIKEG_REALISASI_KINERJA_BLN8", labelWidth:180},
		{view:"text", label:"REALISASI FISIK BLN 8", name:"INDIKEG_REALISASI_FISIK_BLN8",		id:"INDIKEG_REALISASI_FISIK_BLN8", labelWidth:180},
		{view:"text", label:"REALISASI KINERJA BLN 9", name:"INDIKEG_REALISASI_KINERJA_BLN9",		id:"INDIKEG_REALISASI_KINERJA_BLN9", labelWidth:180},
		{view:"text", label:"REALISASI FISIK BLN 9", name:"INDIKEG_REALISASI_FISIK_BLN9",		id:"INDIKEG_REALISASI_FISIK_BLN9", labelWidth:180},
		{view:"text", label:"REALISASI KINERJA BLN 10", name:"INDIKEG_REALISASI_KINERJA_BLN10",	id:"INDIKEG_REALISASI_KINERJA_BLN10", labelWidth:180},
		{view:"text", label:"REALISASI FISIK BLN 10", name:"INDIKEG_REALISASI_FISIK_BLN10",		id:"INDIKEG_REALISASI_FISIK_BLN10", labelWidth:180},
		{view:"text", label:"REALISASI KINERJA BLN 11",	name:"INDIKEG_REALISASI_KINERJA_BLN11",	id:"INDIKEG_REALISASI_KINERJA_BLN11", labelWidth:180},
		{view:"text", label:"REALISASI FISIK BLN 11", name:"INDIKEG_REALISASI_FISIK_BLN11",		id:"INDIKEG_REALISASI_FISIK_BLN11", labelWidth:180},
		{view:"text", label:"REALISASI KINERJA BLN 12",	name:"INDIKEG_REALISASI_KINERJA_BLN12",	id:"INDIKEG_REALISASI_KINERJA_BLN12", labelWidth:180},
		{view:"text", label:"REALISASI FISIK BLN 12", name:"INDIKEG_REALISASI_FISIK_BLN12",		id:"INDIKEG_REALISASI_FISIK_BLN12", labelWidth:180},
		{view:"textarea", label:"CATATAN REJECT",	id:"INDIKEG_CATATAN_REJECT", name:"INDIKEG_CATATAN_REJECT",	labelWidth:180, disabled:true},
		{
			margin:5,
			cols:[
				{width:116},
				{view:"button", label:"Simpan", type:"form", align:"center", width:100, click:function(){
					dataEditIndiKeg();
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
	id:"FORM_ENTRY_SUBKEG",
	borderless:true,
	scroll:"auto",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements:[
		{view:"text", label:"PAGU RENJA",	id:"SUBKEG_TARGET_PAGU_SUBKEG_RENJA", name:"SUBKEG_TARGET_PAGU_SUBKEG_RENJA", labelWidth:180, disabled:true},
		{view:"text", label:"ANGGARAN DPA",	id:"SUBKEG_TARGET_PAGU_SUBKEG_DPA", name:"SUBKEG_TARGET_PAGU_SUBKEG_DPA", labelWidth:180, disabled:true},

		{view:"text", label:"REALISASI ANGGARAN",		id:"SUBKEG_REALISASI_JUMLAH", name:"SUBKEG_REALISASI_JUMLAH", labelWidth:180, disabled:true},
		{view:"text", label:"REALISASI ANGGARAN BLN 1",	id:"SUBKEG_REALISASI_JUMLAH_BLN1", name:"SUBKEG_REALISASI_JUMLAH_BLN1", labelWidth:180},
		{view:"text", label:"REALISASI ANGGARAN BLN 2",	id:"SUBKEG_REALISASI_JUMLAH_BLN2", name:"SUBKEG_REALISASI_JUMLAH_BLN2", labelWidth:180},
		{view:"text", label:"REALISASI ANGGARAN BLN 3",	id:"SUBKEG_REALISASI_JUMLAH_BLN3", name:"SUBKEG_REALISASI_JUMLAH_BLN3", labelWidth:180},
		{view:"text", label:"REALISASI ANGGARAN BLN 4",	id:"SUBKEG_REALISASI_JUMLAH_BLN4", name:"SUBKEG_REALISASI_JUMLAH_BLN4", labelWidth:180},
		{view:"text", label:"REALISASI ANGGARAN BLN 5",	id:"SUBKEG_REALISASI_JUMLAH_BLN5", name:"SUBKEG_REALISASI_JUMLAH_BLN5", labelWidth:180},
		{view:"text", label:"REALISASI ANGGARAN BLN 6",	id:"SUBKEG_REALISASI_JUMLAH_BLN6", name:"SUBKEG_REALISASI_JUMLAH_BLN6", labelWidth:180},
		{view:"text", label:"REALISASI ANGGARAN BLN 7",	id:"SUBKEG_REALISASI_JUMLAH_BLN7", name:"SUBKEG_REALISASI_JUMLAH_BLN7", labelWidth:180},
		{view:"text", label:"REALISASI ANGGARAN BLN 8",	id:"SUBKEG_REALISASI_JUMLAH_BLN8", name:"SUBKEG_REALISASI_JUMLAH_BLN8", labelWidth:180},
		{view:"text", label:"REALISASI ANGGARAN BLN 9",	id:"SUBKEG_REALISASI_JUMLAH_BLN9", name:"SUBKEG_REALISASI_JUMLAH_BLN9", labelWidth:180},
		{view:"text", label:"REALISASI ANGGARAN BLN 10",	id:"SUBKEG_REALISASI_JUMLAH_BLN10", name:"SUBKEG_REALISASI_JUMLAH_BLN10", labelWidth:180},
		{view:"text", label:"REALISASI ANGGARAN BLN 11",	id:"SUBKEG_REALISASI_JUMLAH_BLN11", name:"SUBKEG_REALISASI_JUMLAH_BLN11", labelWidth:180},
		{view:"text", label:"REALISASI ANGGARAN BLN 12",	id:"SUBKEG_REALISASI_JUMLAH_BLN12", name:"SUBKEG_REALISASI_JUMLAH_BLN12", labelWidth:180},

		{view:"textarea", label:"CATATAN REJECT", id:"SUBKEG_CATATAN_REJECT", name:"SUBKEG_CATATAN_REJECT",	labelWidth:180, disabled:true},
		{
			margin:5,
			cols:[
				{width:116},
				{view:"button", label:"Simpan", type:"form", align:"center", width:100, click:function(){
					dataEditSubKeg();
				}},
				{view:"button", label:"Cancel", align:"center", width:100, click:function(){
					$$("WIN_DATA3_EDIT").hide();
				}},
				{}
			]
		}
	]
};

// form entry indikator sub kegiatan
var FORM_DATA31_EDIT = {
	view:"form",
	id:"FORM_ENTRY_INDI_SUBKEG",
	borderless:true,
	scroll:"auto",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements:[
		{view:"textarea",	label:"INDIKATOR SUB KEGIATAN", id:"INDISUBKEG_INDIKATOR_SUBKEGIATAN", name:"INDISUBKEG_INDIKATOR_SUBKEGIATAN",	labelWidth:180, disabled:true},
		{view:"text", label:"SATUAN INDIKATOR",	id:"INDISUBKEG_SATUAN_INDIKATOR_SUBKEGIATAN", name:"INDISUBKEG_SATUAN_INDIKATOR_SUBKEGIATAN", labelWidth:180, disabled:true},
		{view:"text", label:"TARGET KINERJA DPA", id:"INDISUBKEG_KINERJA_DPA_SUBKEG", name:"INDISUBKEG_KINERJA_DPA_SUBKEG", labelWidth:180, disabled:true},
		{view:"text", label:"TARGET KINERJA RENJA", id:"INDISUBKEG_KINERJA_RENJA_SUBKEG", name:"INDISUBKEG_KINERJA_RENJA_SUBKEG", labelWidth:180, disabled:true},

		{view:"text", label:"REALISASI KINERJA BLN 1", name:"INDISUBKEG_REALISASI_KINERJA_BLN1",		id:"INDISUBKEG_REALISASI_KINERJA_BLN1", labelWidth:180},
		{view:"text", label:"REALISASI FISIK BLN 1", name:"INDISUBKEG_REALISASI_FISIK_BLN1",		id:"INDISUBKEG_REALISASI_FISIK_BLN1", labelWidth:180},
		{view:"text", label:"REALISASI KINERJA BLN 2", name:"INDISUBKEG_REALISASI_KINERJA_BLN2",		id:"INDISUBKEG_REALISASI_KINERJA_BLN2", labelWidth:180},
		{view:"text", label:"REALISASI FISIK BLN 2", name:"INDISUBKEG_REALISASI_FISIK_BLN2",		id:"INDISUBKEG_REALISASI_FISIK_BLN2", labelWidth:180},
		{view:"text", label:"REALISASI KINERJA BLN 3", name:"INDISUBKEG_REALISASI_KINERJA_BLN3",		id:"INDISUBKEG_REALISASI_KINERJA_BLN3", labelWidth:180},
		{view:"text", label:"REALISASI FISIK BLN 3", name:"INDISUBKEG_REALISASI_FISIK_BLN3",		id:"INDISUBKEG_REALISASI_FISIK_BLN3", labelWidth:180},
		{view:"text", label:"REALISASI KINERJA BLN 4", name:"INDISUBKEG_REALISASI_KINERJA_BLN4",		id:"INDISUBKEG_REALISASI_KINERJA_BLN4", labelWidth:180},
		{view:"text", label:"REALISASI FISIK BLN 4", name:"INDISUBKEG_REALISASI_FISIK_BLN4",		id:"INDISUBKEG_REALISASI_FISIK_BLN4", labelWidth:180},
		{view:"text", label:"REALISASI KINERJA BLN 5", name:"INDISUBKEG_REALISASI_KINERJA_BLN5",		id:"INDISUBKEG_REALISASI_KINERJA_BLN5", labelWidth:180},
		{view:"text", label:"REALISASI FISIK BLN 5", name:"INDISUBKEG_REALISASI_FISIK_BLN5",		id:"INDISUBKEG_REALISASI_FISIK_BLN5", labelWidth:180},
		{view:"text", label:"REALISASI KINERJA BLN 6", name:"INDISUBKEG_REALISASI_KINERJA_BLN6",		id:"INDISUBKEG_REALISASI_KINERJA_BLN6", labelWidth:180},
		{view:"text", label:"REALISASI FISIK BLN 6", name:"INDISUBKEG_REALISASI_FISIK_BLN6",		id:"INDISUBKEG_REALISASI_FISIK_BLN6", labelWidth:180},
		{view:"text", label:"REALISASI KINERJA BLN 7", name:"INDISUBKEG_REALISASI_KINERJA_BLN7",		id:"INDISUBKEG_REALISASI_KINERJA_BLN7", labelWidth:180},
		{view:"text", label:"REALISASI FISIK BLN 7", name:"INDISUBKEG_REALISASI_FISIK_BLN7",		id:"INDISUBKEG_REALISASI_FISIK_BLN7", labelWidth:180},
		{view:"text", label:"REALISASI KINERJA BLN 8", name:"INDISUBKEG_REALISASI_KINERJA_BLN8",		id:"INDISUBKEG_REALISASI_KINERJA_BLN8", labelWidth:180},
		{view:"text", label:"REALISASI FISIK BLN 8", name:"INDISUBKEG_REALISASI_FISIK_BLN8",		id:"INDISUBKEG_REALISASI_FISIK_BLN8", labelWidth:180},
		{view:"text", label:"REALISASI KINERJA BLN 9", name:"INDISUBKEG_REALISASI_KINERJA_BLN9",		id:"INDISUBKEG_REALISASI_KINERJA_BLN9", labelWidth:180},
		{view:"text", label:"REALISASI FISIK BLN 9", name:"INDISUBKEG_REALISASI_FISIK_BLN9",		id:"INDISUBKEG_REALISASI_FISIK_BLN9", labelWidth:180},
		{view:"text", label:"REALISASI KINERJA BLN 10", name:"INDISUBKEG_REALISASI_KINERJA_BLN10",	id:"INDISUBKEG_REALISASI_KINERJA_BLN10", labelWidth:180},
		{view:"text", label:"REALISASI FISIK BLN 10", name:"INDISUBKEG_REALISASI_FISIK_BLN10",		id:"INDISUBKEG_REALISASI_FISIK_BLN10", labelWidth:180},
		{view:"text", label:"REALISASI KINERJA BLN 11",	name:"INDISUBKEG_REALISASI_KINERJA_BLN11",	id:"INDISUBKEG_REALISASI_KINERJA_BLN11", labelWidth:180},
		{view:"text", label:"REALISASI FISIK BLN 11", name:"INDISUBKEG_REALISASI_FISIK_BLN11",		id:"INDISUBKEG_REALISASI_FISIK_BLN11", labelWidth:180},
		{view:"text", label:"REALISASI KINERJA BLN 12",	name:"INDISUBKEG_REALISASI_KINERJA_BLN12",	id:"INDISUBKEG_REALISASI_KINERJA_BLN12", labelWidth:180},
		{view:"text", label:"REALISASI FISIK BLN 12", name:"INDISUBKEG_REALISASI_FISIK_BLN12",		id:"INDISUBKEG_REALISASI_FISIK_BLN12", labelWidth:180},
		{view:"textarea", label:"CATATAN REJECT",	id:"INDISUBKEG_CATATAN_REJECT", name:"INDISUBKEG_CATATAN_REJECT",	labelWidth:180, disabled:true},
		{
			margin:5,
			cols:[
				{width:116},
				{view:"button", label:"Simpan", type:"form", align:"center", width:100, click:function(){
					dataEditIndiSubKeg();
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


// init public var
var id_opd 	  = 0;
// var id_keg 	  = 0;
var from = 0;
var numr = 0;
var page = 0;
var perp = 0;
var numA = 0;
var numB = 0;

function showWindow(winId, node){
	$$(winId).getBody().clear();
	$$(winId).show(node);
	$$(winId).getBody().focus();
}

function filterData(){
	from = 0;
	$$('PAGER_REALISASI').select(0);
	getData();
}

//GET DATA 
function getData(){

	var URUSAN_TXT     		= $$('URUSAN_TXT').getValue();
	var BIDANG_URUSAN_TXT   = $$('BIDANG_URUSAN_TXT').getValue();
	var OPD_TXT        		= $$('OPD_TXT').getValue();
	var SUBOPD_TXT 			= $$('SUBOPD_TXT').getValue();
	
	if ($$("URUSAN_CB").getValue()==0) 			{URUSAN_TXT = "";}
	if ($$("BIDANG_URUSAN_CB").getValue()==0) 	{BIDANG_URUSAN_TXT = "";}
	if ($$("OPD_CB").getValue()==0)        		{OPD_TXT = "";}
	if ($$("SUBOPD_CB").getValue()==0)      	{SUBOPD_TXT = "";}
	
	var param = "?";
	param += "URUSAN_TXT="+ URUSAN_TXT; 							param += "&";
	param += "BIDANG_URUSAN_TXT="+ BIDANG_URUSAN_TXT; 				param += "&";
	param += "OPD_TXT="+ OPD_TXT; 									param += "&";
	param += "SUBOPD_TXT="+ SUBOPD_TXT; 							param += "&";
	param += "from="+ from; 												
	param += "&";
	
	// console.log(param);
		
	webix.ajax().post("evaluasi_realisasi_entri_realisasi_t1_data.php"+ param +"mode=paging", function(text, data){
		if (data.json().status=="success"){
			// console.log(data.json().where);

			numr = data.json().numr;
			page = data.json().page;
			perp = data.json().perp;
			//webix.message(numr);
			if (numr==0){
				$$("DTRealisasiEntriProgTw1").clearAll();
				$$("DTRealisasiEntriProgTw1").refresh();
				$$('PAGER_REALISASI').hide();
				$$('PAGER_REALISASI').refresh();
				$$('PAGER_INFO').define("label", "<text style='font-size:13px; float:left;'>0 - 0 / 0 Data </text>");
				$$('PAGER_INFO').refresh();	
			} else {
				// console.log(numr);
				$$("DTRealisasiEntriProgTw1").clearAll();
				$$("DTRealisasiEntriProgTw1").refresh();
				$$("DTRealisasiEntriProgTw1").load("evaluasi_realisasi_entri_realisasi_t1_data.php"+ param+"mode=pagingx");
				$$('PAGER_REALISASI').show();
				$$('PAGER_REALISASI').define("count", numr);
				$$('PAGER_REALISASI').define("template", "{common.first()}{common.prev()}{common.pages()}{common.next()}{common.last()} <text style='color:white;'> {common.page()} / #limit# Halaman </text>");
				$$('PAGER_REALISASI').refresh();
				numA = from + 1;
				numB = from + perp;
				if (numB > numr) {numB = from + (numr - from);}
				$$('PAGER_INFO').define("label", "<text style='font-size:13px; float:right;'>"+ numA +" - "+ numB +" / "+ numr +" Data </text>");
				$$('PAGER_INFO').refresh();
			}
		} else {
			// $$("DT_PROG").load("perencanaan_renstra_entri_murni_data.php"+ param +"mode=paging");
			webix.alert({
				type:"alert-error",
				title: "INFORMATION",
				text: "Error get data !!",
				ok:"OK",
				callback:function(){}
			});
		}
	});
} 


// bind data
function bindProgFormEdit(){
	// indikator program
	$$('FORM_ENTRY_INDI_PROG').bind('DTRealisasiEntriIndiProgTw1');

	// indikator kegiatan
	$$('FORM_ENTRY_INDI_KEG').bind('DTRealisasiEntriIndiKegTw1');

	// sub kegiatan
	$$('FORM_ENTRY_SUBKEG').bind('DTRealisasiEntriSubkegTw1');
	$$('FORM_ENTRY_INDI_SUBKEG').bind('DTRealisasiEntriIndiSubKegTw1');

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

// entri realisasi indikator kinerja program
var temp_FORM_ENTRY_INDI_PROG = {};
function editData11(){
	showWindow("WIN_DATA11_EDIT");
	if ($$("FORM_ENTRY_INDI_PROG").getValues().INDIPROG_ROW_ID > 0) {
		temp_FORM_ENTRY_INDI_PROG = $$("FORM_ENTRY_INDI_PROG").getValues();
	} else{
		$$("FORM_ENTRY_INDI_PROG").setValues(temp_FORM_ENTRY_INDI_PROG);
	}
}

// validasi manual entri indikator program
function validasiIndikatorProg(){
	var data = $$("FORM_ENTRY_INDI_PROG").getValues();
	if (!webix.rules.isNumber( data.INDIPROG_REALISASI_KINERJA_BLN1 )) return false;
	if (!webix.rules.isNumber( data.INDIPROG_REALISASI_KINERJA_BLN2 )) return false;
	if (!webix.rules.isNumber( data.INDIPROG_REALISASI_KINERJA_BLN3 )) return false;
	if (!webix.rules.isNumber( data.INDIPROG_REALISASI_KINERJA_BLN4 )) return false;
	if (!webix.rules.isNumber( data.INDIPROG_REALISASI_KINERJA_BLN5 )) return false;
	if (!webix.rules.isNumber( data.INDIPROG_REALISASI_KINERJA_BLN6 )) return false;
	if (!webix.rules.isNumber( data.INDIPROG_REALISASI_KINERJA_BLN7 )) return false;
	if (!webix.rules.isNumber( data.INDIPROG_REALISASI_KINERJA_BLN8 )) return false;
	if (!webix.rules.isNumber( data.INDIPROG_REALISASI_KINERJA_BLN9 )) return false;
	if (!webix.rules.isNumber( data.INDIPROG_REALISASI_KINERJA_BLN10 )) return false;
	if (!webix.rules.isNumber( data.INDIPROG_REALISASI_KINERJA_BLN11 )) return false;
	if (!webix.rules.isNumber( data.INDIPROG_REALISASI_KINERJA_BLN12 )) return false;
	if (!webix.rules.isNumber( data.INDIPROG_REALISASI_FISIK_BLN1 )) return false;
	if (!webix.rules.isNumber( data.INDIPROG_REALISASI_FISIK_BLN2 )) return false;
	if (!webix.rules.isNumber( data.INDIPROG_REALISASI_FISIK_BLN3 )) return false;
	if (!webix.rules.isNumber( data.INDIPROG_REALISASI_FISIK_BLN4 )) return false;
	if (!webix.rules.isNumber( data.INDIPROG_REALISASI_FISIK_BLN5 )) return false;
	if (!webix.rules.isNumber( data.INDIPROG_REALISASI_FISIK_BLN6 )) return false;
	if (!webix.rules.isNumber( data.INDIPROG_REALISASI_FISIK_BLN7 )) return false;
	if (!webix.rules.isNumber( data.INDIPROG_REALISASI_FISIK_BLN8 )) return false;
	if (!webix.rules.isNumber( data.INDIPROG_REALISASI_FISIK_BLN9 )) return false;
	if (!webix.rules.isNumber( data.INDIPROG_REALISASI_FISIK_BLN10 )) return false;
	if (!webix.rules.isNumber( data.INDIPROG_REALISASI_FISIK_BLN11 )) return false;
	if (!webix.rules.isNumber( data.INDIPROG_REALISASI_FISIK_BLN12 )) return false;
	return true;
}


// tombol simpan form indikator program
function dataEditIndiProg(){
	// console.log("simpan indikator program");
	if  (validasiIndikatorProg()) {
		// proses simpan
		var param1 = $$("FORM_ENTRY_INDI_PROG").getValues();
		// console.log(param1)
		webix.ajax().post("evaluasi_realisasi_entri_realisasi_t1_update.php?lvl=indiprog",{param1:param1}, function(text, data){
			if (data.json().status=="success"){
				webix.message({type:"form", text:"<div style='background-color:#24c066; color:#fff; margin:-6px -11px -6px -11px;'><span class='webix_icon fa-check-square-o'></span>Data Berhasil Diedit.</div>"});
					// console.log("realisasi indikator program");
					// console.log(data.json().sqltes);
				$$("WIN_DATA11_EDIT").hide();
				$$("DTRealisasiEntriIndiProgTw1").clearAll();
				$$("DTRealisasiEntriIndiProgTw1").load(function(){
				    return webix.ajax().post("evaluasi_realisasi_entri_realisasi_t1_data_child.php?lvl=indiprog",{rowid:param1.INDIPROG_PRT_ID},function(text, data){
				    	
				    })
				});
			} else {
				webix.alert({
					type:"alert-error",
					title: "INFORMATION",
					text:"Data Tidak Berhasil Diedit!! "+data.json().status,
					ok:"OK",
					callback:function(){}
				});
			}
		});
		
	}else{
		// console.log("isi data dengan angka saja");
		webix.message({ type:"error", text:"isi data dengan angka saja" });
	}
}

// akhir indikator program


// entri realisasi indikator kinerja kegiatan

var temp_FORM_ENTRY_INDI_KEG = {};
function editData21(){
	showWindow("WIN_DATA21_EDIT");
	if ($$("FORM_ENTRY_INDI_KEG").getValues().INDIKEG_ROW_ID > 0) {
		temp_FORM_ENTRY_INDI_KEG = $$("FORM_ENTRY_INDI_KEG").getValues();
	} else{
		$$("FORM_ENTRY_INDI_KEG").setValues(temp_FORM_ENTRY_INDI_KEG);
	}
}

// validasi manual entri indikator Kegiatan
function validasiIndikatorKeg(){
	var data = $$("FORM_ENTRY_INDI_KEG").getValues();
	if (!webix.rules.isNumber( data.INDIKEG_REALISASI_KINERJA_BLN1 )) return false;
	if (!webix.rules.isNumber( data.INDIKEG_REALISASI_KINERJA_BLN2 )) return false;
	if (!webix.rules.isNumber( data.INDIKEG_REALISASI_KINERJA_BLN3 )) return false;
	if (!webix.rules.isNumber( data.INDIKEG_REALISASI_KINERJA_BLN4 )) return false;
	if (!webix.rules.isNumber( data.INDIKEG_REALISASI_KINERJA_BLN5 )) return false;
	if (!webix.rules.isNumber( data.INDIKEG_REALISASI_KINERJA_BLN6 )) return false;
	if (!webix.rules.isNumber( data.INDIKEG_REALISASI_KINERJA_BLN7 )) return false;
	if (!webix.rules.isNumber( data.INDIKEG_REALISASI_KINERJA_BLN8 )) return false;
	if (!webix.rules.isNumber( data.INDIKEG_REALISASI_KINERJA_BLN9 )) return false;
	if (!webix.rules.isNumber( data.INDIKEG_REALISASI_KINERJA_BLN10 )) return false;
	if (!webix.rules.isNumber( data.INDIKEG_REALISASI_KINERJA_BLN11 )) return false;
	if (!webix.rules.isNumber( data.INDIKEG_REALISASI_KINERJA_BLN12 )) return false;
	if (!webix.rules.isNumber( data.INDIKEG_REALISASI_FISIK_BLN1 )) return false;
	if (!webix.rules.isNumber( data.INDIKEG_REALISASI_FISIK_BLN2 )) return false;
	if (!webix.rules.isNumber( data.INDIKEG_REALISASI_FISIK_BLN3 )) return false;
	if (!webix.rules.isNumber( data.INDIKEG_REALISASI_FISIK_BLN4 )) return false;
	if (!webix.rules.isNumber( data.INDIKEG_REALISASI_FISIK_BLN5 )) return false;
	if (!webix.rules.isNumber( data.INDIKEG_REALISASI_FISIK_BLN6 )) return false;
	if (!webix.rules.isNumber( data.INDIKEG_REALISASI_FISIK_BLN7 )) return false;
	if (!webix.rules.isNumber( data.INDIKEG_REALISASI_FISIK_BLN8 )) return false;
	if (!webix.rules.isNumber( data.INDIKEG_REALISASI_FISIK_BLN9 )) return false;
	if (!webix.rules.isNumber( data.INDIKEG_REALISASI_FISIK_BLN10 )) return false;
	if (!webix.rules.isNumber( data.INDIKEG_REALISASI_FISIK_BLN11 )) return false;
	if (!webix.rules.isNumber( data.INDIKEG_REALISASI_FISIK_BLN12 )) return false;
	return true;
}

// tombol simpan form indikator kegiatan
function dataEditIndiKeg(){
	// console.log("simpan indikator kegiatan");
	// console.log($$("FORM_ENTRY_INDI_KEG").getValues());

	if  (validasiIndikatorKeg()) {
		// proses simpan
		var param1 = $$("FORM_ENTRY_INDI_KEG").getValues();
		// console.log(param1)
		webix.ajax().post("evaluasi_realisasi_entri_realisasi_t1_update.php?lvl=indikeg",{param1:param1}, function(text, data){
			if (data.json().status=="success"){
				webix.message({type:"form", text:"<div style='background-color:#24c066; color:#fff; margin:-6px -11px -6px -11px;'><span class='webix_icon fa-check-square-o'></span>Data Berhasil Diedit.</div>"});
					// console.log("realisasi indikator program");
					// console.log(data.json().sqltes);
				$$("WIN_DATA21_EDIT").hide();
				$$("DTRealisasiEntriIndiKegTw1").clearAll();
				$$("DTRealisasiEntriIndiKegTw1").load(function(){
				    return webix.ajax().post("evaluasi_realisasi_entri_realisasi_t1_data_child.php?lvl=indikeg",{rowid:param1.INDIKEG_PRT_ID},function(text, data){
				    	
				    })
				});
			} else {
				webix.alert({
					type:"alert-error",
					title: "INFORMATION",
					text:"Data Tidak Berhasil Diedit!! "+data.json().status,
					ok:"OK",
					callback:function(){}
				});
			}
		});
		
	}else{
		// console.log("isi data dengan angka saja");
		webix.message({ type:"error", text:"isi data dengan angka saja" });
	}
}

// akhir indikator kegiatan


// entri realisasi indikator kinerja sub kegiatan

var temp_FORM_ENTRY_INDI_SUBKEG = {};
function editData31(){
	showWindow("WIN_DATA31_EDIT");
	if ($$("FORM_ENTRY_INDI_SUBKEG").getValues().INDISUBKEG_ROW_ID > 0) {
		temp_FORM_ENTRY_INDI_SUBKEG = $$("FORM_ENTRY_INDI_SUBKEG").getValues();
	} else{
		$$("FORM_ENTRY_INDI_SUBKEG").setValues(temp_FORM_ENTRY_INDI_SUBKEG);
	}
}

// validasi manual entri indikator sub Kegiatan
function validasiIndikatorSubKeg(){
	var data = $$("FORM_ENTRY_INDI_SUBKEG").getValues();
	if (!webix.rules.isNumber( data.INDISUBKEG_REALISASI_KINERJA_BLN1 )) return false;
	if (!webix.rules.isNumber( data.INDISUBKEG_REALISASI_KINERJA_BLN2 )) return false;
	if (!webix.rules.isNumber( data.INDISUBKEG_REALISASI_KINERJA_BLN3 )) return false;
	if (!webix.rules.isNumber( data.INDISUBKEG_REALISASI_KINERJA_BLN4 )) return false;
	if (!webix.rules.isNumber( data.INDISUBKEG_REALISASI_KINERJA_BLN5 )) return false;
	if (!webix.rules.isNumber( data.INDISUBKEG_REALISASI_KINERJA_BLN6 )) return false;
	if (!webix.rules.isNumber( data.INDISUBKEG_REALISASI_KINERJA_BLN7 )) return false;
	if (!webix.rules.isNumber( data.INDISUBKEG_REALISASI_KINERJA_BLN8 )) return false;
	if (!webix.rules.isNumber( data.INDISUBKEG_REALISASI_KINERJA_BLN9 )) return false;
	if (!webix.rules.isNumber( data.INDISUBKEG_REALISASI_KINERJA_BLN10 )) return false;
	if (!webix.rules.isNumber( data.INDISUBKEG_REALISASI_KINERJA_BLN11 )) return false;
	if (!webix.rules.isNumber( data.INDISUBKEG_REALISASI_KINERJA_BLN12 )) return false;
	if (!webix.rules.isNumber( data.INDISUBKEG_REALISASI_FISIK_BLN1 )) return false;
	if (!webix.rules.isNumber( data.INDISUBKEG_REALISASI_FISIK_BLN2 )) return false;
	if (!webix.rules.isNumber( data.INDISUBKEG_REALISASI_FISIK_BLN3 )) return false;
	if (!webix.rules.isNumber( data.INDISUBKEG_REALISASI_FISIK_BLN4 )) return false;
	if (!webix.rules.isNumber( data.INDISUBKEG_REALISASI_FISIK_BLN5 )) return false;
	if (!webix.rules.isNumber( data.INDISUBKEG_REALISASI_FISIK_BLN6 )) return false;
	if (!webix.rules.isNumber( data.INDISUBKEG_REALISASI_FISIK_BLN7 )) return false;
	if (!webix.rules.isNumber( data.INDISUBKEG_REALISASI_FISIK_BLN8 )) return false;
	if (!webix.rules.isNumber( data.INDISUBKEG_REALISASI_FISIK_BLN9 )) return false;
	if (!webix.rules.isNumber( data.INDISUBKEG_REALISASI_FISIK_BLN10 )) return false;
	if (!webix.rules.isNumber( data.INDISUBKEG_REALISASI_FISIK_BLN11 )) return false;
	if (!webix.rules.isNumber( data.INDISUBKEG_REALISASI_FISIK_BLN12 )) return false;
	return true;
}


// tombol simpan form indikator kegiatan
function dataEditIndiSubKeg(){
	// console.log("simpan indikator sub kegiatan");
	// console.log($$("FORM_ENTRY_INDI_SUBKEG").getValues());


	if  (validasiIndikatorSubKeg()) {
		// proses simpan
		var param1 = $$("FORM_ENTRY_INDI_SUBKEG").getValues();
		// console.log(param1)
		webix.ajax().post("evaluasi_realisasi_entri_realisasi_t1_update.php?lvl=indisubkeg",{param1:param1}, function(text, data){
			if (data.json().status=="success"){
				webix.message({type:"form", text:"<div style='background-color:#24c066; color:#fff; margin:-6px -11px -6px -11px;'><span class='webix_icon fa-check-square-o'></span>Data Berhasil Di-input.</div>"});
					// console.log("realisasi indikator program");
					// console.log(data.json().sqltes);
				$$("WIN_DATA31_EDIT").hide();
				$$("DTRealisasiEntriIndiSubKegTw1").clearAll();
				$$("DTRealisasiEntriIndiSubKegTw1").load(function(){
				    return webix.ajax().post("evaluasi_realisasi_entri_realisasi_t1_data_child.php?lvl=indisubkeg",{rowid:param1.INDISUBKEG_PRT_ID},function(text, data){
				    	
				    })
				});
			} else {
				webix.alert({
					type:"alert-error",
					title: "INFORMATION",
					text:"Data Tidak Berhasil Di-input!! "+data.json().status,
					ok:"OK",
					callback:function(){}
				});
			}
		});
		
	}else{
		// console.log("isi data dengan angka saja");
		webix.message({ type:"error", text:"isi data dengan angka saja" });
	}
}
// akhir indikator sub kegiatan


// entri sub kegiatan

var temp_FORM_ENTRY_SUBKEG = {};
function editData3(){
	showWindow("WIN_DATA3_EDIT");
	if ($$("FORM_ENTRY_SUBKEG").getValues().SUBKEG_ROW_ID > 0) {
		temp_FORM_ENTRY_SUBKEG = $$("FORM_ENTRY_SUBKEG").getValues();
	} else{
		$$("FORM_ENTRY_SUBKEG").setValues(temp_FORM_ENTRY_SUBKEG);
	}
}


// validasi manual entri sub Kegiatan
function validasiSubKeg(){
	var data = $$("FORM_ENTRY_SUBKEG").getValues();
	if (!webix.rules.isNumber( data.SUBKEG_REALISASI_JUMLAH_BLN1 )) return false;
	if (!webix.rules.isNumber( data.SUBKEG_REALISASI_JUMLAH_BLN2 )) return false;
	if (!webix.rules.isNumber( data.SUBKEG_REALISASI_JUMLAH_BLN3 )) return false;
	if (!webix.rules.isNumber( data.SUBKEG_REALISASI_JUMLAH_BLN4 )) return false;
	if (!webix.rules.isNumber( data.SUBKEG_REALISASI_JUMLAH_BLN5 )) return false;
	if (!webix.rules.isNumber( data.SUBKEG_REALISASI_JUMLAH_BLN6 )) return false;
	if (!webix.rules.isNumber( data.SUBKEG_REALISASI_JUMLAH_BLN7 )) return false;
	if (!webix.rules.isNumber( data.SUBKEG_REALISASI_JUMLAH_BLN8 )) return false;
	if (!webix.rules.isNumber( data.SUBKEG_REALISASI_JUMLAH_BLN9 )) return false;
	if (!webix.rules.isNumber( data.SUBKEG_REALISASI_JUMLAH_BLN10 )) return false;
	if (!webix.rules.isNumber( data.SUBKEG_REALISASI_JUMLAH_BLN11 )) return false;
	if (!webix.rules.isNumber( data.SUBKEG_REALISASI_JUMLAH_BLN12 )) return false;
	
	return true;
}

// tombol simpan form indikator kegiatan
function dataEditSubKeg(){
	// console.log("simpan sub kegiatan");
	// console.log($$("FORM_ENTRY_SUBKEG").getValues());

	if  (validasiSubKeg()) {
		// proses simpan
		var param1 = $$("FORM_ENTRY_SUBKEG").getValues();
		// console.log(param1)
		webix.ajax().post("evaluasi_realisasi_entri_realisasi_t1_update.php?lvl=subkeg",{param1:param1}, function(text, data){
			if (data.json().status=="success"){
				webix.message({type:"form", text:"<div style='background-color:#24c066; color:#fff; margin:-6px -11px -6px -11px;'><span class='webix_icon fa-check-square-o'></span>Data Berhasil Di-input.</div>"});
					// console.log("realisasi indikator program");
					// console.log(data.json().sqltes);
				$$("WIN_DATA3_EDIT").hide();
				$$("DTRealisasiEntriSubkegTw1").clearAll();
				$$("DTRealisasiEntriSubkegTw1").load(function(){
				    return webix.ajax().post("evaluasi_realisasi_entri_realisasi_t1_data_child.php?lvl=subkegiatan",{rowid:param1.SUBKEG_PRT_ID},function(text, data){
				    	
				    })
				});

				$$("DTRealisasiEntriKegTw1").clearAll();
				$$("DTRealisasiEntriKegTw1").load(function(){
				    return webix.ajax().post("evaluasi_realisasi_entri_realisasi_t1_data_child.php?lvl=kegiatan",{rowid:param1.SUBKEG_PRTPRT_ID},function(text, data){
				    })
				});
				getData();

			} else {
				webix.alert({
					type:"alert-error",
					title: "INFORMATION",
					text:"Data Tidak Berhasil Di-input!! "+data.json().status,
					ok:"OK",
					callback:function(){}
				});
			}
		});
		
	}else{
		// console.log("isi data dengan angka saja");
		webix.message({ type:"error", text:"isi data dengan angka saja" });
	}

}
// akhir entri sub kegiatan


function editData2(){
	showWindow("WIN_DATA2_EDIT");
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