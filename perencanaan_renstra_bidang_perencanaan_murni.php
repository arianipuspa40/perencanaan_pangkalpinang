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

var combo_sasaran_daerah 	= <?php include ('combo_sasaran_daerah.php');	?>;
var combo_tujuan_pd 		= <?php include ('combo_tujuan_pd.php');	?>;
var combo_sasaran_pd 		= <?php include ('combo_sasaran_pd.php');	?>;
var combo_bidang_opd 		= <?php include ('combo_bidang_opd.php');	?>;
var combo_program			= <?php include ('combo_program.php');		?>;
// console.log(combo_program);

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
								{view:"checkbox", label:"SASARAN PD", id:"SASARAN_PD_CB", labelWidth:140, width:170, click:"filterData()"},
								{view:"text", id:"SASARAN_PD_TXT", width:400}, {},
								{view:"checkbox", label:"PAGU TAHUN 1", id:"PAGU TAHUN 2CB", labelWidth:140, width:170},
								{view:"text", id:"PAGU_TAHUN_1TXT", width:400}
							],
						},
						{
							cols:[
								{view:"checkbox", label:"OPD", id:"OPD_CB", labelWidth:140, width:170, click:"filterData()"},
								{view:"text", id:"OPD_TXT", width:400}, {},
								{view:"checkbox", label:"PAGU TAHUN 2", id:"PAGU TAHUN 2CB", labelWidth:140, width:170},
								{view:"text", id:"PAGU_TAHUN_2TXT", width:400}
							],
						},
						{
							cols:[
								{view:"checkbox", label:"SUB OPD", id:"SUB_OPD_CB", labelWidth:140, width:170, click:"filterData()"},
								{view:"text", id:"SUB_OPD_TXT", width:400}, {},
								{view:"checkbox", label:"PAGU TAHUN 3", id:"PAGU TAHUN 3CB", labelWidth:140, width:170},
								{view:"text", id:"PAGU_TAHUN_3TXT", width:400}
							],
						},
						{
							cols:[
								{view:"checkbox", label:"PROGRAM", id:"DESKRIPSI_CB", labelWidth:140, width:170, click:"filterData()"},
								{view:"text", id:"DESKRIPSI_TXT", width:400}, {},
								{view:"checkbox", label:"PAGU TAHUN 4", id:"PAGU TAHUN 4CB", labelWidth:140, width:170},
								{view:"text", id:"PAGU_TAHUN_4TXT", width:400}
							],
						},
						{
							cols:[
								{view:"checkbox", label:"STATUS RENSTRA", id:"STATUS_RENSTRA_CB", labelWidth:140, width:170, click:"filterData()"},
								{view:"text", id:"STATUS_RENSTRA_TXT", width:400}, {},
								{view:"checkbox", label:"PAGU TAHUN 5", id:"PAGU TAHUN 5CB", labelWidth:140, width:170},
								{view:"text", id:"PAGU_TAHUN_5TXT", width:400}
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
		// {view:"button", type:"iconButton", icon:"plus-circle", label:"TAMBAH", autowidth:true, click:"addData1()"},
		{view:"button", type:"iconButton", icon:"edit", label:"TAMBAH CATATAN", autowidth:true, click:"editData1()"},
		// {view:"button", type:"iconButton", icon:"trash-o", label:"DELETE", autowidth:true, click:"deleteData1()"},
	]
};
var program = {
	view:"datatable", id:"DT_PROG",resizeColumn:true, navigation:true,
	select:true, css:"datatable_column", height:300,
	scheme:{
		$change:function(item){
			if (item.CATATAN_REJECT.trim().length > 1)
				item.$css = "highlight";
		}
	},
	columns:[
		{header:"#", 						id:"ROW_ID", 				hidden:true},		
		{header:"No", 						id:"NO", 	width:35, 	css:{'text-align':'right'}},
		{header:"KODE PROGRAM", 		    id:"KODE_PROGRAM_LENGKAP", width:70, 	css:{'text-align':'left'}},
		{header:"PROGRAM", 					id:"DESKRIPSI", 					    width:400, 	css:{'text-align':'left'}},
		{header:"TARGET AKHIR PAGU", 		id:"TARGET_AKHIR_PAGU_PROGRAM", width:150, 	css:{'text-align':'right'},format:webix.Number.numToStr({groupDelimiter:".", groupSize:3,decimalDelimiter:",",decimalSize:0})},			
		{header:"PAGU TAHUN KE-1", 			id:"TARGET_PAGU_PROG_TAHUN1",   width:150, 	css:{'text-align':'right'},format:webix.Number.numToStr({groupDelimiter:".", groupSize:3,decimalDelimiter:",",decimalSize:0})},
		{header:"PAGU TAHUN KE-2", 			id:"TARGET_PAGU_PROG_TAHUN2", 	width:150, 	css:{'text-align':'right'},format:webix.Number.numToStr({groupDelimiter:".", groupSize:3,decimalDelimiter:",",decimalSize:0})},
		{header:"PAGU TAHUN KE-3", 			id:"TARGET_PAGU_PROG_TAHUN3", 	width:150, 	css:{'text-align':'right'},format:webix.Number.numToStr({groupDelimiter:".", groupSize:3,decimalDelimiter:",",decimalSize:0})},
		{header:"PAGU TAHUN KE-4", 			id:"TARGET_PAGU_PROG_TAHUN4", 	width:150, 	css:{'text-align':'right'},format:webix.Number.numToStr({groupDelimiter:".", groupSize:3,decimalDelimiter:",",decimalSize:0})},
		{header:"PAGU TAHUN KE-5", 			id:"TARGET_PAGU_PROG_TAHUN5", 	width:150, 	css:{'text-align':'right'},format:webix.Number.numToStr({groupDelimiter:".", groupSize:3,decimalDelimiter:",",decimalSize:0})},
		{header:"CATATAN REJECT", 			id:"CATATAN_REJECT", width:400, css:{'text-align':'left'}},	
		{header:"KODE OPD",                 id:"OPD_ID", width:100, 	css:{'text-align':'left'}},
		{header:"KODE SUB OPD", 	        id:"SUB_OPD_ID", width:110, 	css:{'text-align':'left'}},
		{header:"KODE BIDANG", 				id:"BIDANG_OPD_ID", width:100, 	css:{'text-align':'left'}},

		
		{header:"&nbsp;", 	id:"EDIT", 	 width:37, 	template:"<span style='cursor:pointer;' class='webix_icon fa-edit'></span>", 	tooltip:"Edit"},
		{header:"&nbsp;", 	id:"DELETE", width:35, 	template:"<span style='cursor:pointer;' class='webix_icon fa-trash-o'></span>", 	tooltip:"Hapus"}
	],
	on:{
		"onBeforeLoad":function(){
			this.showOverlay("Loading...");
			// this.select(this.getFirstId());
		},
		"onAfterLoad":function(){
			this.hideOverlay();
			this.select(this.getFirstId());
			// this.select(1,1, true);
			// console.log(this.getFirstId())
		},
		"onAfterSelect":function(id){
			 // console.log( this.getSelectedId());  			
			 // console.log($$("DT_PROG").getSelectedId(true).join())
			id_opd = id;
			var item = $$("DT_PROG").getItem(id);
			// console.log(item);

			// webix.ajax().post("combo_kegiatan_dinamis.php?prgfull="+item.PRG_FULL, function(text, data){
			// 	$$("ADD_KEG_KEG_FULL").define("options", data.json());
			// 	$$("ADD_KEG_KEG_FULL").refresh();
			// });

			$$('SASARAN_PD_TXT').setValue(item.SASARAN_PD_ID);
			$$('OPD_TXT').setValue(item.OPD_ID);
			$$('SUB_OPD_TXT').setValue(item.SUB_OPD_ID);
			$$('DESKRIPSI_TXT').setValue(item.DESKRIPSI);
			$$('STATUS_RENSTRA_TXT').setValue(item.STATUS_RENSTRA);
			$$('PAGU_TAHUN_1TXT').setValue(item.TARGET_PAGU_PROG_TAHUN1);
			$$('PAGU_TAHUN_2TXT').setValue(item.TARGET_PAGU_PROG_TAHUN2);
			$$('PAGU_TAHUN_3TXT').setValue(item.TARGET_PAGU_PROG_TAHUN3);
			$$('PAGU_TAHUN_4TXT').setValue(item.TARGET_PAGU_PROG_TAHUN4);
			$$('PAGU_TAHUN_5TXT').setValue(item.TARGET_PAGU_PROG_TAHUN5);

			var prg_rowid =item.ROW_ID;
			// console.log(prg_rowid);

			// get data indikator program
			$$("DT_INDI_PROG").clearAll();
			$$("DT_INDI_PROG").load(function(){
			    return webix.ajax().post("perencanaan_renstra_entri_murni_data_child.php?lvl=indiprog",{rowid:prg_rowid},function(text, data){
			    	// console.log(data.json().id);
			    	// console.log(data.json().numrows);
			    })
			});
			// akhir get data indikator program

			// get data kegiatan
			$$("DT_KEG").clearAll();
			$$("DT_KEG").load(function(){
			    return webix.ajax().post("perencanaan_renstra_entri_murni_data_child.php?lvl=kegiatan",{rowid:prg_rowid},function(text, data){
			    	// console.log(data.json().status);
			    	// console.log(data.json().KEG_ROW_ID);
			    	// console.log(data.json().numrows);
			    	// console.log(data.json().lvl);
			    })
			});
			// akhir get data kegiatan

			// clear semua child
			$$("DT_SUBKEG").clearAll();
			$$("DT_INDI_KEG").clearAll();
			$$("DT_INDI_SUB_KEG").clearAll();
		},
		"onItemClick":function(id,e,node){

			id_opd = id;
			// console.log(id_opd);
			// var item = $$("DT_PROG").getItem(id);
			// $$('SASARAN_PD_TXT').setValue(item.SASARAN_PD_ID);
			// $$('OPD_TXT').setValue(item.OPD_ID);
			// $$('SUB_OPDTXT').setValue(item.SUB_OPD_ID);
			// $$('DESKRIPSI_TXT').setValue(item.DESKRIPSI);
			// $$('STATUS_RENSTRA_TXT').setValue(item.STATUS_RENSTRA);

			// $$('PAGU_TAHUN_1TXT').setValue(item.TARGET_PAGU_PROG_TAHUN1);
			// $$('PAGU_TAHUN_2TXT').setValue(item.TARGET_PAGU_PROG_TAHUN2);
			// $$('PAGU_TAHUN_3TXT').setValue(item.TARGET_PAGU_PROG_TAHUN3);
			// $$('PAGU_TAHUN_4TXT').setValue(item.TARGET_PAGU_PROG_TAHUN4);
			// $$('PAGU_TAHUN_5TXT').setValue(item.TARGET_PAGU_PROG_TAHUN5);			
			
		},
		"onItemDblClick":function(id,e,node){
			editData1();
		},
		"onSelectChange":function(){
			// console.log("on select change");
			// console.log($$("DT_PROG").getSelectedId(true).join());
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
	// url:"perencanaan_renstra_entri_murni_data.php",
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
		// {view:"button", type:"iconButton", icon:"plus-circle", label:"TAMBAH", autowidth:true, click:"addData11()"},
		{view:"button", type:"iconButton", icon:"edit", label:"TAMBAH CATATAN", autowidth:true, click:"editData11()"},
		// {view:"button", type:"iconButton", icon:"trash-o", label:"DELETE", autowidth:true, click:"deleteData11()"},
	]
};
var indikator_program = {
	view:"datatable", id:"DT_INDI_PROG", resizeColumn:true, navigation:true,
	select:true, css:"datatable_column", 
	scheme:{
		$change:function(item){
			// console.log(item);
			if (item.INDIPROG_CATATAN_REJECT.trim().length > 1)
				item.$css = "highlight";
		}
	},
	columns:[
		{header:"#", 							id:"INDIPROG_ROW_ID", 				hidden:true},		
		{header:"No", 							id:"INDIPROG_NO", 								width:35, 	css:{'text-align':'right'}},
		{header:"INDIKATOR PROGRAM", 			id:"INDIPROG_INDIKATOR_PROGRAM", 				width:415, 	css:{'text-align':'left'}},
		{header:"SATUAN INDIKATOR", 			id:"INDIPROG_SATUAN_INDIKATOR_PROGRAM", 		width:200, 	css:{'text-align':'left'}},
		{header:"KINERJA AWAL", 				id:"INDIPROG_KINERJA_AWAL_PROGRAM", 			width:150, 	css:{'text-align':'right'}},
		{header:"TARGET KINERJA AKHIR", 		id:"INDIPROG_TARGET_AKHIR_KINERJA_PROGRAM", 			width:200, 	css:{'text-align':'right'}},
		{header:"TARGET KINERJA TAHUN 1", 		id:"INDIPROG_TARGET_KINERJA_PROG_TAHUN1", 				width:200, 	css:{'text-align':'right'}},
		{header:"TARGET KINERJA TAHUN 2", 		id:"INDIPROG_TARGET_KINERJA_PROG_TAHUN2", 				width:200, 	css:{'text-align':'right'}},
		{header:"TARGET KINERJA TAHUN 3", 		id:"INDIPROG_TARGET_KINERJA_PROG_TAHUN3", 				width:200, 	css:{'text-align':'right'}},
		{header:"TARGET KINERJA TAHUN 4", 		id:"INDIPROG_TARGET_KINERJA_PROG_TAHUN4", 				width:200, 	css:{'text-align':'right'}},
		{header:"TARGET KINERJA TAHUN 5", 		id:"INDIPROG_TARGET_KINERJA_PROG_TAHUN5", 				width:200, 	css:{'text-align':'right'}},
		{header:"CATATAN REJECT", 				id:"INDIPROG_CATATAN_REJECT", width:200, css:{'text-align':'left'}},	

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
		// {view:"button", type:"iconButton", icon:"plus-circle", label:"TAMBAH", autowidth:true, click:"addData2()"},
		{view:"button", type:"iconButton", icon:"edit", label:"TAMBAH CATATAN", autowidth:true, click:"editData2()"},
		// {view:"button", type:"iconButton", icon:"trash-o", label:"DELETE", autowidth:true, click:"deleteData2()"},
	]
};
var kegiatan = {
	view:"datatable", id:"DT_KEG",resizeColumn:true, navigation:true,
	select:true, css:"datatable_column", height:300,
	scheme:{
		$change:function(item){
			// console.log(item);
			if (item.KEG_CATATAN_REJECT.trim().length > 1)
				item.$css = "highlight";
		}
	},
	columns:[
		{header:"#", 													id:"KEG_ROW_ID", 				hidden:true},
		
		{header:"No", 												id:"KEG_NO", 									width:35, 	css:{'text-align':'right'}},
		{header:"KODE", 				id:"KEG_KODE_LENGKAP", 								width:100, 	css:{'text-align':'left'}},
		{header:"KEGIATAN", 										id:"KEG_DESKRIPSI", 					width:405, 	css:{'text-align':'left'}},
		{header:"TARGET AKHIR PAGU", 		id:"KEG_TARGET_AKHIR_PAGU_KEGIATAN", width:110, 	css:{'text-align':'right'},format:webix.Number.numToStr({groupDelimiter:".", groupSize:3,decimalDelimiter:",",decimalSize:0})},			
		{header:"PAGU TAHUN KE-1", 			id:"KEG_TARGET_PAGU_KEG_TAHUN1",   width:150, 	css:{'text-align':'right'},format:webix.Number.numToStr({groupDelimiter:".", groupSize:3,decimalDelimiter:",",decimalSize:0})},
		{header:"PAGU TAHUN KE-2", 			id:"KEG_TARGET_PAGU_KEG_TAHUN2", 	width:150, 	css:{'text-align':'right'},format:webix.Number.numToStr({groupDelimiter:".", groupSize:3,decimalDelimiter:",",decimalSize:0})},
		{header:"PAGU TAHUN KE-3", 			id:"KEG_TARGET_PAGU_KEG_TAHUN3", 	width:150, 	css:{'text-align':'right'},format:webix.Number.numToStr({groupDelimiter:".", groupSize:3,decimalDelimiter:",",decimalSize:0})},
		{header:"PAGU TAHUN KE-4", 			id:"KEG_TARGET_PAGU_KEG_TAHUN4", 	width:150, 	css:{'text-align':'right'},format:webix.Number.numToStr({groupDelimiter:".", groupSize:3,decimalDelimiter:",",decimalSize:0})},
		{header:"PAGU TAHUN KE-5", 			id:"KEG_TARGET_PAGU_KEG_TAHUN5", 	width:150, 	css:{'text-align':'right'},format:webix.Number.numToStr({groupDelimiter:".", groupSize:3,decimalDelimiter:",",decimalSize:0})},
		{header:"CATATAN REJECT", 			id:"CATATAN_REJECT", width:200, css:{'text-align':'left'}},	
		
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
			id_keg = id;
			var item = $$("DT_KEG").getItem(id);
			// console.log(item.KEG_ROW_ID);	
			var keg_rowid =item.KEG_ROW_ID;
			

			// webix.ajax().post("combo_kegiatan_dinamis.php?prgfull="+item.KEG_PRG_FULL, function(text, data){
			// 	$$("ADD_INDIKEG_KEG_FULL").define("options", data.json());
			// 	$$("ADD_INDIKEG_KEG_FULL").refresh();
			// });

			// // console.log(item.KEG_KEG_FULL)
			// webix.ajax().post("combo_subkegiatan_dinamis.php?kegfull="+item.KEG_KEG_FULL, function(text, data){
			// 	// console.log(data.json())
			// 	$$("ADD_SUBKEG_SUBKEG_FULL").define("options", data.json());
			// 	$$("ADD_SUBKEG_SUBKEG_FULL").refresh();
			// });

			// get data indikator kegiatan
			$$("DT_INDI_KEG").clearAll();
			$$("DT_INDI_KEG").load(function(){
			    return webix.ajax().post("perencanaan_renstra_entri_murni_data_child.php?lvl=indikeg",{rowid:keg_rowid},function(text, data){
			    	// console.log(data.json().numrows);
			    })
			});
			// akhir get data indikator program

			// get data sub kegiatan
			$$("DT_SUBKEG").clearAll();
			$$("DT_SUBKEG").load(function(){
			    return webix.ajax().post("perencanaan_renstra_entri_murni_data_child.php?lvl=subkegiatan",{rowid:keg_rowid},function(text, data){
			    	// console.log(data.json().lvl);
			    })
			});
			// akhir get data sub kegiatan

			// clear semua child
			$$("DT_INDI_SUB_KEG").clearAll();
		},
		"onItemDblClick":function(id,e,node){
			editData2();
		},
		"onItemClick":function(id,e,node){
			id_keg = id;			
		},		

	},
	onClick:{
		"fa-edit":function(e,id){
			id_keg = id
		},
		"fa-trash-o":function(e,id){
			id_keg = id
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
		// {view:"button", type:"iconButton", icon:"plus-circle", label:"TAMBAH", autowidth:true, click:"addData21()"},
		{view:"button", type:"iconButton", icon:"edit", label:"TAMBAH CATATAN", autowidth:true, click:"editData21()"},
		// {view:"button", type:"iconButton", icon:"trash-o", label:"DELETE", autowidth:true, click:"deleteData21()"},
	]
};
var indikator_kegiatan = {
	view:"datatable", id:"DT_INDI_KEG",resizeColumn:true, navigation:true,
	select:true, css:"datatable_column", 
	scheme:{
		$change:function(item){
			// console.log(item);
			if (item.INDIKEG_CATATAN_REJECT.trim().length > 1)
				item.$css = "highlight";
		}
	},
	columns:[
		{header:"#", 							id:"INDIKEG_ROW_ID", 				hidden:true},		
		{header:"No", 							id:"INDIKEG_NO", 								width:35, 	css:{'text-align':'right'}},
		{header:"INDIKATOR KEGIATAN", 			id:"INDIKEG_INDIKATOR_KEGIATAN", 				width:400, 	css:{'text-align':'left'}},
		{header:"SATUAN INDIKATOR", 			id:"INDIKEG_SATUAN_INDIKATOR_KEGIATAN", 		width:215, 	css:{'text-align':'left'}},
		{header:"KINERJA AWAL", 				id:"INDIKEG_KINERJA_AWAL_KEGIATAN", 			width:200, 	css:{'text-align':'right'}},
		{header:"TARGET KINERJA AKHIR", 		id:"INDIKEG_TARGET_AKHIR_KINERJA_KEGIATAN", 	width:200, 	css:{'text-align':'right'}},
		{header:"TARGET KINERJA TAHUN 1", 		id:"INDIKEG_TARGET_KINERJA_KEG_TAHUN1", 		width:200, 	css:{'text-align':'right'}},
		{header:"TARGET KINERJA TAHUN 2", 		id:"INDIKEG_TARGET_KINERJA_KEG_TAHUN2",			width:200, 	css:{'text-align':'right'}},
		{header:"TARGET KINERJA TAHUN 3", 		id:"INDIKEG_TARGET_KINERJA_KEG_TAHUN3",			width:200, 	css:{'text-align':'right'}},
		{header:"TARGET KINERJA TAHUN 4", 		id:"INDIKEG_TARGET_KINERJA_KEG_TAHUN4",			width:200, 	css:{'text-align':'right'}},
		{header:"TARGET KINERJA TAHUN 5", 		id:"INDIKEG_TARGET_KINERJA_KEG_TAHUN5",			width:200, 	css:{'text-align':'right'}},
		{header:"CATATAN REJECT", 				id:"INDIKEG_CATATAN_REJECT", width:200, css:{'text-align':'left'}},
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
		// {view:"button", type:"iconButton", icon:"plus-circle", label:"TAMBAH", autowidth:true, click:"addData3()"},
		{view:"button", type:"iconButton", icon:"edit", label:"TAMBAH CATATAN", autowidth:true, click:"editData3()"},
		// {view:"button", type:"iconButton", icon:"trash-o", label:"DELETE", autowidth:true, click:"deleteData3()"},
	]
};
var subkegiatan = {
	view:"datatable", id:"DT_SUBKEG",resizeColumn:true, navigation:true,
	select:true, css:"datatable_column", height:300,
	scheme:{
		$change:function(item){
			// console.log(item);
			if (item.SUBKEG_CATATAN_REJECT.trim().length > 1)
				item.$css = "highlight";
		}
	},
	columns:[
		{header:"#", 								id:"SUBKEG_ROW_ID", 				hidden:true},		
		{header:"No", 								id:"SUBKEG_NO", 									width:35, 	css:{'text-align':'right'}},
		{header:"KODE", 							id:"SUBKEG_KODE_LENGKAP", 				width:110, 	css:{'text-align':'left'}},
		{header:"SUB KEGIATAN",						id:"SUBKEG_DESKRIPSI", 					width:385, 	css:{'text-align':'left'}},
		{header:"TARGET AKHIR PAGU", 		id:"SUBKEG_TARGET_AKHIR_PAGU_SUBKEGIATAN", width:120, 	css:{'text-align':'right'},format:webix.Number.numToStr({groupDelimiter:".", groupSize:3,decimalDelimiter:",",decimalSize:0})},			
		{header:"PAGU TAHUN KE-1", 			id:"SUBKEG_TARGET_PAGU_SUBKEG_TAHUN1",   width:150, 	css:{'text-align':'right'},format:webix.Number.numToStr({groupDelimiter:".", groupSize:3,decimalDelimiter:",",decimalSize:0})},
		{header:"PAGU TAHUN KE-2", 			id:"SUBKEG_TARGET_PAGU_SUBKEG_TAHUN2", 	width:150, 	css:{'text-align':'right'},format:webix.Number.numToStr({groupDelimiter:".", groupSize:3,decimalDelimiter:",",decimalSize:0})},
		{header:"PAGU TAHUN KE-3", 			id:"SUBKEG_TARGET_PAGU_SUBKEG_TAHUN3", 	width:150, 	css:{'text-align':'right'},format:webix.Number.numToStr({groupDelimiter:".", groupSize:3,decimalDelimiter:",",decimalSize:0})},
		{header:"PAGU TAHUN KE-4", 			id:"SUBKEG_TARGET_PAGU_SUBKEG_TAHUN4", 	width:150, 	css:{'text-align':'right'},format:webix.Number.numToStr({groupDelimiter:".", groupSize:3,decimalDelimiter:",",decimalSize:0})},
		{header:"PAGU TAHUN KE-5", 			id:"SUBKEG_TARGET_PAGU_SUBKEG_TAHUN5", 	width:150, 	css:{'text-align':'right'},format:webix.Number.numToStr({groupDelimiter:".", groupSize:3,decimalDelimiter:",",decimalSize:0})},
		{header:"CATATAN REJECT", 			id:"SUBKEG_CATATAN_REJECT", width:200, css:{'text-align':'left'}},	
		
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
			id_subkeg = id;
			var item = $$("DT_SUBKEG").getItem(id);			
			var subkeg_rowid =item.SUBKEG_ROW_ID;
			// console.log(subkeg_rowid);	
		
			// get data indikator sub kegiatan
			$$("DT_INDI_SUB_KEG").clearAll();
			$$("DT_INDI_SUB_KEG").load(function(){
			    return webix.ajax().post("perencanaan_renstra_entri_murni_data_child.php?lvl=indisubkeg",{rowid:subkeg_rowid},function(text, data){
			    	// console.log(data.json().status);
			    })
			});
			// akhir get data indikator sub kegiatan
		},
		
		"onItemDblClick":function(id,e,node){
			editData3();
		},
		"onItemClick":function(id,e,node){
			id_subkeg = id;			
		},
	},
	onClick:{
		"fa-edit":function(e,id){
			id_subkeg = id;
		},
		"fa-trash-o":function(e,id){
			id_subkeg = id;
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
		// {view:"button", type:"iconButton", icon:"plus-circle", label:"TAMBAH", autowidth:true, click:"addData31()"},
		{view:"button", type:"iconButton", icon:"edit", label:"TAMBAH CATATAN", autowidth:true, click:"editData31()"},
		// {view:"button", type:"iconButton", icon:"trash-o", label:"DELETE", autowidth:true, click:"deleteData31()"},
	]
};
var indikator_subkegiatan = {
	view:"datatable", id:"DT_INDI_SUB_KEG",resizeColumn:true, navigation:true,
	select:true, css:"datatable_column", 
	scheme:{
		$change:function(item){
			// console.log(item);
			if (item.INDISUBKEG_CATATAN_REJECT.trim().length > 1)
				item.$css = "highlight";
		}
	},
	columns:[
		{header:"#", 							id:"INDISUBKEG_ROW_ID", 				hidden:true},		
		{header:"No", 							id:"INDISUBKEG_NO", 					width:35, 	css:{'text-align':'right'}},
		{header:"INDIKATOR SUB KEGIATAN", 		id:"INDISUBKEG_INDIKATOR_SUBKEGIATAN", 			width:400, 	css:{'text-align':'left'}},
		{header:"SATUAN INDIKATOR", 			id:"INDISUBKEG_SATUAN_INDIKATOR_SUBKEGIATAN", 		width:220, 	css:{'text-align':'left'}},
		{header:"KINERJA AWAL", 				id:"INDISUBKEG_KINERJA_AWAL_SUBKEGIATAN", 							width:200, 	css:{'text-align':'right'}},
		{header:"TARGET KINERJA AKHIR", 		id:"INDISUBKEG_TARGET_AKHIR_KINERJA_SUBKEGIATAN", 			width:200, 	css:{'text-align':'right'}},
		{header:"TARGET KINERJA TAHUN 1", 		id:"INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN1", 				width:200, 	css:{'text-align':'right'}},
		{header:"TARGET KINERJA TAHUN 2", 		id:"INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN2", 				width:200, 	css:{'text-align':'right'}},
		{header:"TARGET KINERJA TAHUN 3", 		id:"INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN3", 				width:200, 	css:{'text-align':'right'}},
		{header:"TARGET KINERJA TAHUN 4", 		id:"INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN4", 				width:200, 	css:{'text-align':'right'}},
		{header:"TARGET KINERJA TAHUN 5", 		id:"INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN5", 				width:200, 	css:{'text-align':'right'}},
		{header:"CATATAN REJECT", 			    id:"INDISUBKEG_CATATAN_REJECT", width:200, css:{'text-align':'left'}},	
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

var renstra_opd = {
	//type:"clean",
	view:"toolbar",
	css:"highlighted_header header",
	paddingX:2,
	paddingY:2,
	height:35,
	cols:[
		{	view:"pager", id:"PAGER_RENSTRA", master:false, borderless:true,
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
				{rows:[nav_program, program,renstra_opd]}, 
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
				{view:"checkbox", label:"", id:"CATATAN REJECT", labelWidth:110, width:22},
				// {view:"label", label:"TAMPILKAN DATA YANG ADA CATATAN REJECT"},
				{}
			]}, 
			{cols:[
				{},
				{view:"button", 	label:"CANCEL FINISH", type:"form", align:"center", width:150, height:40, click:"cancel_finish()"},
				// {width:20},
				// {view:"button", 	label:"CANCEL REQUEST", type:"", align:"center", width:150, height:40, click:"cancel_request()"},
				{}
			]}, 
			{height:50},
		],
	}
};

webix.ready(function(){
	webix.ui(ui);
	
	// add program
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
		body:webix.copy(FORM_DATA1_ADD),
		// tambah data program
		on:{
			onShow: function(id){
				// $$('FORM_DATA1_ADD').bind('DT_PROG');
				// $$('formEditOpd').bind('DT_PROG');
				var item = $$("DT_PROG").getItem(id_opd);		
				// console.log(item);

				// setting data awal program
				// if (){

				// }
 				
 				if (id_opd > 0) {
 					
 					$$('FORM_PROGRAM_ADD1').setValues({
					   // harusnya ambil dari setting / user
				       OPD_ID: item.OPD_ID, 
				       SUB_OPD_ID: item.SUB_OPD_ID,
				       STATUS_RENSTRA: item.STATUS_RENSTRA
				       // field_b: "New York"
			   		 });
 					// console.log("hallo1 "+id_opd);
 				}else {
 					  $$('FORM_PROGRAM_ADD1').setValues({
					   // harusnya ambil dari setting / user					   
				       // OPD_ID: item.OPD_ID, 
				       // SUB_OPD_ID: item.SUB_OPD_ID,
				       // bidang opd

				       STATUS_RENSTRA: "new"
				       // field_b: "New York"
			   		 });

 					// console.log("hallo2 "+id_opd);
 				}
				
				// // console.log(item.SUB_OPD_ID);
				
						
				// $$('ADD_SASARAN_DAERAH_ID').setValue("1");

				// $$('OPD_EDIT_URUSAN_1').setValue(item.URUSAN_1);
				// $$('OPD_EDIT_BIDANG_URUSAN_1').setValue(item.BIDANG_URUSAN_1);
				// $$('OPD_EDIT_URUSAN_2').setValue(item.URUSAN_2);
				// $$('OPD_EDIT_BIDANG_URUSAN_2').setValue(item.BIDANG_URUSAN_2);
				// $$('OPD_EDIT_URUSAN_3').setValue(item.URUSAN_3);
				// $$('OPD_EDIT_BIDANG_URUSAN_3').setValue(item.BIDANG_URUSAN_3);
				// $$('OPD_EDIT_URUTAN_OPD').setValue(item.URUTAN_OPD);
				// $$('OPD_EDIT_KODE_OPD_LENGKAP').setValue(item.KODE_OPD_LENGKAP);
				// $$('OPD_EDIT_DESKRIPSI_OPD').setValue(item.DESKRIPSI_OPD);
				// $$('OPD_EDIT_KODE_OPD_LAMA').setValue(item.KODE_OPD_LAMA);
				// $$('OPD_EDIT_DESKRIPSI_OPD_LAMA').setValue(item.DESKRIPSI_OPD_LAMA);
				// $$('OPD_EDIT_PIMPINAN').setValue(item.PIMPINAN);
				// $$('OPD_EDIT_SEKRETARIS').setValue(item.SEKRETARIS);
				// $$('OPD_EDIT_BIDANG_TEKNIS_BAPPEDA').setValue(item.BIDANG_TEKNIS_BAPPEDA);
			}
		}
	});
	
	// add indikator program
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
		body:webix.copy(FORM_DATA11_ADD),
		on:{
			onShow: function(id){
				// form add indikator program firo
				// $$('FORM_DATA1_ADD').bind('DT_PROG');
				// $$('formEditOpd').bind('DT_PROG');
				var item = $$("DT_PROG").getItem(id_opd);		
				// console.log("add indikator program");
				// console.log(id_opd);
				if (id_opd > 0){
					// setting data awal program
					$$('FORM_INDI_PROGRAM_ADD').setValues({
				       INDIPROG_PRT_ID:item.ROW_ID,
				       INDIPROG_OPD_ID: item.OPD_ID, 
				       INDIPROG_SUB_OPD_ID: item.SUB_OPD_ID,
				       INDIPROG_PROG_ID: item.PROG_ID,
				       INDIPROG_URS_ID: item.URS_ID,
				       INDIPROG_BID_URS_ID: item.BID_URS_ID,
				       INDIPROG_PRG_FULL: item.PRG_FULL,
				       INDIPROG_STATUS_RENSTRA: item.STATUS_RENSTRA,
				       INDIPROG_KINERJA_AWAL_PROGRAM:"0",
				       INDIPROG_TARGET_AKHIR_KINERJA_PROGRAM:"0",
				       INDIPROG_TARGET_KINERJA_PROG_TAHUN1:"0",
				       INDIPROG_TARGET_KINERJA_PROG_TAHUN2:"0",
				       INDIPROG_TARGET_KINERJA_PROG_TAHUN3:"0",
				       INDIPROG_TARGET_KINERJA_PROG_TAHUN4:"0",
				       INDIPROG_TARGET_KINERJA_PROG_TAHUN5:"0",
				    });				
				}else{
					webix.alert({
						type:"alert-error",
						title: "INFORMATION",
						text: "Buat Program Terlebih Dahulu",
						ok:"OK",
						callback:function(){
							$$('WIN_DATA11_ADD').hide();
						}
					});
				}
					
				
			}
				
		}
	});
	
	// add kegiatan
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
		body:webix.copy(FORM_DATA2_ADD),
		on:{
			onShow: function(id){
				// form add indikator program firo
				// $$('FORM_DATA1_ADD').bind('DT_PROG');
				// $$('formEditOpd').bind('DT_PROG');

				var item = $$("DT_PROG").getItem(id_opd);		
				// console.log("add Kegiatan");
				// $$("ADD_KEG_KEG_FULL").
				// setting data awal kegiatan
				

				if (id_opd > 0){
					$$('FORM_KEGIATAN_ADD').setValues({
				       KEG_PRT_ID:item.ROW_ID,
				       KEG_OPD_ID: item.OPD_ID, 
				       KEG_SUB_OPD_ID: item.SUB_OPD_ID,
				       KEG_PRG_FULL: item.PRG_FULL,
				       KEG_STATUS_RENSTRA: item.STATUS_RENSTRA,
				    });
			    }else{
					webix.alert({
						type:"alert-error",
						title: "INFORMATION",
						text: "Buat Program Terlebih Dahulu",
						ok:"OK",
						callback:function(){
							$$('WIN_DATA2_ADD').hide();
						}
					});
				}					
				
			}
		}
	});
	
	// add indikator kegiatan
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
		body:webix.copy(FORM_DATA21_ADD),
		on:{
			onShow: function(id){
				var item = $$("DT_KEG").getItem(id_keg);		
				// console.log("add indikator Kegiatan");
				// console.log(item);
				// setting data awal indikator kegiatan
				if (id_keg > 0){
					$$('FORM_INDI_KEGIATAN_ADD').setValues({
				       INDIKEG_PRT_ID:item.KEG_ROW_ID,
				       INDIKEG_OPD_ID: item.KEG_OPD_ID, 
				       INDIKEG_SUB_OPD_ID: item.KEG_SUB_OPD_ID,
				       INDIKEG_PRG_FULL: item.KEG_PRG_FULL,
				       INDIKEG_KEG_FULL: item.KEG_KEG_FULL,
				       INDIKEG_STATUS_RENSTRA: item.KEG_STATUS_RENSTRA,
				       INDIKEG_KINERJA_AWAL_KEGIATAN:"0",
				       INDIKEG_TARGET_AKHIR_KINERJA_KEGIATAN:"0",
				       INDIKEG_TARGET_KINERJA_KEG_TAHUN1:"0",
				       INDIKEG_TARGET_KINERJA_KEG_TAHUN2:"0",
				       INDIKEG_TARGET_KINERJA_KEG_TAHUN3:"0",
				       INDIKEG_TARGET_KINERJA_KEG_TAHUN4:"0",
				       INDIKEG_TARGET_KINERJA_KEG_TAHUN5:"0",

				    });			
			    }else{
					webix.alert({
						type:"alert-error",
						title: "INFORMATION",
						text: "Buat Kegiatan Terlebih Dahulu",
						ok:"OK",
						callback:function(){
							$$('WIN_DATA21_ADD').hide();
						}
					});
				}					
				
			}
		}
	});
		
	// add sub kegiatan
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
		body:webix.copy(FORM_DATA3_ADD),
		on:{
			onShow: function(id){
				// form add indikator program firo
				// $$('FORM_DATA1_ADD').bind('DT_PROG');
				// $$('formEditOpd').bind('DT_PROG');

				var item = $$("DT_KEG").getItem(id_keg);	
				// console.log(item)	
				// console.log("add Kegiatan");
				// $$("ADD_KEG_KEG_FULL").
				// setting data awal kegiatan
				

				if (id_keg > 0){
					$$('FORM_SUBKEGIATAN_ADD').setValues({			   
				       SUBKEG_PRT_ID:item.KEG_ROW_ID,
				       SUBKEG_PRTPRT_ID:item.KEG_PRT_ID,
				       SUBKEG_OPD_ID: item.KEG_OPD_ID, 
				       SUBKEG_SUB_OPD_ID: item.KEG_SUB_OPD_ID,
				       SUBKEG_KEG_FULL: item.KEG_KEG_FULL,
				       SUBKEG_STATUS_RENSTRA: item.KEG_STATUS_RENSTRA,
				       SUBKEG_TARGET_PAGU_SUBKEG_TAHUN1:"0",
				       SUBKEG_TARGET_PAGU_SUBKEG_TAHUN2:"0",
				       SUBKEG_TARGET_PAGU_SUBKEG_TAHUN3:"0",
				       SUBKEG_TARGET_PAGU_SUBKEG_TAHUN4:"0",
				       SUBKEG_TARGET_PAGU_SUBKEG_TAHUN5:"0",
				    });
			    }else{
					webix.alert({
						type:"alert-error",
						title: "INFORMATION",
						text: "Buat kegiatan Terlebih Dahulu",
						ok:"OK",
						callback:function(){
							$$('WIN_DATA2_ADD').hide();
						}
					});
				}					
				
			}
		}
	});
	
	// add indikator sub kegiatan
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
		body:webix.copy(FORM_DATA31_ADD),
		on:{
			onShow: function(id){
				var item = $$("DT_SUBKEG").getItem(id_subkeg);		
				// console.log("add indikator Kegiatan");
				// console.log(item);
				// setting data awal indikator kegiatan

				if (id_subkeg > 0){
					$$('FORM_INDI_SUBKEGIATAN_ADD').setValues({
				       INDISUBKEG_PRT_ID:item.SUBKEG_ROW_ID,
				       INDISUBKEG_OPD_ID: item.SUBKEG_OPD_ID, 
				       INDISUBKEG_SUB_OPD_ID: item.SUBKEG_SUB_OPD_ID,
				       INDISUBKEG_KEG_FULL: item.SUBKEG_KEG_FULL,
				       INDISUBKEG_SUBKEG_FULL: item.SUBKEG_SUBKEG_FULL,
				       INDISUBKEG_STATUS_RENSTRA: item.SUBKEG_STATUS_RENSTRA,
				       INDISUBKEG_KINERJA_AWAL_SUBKEGIATAN:"0",
				       INDISUBKEG_TARGET_AKHIR_KINERJA_SUBKEGIATAN:"0",
				       INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN1:"0",
				       INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN2:"0",
				       INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN3:"0",
				       INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN4:"0",
				       INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN5:"0",
				    });			
			    }else{
					webix.alert({
						type:"alert-error",
						title: "INFORMATION",
						text: "Buat Sub Kegiatan Terlebih Dahulu",
						ok:"OK",
						callback:function(){
							$$('WIN_DATA21_ADD').hide();
						}
					});
				}					
				
			}
		}
	});
	
	
	// edit program
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
		on:{
			onShow: function(id){
				// var xx = $$("FORM_PROGRAM_EDIT1").getValues();
				// console.log(xx.PRG_FULL);
				// console.log(xx.PRG_FULL.substring(4,6));
				// firo
				// if (xx.PRG_FULL.substring(4,6) == "01") {
				// 	// console.log("set program");
				// 	$$('PRG_FULL').setValue("000001");					
				// }

				// $$('FORM_PROGRAM_EDIT1').clear();
				
				// var item = $$("DT_PROG").getItem(id_opd);
				// console.log(item);
				// $$('SUB_OPD_IDx').setValue(item.SUB_OPD_ID);
				

				// $$('OPD_EDIT_BIDANG_URUSAN_1').setValue(item.BIDANG_URUSAN_1);
				// $$('OPD_EDIT_URUSAN_2').setValue(item.URUSAN_2);
				// $$('OPD_EDIT_BIDANG_URUSAN_2').setValue(item.BIDANG_URUSAN_2);
				// $$('OPD_EDIT_URUSAN_3').setValue(item.URUSAN_3);
				// $$('OPD_EDIT_BIDANG_URUSAN_3').setValue(item.BIDANG_URUSAN_3);
				// $$('OPD_EDIT_URUTAN_OPD').setValue(item.URUTAN_OPD);
				// $$('OPD_EDIT_KODE_OPD_LENGKAP').setValue(item.KODE_OPD_LENGKAP);
				// $$('OPD_EDIT_DESKRIPSI_OPD').setValue(item.DESKRIPSI_OPD);
				// $$('OPD_EDIT_KODE_OPD_LAMA').setValue(item.KODE_OPD_LAMA);
				// $$('OPD_EDIT_DESKRIPSI_OPD_LAMA').setValue(item.DESKRIPSI_OPD_LAMA);
				// $$('OPD_EDIT_PIMPINAN').setValue(item.PIMPINAN);
				// $$('OPD_EDIT_SEKRETARIS').setValue(item.SEKRETARIS);
				// $$('OPD_EDIT_BIDANG_TEKNIS_BAPPEDA').setValue(item.BIDANG_TEKNIS_BAPPEDA);
			}
		}
	});
	
	// form edit indikator program
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
	
	// edit kegiatan
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
	
	// edit indikator kegiatan
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
	
	// edit sub kegiatan
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
	
	// edit indikator sub kegiatan
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
	
	// delete program
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
		body:webix.copy(FORM_DATA1_DELETE),
		on:{
			onShow: function(id){		
				xx = $$("FORM_PROGRAM_DELETE1").getValues();
				console.log(xx.PRG_FULL.substring(4,6))
				if (xx.PRG_FULL.substring(4,6) == "01") {
					$$('DELETE_PRG_FULL').setValue("000001");					
				}
			}
		}
	});
	
	// delete indikator program
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
	
	// delete kegiatan
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
	
	// delete indikator kegiatan
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
	
	// delete sub kegiatan
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
	
	// delete indikator sub kegiatan
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
	//$$("DT_PROG").load("perencanaan_renstra_entri_murni_data.php");
	getData();
	bindProgFormEdit();
});

// add program
var FORM_DATA1_ADD = {
	view:"form",
	borderless:true,
	id:"FORM_PROGRAM_ADD1",
	// scroll:"xy",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements:[
		
		{view:"combo", 		label:"SASARAN DAERAH", id:"ADD_SASARAN_DAERAH_ID", 	name:"SASARAN_DAERAH_ID" ,	labelWidth:180, options: combo_sasaran_daerah, disabled:true},
		{view:"text", 		label:"OPD", 		  	id:"ADD_OPD_ID", 	name:"OPD_ID" ,	labelWidth:180, disabled:true},
		{view:"text", 		label:"SUB OPD", 		id:"ADD_SUB_OPD_ID", 	name:"SUB_OPD_ID" ,	labelWidth:180, disabled:true},	
		{view:"combo", 		label:"BIDANG OPD", 	id:"ADD_BIDANG_OPD_ID", 	name:"BIDANG_OPD_ID" ,	labelWidth:180, options: combo_bidang_opd},
		{view:"combo", 		label:"TUJUAN PERANGKAT DAERAH", 	id:"ADD_TUJUAN_PD_ID", 	name:"TUJUAN_PD_ID" ,	labelWidth:180, options: combo_tujuan_pd},
		{view:"combo", 		label:"SASARAN PERANGKAT DAERAH", 	id:"ADD_SASARAN_PD_ID", 	name:"SASARAN_PD_ID" ,	labelWidth:180, options: combo_sasaran_pd},	

		{view:"combo", 		label:"PROGRAM", 	id:"ADD_PRG_FULL", name:"PRG_FULL",			labelWidth:180, options: combo_program},
		{view:"text", 		label:"PAGU TAHUN KE-1", id:"ADD_TARGET_PAGU_PROG_TAHUN1", 	name:"TARGET_PAGU_PROG_TAHUN1",	labelWidth:180, disabled:true },
		{view:"text", 		label:"PAGU TAHUN KE-2", id:"ADD_TARGET_PAGU_PROG_TAHUN2", 	name:"TARGET_PAGU_PROG_TAHUN2",	labelWidth:180, disabled:true},
		{view:"text", 		label:"PAGU TAHUN KE-3", id:"ADD_TARGET_PAGU_PROG_TAHUN3", 	name:"TARGET_PAGU_PROG_TAHUN3",	labelWidth:180, disabled:true},
		{view:"text", 		label:"PAGU TAHUN KE-4", id:"ADD_TARGET_PAGU_PROG_TAHUN4", 	name:"TARGET_PAGU_PROG_TAHUN4",	labelWidth:180, disabled:true},
		{view:"text", 		label:"PAGU TAHUN KE-5", id:"ADD_TARGET_PAGU_PROG_TAHUN5", 	name:"TARGET_PAGU_PROG_TAHUN5",	labelWidth:180, disabled:true},
		// {view:"textarea", 			label:"CATATAN REJECT",	 id:"CATATAN_REJECT", 	name:"CATATAN_REJECT",	labelWidth:180, disabled:true},
		{view:"text", 			label:"STATUS RENSTRA",	 id:"ADD_STATUS_RENSTRA", 	name:"STATUS_RENSTRA",	labelWidth:180, hidden:true},
		{
			margin:5,
			cols:[
				{width:126},
				{view:"button", label:"Simpan", type:"form", align:"center", width:100, click:function(){
					dataAddprog();
					// $$("WIN_DATA1_ADD").hide();
				}},
				{view:"button", label:"Cancel", align:"center", width:100, click:function(){
					$$("WIN_DATA1_ADD").hide();
				}},
				{}
			]
		}
	]
};

// add indikator program
var FORM_DATA11_ADD = {
	view:"form",
	borderless:true,
	id:"FORM_INDI_PROGRAM_ADD",
	// scroll:"xy",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements:[
		{view:"text", label:"PRTID", id:"ADD_INDIPROG_PRT_ID", name:"INDIPROG_PRT_ID", hidden:true, labelWidth:180},
		{view:"text", label:"OPD", id:"ADD_INDIPROG_OPD_ID", name:"INDIPROG_OPD_ID", hidden:true, labelWidth:180},
		{view:"text", label:"SUB OPD", id:"ADD_INDIPROG_SUB_OPD_ID", name:"INDIPROG_SUB_OPD_ID", hidden:true, labelWidth:180},
		{view:"text", label:"KODE URUSAN", id:"ADD_INDIPROG_URS_ID", name:"INDIPROG_URS_ID", hidden:true, labelWidth:180},
		{view:"text", label:"KODE BIDANG URUSAN", id:"ADD_INDIPROG_BID_URS_ID", name:"INDIPROG_BID_URS_ID", hidden:true, labelWidth:180},
		{view:"text", label:"KODE PROGRAM", id:"ADD_INDIPROG_PROG_ID", name:"INDIPROG_PROG_ID", hidden:true, labelWidth:180},
		{view:"text", label:"KODE PROGRAM FULL", id:"ADD_INDIPROG_PRG_FULL", name:"INDIPROG_PRG_FULL", hidden:true, labelWidth:180},
		{view:"text", label:"STATUS RENSTRA", id:"ADD_INDIPROG_STATUS_RENSTRA", name:"INDIPROG_STATUS_RENSTRA", hidden:true, labelWidth:180},
		{view:"textarea", 	label:"INDIKATOR PROGRAM", id:"ADD_INDIPROG_INDIKATOR_PROGRAM", name:"INDIPROG_INDIKATOR_PROGRAM", labelWidth:180},
		{view:"text", label:"SATUAN INDIKATOR", id:"ADD_INDIPROG_SATUAN_INDIKATOR_PROGRAM", name:"INDIPROG_SATUAN_INDIKATOR_PROGRAM", labelWidth:180},
		{view:"text", label:"KINERJA AWAL", 	id:"ADD_INDIPROG_KINERJA_AWAL_PROGRAM", name:"INDIPROG_KINERJA_AWAL_PROGRAM", labelWidth:180},
		{view:"text", label:"TARGET KINERJA AKHIR", id:"ADD_INDIPROG_TARGET_AKHIR_KINERJA_PROGRAM", name:"INDIPROG_TARGET_AKHIR_KINERJA_PROGRAM",labelWidth:180},
		{view:"text", label:"TARGET KINERJA TAHUN KE-1", id:"ADD_INDIPROG_TARGET_KINERJA_PROG_TAHUN1",name:"INDIPROG_TARGET_KINERJA_PROG_TAHUN1", labelWidth:180},
		{view:"text", label:"TARGET KINERJA TAHUN KE-2", id:"ADD_INDIPROG_TARGET_KINERJA_PROG_TAHUN2",name:"INDIPROG_TARGET_KINERJA_PROG_TAHUN2", labelWidth:180},
		{view:"text", label:"TARGET KINERJA TAHUN KE-3", id:"ADD_INDIPROG_TARGET_KINERJA_PROG_TAHUN3",name:"INDIPROG_TARGET_KINERJA_PROG_TAHUN3", labelWidth:180},
		{view:"text", label:"TARGET KINERJA TAHUN KE-4", id:"ADD_INDIPROG_TARGET_KINERJA_PROG_TAHUN4",name:"INDIPROG_TARGET_KINERJA_PROG_TAHUN4", labelWidth:180},
		{view:"text", label:"TARGET KINERJA TAHUN KE-5", id:"ADD_INDIPROG_TARGET_KINERJA_PROG_TAHUN5",name:"INDIPROG_TARGET_KINERJA_PROG_TAHUN5", labelWidth:180},
		{view:"textarea", 	label:"CATATAN REJECT",		 id:"ADD_INDIPROG_CATATAN_REJECT", name:"INDIPROG_CATATAN_REJECT",	labelWidth:180, disabled:true},
		{
			margin:5,
			cols:[
				{width:126},
				{view:"button", label:"Simpan", type:"form", align:"center", width:100, click:function(){
					dataAddIndiProg();
					// $$("WIN_DATA11_ADD").hide();
				}},
				{view:"button", label:"Cancel", align:"center", width:100, click:function(){
					$$("WIN_DATA11_ADD").hide();
				}},
				{}
			]
		}
	]
};


// add kegiatan
var FORM_DATA2_ADD = {
	view:"form",
	borderless:true,
	id:"FORM_KEGIATAN_ADD",
	// scroll:"xy",
	elementsConfig:{
		paddingY:5, paddingX:0,			
	},
	elements:[
		{view:"text", label:"STATUS KEGIATAN", 		  	id:"ADD_KEG_STATUS_RENSTRA", 	name:"KEG_STATUS_RENSTRA" ,	labelWidth:180, hidden:true},
		{view:"text", label:"DESKRIPSI", 		  	id:"ADD_DESKRIPSI", 	name:"KEG_DESKRIPSI" ,	labelWidth:180, hidden:true},
		{view:"text", label:"PRTID", 		id:"ADD_KEG_PRT_ID", 	name:"KEG_PRT_ID" ,	labelWidth:180, hidden:true},
		{view:"text", label:"OPD", 		  	id:"ADD_KEG_OPD_ID", 	name:"KEG_OPD_ID" ,	labelWidth:180, disabled:true},
		{view:"text", label:"SUB OPD", 		id:"ADD_KEG_SUB_OPD_ID", 	name:"KEG_SUB_OPD_ID" ,	labelWidth:180, disabled:true},	
		// {view:"combo",	label:"BIDANG OPD", 	id:"ADD_KEG_BIDANG_OPD_ID", 	name:"KEG_BIDANG_OPD_ID" ,	labelWidth:180, options: combo_bidang_opd},		
		// {view:"combo",	label:"PROGRAM", 		id:"ADD_KEG_PRG_FULL", name:"KEG_PRG_FULL",			labelWidth:180, options: combo_program},
		
		{view:"combo",	label:"KEGIATAN", 		 id:"ADD_KEG_KEG_FULL", name:"KEG_KEG_FULL", labelWidth:180, options: [{id:"", value:""},] },
		{view:"text", 	label:"PAGU TAHUN KE-1", id:"ADD_KEG_TARGET_PAGU_KEG_TAHUN1", 	name:"KEG_TARGET_PAGU_KEG_TAHUN1",	labelWidth:180, disabled:true },
		{view:"text", 	label:"PAGU TAHUN KE-2", id:"ADD_KEG_TARGET_PAGU_KEG_TAHUN2", 	name:"KEG_TARGET_PAGU_KEG_TAHUN2",	labelWidth:180, disabled:true},
		{view:"text", 	label:"PAGU TAHUN KE-3", id:"ADD_KEG_TARGET_PAGU_KEG_TAHUN3", 	name:"KEG_TARGET_PAGU_KEG_TAHUN3",	labelWidth:180, disabled:true},
		{view:"text", 	label:"PAGU TAHUN KE-4", id:"ADD_KEG_TARGET_PAGU_KEG_TAHUN4", 	name:"KEG_TARGET_PAGU_KEG_TAHUN4",	labelWidth:180, disabled:true},
		{view:"text", 	label:"PAGU TAHUN KE-5", id:"ADD_KEG_TARGET_PAGU_KEG_TAHUN5", 	name:"KEG_TARGET_PAGU_KEG_TAHUN5",	labelWidth:180, disabled:true},
		{
			margin:5,
			cols:[
				{width:126},
				{view:"button", label:"Simpan", type:"form", align:"center", width:100, click:function(){
					dataAddKeg();
					// $$("WIN_DATA2_ADD").hide();
				}},
				{view:"button", label:"Cancel", align:"center", width:100, click:function(){
					$$("WIN_DATA2_ADD").hide();
				}},
				{}
			]
		}
	]
	
};

// add indikator kegiatan
var FORM_DATA21_ADD = {
	view:"form",
	borderless:true,
	id:"FORM_INDI_KEGIATAN_ADD",
	// scroll:"xy",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements:[
		{view:"text", label:"STATUS RENSTRA", 	id:"INDIKEG_STATUS_RENSTRA", 	name:"INDIKEG_STATUS_RENSTRA" ,	labelWidth:180, hidden:true},
		{view:"text", label:"PRTID", 	id:"ADD_INDIKEG_PRT_ID", 	name:"INDIKEG_PRT_ID" ,	labelWidth:180, hidden:true},
		{view:"text", label:"OPD", 	id:"ADD_INDIKEG_OPD_ID", 	name:"INDIKEG_OPD_ID" ,	labelWidth:180, hidden:true},
		{view:"text", label:"SUB OPD", 	id:"ADD_INDIKEG_SUB_OPD_ID", 	name:"INDIKEG_SUB_OPD_ID" ,	labelWidth:180, hidden:true},
		{view:"combo", label:"KEG FULL", id:"ADD_INDIKEG_KEG_FULL", 	name:"INDIKEG_KEG_FULL" ,	labelWidth:180, option:[{id:"Admin", value:""},{id:"", value:""},],disabled:true},
		{view:"textarea", 	label:"INDIKATOR KEGIATAN", id:"ADD_INDIKEG_INDIKATOR_KEGIATAN", name:"INDIKEG_INDIKATOR_KEGIATAN", labelWidth:180},
		{view:"text", label:"SATUAN INDIKATOR", id:"ADD_INDIKEG_SATUAN_INDIKATOR_KEGIATAN", name:"INDIKEG_SATUAN_INDIKATOR_KEGIATAN", labelWidth:180},
		{view:"text", label:"KINERJA AWAL", 	id:"ADD_INDIKEG_KINERJA_AWAL_KEGIATAN", name:"INDIKEG_KINERJA_AWAL_KEGIATAN", labelWidth:180},
		{view:"text", label:"TARGET KINERJA AKHIR", id:"ADD_INDIKEG_TARGET_AKHIR_KINERJA_KEGIATAN", name:"INDIKEG_TARGET_AKHIR_KINERJA_KEGIATAN",labelWidth:180},
		{view:"text", label:"TARGET KINERJA TAHUN KE-1", id:"ADD_INDIKEG_TARGET_KINERJA_KEG_TAHUN1",name:"INDIKEG_TARGET_KINERJA_KEG_TAHUN1", labelWidth:180},
		{view:"text", label:"TARGET KINERJA TAHUN KE-2", id:"ADD_INDIKEG_TARGET_KINERJA_KEG_TAHUN2",name:"INDIKEG_TARGET_KINERJA_KEG_TAHUN2", labelWidth:180},
		{view:"text", label:"TARGET KINERJA TAHUN KE-3", id:"ADD_INDIKEG_TARGET_KINERJA_KEG_TAHUN3",name:"INDIKEG_TARGET_KINERJA_KEG_TAHUN3", labelWidth:180},
		{view:"text", label:"TARGET KINERJA TAHUN KE-4", id:"ADD_INDIKEG_TARGET_KINERJA_KEG_TAHUN4",name:"INDIKEG_TARGET_KINERJA_KEG_TAHUN4", labelWidth:180},
		{view:"text", label:"TARGET KINERJA TAHUN KE-5", id:"ADD_INDIKEG_TARGET_KINERJA_KEG_TAHUN5",name:"INDIKEG_TARGET_KINERJA_KEG_TAHUN5", labelWidth:180},
		{view:"textarea", 	label:"CATATAN REJECT",		 id:"ADD_INDIKEG_CATATAN_REJECT", name:"ADD_INDIKEG_CATATAN_REJECT",	labelWidth:180, disabled:true},
		{
			margin:5,
			cols:[
				{width:126},
				{view:"button", label:"Simpan", type:"form", align:"center", width:100, click:function(){
					dataAddIndKeg();
					// $$("WIN_DATA21_ADD").hide();
				}},
				{view:"button", label:"Cancel", align:"center", width:100, click:function(){
					$$("WIN_DATA21_ADD").hide();
				}},
				{}
			]
		}
	]
};

// add sub kegiatan
var FORM_DATA3_ADD = {
	view:"form",
	borderless:true,
	id:"FORM_SUBKEGIATAN_ADD",
	// scroll:"xy",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements:[
		
		{view:"text", label:"OPD",      id:"ADD_SUBKEG_OPD_ID", name:"SUBKEG_OPD_ID", labelWidth:180, hidden:true},
		{view:"text", label:"SUB OPD",  id:"ADD_SUBKEG_SUB_OPD_ID", name:"SUBKEG_SUB_OPD_ID", labelWidth:180, hidden:true},
		{view:"text", label:"BIDANG",   id:"ADD_SUBKEG_BIDANG_OPD_ID", name:"SUBKEG_BIDANG_OPD_ID", labelWidth:180, hidden:true},
		{view:"text", label:"DESKRIPSI",   id:"ADD_SUBKEG_DESKRIPSI", name:"SUBKEG_DESKRIPSI", labelWidth:180, hidden:true},
		// {view:"text", label:"URUSAN", id:"3URUSAN", labelWidth:180},
		// {view:"richselect", label:"PROGRAM",  id:"3PROGRAM", labelWidth:180, options:[{id:"Admin", value:""},{id:"", value:""},]},
		// {view:"richselect", label:"KEGIATAN", id:"3KEGIATAN", labelWidth:180, options:[{id:"Admin", value:""},{id:"", value:""},]},
		{view:"combo", label:"SUB KEGIATAN", id:"ADD_SUBKEG_SUBKEG_FULL", name:"SUBKEG_SUBKEG_FULL", labelWidth:180, options:[{id:"Admin", value:""},{id:"", value:""},]},
		// {view:"text", label:"TOTAL PAGU AKHIR PERIODE",	id:"3TOTAL PAGU", 				labelWidth:180},
		{view:"text", label:"PAGU TAHUN KE-1", id:"ADD_SUBKEG_TARGET_PAGU_SUBKEG_TAHUN1", name:"SUBKEG_TARGET_PAGU_SUBKEG_TAHUN1",  labelWidth:180},
		{view:"text", label:"PAGU TAHUN KE-2", id:"ADD_SUBKEG_TARGET_PAGU_SUBKEG_TAHUN2", name:"SUBKEG_TARGET_PAGU_SUBKEG_TAHUN2",	labelWidth:180},
		{view:"text", label:"PAGU TAHUN KE-3", id:"ADD_SUBKEG_TARGET_PAGU_SUBKEG_TAHUN3", name:"SUBKEG_TARGET_PAGU_SUBKEG_TAHUN3",	labelWidth:180},
		{view:"text", label:"PAGU TAHUN KE-4", id:"ADD_SUBKEG_TARGET_PAGU_SUBKEG_TAHUN4", name:"SUBKEG_TARGET_PAGU_SUBKEG_TAHUN4",	labelWidth:180},
		{view:"text", label:"PAGU TAHUN KE-5", id:"ADD_SUBKEG_TARGET_PAGU_SUBKEG_TAHUN5", name:"SUBKEG_TARGET_PAGU_SUBKEG_TAHUN5",	labelWidth:180},
		{
			margin:5,
			cols:[
				{width:126},
				{view:"button", label:"Simpan", type:"form", align:"center", width:100, click:function(){
					dataAddSubKeg();
					// $$("WIN_DATA3_ADD").hide();
				}},
				{view:"button", label:"Cancel", align:"center", width:100, click:function(){
					$$("WIN_DATA3_ADD").hide();
				}},
				{}
			]
		}
	]
};

// add indikator sub kegiatan
var FORM_DATA31_ADD = {
	view:"form",
	borderless:true,
	id:"FORM_INDI_SUBKEGIATAN_ADD",
	// scroll:"xy",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements:[
		
		{view:"text", label:"STATUS RENSTRA", 	id:"ADD_INDISUBKEG_PROSES_RENSTRA", 	name:"INDISUBKEG_PROSES_RENSTRA" ,	labelWidth:180, hidden:true},
		{view:"text", label:"PRTID", 	id:"ADD_INDISUBKEG_PRT_ID", 	name:"INDISUBKEG_PRT_ID" ,	labelWidth:180, hidden:true},
		{view:"text", label:"OPD", 	id:"ADD_INDISUBKEG_OPD_ID", 	name:"INDISUBKEG_OPD_ID" ,	labelWidth:180, hidden:true},
		{view:"text", label:"SUB OPD", 	id:"ADD_INDISUBKEG_SUB_OPD_ID", 	name:"INDISUBKEG_SUB_OPD_ID" ,	labelWidth:180, hidden:true},
		// {view:"combo", label:"KEG FULL", id:"ADD_INDIKEG_KEG_FULL", 	name:"INDIKEG_KEG_FULL" ,	labelWidth:180, option:[{id:"Admin", value:""},{id:"", value:""},],disabled:true},
		{view:"textarea", 	label:"INDIKATOR SUB KEGIATAN", id:"ADD_INDISUBKEG_INDIKATOR_SUBKEGIATAN", name:"INDISUBKEG_INDIKATOR_SUBKEGIATAN", labelWidth:180},
		{view:"text", label:"SATUAN INDIKATOR", id:"ADD_INDISUBKEG_SATUAN_INDIKATOR_SUBKEGIATAN", name:"INDISUBKEG_SATUAN_INDIKATOR_SUBKEGIATAN", labelWidth:180},
		{view:"text", label:"KINERJA AWAL", 	id:"ADD_INDISUBKEG_KINERJA_AWAL_SUBKEGIATAN", name:"INDISUBKEG_KINERJA_AWAL_SUBKEGIATAN", labelWidth:180},
		{view:"text", label:"TARGET KINERJA AKHIR", id:"ADD_INDISUBKEG_TARGET_AKHIR_KINERJA_SUBKEGIATAN", name:"INDISUBKEG_TARGET_AKHIR_KINERJA_SUBKEGIATAN",labelWidth:180},
		{view:"text", label:"TARGET KINERJA TAHUN KE-1", id:"ADD_INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN1",name:"INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN1", labelWidth:180},
		{view:"text", label:"TARGET KINERJA TAHUN KE-2", id:"ADD_INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN2",name:"INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN2", labelWidth:180},
		{view:"text", label:"TARGET KINERJA TAHUN KE-3", id:"ADD_INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN3",name:"INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN3", labelWidth:180},
		{view:"text", label:"TARGET KINERJA TAHUN KE-4", id:"ADD_INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN4",name:"INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN4", labelWidth:180},
		{view:"text", label:"TARGET KINERJA TAHUN KE-5", id:"ADD_INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN5",name:"INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN5", labelWidth:180},
		{view:"textarea", 	label:"CATATAN REJECT",		 id:"ADD_INDISUBKEG_CATATAN_REJECT", name:"INDISUBKEG_CATATAN_REJECT",	labelWidth:180, disabled:true},
		{
			margin:5,
			cols:[
				{width:126},
				{view:"button", label:"Simpan", type:"form", align:"center", width:100, click:function(){
					dataAddIndSubKeg();
					// $$("WIN_DATA31_ADD").hide();
				}},
				{view:"button", label:"Cancel", align:"center", width:100, click:function(){
					$$("WIN_DATA31_ADD").hide();
				}},
				{}
			]
		}
	]
};


// edit program
var FORM_DATA1_EDIT = {
	view:"form",
	borderless:true,
	id:"FORM_PROGRAM_EDIT1",
	// scroll:"xy",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements:[
		// {view:"combo", 		label:"SASARAN DAERAH", id:"SASARAN_DAERAH_ID", 	name:"SASARAN_DAERAH_ID" ,	labelWidth:180, options: combo_sasaran_daerah, disabled:true},
		// {view:"text", 		label:"URUSAN",		    id:"URS_ID", name:"URS_ID",		labelWidth:180, disabled:true},
		// {view:"text", 		label:"BIDANG URUSAN", 	id:"BID_URS_ID", name:"BID_URS_ID",	labelWidth:180, disabled:true},
		// {view:"text", 		label:"OPD", 		  	id:"OPD_ID", 	name:"OPD_ID" ,	labelWidth:180, disabled:true},
		// {view:"text", 		label:"SUB OPD", 		id:"SUB_OPD_ID", 	name:"SUB_OPD_ID" ,	labelWidth:180, disabled:true},	
		// {view:"combo", 		label:"BIDANG OPD", 	id:"BIDANG_OPD_ID", 	name:"BIDANG_OPD_ID" ,	labelWidth:180, options: combo_bidang_opd},
		// {view:"combo", 		label:"TUJUAN PERANGKAT DAERAH", 	id:"TUJUAN_PD_ID", 	name:"TUJUAN_PD_ID" ,	labelWidth:180, options: combo_tujuan_pd},
		// {view:"combo", 		label:"SASARAN PERANGKAT DAERAH", 	id:"SASARAN_PD_ID", 	name:"SASARAN_PD_ID" ,	labelWidth:180, options: combo_sasaran_pd},	
		{view:"textarea", 			label:"CATATAN REJECT",	 id:"CATATAN_REJECT", 	name:"CATATAN_REJECT",	labelWidth:180, disabled:false},
		{view:"combo", 		label:"PROGRAM", 	id:"PRG_FULL", name:"PRG_FULL",			labelWidth:180, options: combo_program, disabled:true},
		// {view:"text", 		label:"DESKRIPSI", 	id:"DESKRIPSI", name:"DESKRIPSI",		labelWidth:180, options:[{id:"Admin", value:""},{id:"", value:""},]},
		// {view:"text", 			label:"TOTAL PAGU AKHIR PERIODE",	id:"TARGET_AKHIR_PAGU_PROGRAMU", 				labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-1", id:"TARGET_PAGU_PROG_TAHUN1", 	name:"TARGET_PAGU_PROG_TAHUN1",	labelWidth:180, disabled:true},
		{view:"text", 			label:"PAGU TAHUN KE-2", id:"TARGET_PAGU_PROG_TAHUN2", 	name:"TARGET_PAGU_PROG_TAHUN2",	labelWidth:180, disabled:true},
		{view:"text", 			label:"PAGU TAHUN KE-3", id:"TARGET_PAGU_PROG_TAHUN3", 	name:"TARGET_PAGU_PROG_TAHUN3",	labelWidth:180, disabled:true},
		{view:"text", 			label:"PAGU TAHUN KE-4", id:"TARGET_PAGU_PROG_TAHUN4", 	name:"TARGET_PAGU_PROG_TAHUN4",	labelWidth:180, disabled:true},
		{view:"text", 			label:"PAGU TAHUN KE-5", id:"TARGET_PAGU_PROG_TAHUN5", 	name:"TARGET_PAGU_PROG_TAHUN5",	labelWidth:180, disabled:true},		
		{view:"text", 			label:"STATUS RENSTRA",	 id:"STATUS_RENSTRA", 	name:"STATUS_RENSTRA",	labelWidth:180, disabled:true},
		{
			margin:5,
			cols:[
				{width:116},
				{view:"button", label:"Simpan", type:"form", align:"center", width:100, click:function(){
					dataEdit1();
					// $$("WIN_DATA1_EDIT").hide();
				}},
				{view:"button", label:"Cancel", align:"center", width:100, click:function(){
					$$("WIN_DATA1_EDIT").hide();
				}},
				{}
			]
		}
	]
};

// edit indikator program
var FORM_DATA11_EDIT = {
	view:"form",
	borderless:true,
	id:"FORM_INDI_PROGRAM_EDIT",
	// scroll:"xy",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements:[
		{view:"textarea", 	label:"CATATAN REJECT",		 id:"INDIPROG_CATATAN_REJECT", name:"INDIPROG_CATATAN_REJECT",	labelWidth:180, disabled:false},
		{view:"textarea", 	label:"INDIKATOR PROGRAM", id:"INDIPROG_INDIKATOR_PROGRAM", name:"INDIPROG_INDIKATOR_PROGRAM", labelWidth:180, disabled:true},
		{view:"text", label:"SATUAN INDIKATOR", id:"INDIPROG_SATUAN_INDIKATOR_PROGRAM", name:"INDIPROG_SATUAN_INDIKATOR_PROGRAM", labelWidth:180, disabled:true},
		{view:"text", label:"KINERJA AWAL", 	id:"INDIPROG_KINERJA_AWAL_PROGRAM", name:"INDIPROG_KINERJA_AWAL_PROGRAM", labelWidth:180, disabled:true},
		{view:"text", label:"TARGET KINERJA AKHIR", id:"INDIPROG_TARGET_AKHIR_KINERJA_PROGRAM", name:"INDIPROG_TARGET_AKHIR_KINERJA_PROGRAM",labelWidth:180, disabled:true},
		{view:"text", label:"TARGET KINERJA TAHUN KE-1", id:"INDIPROG_TARGET_KINERJA_PROG_TAHUN1",name:"INDIPROG_TARGET_KINERJA_PROG_TAHUN1", labelWidth:180, disabled:true},
		{view:"text", label:"TARGET KINERJA TAHUN KE-2", id:"INDIPROG_TARGET_KINERJA_PROG_TAHUN2",name:"INDIPROG_TARGET_KINERJA_PROG_TAHUN2", labelWidth:180, disabled:true},
		{view:"text", label:"TARGET KINERJA TAHUN KE-3", id:"INDIPROG_TARGET_KINERJA_PROG_TAHUN3",name:"INDIPROG_TARGET_KINERJA_PROG_TAHUN3", labelWidth:180, disabled:true},
		{view:"text", label:"TARGET KINERJA TAHUN KE-4", id:"INDIPROG_TARGET_KINERJA_PROG_TAHUN4",name:"INDIPROG_TARGET_KINERJA_PROG_TAHUN4", labelWidth:180, disabled:true},
		{view:"text", label:"TARGET KINERJA TAHUN KE-5", id:"INDIPROG_TARGET_KINERJA_PROG_TAHUN5",name:"INDIPROG_TARGET_KINERJA_PROG_TAHUN5", labelWidth:180, disabled:true},		
		{
			margin:5,
			cols:[
				{width:116},
				{view:"button", label:"Simpan", type:"form", align:"center", width:100, click:function(){
					dataEditIndiProg();
					// $$("WIN_DATA11_EDIT").hide();
				}},
				{view:"button", label:"Cancel", align:"center", width:100, click:function(){
					$$("WIN_DATA11_EDIT").hide();
				}},
				{}
			]
		}
	]
};

// edit kegiatan
var FORM_DATA2_EDIT = {
	view:"form",
	borderless:true,
	id:"FORM_KEGIATAN_EDIT",
	// scroll:"xy",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements:[
		// {view:"text", 			label:"OPD", 	id:"KEG_OPD_ID", name:"KEG_OPD_ID",					labelWidth:180},
		// {view:"text", 			label:"URUSAN", 									id:"2E-URUSAN", 						labelWidth:180},
		//{view:"text", 			label:"BIDANG",	id:"KEG_BIDANG_OPD_ID", name:"KEG_BIDANG_OPD_ID", labelWidth:180},		
		{view:"textarea", 	label:"CATATAN REJECT",		id:"KEG_CATATAN_REJECT", name: "KEG_CATATAN_REJECT", labelWidth:180, disabled:false},
		{view:"combo", label:"PROGRAM", id:"KEG_PRG_FULL", name:"KEG_PRG_FULL", labelWidth:180, options:combo_program, hidden:true},
		// {view:"combo", label:"KEGIATAN", id:"KEG_KEG_FULL", name:"KEG_KEG_FULL", labelWidth:180, options:combo_kegiatan, hidden:true},
		{view:"textarea", label:"KEGIATAN", id:"KEG_DESKRIPSI", name:"KEG_DESKRIPSI", labelWidth:180, disabled:true},
		// {view:"text", 			label:"TOTAL PAGU AKHIR PERIODE",	id:"2E-TOTAL PAGU", 				labelWidth:180},
		{view:"text", 	label:"PAGU TAHUN KE-1",	id:"KEG_TARGET_PAGU_KEG_TAHUN1",	name:"KEG_TARGET_PAGU_KEG_TAHUN1",	labelWidth:180, disabled:true},
		{view:"text", 	label:"PAGU TAHUN KE-2",	id:"KEG_TARGET_PAGU_KEG_TAHUN2",	name:"KEG_TARGET_PAGU_KEG_TAHUN2", 	labelWidth:180, disabled:true},
		{view:"text", 	label:"PAGU TAHUN KE-3",	id:"KEG_TARGET_PAGU_KEG_TAHUN3",	name:"KEG_TARGET_PAGU_KEG_TAHUN3", 	labelWidth:180, disabled:true},
		{view:"text", 	label:"PAGU TAHUN KE-4",	id:"KEG_TARGET_PAGU_KEG_TAHUN4",	name:"KEG_TARGET_PAGU_KEG_TAHUN4", 	labelWidth:180, disabled:true},
		{view:"text", 	label:"PAGU TAHUN KE-5",	iid:"KEG_TARGET_PAGU_KEG_TAHUN5",	name:"KEG_TARGET_PAGU_KEG_TAHUN5",	labelWidth:180, disabled:true},
		{
			margin:5,
			cols:[
				{width:116},
				{view:"button", label:"Simpan", type:"form", align:"center", width:100, click:function(){
					dataEditKeg();
					$$("WIN_DATA2_EDIT").hide();
				}},
				{view:"button", label:"Cancel", align:"center", width:100, click:function(){
					$$("WIN_DATA2_EDIT").hide();
				}},
				{}
			]
		}
	]
};

// edit indikator kegiatan
var FORM_DATA21_EDIT = {
	view:"form",
	borderless:true,
	id:"FORM_INDI_KEGIATAN_EDIT",
	// scroll:"xy",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements:[
		{view:"textarea", 	label:"CATATAN REJECT",		 id:"INDIKEG_CATATAN_REJECT", name:"INDIKEG_CATATAN_REJECT",	labelWidth:180, disabled:false},
		{view:"textarea", 	label:"INDIKATOR KEGIATAN", id:"INDIKEG_INDIKATOR_KEGIATAN", name:"INDIKEG_INDIKATOR_KEGIATAN", labelWidth:180, disabled:true},
		{view:"text", label:"SATUAN INDIKATOR", id:"INDIKEG_SATUAN_INDIKATOR_KEGIATAN", name:"INDIKEG_SATUAN_INDIKATOR_KEGIATAN", labelWidth:180, disabled:true},
		{view:"text", label:"KINERJA AWAL", 	id:"INDIKEG_KINERJA_AWAL_KEGIATAN", name:"INDIKEG_KINERJA_AWAL_KEGIATAN", labelWidth:180, disabled:true},
		{view:"text", label:"TARGET KINERJA AKHIR", id:"INDIKEG_TARGET_AKHIR_KINERJA_PROGRAM", name:"INDIKEG_TARGET_AKHIR_KINERJA_KEGIATAN",labelWidth:180, disabled:true},
		{view:"text", label:"TARGET KINERJA TAHUN KE-1", id:"INDIKEG_TARGET_KINERJA_KEG_TAHUN1",name:"INDIKEG_TARGET_KINERJA_KEG_TAHUN1", labelWidth:180, disabled:true},
		{view:"text", label:"TARGET KINERJA TAHUN KE-2", id:"INDIKEG_TARGET_KINERJA_KEG_TAHUN2",name:"INDIKEG_TARGET_KINERJA_KEG_TAHUN2", labelWidth:180, disabled:true},
		{view:"text", label:"TARGET KINERJA TAHUN KE-3", id:"INDIKEG_TARGET_KINERJA_KEG_TAHUN3",name:"INDIKEG_TARGET_KINERJA_KEG_TAHUN3", labelWidth:180, disabled:true},
		{view:"text", label:"TARGET KINERJA TAHUN KE-4", id:"INDIKEG_TARGET_KINERJA_KEG_TAHUN4",name:"INDIKEG_TARGET_KINERJA_KEG_TAHUN4", labelWidth:180, disabled:true},
		{view:"text", label:"TARGET KINERJA TAHUN KE-5", id:"INDIKEG_TARGET_KINERJA_KEG_TAHUN5",name:"INDIKEG_TARGET_KINERJA_KEG_TAHUN5", labelWidth:180, disabled:true},
		
		{
			margin:5,
			cols:[
				{width:116},
				{view:"button", label:"Simpan", type:"form", align:"center", width:100, click:function(){
					dataEditIndiKeg();
					// $$("WIN_DATA21_EDIT").hide();
				}},
				{view:"button", label:"Cancel", align:"center", width:100, click:function(){
					$$("WIN_DATA21_EDIT").hide();
				}},
				{}
			]
		}
	]
};

// edit sub kegiatan
var FORM_DATA3_EDIT = {
	view:"form",
	borderless:true,
	id:"FORM_SUBKEGIATAN_EDIT",
	// scroll:"xy",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements:[
		// {view:"text", 			label:"OPD", 	id:"KEG_OPD_ID", name:"KEG_OPD_ID",					labelWidth:180},
		// {view:"text", 			label:"URUSAN", 									id:"2E-URUSAN", 						labelWidth:180},
		// {view:"combo", 			label:"BIDANG",	id:"SUBKEG_BIDANG_OPD_ID", name:"SUBKEG_BIDANG_OPD_ID", labelWidth:180, options:combo_bidang_opd},		
		// {view:"combo", label:"PROGRAM", id:"SUBKEG_PRG_FULL", name:"SUBKEG_PRG_FULL", labelWidth:180, options:combo_program, hidden:true},
		// {view:"combo", label:"KEGIATAN", id:"SUBKEG_KEG_FULL", name:"SUBKEG_KEG_FULL", labelWidth:180, options:combo_kegiatan, hidden:true},
		// {view:"text", 	label:"SUB KEGIATAN",	id:"SUBKEG_SUBKEG_FULL", name:"SUBKEG_SUBKEG_FULL",		labelWidth:180, hidden:true},
		{view:"textarea", 	label:"CATATAN REJECT",		id:"SUBKEG_CATATAN_REJECT", name: "SUBKEG_CATATAN_REJECT", labelWidth:180, disabled:false},
		{view:"textarea", 	label:"SUB KEGIATAN",	id:"SUBKEG_DESKRIPSI", name:"SUBKEG_DESKRIPSI",		labelWidth:180, disabled:true},
		{view:"text", label:"PAGU TAHUN KE-1",id:"SUBKEG_TARGET_PAGU_SUBKEG_TAHUN1",name:"SUBKEG_TARGET_PAGU_SUBKEG_TAHUN1",labelWidth:180, disabled:true},
		{view:"text", label:"PAGU TAHUN KE-2",id:"SUBKEG_TARGET_PAGU_SUBKEG_TAHUN2",name:"SUBKEG_TARGET_PAGU_SUBKEG_TAHUN2",labelWidth:180, disabled:true},
		{view:"text", label:"PAGU TAHUN KE-3",id:"SUBKEG_TARGET_PAGU_SUBKEG_TAHUN3",name:"SUBKEG_TARGET_PAGU_SUBKEG_TAHUN3",labelWidth:180, disabled:true},
		{view:"text", label:"PAGU TAHUN KE-4",id:"SUBKEG_TARGET_PAGU_SUBKEG_TAHUN4",name:"SUBKEG_TARGET_PAGU_SUBKEG_TAHUN4",labelWidth:180, disabled:true},
		{view:"text", label:"PAGU TAHUN KE-5",iid:"SUBKEG_TARGET_PAGU_SUBKEG_TAHUN5",name:"SUBKEG_TARGET_PAGU_SUBKEG_TAHUN5",labelWidth:180, disabled:true},
		{
			margin:5,
			cols:[
				{width:116},
				{view:"button", label:"Simpan", type:"form", align:"center", width:100, click:function(){
					dataEditSubKeg();
					// $$("WIN_DATA3_EDIT").hide();
				}},
				{view:"button", label:"Cancel", align:"center", width:100, click:function(){
					$$("WIN_DATA3_EDIT").hide();
				}},
				{}
			]
		}
	]
};

// edit indikator sub kegiatan
var FORM_DATA31_EDIT = {
	view:"form",
	borderless:true,
	id:"FORM_INDI_SUBKEGIATAN_EDIT",
	// scroll:"xy",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements:[
		{view:"textarea", 	label:"CATATAN REJECT",		 id:"EDIT_INDISUBKEG_CATATAN_REJECT", name:"INDISUBKEG_CATATAN_REJECT",	labelWidth:180, disabled:false},
		{view:"text", label:"STATUS RENSTRA", 	id:"EDIT_INDISUBKEG_PROSES_RENSTRA", 	name:"INDISUBKEG_PROSES_RENSTRA" ,	labelWidth:180, hidden:true},
		{view:"text", label:"PRTID", 	id:"EDIT_INDISUBKEG_PRT_ID", 	name:"INDISUBKEG_PRT_ID" ,	labelWidth:180, hidden:true},
		{view:"text", label:"OPD", 	id:"EDIT_INDISUBKEG_OPD_ID", 	name:"INDISUBKEG_OPD_ID" ,	labelWidth:180, hidden:true},
		{view:"text", label:"SUB OPD", 	id:"EDIT_INDISUBKEG_SUB_OPD_ID", 	name:"INDISUBKEG_SUB_OPD_ID" ,	labelWidth:180, hidden:true},
		// {view:"combo", label:"KEG FULL", id:"ADD_INDIKEG_KEG_FULL", 	name:"INDIKEG_KEG_FULL" ,	labelWidth:180, option:[{id:"Admin", value:""},{id:"", value:""},],disabled:true},
		{view:"textarea", 	label:"INDIKATOR SUB KEGIATAN", id:"EDIT_INDISUBKEG_INDIKATOR_SUBKEGIATAN", name:"INDISUBKEG_INDIKATOR_SUBKEGIATAN", labelWidth:180, disabled:true},
		{view:"text", label:"SATUAN INDIKATOR", id:"EDIT_INDISUBKEG_SATUAN_INDIKATOR_SUBKEGIATAN", name:"INDISUBKEG_SATUAN_INDIKATOR_SUBKEGIATAN", labelWidth:180, disabled:true},
		{view:"text", label:"KINERJA AWAL", 	id:"EDIT_INDISUBKEG_KINERJA_AWAL_SUBKEGIATAN", name:"INDISUBKEG_KINERJA_AWAL_SUBKEGIATAN", labelWidth:180, disabled:true},
		{view:"text", label:"TARGET KINERJA AKHIR", id:"EDIT_INDISUBKEG_TARGET_AKHIR_KINERJA_SUBKEGIATAN", name:"INDISUBKEG_TARGET_AKHIR_KINERJA_SUBKEGIATAN",labelWidth:180, disabled:true},
		{view:"text", label:"TARGET KINERJA TAHUN KE-1", id:"EDIT_INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN1",name:"INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN1", labelWidth:180, disabled:true},
		{view:"text", label:"TARGET KINERJA TAHUN KE-2", id:"EDIT_INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN2",name:"INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN2", labelWidth:180, disabled:true},
		{view:"text", label:"TARGET KINERJA TAHUN KE-3", id:"EDIT_INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN3",name:"INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN3", labelWidth:180, disabled:true},
		{view:"text", label:"TARGET KINERJA TAHUN KE-4", id:"EDIT_INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN4",name:"INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN4", labelWidth:180, disabled:true},
		{view:"text", label:"TARGET KINERJA TAHUN KE-5", id:"EDIT_INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN5",name:"INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN5", labelWidth:180, disabled:true},		
		{
			margin:5,
			cols:[
				{width:116},
				{view:"button", label:"Simpan", type:"form", align:"center", width:100, click:function(){
					dataEditIndSubKeg();
					// $$("WIN_DATA31_EDIT").hide();
				}},
				{view:"button", label:"Cancel", align:"center", width:100, click:function(){
					$$("WIN_DATA31_EDIT").hide();
				}},
				{}
			]
		}
	]
};


// delete program
var FORM_DATA1_DELETE = {
	view:"form",
	borderless:true,
	id:"FORM_PROGRAM_DELETE1",
	// scroll:"xy",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements:[
		
		{view:"combo", 		label:"SASARAN DAERAH", id:"DELETE_SASARAN_DAERAH_ID", 	name:"SASARAN_DAERAH_ID" ,	labelWidth:180, options: combo_sasaran_daerah, disabled:true},
		// {view:"text", 		label:"URUSAN",		    id:"DELETE_URS_ID", name:"URS_ID",		labelWidth:180, disabled:true},
		// {view:"text", 		label:"BIDANG URUSAN", 	id:"DELETE_BID_URS_ID", name:"BID_URS_ID",	labelWidth:180, disabled:true},
		// {view:"text", 		label:"OPD", 		  	id:"DELETE_OPD_ID", 	name:"OPD_ID" ,	labelWidth:180, disabled:true},
		// {view:"text", 		label:"SUB OPD", 		id:"DELETE_SUB_OPD_ID", 	name:"SUB_OPD_ID" ,	labelWidth:180, disabled:true},	
		{view:"combo", 		label:"BIDANG OPD", 	id:"DELETE_BIDANG_OPD_ID", 	name:"BIDANG_OPD_ID" ,	labelWidth:180, options: combo_bidang_opd},
		{view:"combo", 		label:"TUJUAN PERANGKAT DAERAH", 	id:"DELETE_TUJUAN_PD_ID", 	name:"TUJUAN_PD_ID" ,	labelWidth:180, options: combo_tujuan_pd},
		{view:"combo", 		label:"SASARAN PERANGKAT DAERAH", 	id:"DELETE_SASARAN_PD_ID", 	name:"SASARAN_PD_ID" ,	labelWidth:180, options: combo_sasaran_pd},	
		{view:"combo", 		label:"PROGRAM", 	id:"DELETE_PRG_FULL", name:"PRG_FULL",			labelWidth:180, options: combo_program},
		// {view:"text", 		label:"DESKRIPSI", 	id:"DELETE_DESKRIPSI", name:"DESKRIPSI",		labelWidth:180, options:[{id:"Admin", value:""},{id:"", value:""},]},
		// {view:"text", 			label:"TOTAL PAGU AKHIR PERIODE",	id:"DELETE_ARGET_AKHIR_PAGU_PROGRAMU", 				labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-1", id:"DELETE_ARGET_PAGU_PROG_TAHUN1", 	name:"TARGET_PAGU_PROG_TAHUN1",			labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-2", id:"DELETE_TARGET_PAGU_PROG_TAHUN2", 	name:"TARGET_PAGU_PROG_TAHUN2",	   		labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-3", id:"DELETE_TARGET_PAGU_PROG_TAHUN3", 	name:"TARGET_PAGU_PROG_TAHUN3",			labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-4", id:"DELETE_TARGET_PAGU_PROG_TAHUN4", 	name:"TARGET_PAGU_PROG_TAHUN4",			 labelWidth:180},
		{view:"text", 			label:"PAGU TAHUN KE-5", id:"DELETE_TARGET_PAGU_PROG_TAHUN5", 	name:"TARGET_PAGU_PROG_TAHUN5",			labelWidth:180},
		{view:"textarea", 			label:"CATATAN REJECT",	 id:"DELETE_CATATAN_REJECT", 	name:"CATATAN_REJECT",	labelWidth:180, disabled:true},
		// {view:"text", 			label:"STATUS RENSTRA",	 id:"DELETE_STATUS_RENSTRA", 	name:"STATUS_RENSTRA",	labelWidth:180, disabled:true},
		{
			margin:5,
			cols:[
				{width:126},
				{view:"button", label:"Delete", type:"form", align:"center", width:100, click:function(){
					dataDeleteProgram();
					// $$("WIN_DATA1_DELETE").hide();
				}},
				{view:"button", label:"Cancel", align:"center", width:100, click:function(){
					$$("WIN_DATA1_DELETE").hide();
				}},
				{}
			]
		}
	]
};

// delete indikator program
var FORM_DATA11_DELETE = {
	view:"form",
	borderless:true,
	id:"FORM_INDI_PROGRAM_DELETE",
	// scroll:"xy",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements:[
		
		{view:"textarea", 	label:"INDIKATOR PROGRAM", id:"DEL_INDIPROG_INDIKATOR_PROGRAM", name:"INDIPROG_INDIKATOR_PROGRAM", labelWidth:180},
		{view:"text", label:"SATUAN INDIKATOR", id:"DEL_INDIPROG_SATUAN_INDIKATOR_PROGRAM", name:"INDIPROG_SATUAN_INDIKATOR_PROGRAM", labelWidth:180},
		{view:"text", label:"KINERJA AWAL", 	id:"DEL_INDIPROG_KINERJA_AWAL_PROGRAM", name:"INDIPROG_KINERJA_AWAL_PROGRAM", labelWidth:180},
		{view:"text", label:"TARGET KINERJA AKHIR", id:"DEL_INDIPROG_TARGET_AKHIR_KINERJA_PROGRAM", name:"INDIPROG_TARGET_AKHIR_KINERJA_PROGRAM",labelWidth:180},
		{view:"text", label:"TARGET KINERJA TAHUN KE-1", id:"DEL_INDIPROG_TARGET_KINERJA_PROG_TAHUN1",name:"INDIPROG_TARGET_KINERJA_PROG_TAHUN1", labelWidth:180},
		{view:"text", label:"TARGET KINERJA TAHUN KE-2", id:"DEL_INDIPROG_TARGET_KINERJA_PROG_TAHUN2",name:"INDIPROG_TARGET_KINERJA_PROG_TAHUN2", labelWidth:180},
		{view:"text", label:"TARGET KINERJA TAHUN KE-3", id:"DEL_INDIPROG_TARGET_KINERJA_PROG_TAHUN3",name:"INDIPROG_TARGET_KINERJA_PROG_TAHUN3", labelWidth:180},
		{view:"text", label:"TARGET KINERJA TAHUN KE-4", id:"DEL_INDIPROG_TARGET_KINERJA_PROG_TAHUN4",name:"INDIPROG_TARGET_KINERJA_PROG_TAHUN4", labelWidth:180},
		{view:"text", label:"TARGET KINERJA TAHUN KE-5", id:"DEL_INDIPROG_TARGET_KINERJA_PROG_TAHUN5",name:"INDIPROG_TARGET_KINERJA_PROG_TAHUN5", labelWidth:180},
		{view:"textarea", 	label:"CATATAN REJECT",		 id:"DEL_INDIPROG_CATATAN_REJECT", name:"INDIPROG_CATATAN_REJECT",	labelWidth:180, disabled:true},

		{
			margin:5,
			cols:[
				{width:126},
				{view:"button", label:"Delete", type:"form", align:"center", width:100, click:function(){
					dataDeleteIndiProgram();
					// $$("WIN_DATA11_DELETE").hide();
				}},
				{view:"button", label:"Cancel", align:"center", width:100, click:function(){
					$$("WIN_DATA11_DELETE").hide();
				}},
				{}
			]
		}
	]
};

// delete kegiatan
var FORM_DATA2_DELETE = {
	view:"form",
	borderless:true,
	id:"FORM_KEGIATAN_DELETE",
	// scroll:"xy",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements:[
		
		// {view:"text", 			label:"BIDANG",	id:"DEL_KEG_BIDANG_OPD_ID", name:"KEG_BIDANG_OPD_ID", labelWidth:180},		
		// {view:"combo", label:"PROGRAM", id:"DEL_KEG_PRG_FULL", name:"KEG_PRG_FULL", labelWidth:180, options:combo_program},
		{view:"textarea", label:"KEGIATAN", id:"DEL_KEG_KEG_FULL", name:"KEG_DESKRIPSI", labelWidth:180},
		// {view:"text", 			label:"TOTAL PAGU AKHIR PERIODE",	id:"2E-TOTAL PAGU", 				labelWidth:180},
		{view:"text", label:"PAGU TAHUN KE-1",	id:"DEL_KEG_TARGET_PAGU_KEG_TAHUN1",	name:"KEG_TARGET_PAGU_KEG_TAHUN1",	labelWidth:180, disabled:true},
		{view:"text", label:"PAGU TAHUN KE-2",	id:"DEL_KEG_TARGET_PAGU_KEG_TAHUN2",	name:"KEG_TARGET_PAGU_KEG_TAHUN2", 	labelWidth:180, disabled:true},
		{view:"text", label:"PAGU TAHUN KE-3",	id:"DEL_KEG_TARGET_PAGU_KEG_TAHUN3",	name:"KEG_TARGET_PAGU_KEG_TAHUN3", 	labelWidth:180, disabled:true},
		{view:"text", label:"PAGU TAHUN KE-4",	id:"DEL_KEG_TARGET_PAGU_KEG_TAHUN4",	name:"KEG_TARGET_PAGU_KEG_TAHUN4", 	labelWidth:180, disabled:true},
		{view:"text", label:"PAGU TAHUN KE-5",	iid:"DEL_KEG_TARGET_PAGU_KEG_TAHUN5",	name:"KEG_TARGET_PAGU_KEG_TAHUN5",	labelWidth:180, disabled:true},
		{view:"textarea", label:"CATATAN REJECT",		id:"DEL_KEG_CATATAN_REJECT", name: "KEG_CATATAN_REJECT", labelWidth:180, disabled:true},
		{
			margin:5,
			cols:[
				{width:126},
				{view:"button", label:"Delete", type:"form", align:"center", width:100, click:function(){
					dataDeleteKegiatan();
					// $$("WIN_DATA2_DELETE").hide();
				}},
				{view:"button", label:"Cancel", align:"center", width:100, click:function(){
					$$("WIN_DATA2_DELETE").hide();
				}},
				{}
			]
		}
	]
};

// delete indikator kegiatan
var FORM_DATA21_DELETE = {
	view:"form",
	borderless:true,
	id:"FORM_INDI_KEGIATAN_DELETE",
	// scroll:"xy",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements:[
		
		{view:"textarea", 	label:"INDIKATOR KEGIATAN", id:"DEL_INDIKEG_INDIKATOR_KEGIATAN", name:"INDIKEG_INDIKATOR_KEGIATAN", labelWidth:180},
		{view:"text", label:"SATUAN INDIKATOR", id:"DEL_INDIKEG_SATUAN_INDIKATOR_KEGIATAN", name:"INDIKEG_SATUAN_INDIKATOR_KEGIATAN", labelWidth:180},
		{view:"text", label:"KINERJA AWAL", 	id:"DEL_INDIKEG_KINERJA_AWAL_KEGIATAN", name:"INDIKEG_KINERJA_AWAL_KEGIATAN", labelWidth:180},
		{view:"text", label:"TARGET KINERJA AKHIR", id:"DEL_INDIKEG_TARGET_AKHIR_KINERJA_PROGRAM", name:"INDIKEG_TARGET_AKHIR_KINERJA_KEGIATAN",labelWidth:180},
		{view:"text", label:"TARGET KINERJA TAHUN KE-1", id:"DEL_INDIKEG_TARGET_KINERJA_KEG_TAHUN1",name:"INDIKEG_TARGET_KINERJA_KEG_TAHUN1", labelWidth:180},
		{view:"text", label:"TARGET KINERJA TAHUN KE-2", id:"DEL_INDIKEG_TARGET_KINERJA_KEG_TAHUN2",name:"INDIKEG_TARGET_KINERJA_KEG_TAHUN2", labelWidth:180},
		{view:"text", label:"TARGET KINERJA TAHUN KE-3", id:"DEL_INDIKEG_TARGET_KINERJA_KEG_TAHUN3",name:"INDIKEG_TARGET_KINERJA_KEG_TAHUN3", labelWidth:180},
		{view:"text", label:"TARGET KINERJA TAHUN KE-4", id:"DEL_INDIKEG_TARGET_KINERJA_KEG_TAHUN4",name:"INDIKEG_TARGET_KINERJA_KEG_TAHUN4", labelWidth:180},
		{view:"text", label:"TARGET KINERJA TAHUN KE-5", id:"DEL_INDIKEG_TARGET_KINERJA_KEG_TAHUN5",name:"INDIKEG_TARGET_KINERJA_KEG_TAHUN5", labelWidth:180},
		{view:"textarea", 	label:"CATATAN REJECT",		 id:"DEL_INDIKEG_CATATAN_REJECT", name:"INDIKEG_CATATAN_REJECT",	labelWidth:180, disabled:true},
		{
			margin:5,
			cols:[
				{width:126},
				{view:"button", label:"Delete", type:"form", align:"center", width:100, click:function(){
					dataDeleteIndiKegiatan();
					// $$("WIN_DATA21_DELETE").hide();
				}},
				{view:"button", label:"Cancel", align:"center", width:100, click:function(){
					$$("WIN_DATA21_DELETE").hide();
				}},
				{}
			]
		}
	]
};

// delete sub kegiatan
var FORM_DATA3_DELETE = {
	view:"form",
	borderless:true,
	id:"FORM_SUBKEGIATAN_DELETE",
	// scroll:"xy",
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements:[
		
		{view:"textarea", 	label:"SUB KEGIATAN",	id:"DEL_SUBKEG_DESKRIPSI", name:"SUBKEG_DESKRIPSI",		labelWidth:180, disabled:true},
		{view:"text", label:"PAGU TAHUN KE-1",id:"DEL_SUBKEG_TARGET_PAGU_SUBKEG_TAHUN1",name:"SUBKEG_TARGET_PAGU_SUBKEG_TAHUN1",labelWidth:180, disabled:false},
		{view:"text", label:"PAGU TAHUN KE-2",id:"DEL_SUBKEG_TARGET_PAGU_SUBKEG_TAHUN2",name:"SUBKEG_TARGET_PAGU_SUBKEG_TAHUN2",labelWidth:180, disabled:false},
		{view:"text", label:"PAGU TAHUN KE-3",id:"DEL_SUBKEG_TARGET_PAGU_SUBKEG_TAHUN3",name:"SUBKEG_TARGET_PAGU_SUBKEG_TAHUN3",labelWidth:180, disabled:false},
		{view:"text", label:"PAGU TAHUN KE-4",id:"DEL_SUBKEG_TARGET_PAGU_SUBKEG_TAHUN4",name:"SUBKEG_TARGET_PAGU_SUBKEG_TAHUN4",labelWidth:180, disabled:false},
		{view:"text", label:"PAGU TAHUN KE-5",iid:"DEL_SUBKEG_TARGET_PAGU_SUBKEG_TAHUN5",name:"SUBKEG_TARGET_PAGU_SUBKEG_TAHUN5",labelWidth:180, disabled:false},
		{view:"textarea", 	label:"CATATAN REJECT",		id:"DEL_SUBKEG_CATATAN_REJECT", name: "SUBKEG_CATATAN_REJECT", labelWidth:180, disabled:true},
		{
			margin:5,
			cols:[
				{width:126},
				{view:"button", label:"Delete", type:"form", align:"center", width:100, click:function(){
					dataDeleteSubKegiatan();
					// $$("WIN_DATA3_DELETE").hide();
				}},
				{view:"button", label:"Cancel", align:"center", width:100, click:function(){
					$$("WIN_DATA3_DELETE").hide();
				}},
				{}
			]
		}
	]
};

// delete indikator sub kegiatan
var FORM_DATA31_DELETE = {
	view:"form",
	borderless:true,
	id:"FORM_INDI_SUBKEGIATAN_DELETE",
	// scroll:"xy",	
	elementsConfig:{
		paddingY:5, paddingX:0,
	},
	elements:[
		
		{view:"text", label:"STATUS RENSTRA", 	id:"DEL_INDISUBKEG_PROSES_RENSTRA", 	name:"INDISUBKEG_PROSES_RENSTRA" ,	labelWidth:180, hidden:true},
		{view:"text", label:"PRTID", 	id:"DEL_INDISUBKEG_PRT_ID", 	name:"INDISUBKEG_PRT_ID" ,	labelWidth:180, hidden:true},
		{view:"text", label:"OPD", 	id:"DEL_INDISUBKEG_OPD_ID", 	name:"INDISUBKEG_OPD_ID" ,	labelWidth:180, hidden:true},
		{view:"text", label:"SUB OPD", 	id:"DEL_INDISUBKEG_SUB_OPD_ID", 	name:"INDISUBKEG_SUB_OPD_ID" ,	labelWidth:180, hidden:true},
		// {view:"combo", label:"KEG FULL", id:"ADD_INDIKEG_KEG_FULL", 	name:"INDIKEG_KEG_FULL" ,	labelWidth:180, option:[{id:"Admin", value:""},{id:"", value:""},],disabled:true},
		{view:"textarea", 	label:"INDIKATOR SUB KEGIATAN", id:"DEL_INDISUBKEG_INDIKATOR_SUBKEGIATAN", name:"INDISUBKEG_INDIKATOR_SUBKEGIATAN", labelWidth:180},
		{view:"text", label:"SATUAN INDIKATOR", id:"DEL_INDISUBKEG_SATUAN_INDIKATOR_SUBKEGIATAN", name:"INDISUBKEG_SATUAN_INDIKATOR_SUBKEGIATAN", labelWidth:180},
		{view:"text", label:"KINERJA AWAL", 	id:"DEL_INDISUBKEG_KINERJA_AWAL_SUBKEGIATAN", name:"INDISUBKEG_KINERJA_AWAL_SUBKEGIATAN", labelWidth:180},
		{view:"text", label:"TARGET KINERJA AKHIR", id:"DEL_INDISUBKEG_TARGET_AKHIR_KINERJA_SUBKEGIATAN", name:"INDISUBKEG_TARGET_AKHIR_KINERJA_SUBKEGIATAN",labelWidth:180},
		{view:"text", label:"TARGET KINERJA TAHUN KE-1", id:"DEL_INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN1",name:"INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN1", labelWidth:180},
		{view:"text", label:"TARGET KINERJA TAHUN KE-2", id:"DEL_INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN2",name:"INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN2", labelWidth:180},
		{view:"text", label:"TARGET KINERJA TAHUN KE-3", id:"DEL_INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN3",name:"INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN3", labelWidth:180},
		{view:"text", label:"TARGET KINERJA TAHUN KE-4", id:"DEL_INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN4",name:"INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN4", labelWidth:180},
		{view:"text", label:"TARGET KINERJA TAHUN KE-5", id:"DEL_INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN5",name:"INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN5", labelWidth:180},
		{view:"textarea", 	label:"CATATAN REJECT",		 id:"DEL_INDISUBKEG_CATATAN_REJECT", name:"INDISUBKEG_CATATAN_REJECT",	labelWidth:180, disabled:true},
		{
			margin:5,
			cols:[
				{width:126},
				{view:"button", label:"Delete", type:"form", align:"center", width:100, click:function(){
					dataDeleteIndSubKeg();
					// $$("WIN_DATA31_DELETE").hide();
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
var id_keg 	  = 0;
var id_subkeg = 0;
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

//GET DATA 
function filterData(){
	from = 0;
	$$('PAGER_RENSTRA').select(0);
	getData();
}

//GET DATA 
function getData(){
	// var KODE_OPD_TXT 									= $$("KODE_OPD_TXT").getValue();
	// var DESKRIPSI_TXT 								= $$("DESKRIPSI_TXT").getValue();
	// var BIDANG_TEKNIS_TXT 						= $$("BIDANG_TEKNIS_TXT").getValue();
	// var PIMPINAN_TXT 									= $$("PIMPINAN_TXT").getValue();

	var SASARAN_PD_TXT     = $$('SASARAN_PD_TXT').getValue();
	var OPD_TXT            = $$('OPD_TXT').getValue();
	var SUB_OPD_TXT         = $$('SUB_OPD_TXT').getValue();
	var DESKRIPSI_TXT      = $$('DESKRIPSI_TXT').getValue();
	var STATUS_RENSTRA_TXT = $$('STATUS_RENSTRA_TXT').getValue();
	
	if ($$("SASARAN_PD_CB").getValue()==0) 		{SASARAN_PD_TXT = "";}
	if ($$("OPD_CB").getValue()==0) 		    {OPD_TXT = "";}
	if ($$("SUB_OPD_CB").getValue()==0)         {SUB_OPD_TXT = "";}
	if ($$("DESKRIPSI_CB").getValue()==0)       {DESKRIPSI_TXT = "";}
	if ($$("STATUS_RENSTRA_CB").getValue()==0) 	{STATUS_RENSTRA_TXT = "";}
	
	var param = "?";
	param += "SASARAN_PD_TXT="+ SASARAN_PD_TXT; 							param += "&";
	param += "OPD_TXT="+ OPD_TXT; 											param += "&";
	param += "SUB_OPD_TXT="+ SUB_OPD_TXT; 									param += "&";
	param += "DESKRIPSI_TXT="+ DESKRIPSI_TXT; 								param += "&";
	param += "STATUS_RENSTRA_TXT="+ STATUS_RENSTRA_TXT; 					param += "&";
	param += "from="+ from; 												
	param += "&";
	
	// $$("DT_PROG").load("perencanaan_renstra_entri_murni_data.php");
	// webix.alert({
		// type: "alert-info",
		// text: param,
		// ok: "OK",
		// callback: function(){}
	// });
	
	webix.ajax().post("perencanaan_renstra_entri_murni_data.php"+ param +"mode=paging", function(text, data){
		if (data.json().status=="success"){
			// console.log(data.json().numr);
			numr = data.json().numr;
			page = data.json().page;
			perp = data.json().perp;
			// webix.message(numr);
			if (numr==0){
				$$("DT_PROG").clearAll();
				$$("DT_PROG").refresh();
				$$('PAGER_RENSTRA').hide();
				$$('PAGER_RENSTRA').refresh();
				$$('PAGER_INFO').define("label", "<text style='font-size:13px; float:left;'>0 - 0 / 0 Data </text>");
				$$('PAGER_INFO').refresh();	
			} else {
				// console.log(numr);
				$$("DT_PROG").clearAll();
				$$("DT_PROG").refresh();
				$$("DT_PROG").load("perencanaan_renstra_entri_murni_data.php"+ param+"mode=pagingx");
				$$('PAGER_RENSTRA').show();
				$$('PAGER_RENSTRA').define("count", numr);
				$$('PAGER_RENSTRA').define("template", "{common.first()}{common.prev()}{common.pages()}{common.next()}{common.last()} <text style='color:white;'> {common.page()} / #limit# Halaman </text>");
				$$('PAGER_RENSTRA').refresh();
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



// bind data
function bindProgFormEdit(){
	// program
	$$('FORM_PROGRAM_EDIT1').bind('DT_PROG');
	$$('FORM_PROGRAM_DELETE1').bind('DT_PROG');

	// indikator program
	$$('FORM_INDI_PROGRAM_EDIT').bind('DT_INDI_PROG');
	$$('FORM_INDI_PROGRAM_DELETE').bind('DT_INDI_PROG');

	// kegiatan
	$$('FORM_KEGIATAN_EDIT').bind('DT_KEG');
	$$('FORM_KEGIATAN_DELETE').bind('DT_KEG');

	// indikator kegiatan
	$$('FORM_INDI_KEGIATAN_EDIT').bind('DT_INDI_KEG');
	$$('FORM_INDI_KEGIATAN_DELETE').bind('DT_INDI_KEG');

	// sub kegiatan
	$$('FORM_SUBKEGIATAN_EDIT').bind('DT_SUBKEG');
	$$('FORM_SUBKEGIATAN_DELETE').bind('DT_SUBKEG');

	// indikator sub kegiatan
	$$('FORM_INDI_SUBKEGIATAN_EDIT').bind('DT_INDI_SUB_KEG');
	$$('FORM_INDI_SUBKEGIATAN_DELETE').bind('DT_INDI_SUB_KEG');
}

// add program
function addData1(){
	showWindow("WIN_DATA1_ADD");
}

function dataAddprog(){
	// proses tambah program
	// console.log($$('FORM_PROGRAM_ADD1').getValues());

	var param1=$$('FORM_PROGRAM_ADD1').getValues();
	console.log(param1)
	webix.ajax().post("perencanaan_renstra_entri_murni_data_crud_program.php?lvl=program&action=add",{param1:param1}, function(text, data){
		if (data.json().status=="success"){
			webix.message({type:"form", text:"<div style='background-color:#24c066; color:#fff; margin:-6px -11px -6px -11px;'><span class='webix_icon fa-check-square-o'></span>Data Berhasil Ditambahkan.</div>"});
				// console.log("add program");
				// console.log(data.json().action);
				// console.log(data.json().sqltes);
			$$("WIN_DATA1_ADD").hide();
			getData();
		} else {
			webix.alert({
				type:"alert-error",
				title: "INFORMATION",
				text:"Data Tidak Berhasil Ditambahkan !! "+data.json().status,
				ok:"OK",
				callback:function(){}
			});
		}
	});
}
// akhir add program


// edit program
var temp_FORM_PROGRAM_EDIT1 = {};
function editData1(){
	showWindow("WIN_DATA1_EDIT");
	if ($$("FORM_PROGRAM_EDIT1").getValues().ROW_ID > 0) {
		temp_FORM_PROGRAM_EDIT1 = $$("FORM_PROGRAM_EDIT1").getValues();
	} else{
		$$("FORM_PROGRAM_EDIT1").setValues(temp_FORM_PROGRAM_EDIT1);
	}
}

function dataEdit1(){
	// proses edit program
	// jika status proses_renstra = 2 maka sudah tidak bisa diedit
	// console.log($$("FORM_PROGRAM_EDIT1").getValues());
	
	var param1=$$('FORM_PROGRAM_EDIT1').getValues();
	// console.log(param1)
	if (webix.rules.isNotEmpty (param1.ROW_ID)){
		webix.ajax().post("perencanaan_renstra_entri_murni_tambah_catatan_bidang_perenc_murni.php?lvl=program&action=edit",{param1:param1}, function(text, data){
			if (data.json().status=="success"){
				webix.message({type:"form", text:"<div style='background-color:#24c066; color:#fff; margin:-6px -11px -6px -11px;'><span class='webix_icon fa-check-square-o'></span>Tambah Catatan Berhasil.</div>"});
					// console.log("add program");
					// console.log(data.json().action);
					// console.log(data.json().sqltes);
				$$("WIN_DATA1_EDIT").hide();			
				getData();
				// var id_terakhir = $$('DT_PROG').getSelectedId().id;
			} else {
				webix.alert({
					type:"alert-error",
					title: "INFORMATION",
					text:"Tambah Catatan Gagal !! "+data.json().status,
					ok:"OK",
					callback:function(){}
				});
			}
		});
	}else{
		webix.message({ type:"error", text:"Data Tidak Boleh Kosong" });
	}
}
// akhir edit program

// delete program
var temp_FORM_PROGRAM_DELETE1 = {};
function deleteData1(){
	showWindow("WIN_DATA1_DELETE");
	if ($$("FORM_PROGRAM_DELETE1").getValues().ROW_ID > 0) {
		temp_FORM_PROGRAM_DELETE1 = $$("FORM_PROGRAM_DELETE1").getValues();
	} else{
		$$("FORM_PROGRAM_DELETE1").setValues(temp_FORM_PROGRAM_DELETE1);
	}
}

function dataDeleteProgram(){
	// proses delete program
	// akan menghapus program, indikator program terkait, kegiatan dan indikator kegiatan terkait serta sub kegiatan dan indikator sub kegiatan	
	// jika status proses_renstra = 2 maka sudah tidak bisa dihapus
	// var xx = $$("FORM_PROGRAM_DELETE1").getValues();
	// console.log(xx);

	var param1=$$('FORM_PROGRAM_DELETE1').getValues();
	console.log(param1)
	webix.ajax().post("perencanaan_renstra_entri_murni_data_crud_program.php?lvl=program&action=delete",{param1:param1}, function(text, data){
		if (data.json().status=="success"){
			webix.message({type:"form", text:"<div style='background-color:#24c066; color:#fff; margin:-6px -11px -6px -11px;'><span class='webix_icon fa-check-square-o'></span>Data Berhasil Dihapus.</div>"});
				// console.log("delete program");
				// console.log(data.json().action);
				// console.log(data.json().sqltes);
			$$("WIN_DATA1_DELETE").hide();
			getData();
		} else {
			webix.alert({
				type:"alert-error",
				title: "INFORMATION",
				text:"Data Tidak Berhasil Dihapus !! "+data.json().status,
				ok:"OK",
				callback:function(){}
			});
		}
	});
}
// akhir delete program

// edit indikator program
var temp_FORM_INDI_PROGRAM_EDIT  = {}; 
function editData11(){
	showWindow("WIN_DATA11_EDIT");
	//console.log($$("FORM_INDI_PROGRAM_EDIT").getValues());
	if ($$("FORM_INDI_PROGRAM_EDIT").getValues().INDIPROG_ROW_ID > 0) {
		temp_FORM_INDI_PROGRAM_EDIT = $$("FORM_INDI_PROGRAM_EDIT").getValues();
	} else{
		$$("FORM_INDI_PROGRAM_EDIT").setValues(temp_FORM_INDI_PROGRAM_EDIT);
	}
}

function validasiEditIndikatorProg(){
	var data = $$("FORM_INDI_PROGRAM_EDIT").getValues();

	if (!webix.rules.isNumber( data.INDIPROG_KINERJA_AWAL_PROGRAM )) return false;
	if (!webix.rules.isNumber( data.INDIPROG_TARGET_AKHIR_KINERJA_PROGRAM )) return false;
	if (!webix.rules.isNumber( data.INDIPROG_TARGET_KINERJA_PROG_TAHUN1 )) return false;
	if (!webix.rules.isNumber( data.INDIPROG_TARGET_KINERJA_PROG_TAHUN2 )) return false;
	if (!webix.rules.isNumber( data.INDIPROG_TARGET_KINERJA_PROG_TAHUN3 )) return false;
	if (!webix.rules.isNumber( data.INDIPROG_TARGET_KINERJA_PROG_TAHUN4 )) return false;
	if (!webix.rules.isNumber( data.INDIPROG_TARGET_KINERJA_PROG_TAHUN5 )) return false;
	return true;
}


function dataEditIndiProg(){
	// proses edit indikator program ke database
	// console.log($$("FORM_INDI_PROGRAM_EDIT").getValues());

	// if  (validasiEditIndikatorProg()) {
	
	var param1=$$('FORM_INDI_PROGRAM_EDIT').getValues();
	// console.log(param1)
	if (webix.rules.isNotEmpty (param1.INDIPROG_ROW_ID)){
		webix.ajax().post("perencanaan_renstra_entri_murni_tambah_catatan_bidang_perenc_murni.php?lvl=indiprog&action=edit",{param1:param1}, function(text, data){
			// console.log(data.json().status);
			if (data.json().status=="success"){
				webix.message({type:"form", text:"<div style='background-color:#24c066; color:#fff; margin:-6px -11px -6px -11px;'><span class='webix_icon fa-check-square-o'></span>Tambah Catatan Berhasil</div>"});
					// console.log("add program");
					// console.log(data.json().action);
					// console.log(data.json().sqltes);
				$$("WIN_DATA11_EDIT").hide();
				// getData();
				$$("DT_INDI_PROG").clearAll();
				$$("DT_INDI_PROG").load(function(){
				    return webix.ajax().post("perencanaan_renstra_entri_murni_data_child.php?lvl=indiprog",{rowid:param1.INDIPROG_PRT_ID},function(text, data){
				    })
				});
			} else {
				webix.alert({
					type:"alert-error",
					title: "INFORMATION",
					text:"Tambah Catatan Gagal !! "+data.json().status,
					ok:"OK",
					callback:function(){
						// $$("WIN_DATA11_ADD").hide();
					}
				});
			}
		});
	}else{
		webix.message({ type:"error", text:"Data Tidak Boleh Kosong" });
	}

}
// akhir edit indikator program

// add indikator program
function addData11(){
	showWindow("WIN_DATA11_ADD");
}


function validasiAddIndikatorProg(){
	var data = $$("FORM_INDI_PROGRAM_ADD").getValues();

	if (!webix.rules.isNumber( data.INDIPROG_KINERJA_AWAL_PROGRAM )) return false;
	if (!webix.rules.isNumber( data.INDIPROG_TARGET_AKHIR_KINERJA_PROGRAM )) return false;
	if (!webix.rules.isNumber( data.INDIPROG_TARGET_KINERJA_PROG_TAHUN1 )) return false;
	if (!webix.rules.isNumber( data.INDIPROG_TARGET_KINERJA_PROG_TAHUN2 )) return false;
	if (!webix.rules.isNumber( data.INDIPROG_TARGET_KINERJA_PROG_TAHUN3 )) return false;
	if (!webix.rules.isNumber( data.INDIPROG_TARGET_KINERJA_PROG_TAHUN4 )) return false;
	if (!webix.rules.isNumber( data.INDIPROG_TARGET_KINERJA_PROG_TAHUN5 )) return false;
	return true;
}

function dataAddIndiProg(){
	// proses tambah indikator program
	// console.log("proses add indikator program");
	// console.log($$('FORM_INDI_PROGRAM_ADD').getValues());
	if  (validasiAddIndikatorProg()) {
		var param1=$$('FORM_INDI_PROGRAM_ADD').getValues();
		// console.log(param1)
		webix.ajax().post("perencanaan_renstra_entri_murni_data_crud_program.php?lvl=indiprog&action=add",{param1:param1}, function(text, data){
			// console.log(data.json().status);
			if (data.json().status=="success"){
				webix.message({type:"form", text:"<div style='background-color:#24c066; color:#fff; margin:-6px -11px -6px -11px;'><span class='webix_icon fa-check-square-o'></span>Data Berhasil Ditambahkan.</div>"});
					// console.log("add program");
					// console.log(data.json().action);
					// console.log(data.json().sqltes);
				$$("WIN_DATA11_ADD").hide();
				// getData();
				$$("DT_INDI_PROG").clearAll();
				$$("DT_INDI_PROG").load(function(){
				    return webix.ajax().post("perencanaan_renstra_entri_murni_data_child.php?lvl=indiprog",{rowid:param1.INDIPROG_PRT_ID},function(text, data){
				    })
				});
			} else {
				webix.alert({
					type:"alert-error",
					title: "INFORMATION",
					text:"Data Tidak Berhasil Ditambahkan !! "+data.json().status,
					ok:"OK",
					callback:function(){
						// $$("WIN_DATA11_ADD").hide();
					}
				});
			}
		});
	}else{
		webix.message({ type:"error", text:"isi data dengan angka saja" });
	}
}
// akhir add indikator program

// delete indikator program
var temp_FORM_INDI_PROGRAM_DELETE  = {}; 
function deleteData11(){
	showWindow("WIN_DATA11_DELETE");
	if ($$("FORM_INDI_PROGRAM_DELETE").getValues().INDIPROG_ROW_ID > 0) {
		temp_FORM_INDI_PROGRAM_DELETE = $$("FORM_INDI_PROGRAM_DELETE").getValues();
	} else{
		$$("FORM_INDI_PROGRAM_DELETE").setValues(temp_FORM_INDI_PROGRAM_DELETE);
	}
}

function dataDeleteIndiProgram(){
	// proses delete indikator program
	// console.log("delete indikator program");
	// console.log($$("FORM_INDI_PROGRAM_DELETE").getValues());

	var param1=$$('FORM_INDI_PROGRAM_DELETE').getValues();
	// console.log(param1)
	webix.ajax().post("perencanaan_renstra_entri_murni_data_crud_program.php?lvl=indiprog&action=delete",{param1:param1}, function(text, data){
		// console.log(data.json().status);
		if (data.json().status=="success"){
			webix.message({type:"form", text:"<div style='background-color:#24c066; color:#fff; margin:-6px -11px -6px -11px;'><span class='webix_icon fa-check-square-o'></span>Data Berhasil Dihapus.</div>"});
				// console.log("add program");
				// console.log(data.json().action);
				// console.log(data.json().sqltes);
			$$("WIN_DATA11_DELETE").hide();
			// getData();
			$$("DT_INDI_PROG").clearAll();
			$$("DT_INDI_PROG").load(function(){
			    return webix.ajax().post("perencanaan_renstra_entri_murni_data_child.php?lvl=indiprog",{rowid:param1.INDIPROG_PRT_ID},function(text, data){
			    })
			});
		} else {
			webix.alert({
				type:"alert-error",
				title: "INFORMATION",
				text:"Data Tidak Berhasil Dihapus !! "+data.json().status,
				ok:"OK",
				callback:function(){
					// $$("WIN_DATA11_ADD").hide();
				}
			});
		}
	});
}
// akhir delete indikator program



// add kegiatan
function dataAddKeg(){
	// console.log("add data kegiatan")
	$$('ADD_DESKRIPSI').setValue($$('ADD_KEG_KEG_FULL').getText());
	// console.log($$('FORM_KEGIATAN_ADD').getValues());

	var param1=$$('FORM_KEGIATAN_ADD').getValues();
	webix.ajax().post("perencanaan_renstra_entri_murni_data_crud_program.php?lvl=kegiatan&action=add",{param1:param1}, function(text, data){
		// console.log(data.json().status);
		if (data.json().status=="success"){
			webix.message({type:"form", text:"<div style='background-color:#24c066; color:#fff; margin:-6px -11px -6px -11px;'><span class='webix_icon fa-check-square-o'></span>Data Berhasil Ditambahkan.</div>"});
				// console.log("add program");
				// console.log(data.json().action);
				// console.log(data.json().sqltes);
			$$("WIN_DATA2_ADD").hide();
			// getData();
			$$("DT_KEG").clearAll();
			$$("DT_KEG").load(function(){
			    return webix.ajax().post("perencanaan_renstra_entri_murni_data_child.php?lvl=kegiatan",{rowid:param1.KEG_PRT_ID},function(text, data){
			    })
			});
		} else {
			webix.alert({
				type:"alert-error",
				title: "INFORMATION",
				text:"Data Tidak Berhasil Ditambahkan !! "+data.json().status,
				ok:"OK",
				callback:function(){
					// $$("WIN_DATA11_ADD").hide();
				}
			});
		}
	});
	
}

// akhir add kegiatan
// edit kegiatan
var temp_FORM_KEGIATAN_EDIT  = {}; 
function editData2(){
	showWindow("WIN_DATA2_EDIT");
	if ($$("FORM_KEGIATAN_EDIT").getValues().KEG_ROW_ID > 0) {
		temp_FORM_KEGIATAN_EDIT = $$("FORM_KEGIATAN_EDIT").getValues();
	} else{
		$$("FORM_KEGIATAN_EDIT").setValues(temp_FORM_KEGIATAN_EDIT);
	}
}

function dataEditKeg(){
	// proses delete indikator program
	// console.log("delete kegiatan");
	// console.log($$("FORM_KEGIATAN_DELETE").getValues());

	var param1=$$('FORM_KEGIATAN_EDIT').getValues();
	// console.log(param1)
	if (webix.rules.isNotEmpty (param1.KEG_ROW_ID )){
		webix.ajax().post("perencanaan_renstra_entri_murni_tambah_catatan_bidang_perenc_murni.php?lvl=kegiatan&action=edit",{param1:param1}, function(text, data){
			// console.log(data.json().status);
			if (data.json().status=="success"){
				webix.message({type:"form", text:"<div style='background-color:#24c066; color:#fff; margin:-6px -11px -6px -11px;'><span class='webix_icon fa-check-square-o'></span>Tambah Catatan Berhasil.</div>"});
					// console.log("add program");
					// console.log(data.json().action);
					// console.log(data.json().sqltes);
				$$("WIN_DATA2_DELETE").hide();
				// getData();
				$$("DT_KEG").clearAll();
				$$("DT_KEG").load(function(){
				    return webix.ajax().post("perencanaan_renstra_entri_murni_data_child.php?lvl=kegiatan",{rowid:param1.KEG_PRT_ID},function(text, data){			    
				    })
				});
			} else {
				webix.alert({
					type:"alert-error",
					title: "INFORMATION",
					text:"Tambah Catatan Gagal !! "+data.json().status,
					ok:"OK",
					callback:function(){
						// $$("WIN_DATA11_ADD").hide();
					}
				});
			}
		});
	}else{
		webix.message({ type:"error", text:"Data Tidak Boleh Kosong" });
	}
}
// akhir edit kegiatan

// delete kegiatan
var temp_FORM_KEGIATAN_DELETE  = {}; 
function deleteData2(){
	showWindow("WIN_DATA2_DELETE");
	if ($$("FORM_KEGIATAN_DELETE").getValues().KEG_ROW_ID > 0) {
		temp_FORM_KEGIATAN_DELETE = $$("FORM_KEGIATAN_DELETE").getValues();
	} else{
		$$("FORM_KEGIATAN_DELETE").setValues(temp_FORM_KEGIATAN_DELETE);
	}
}

function dataDeleteKegiatan(){
	// proses delete indikator program
	// console.log("delete kegiatan");
	// console.log($$("FORM_KEGIATAN_DELETE").getValues());

	var param1=$$('FORM_KEGIATAN_DELETE').getValues();
	console.log(param1)
	webix.ajax().post("perencanaan_renstra_entri_murni_data_crud_program.php?lvl=kegiatan&action=delete",{param1:param1}, function(text, data){
		// console.log(data.json().status);
		if (data.json().status=="success"){
			webix.message({type:"form", text:"<div style='background-color:#24c066; color:#fff; margin:-6px -11px -6px -11px;'><span class='webix_icon fa-check-square-o'></span>Data Berhasil Dihapus.</div>"});
				// console.log("add program");
				// console.log(data.json().action);
				// console.log(data.json().sqltes);
			$$("WIN_DATA2_DELETE").hide();
			// getData();
			$$("DT_KEG").clearAll();
			$$("DT_KEG").load(function(){
			    return webix.ajax().post("perencanaan_renstra_entri_murni_data_child.php?lvl=kegiatan",{rowid:param1.KEG_PRT_ID},function(text, data){			    
			    })
			});
		} else {
			webix.alert({
				type:"alert-error",
				title: "INFORMATION",
				text:"Data Tidak Berhasil Dihapus !! "+data.json().status,
				ok:"OK",
				callback:function(){
					// $$("WIN_DATA11_ADD").hide();
				}
			});
		}
	});
}
// akhir delete kegiatan


// Edit indikator kegiatan
function validasiIndikatorKeg(data){
	// var data = $$("FORM_INDI_KEGIATAN_ADD").getValues();
	// console.log(data)                
	if (!webix.rules.isNumber( data.INDIKEG_KINERJA_AWAL_KEGIATAN )) return false;
	if (!webix.rules.isNumber( data.INDIKEG_TARGET_AKHIR_KINERJA_KEGIATAN )) return false;
	if (!webix.rules.isNumber( data.INDIKEG_TARGET_KINERJA_KEG_TAHUN1 )) return false;
	if (!webix.rules.isNumber( data.INDIKEG_TARGET_KINERJA_KEG_TAHUN2 )) return false;
	if (!webix.rules.isNumber( data.INDIKEG_TARGET_KINERJA_KEG_TAHUN3 )) return false;
	if (!webix.rules.isNumber( data.INDIKEG_TARGET_KINERJA_KEG_TAHUN4 )) return false;
	if (!webix.rules.isNumber( data.INDIKEG_TARGET_KINERJA_KEG_TAHUN5 )) return false;
	return true;
}

var temp_FORM_INDI_KEGIATAN_EDIT = {}; 
function editData21(){
	showWindow("WIN_DATA21_EDIT");
	if ($$("FORM_INDI_KEGIATAN_EDIT").getValues().INDIKEG_ROW_ID > 0) {
		temp_FORM_INDI_KEGIATAN_EDIT = $$("FORM_INDI_KEGIATAN_EDIT").getValues();
	} else{
		$$("FORM_INDI_KEGIATAN_EDIT").setValues(temp_FORM_INDI_KEGIATAN_EDIT);
	}
}

function dataEditIndiKeg(){
	// proses edit indikator kegiatan ke database
	// console.log("edit save indikator kegiatan")	
	// console.log($$("FORM_INDI_KEGIATAN_EDIT").getValues());

	var param1=$$('FORM_INDI_KEGIATAN_EDIT').getValues();
	// if  (validasiIndikatorKeg(param1)) {
	if (webix.rules.isNotEmpty (param1.INDIKEG_ROW_ID )){	
		// console.log(param1)
		webix.ajax().post("perencanaan_renstra_entri_murni_tambah_catatan_bidang_perenc_murni.php?lvl=indikeg&action=edit",{param1:param1}, function(text, data){
			// console.log(data.json().status);
			if (data.json().status=="success"){
				webix.message({type:"form", text:"<div style='background-color:#24c066; color:#fff; margin:-6px -11px -6px -11px;'><span class='webix_icon fa-check-square-o'></span>Tambah Catatan Berhasil.</div>"});
					// console.log("add program");
					// console.log(data.json().action);
					// console.log(data.json().sqltes);
				$$("WIN_DATA21_EDIT").hide();
				// getData();
				$$("DT_INDI_KEG").clearAll();
				$$("DT_INDI_KEG").load(function(){
				    return webix.ajax().post("perencanaan_renstra_entri_murni_data_child.php?lvl=indikeg",{rowid:param1.INDIKEG_PRT_ID},function(text, data){
				    })
				});

			} else {
				webix.alert({
					type:"alert-error",
					title: "INFORMATION",
					text:"Tambah Catatan Gagal "+data.json().status,
					ok:"OK",
					callback:function(){
						// $$("WIN_DATA11_ADD").hide();
					}
				});
			}
		});
	}else{
		webix.message({ type:"error", text:"Data Tidak Boleh Kosong" });
	}

}
//  akhir edit indikator kegiatan

// delete indikator kegiatan
var temp_FORM_INDI_KEGIATAN_DELETE = {};
function deleteData21(){
	showWindow("WIN_DATA21_DELETE");
	if ($$("FORM_INDI_KEGIATAN_DELETE").getValues().INDIKEG_ROW_ID > 0) {
		temp_FORM_INDI_KEGIATAN_DELETE = $$("FORM_INDI_KEGIATAN_DELETE").getValues();
	} else{
		$$("FORM_INDI_KEGIATAN_DELETE").setValues(temp_FORM_INDI_KEGIATAN_DELETE);
	}
}

function dataDeleteIndiKegiatan(){
	// proses delete indikator kegiatan
	console.log("delete indikator kegiatan");
	console.log($$("FORM_INDI_KEGIATAN_DELETE").getValues());

	var param1=$$('FORM_INDI_KEGIATAN_DELETE').getValues();
	webix.ajax().post("perencanaan_renstra_entri_murni_data_crud_program.php?lvl=indikeg&action=delete",{param1:param1}, function(text, data){
		console.log(data.json().status);
		if (data.json().status=="success"){
			webix.message({type:"form", text:"<div style='background-color:#24c066; color:#fff; margin:-6px -11px -6px -11px;'><span class='webix_icon fa-check-square-o'></span>Data Berhasil Dihapus.</div>"});
				// console.log("add program");
				// console.log(data.json().action);
				// console.log(data.json().sqltes);
			$$("WIN_DATA21_DELETE").hide();
			// getData();
			$$("DT_INDI_KEG").clearAll();
			$$("DT_INDI_KEG").load(function(){
			    return webix.ajax().post("perencanaan_renstra_entri_murni_data_child.php?lvl=indikeg",{rowid:param1.INDIKEG_PRT_ID},function(text, data){
			    })
			});
		} else {
			webix.alert({
				type:"alert-error",
				title: "INFORMATION",
				text:"Data Tidak Berhasil Dihapus !! "+data.json().status,
				ok:"OK",
				callback:function(){
					// $$("WIN_DATA11_ADD").hide();
				}
			});
		}
	});
}

// akhir delete indikator kegiatan

// add indikator kegiatan
function dataAddIndKeg(){
	console.log("add data indikator kegiatan")
	// console.log($$('FORM_INDI_KEGIATAN_ADD').getValues());

	var param1=$$('FORM_INDI_KEGIATAN_ADD').getValues();

	if  (validasiIndikatorKeg(param1)) {
		
		// console.log(param1)
		webix.ajax().post("perencanaan_renstra_entri_murni_data_crud_program.php?lvl=indikeg&action=add",{param1:param1}, function(text, data){
			// console.log(data.json().status);
			if (data.json().status=="success"){
				webix.message({type:"form", text:"<div style='background-color:#24c066; color:#fff; margin:-6px -11px -6px -11px;'><span class='webix_icon fa-check-square-o'></span>Data Berhasil Ditambahkan.</div>"});
					// console.log("add program");
					// console.log(data.json().action);
					// console.log(data.json().sqltes);
				$$("WIN_DATA21_ADD").hide();
				// getData();
				$$("DT_INDI_KEG").clearAll();
				$$("DT_INDI_KEG").load(function(){
				    return webix.ajax().post("perencanaan_renstra_entri_murni_data_child.php?lvl=indikeg",{rowid:param1.INDIKEG_PRT_ID},function(text, data){
				    })
				});

			} else {
				webix.alert({
					type:"alert-error",
					title: "INFORMATION",
					text:"Data Tidak Berhasil Ditambahkan !! "+data.json().status,
					ok:"OK",
					callback:function(){
						// $$("WIN_DATA11_ADD").hide();
					}
				});
			}
		});
	}else{
		webix.message({ type:"error", text:"isi data dengan angka saja" });
	}
}

// akhir add indikator kegiatan


// add sub kegiatan
function validasiSubKeg(data){
	// var data = $$("FORM_INDI_KEGIATAN_ADD").getValues();
	// console.log(data)                
	if (!webix.rules.isNumber( data.SUBKEG_TARGET_PAGU_SUBKEG_TAHUN1 )) return false;
	if (!webix.rules.isNumber( data.SUBKEG_TARGET_PAGU_SUBKEG_TAHUN2 )) return false;
	if (!webix.rules.isNumber( data.SUBKEG_TARGET_PAGU_SUBKEG_TAHUN3 )) return false;
	if (!webix.rules.isNumber( data.SUBKEG_TARGET_PAGU_SUBKEG_TAHUN4 )) return false;
	if (!webix.rules.isNumber( data.SUBKEG_TARGET_PAGU_SUBKEG_TAHUN5 )) return false;
	return true;
}

function dataAddSubKeg(){
	console.log("add data sub kegiatan")
	$$('ADD_SUBKEG_DESKRIPSI').setValue($$('ADD_SUBKEG_SUBKEG_FULL').getText());
	console.log($$('FORM_SUBKEGIATAN_ADD').getValues());

	var param1=$$('FORM_SUBKEGIATAN_ADD').getValues();
	if  (validasiSubKeg(param1)) {
		webix.ajax().post("perencanaan_renstra_entri_murni_data_crud_program.php?lvl=subkeg&action=add",{param1:param1}, function(text, data){
			console.log(data.json().status);
			if (data.json().status=="success"){
				webix.message({type:"form", text:"<div style='background-color:#24c066; color:#fff; margin:-6px -11px -6px -11px;'><span class='webix_icon fa-check-square-o'></span>Data Berhasil Ditambahkan.</div>"});
					// console.log("add program");
					// console.log(data.json().action);
					// console.log(data.json().sqltes);
				$$("WIN_DATA3_ADD").hide();
				// getData();
				$$("DT_SUBKEG").clearAll();
				$$("DT_SUBKEG").load(function(){
				    return webix.ajax().post("perencanaan_renstra_entri_murni_data_child.php?lvl=subkegiatan",{rowid:param1.SUBKEG_PRT_ID},function(text, data){
				    })
				});
				getData();
			} else {
				webix.alert({
					type:"alert-error",
					title: "INFORMATION",
					text:"Data Tidak Berhasil Ditambahkan !! "+data.json().status,
					ok:"OK",
					callback:function(){
						// $$("WIN_DATA11_ADD").hide();
					}
				});
			}
		});
	}else{
		webix.message({ type:"error", text:"isi data dengan angka saja" });
	}
	
}

// edit sub kegiatan
var temp_FORM_SUBKEGIATAN_EDIT = {};
function editData3(){
	showWindow("WIN_DATA3_EDIT");
	if ($$("FORM_SUBKEGIATAN_EDIT").getValues().SUBKEG_ROW_ID > 0) {
		temp_FORM_SUBKEGIATAN_EDIT = $$("FORM_SUBKEGIATAN_EDIT").getValues();
	} else{
		$$("FORM_SUBKEGIATAN_EDIT").setValues(temp_FORM_SUBKEGIATAN_EDIT);
	}
}

function dataEditSubKeg(){
	// proses edit indikator kegiatan ke database
	// console.log("edit save sub kegiatan")	
	// console.log($$("FORM_SUBKEGIATAN_EDIT").getValues());

	var param1=$$('FORM_SUBKEGIATAN_EDIT').getValues();
	// if  (validasiSubKeg(param1)) {
	if (webix.rules.isNotEmpty (param1.SUBKEG_ROW_ID )){
		webix.ajax().post("perencanaan_renstra_entri_murni_tambah_catatan_bidang_perenc_murni.php?lvl=subkeg&action=edit",{param1:param1}, function(text, data){
			// console.log(data.json().status);
			if (data.json().status=="success"){
				webix.message({type:"form", text:"<div style='background-color:#24c066; color:#fff; margin:-6px -11px -6px -11px;'><span class='webix_icon fa-check-square-o'></span>Tambah Catatan Berhasil.</div>"});
					// console.log("add program");
					// console.log(data.json().action);
					// console.log(data.json().sqltes);
				$$("WIN_DATA3_EDIT").hide();
				// getData();
				$$("DT_SUBKEG").clearAll();
				$$("DT_SUBKEG").load(function(){
				    return webix.ajax().post("perencanaan_renstra_entri_murni_data_child.php?lvl=subkegiatan",{rowid:param1.SUBKEG_PRT_ID},function(text, data){
				    })
				});
				// getData();
			} else {
				webix.alert({
					type:"alert-error",
					title: "INFORMATION",
					text:"Tambah Catatan Gagal !! "+data.json().status,
					ok:"OK",
					callback:function(){
						// $$("WIN_DATA11_ADD").hide();
					}
				});
			}
		});
	}else{
		webix.message({ type:"error", text:"Data Tidak Boleh Kosong" });
	}

}

var temp_FORM_SUBKEGIATAN_DELETE = {};
function deleteData3(){
	showWindow("WIN_DATA3_DELETE");
	if ($$("FORM_SUBKEGIATAN_DELETE").getValues().SUBKEG_ROW_ID > 0) {
		temp_FORM_SUBKEGIATAN_DELETE = $$("FORM_SUBKEGIATAN_DELETE").getValues();
	} else{
		$$("FORM_SUBKEGIATAN_DELETE").setValues(temp_FORM_SUBKEGIATAN_DELETE);
	}
}

function dataDeleteSubKegiatan(){
	// console.log("delete sub kegiatan")	
	// console.log($$("FORM_SUBKEGIATAN_DELETE").getValues());

	var param1=$$('FORM_SUBKEGIATAN_DELETE').getValues();
	webix.ajax().post("perencanaan_renstra_entri_murni_data_crud_program.php?lvl=subkeg&action=delete",{param1:param1}, function(text, data){
		// console.log(data.json().status);
		if (data.json().status=="success"){
			webix.message({type:"form", text:"<div style='background-color:#24c066; color:#fff; margin:-6px -11px -6px -11px;'><span class='webix_icon fa-check-square-o'></span>Data Berhasil dihapus.</div>"});
				// console.log("add program");
				// console.log(data.json().action);
				// console.log(data.json().sqltes);
			$$("WIN_DATA3_DELETE").hide();
			// getData();
			// $$("DT_SUBKEG").clearAll();
			// $$("DT_SUBKEG").load(function(){
			//     return webix.ajax().post("perencanaan_renstra_entri_murni_data_child.php?lvl=subkegiatan",{rowid:param1.SUBKEG_PRT_ID},function(text, data){
			//     })
			// });
			getData();
		} else {
			webix.alert({
				type:"alert-error",
				title: "INFORMATION",
				text:"Data Tidak Berhasil Diedit !! "+data.json().status,
				ok:"OK",
				callback:function(){
					// $$("WIN_DATA11_ADD").hide();
				}
			});
		}
	});
}

// akhir edit sub kegiatan

// indikator sub kegiatan
function validasiIndiSubKeg(data){
	// var data = $$("FORM_INDI_KEGIATAN_ADD").getValues();
	// console.log(data)                
	// if (!webix.rules.isNumber( data.INDISUBKEG_KINERJA_AWAL_SUBKEGIATAN )) return false;
	// if (!webix.rules.isNumber( data.INDISUBKEG_TARGET_AKHIR_KINERJA_SUBKEGIATAN )) return false;
	// if (!webix.rules.isNumber( data.INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN1 )) return false;
	// if (!webix.rules.isNumber( data.INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN2 )) return false;
	// if (!webix.rules.isNumber( data.INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN3 )) return false;
	// if (!webix.rules.isNumber( data.INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN4 )) return false;
	// if (!webix.rules.isNumber( data.INDISUBKEG_TARGET_KINERJA_SUBKEG_TAHUN5 )) return false;

	// if (!webix.rules.isNotEmpty ( data.INDISUBKEG_CATATAN_REJECT )) return false;
	if (!webix.rules.isNotEmpty ( data.INDISUBKEG_ROW_ID )) return false;
	return true;
}

function dataAddIndSubKeg(){
	// console.log("add indikator sub kegiatan")	
	// console.log($$("FORM_INDI_SUBKEGIATAN_ADD").getValues());
	var param1=$$('FORM_INDI_SUBKEGIATAN_ADD').getValues();
	if  (validasiIndiSubKeg(param1)) {
		webix.ajax().post("perencanaan_renstra_entri_murni_data_crud_program.php?lvl=indisubkeg&action=add",{param1:param1}, function(text, data){
			// console.log(data.json().status);
			if (data.json().status=="success"){
				webix.message({type:"form", text:"<div style='background-color:#24c066; color:#fff; margin:-6px -11px -6px -11px;'><span class='webix_icon fa-check-square-o'></span>Data Berhasil Ditambahkan.</div>"});
					// console.log("add program");
					// console.log(data.json().action);
					// console.log(data.json().sqltes);
				$$("WIN_DATA31_ADD").hide();
				$$("DT_INDI_SUB_KEG").clearAll();
				$$("DT_INDI_SUB_KEG").load(function(){
				    return webix.ajax().post("perencanaan_renstra_entri_murni_data_child.php?lvl=indisubkeg",{rowid:param1.INDISUBKEG_PRT_ID},function(text, data){
				    })
				});
				// getData();
			} else {
				webix.alert({
					type:"alert-error",
					title: "INFORMATION",
					text:"Data Tidak Berhasil Ditambahkan !! "+data.json().status,
					ok:"OK",
					callback:function(){
						// $$("WIN_DATA11_ADD").hide();
					}
				});
			}
		});
	}else{
		webix.message({ type:"error", text:"isi data dengan angka saja" });
	}

}


var temp_FORM_INDI_SUBKEGIATAN_EDIT = {};
function editData31(){
	showWindow("WIN_DATA31_EDIT");
	if ($$("FORM_INDI_SUBKEGIATAN_EDIT").getValues().INDISUBKEG_ROW_ID > 0) {
		temp_FORM_INDI_SUBKEGIATAN_EDIT = $$("FORM_INDI_SUBKEGIATAN_EDIT").getValues();
	} else{
		$$("FORM_INDI_SUBKEGIATAN_EDIT").setValues(temp_FORM_INDI_SUBKEGIATAN_EDIT);
	}
}


function dataEditIndSubKeg(){
	// console.log("edit indikator sub kegiatan")	
	// console.log($$("FORM_INDI_SUBKEGIATAN_EDIT").getValues());

	var param1=$$('FORM_INDI_SUBKEGIATAN_EDIT').getValues();
	// console.log(param1)
	// if  (validasiIndiSubKeg(param1)) {
	if (webix.rules.isNotEmpty (param1.INDISUBKEG_ROW_ID )){
		webix.ajax().post("perencanaan_renstra_entri_murni_tambah_catatan_bidang_perenc_murni.php?lvl=indisubkeg&action=edit",{param1:param1}, function(text, data){
			// console.log(data.json().status);
			if (data.json().status=="success"){
				webix.message({type:"form", text:"<div style='background-color:#24c066; color:#fff; margin:-6px -11px -6px -11px;'><span class='webix_icon fa-check-square-o'></span>Tambah Catatan Berhasil</div>"});
					// console.log("add program");
					// console.log(data.json().action);
					// console.log(data.json().sqltes);
				$$("WIN_DATA31_EDIT").hide();
				$$("DT_INDI_SUB_KEG").clearAll();
				$$("DT_INDI_SUB_KEG").load(function(){
				    return webix.ajax().post("perencanaan_renstra_entri_murni_data_child.php?lvl=indisubkeg",{rowid:param1.INDISUBKEG_PRT_ID},function(text, data){
				    })
				});
				// getData();
			} else {
				webix.alert({
					type:"alert-error",
					title: "INFORMATION",
					text:"Tambah Catatan Gagal !! "+data.json().status,
					ok:"OK",
					callback:function(){
						// $$("WIN_DATA11_ADD").hide();
					}
				});
			}
		});
	}else{
		webix.message({ type:"error", text:"Data Tidak Boleh Kosong" });
	}

}

var temp_FORM_INDI_SUBKEGIATAN_DELETE = {};
function deleteData31(){
	showWindow("WIN_DATA31_DELETE");
	if ($$("FORM_INDI_SUBKEGIATAN_DELETE").getValues().INDISUBKEG_ROW_ID > 0) {
		temp_FORM_INDI_SUBKEGIATAN_DELETE = $$("FORM_INDI_SUBKEGIATAN_DELETE").getValues();
	} else{
		$$("FORM_INDI_SUBKEGIATAN_DELETE").setValues(temp_FORM_INDI_SUBKEGIATAN_DELETE);
	}
}

function dataDeleteIndSubKeg(){
	// console.log("edit indikator sub kegiatan")	
	// console.log($$("FORM_INDI_SUBKEGIATAN_DELETE").getValues());

	var param1=$$('FORM_INDI_SUBKEGIATAN_DELETE').getValues();
	webix.ajax().post("perencanaan_renstra_entri_murni_data_crud_program.php?lvl=indisubkeg&action=delete",{param1:param1}, function(text, data){
		// console.log(data.json().status);
		if (data.json().status=="success"){
			webix.message({type:"form", text:"<div style='background-color:#24c066; color:#fff; margin:-6px -11px -6px -11px;'><span class='webix_icon fa-check-square-o'></span>Data Berhasil Dihapus.</div>"});
				// console.log("add program");
				// console.log(data.json().action);
				// console.log(data.json().sqltes);
			$$("WIN_DATA31_DELETE").hide();
			$$("DT_INDI_SUB_KEG").clearAll();
			$$("DT_INDI_SUB_KEG").load(function(){
			    return webix.ajax().post("perencanaan_renstra_entri_murni_data_child.php?lvl=indisubkeg",{rowid:param1.INDISUBKEG_PRT_ID},function(text, data){
			    })
			});
			// getData();
		} else {
			webix.alert({
				type:"alert-error",
				title: "INFORMATION",
				text:"Data Tidak Berhasil Dihapus !! "+data.json().status,
				ok:"OK",
				callback:function(){
					// $$("WIN_DATA11_ADD").hide();
				}
			});
		}
	});
}



function cancel_finish(){
	// console.log("cancel finish");
	var param1 = $$("DT_PROG").getItem(id_opd);
	// console.log(param1.STATUS_RENSTRA);

	if (webix.rules.isNotEmpty(param1.ROW_ID)){
		webix.ajax().post("getStatus.php?lvl=program_renstra_murni&opd_id="+param1.OPD_ID, function(text, data){
			// console.log(data.json().status);
			if (data.json().status=="finish"){

				webix.ajax().post("verifikasi.php?lvl=renstra_bidang_perencanaan&action=cancel_finish",{param1:param1}, function(text, data){
					// console.log(data.json().status);
					if (data.json().status=="success"){
						webix.message({type:"form", text:"<div style='background-color:#24c066; color:#fff; margin:-6px -11px -6px -11px;'><span class='webix_icon fa-check-square-o'></span>Proses Cancel Finish Berhasil.</div>"});
							// console.log("add program");
							// console.log(data.json().action);
							// console.log(data.json().sqltes);			
						getData();
					} else {
						webix.alert({
							type:"alert-error",
							title: "INFORMATION",
							text:"Proses Cancel Finish Gagal !!"+data.json().status,
							ok:"OK",
							callback:function(){
								// $$("WIN_DATA11_ADD").hide();
							}
						});
					}
				});		
			}else {
				webix.alert({
					type:"alert-error",
					title: "INFORMATION",
					text:"Proses Cancel Finish Gagal !! Karena Status "+data.json().status,
					ok:"OK",
					callback:function(){
						// $$("WIN_DATA11_ADD").hide();
					}
				});
			} 
		});

	}else{
		webix.alert({
			type:"alert-error",
			title: "INFORMATION",
			text:"Proses Cancel Finish Gagal !!",
			ok:"OK",
			callback:function(){
				// $$("WIN_DATA11_ADD").hide();
			}
		});
	}
}


</script>
</body>
</html>