<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=8" />
	<meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no">
	<link rel="icon" type="image/vnd.microsoft.icon" href="img/logo_36.png" />
	<link rel="shortcut icon" type="image/x-icon" href="img/logo_36.png" />
	<title>:: PERENCANAAN - KOTA PANGKALPINANG ::</title>
	<link rel="stylesheet" href="codebase/skins/compact.css" type="text/css" media="screen" charset="utf-8">
	<link rel="stylesheet" href="css/app.less" type="text/css" media="screen" charset="utf-8">
	<script src="codebase/webix.js" type="text/javascript" charset="utf-8"></script>
</head>

<body>

	<script type="text/javascript">
		var filter = {
			rows: [{
				id: "filter_sasaran",
				view: "form",
				borderless: true,
				elementsConfig: {
					paddingY: 0,
					paddingX: 0
				},
				elements: [{
						cols: [{
								view: "checkbox",
								label: "OPD",
								id: "URUSAN_CB",
								labelWidth: 140,
								width: 170
							},
							{
								view: "text",
								id: "OPD",
								name: "SASARAN_KODE_OPD",
								width: 450
							}, {},
						],
					},
					{
						cols: [{
								view: "checkbox",
								label: "SUB OPD",
								id: "URS_ID_CB",
								labelWidth: 140,
								width: 170
							},
							{
								view: "text",
								id: "SUB_OPD",
								name: "SASARAN_KODE_SUBOPD",
								width: 450
							}, {}
						],
					},
					{
						cols: [{
								view: "checkbox",
								label: "SASARAN OPD",
								id: "PROGRAM_CB",
								labelWidth: 140,
								width: 170
							},
							{
								view: "text",
								id: "SASARAN OPD",
								name: "SASARAN_DESKRIPSI",
								width: 450
							}, {}
						],
					},

				]
			}]
		};

		var nav_sasaran_daerah = {
			//type: "clean",
			view: "toolbar",
			css: "highlighted_header header",
			paddingX: 2,
			paddingY: 2,
			height: 35,
			cols: [{
					template: "<span class='webix_icon fa-table'></span>SASARAN PD",
					css: "sub_title2",
					borderless: true
				},
				{
					view: "button",
					type: "iconButton",
					icon: "plus-circle",
					label: "TAMBAH",
					autowidth: true,
					click: "showAddData()"
				},
				{
					view: "button",
					type: "iconButton",
					icon: "edit",
					label: "EDIT",
					autowidth: true,
					click: "showEditData()"
				},
				{
					view: "button",
					type: "iconButton",
					icon: "trash-o",
					label: "DELETE",
					autowidth: true,
					click: "showDeleteData()"
				},
			]
		};
		var sasaran_daerah = {
			view: "datatable",
			id: "DT_SASARAN",
			select: true,
			css: "datatable_column",
			height: 450,
			columns: [{
					header: "#",
					id: "SASARAN_ROW_ID",
					hidden: true
				},
				{
					header: "No",
					id: "NO",
					width: 35,
					css: {
						'text-align': 'right'
					}
				},
				{
					header: "KODE OPD",
					id: "SASARAN_KODE_OPD",
					width: 200,
					css: {
						'text-align': 'left'
					},
					fillspace: false
				},
				{
					header: "KODE SUB OPD",
					id: "SASARAN_KODE_SUBOPD",
					width: 200,
					css: {
						'text-align': 'left'
					},
					fillspace: false
				},
				{
					header: "SASARAN",
					id: "SASARAN_DESKRIPSI",
					width: 850,
					css: {
						'text-align': 'left'
					},
					fillspace: false
				},
				{
					header: "&nbsp;",
					id: "EDIT",
					width: 37,
					template: "<span style='cursor:pointer;' class='webix_icon fa-pencil'></span>",
					tooltip: "Edit"
				},
				{
					header: "&nbsp;",
					id: "DELETE",
					width: 35,
					template: "<span style='cursor:pointer;' class='webix_icon fa-trash-o'></span>",
					tooltip: "Hapus"
				}
			],
			on: {
				"onBeforeLoad": function() {
					this.showOverlay("Loading...");
				},
				"onAfterLoad": function() {
					this.hideOverlay();
					// console.log(this.getFirstId());
					if (this.getFirstId()) {
						this.select(this.getFirstId());
					}
				},
				"onItemDblClick": function(id, e, node) {
					showEditData();
				},
			},
			onClick: {
				"fa-pencil": function(e, id) {
					showEditData();
				},
				"fa-trash-o": function(e, id) {
					showDeleteData();
				}
			},
			fixedRowHeight: false,
			scroll: true,
			animate: {
				type: "slide",
				subtype: "together"
			},
			tooltip: true,
			hover: "my_hover",
			datatype: "json",
		};


		var ui = {
			view: "scrollview",
			scroll: "native-y",
			body: {
				type: "space",
				rows: [
					filter,
					{
						rows: [nav_sasaran_daerah, sasaran_daerah]
					},
					{
						height: 20
					},
				],
			}
		};

		webix.ready(function() {
			webix.ui(ui);
			webix.ui({
				view: "window",
				id: "WIN_DATA_ADD",
				width: 410,
				height: 410,
				move: true,
				modal: true,
				position: "center",
				head: {
					view: "toolbar",
					margin: -5,
					cols: [{
							view: "label",
							label: "<span class='webix_icon fa-plus-circle'></span>TAMBAH"
						},
						{
							view: "icon",
							icon: "times-circle",
							click: "$$('WIN_DATA_ADD').hide();",
							tooltip: "Close"
						},
						{
							width: 10
						},
					]
				},
				body: webix.copy(FORM_DATA_ADD),
				// on:{
				// 	onShow: function(id){
				// 		var id_subkeg = 1;
				// 		if (id_subkeg > 0){
				// 			$$('FORM_ADD').setValues({
				// 		       ADD_OPD:"tes",
				// 		       ADD_SUB_OPD: "tes2", 			       
				// 		    });			
				// 	    }else{
				// 			webix.alert({
				// 				type:"alert-error",
				// 				title: "INFORMATION",
				// 				text: "OPD TIDAK TERDAFTAR",
				// 				ok:"OK",
				// 				callback:function(){
				// 					$$('WIN_DATA21_ADD').hide();
				// 				}
				// 			});
				// 		}					

				// 	}
				// }
			});

			//edit

			webix.ui({
				view: "window",
				id: "WIN_DATA_EDIT",
				width: 410,
				height: 410,
				move: true,
				modal: true,
				position: "center",
				head: {
					view: "toolbar",
					margin: -5,
					cols: [{
							view: "label",
							label: "<span class='webix_icon fa-edit'></span>EDIT"
						},
						{
							view: "icon",
							icon: "times-circle",
							click: "$$('WIN_DATA_EDIT').hide();",
							tooltip: "Close"
						},
						{
							width: 10
						},
					]
				},
				body: webix.copy(FORM_DATA_EDIT)

			});

			// DELETE
			webix.ui({
				view: "window",
				id: "WIN_DATA_DELETE",
				width: 410,
				height: 410,
				move: true,
				modal: true,
				position: "center",
				head: {
					view: "toolbar",
					margin: -5,
					cols: [{
							view: "label",
							label: "<span class='webix_icon fa-trash-o'></span>DELETE"
						},
						{
							view: "icon",
							icon: "times-circle",
							click: "$$('WIN_DATA_DELETE').hide();",
							tooltip: "Close"
						},
						{
							width: 10
						},
					]
				},
				body: webix.copy(FORM_DATA_DELETE)
			});

			$$("DT_SASARAN").load("perencanaan_data_sasaran_opd.php");
			$$('filter_sasaran').bind('DT_SASARAN');
			$$('FORM_EDIT').bind('DT_SASARAN');
			$$('FORM_DELETE').bind('DT_SASARAN');
		});

		var FORM_DATA_ADD = {
			view: "form",
			id: "FORM_ADD",
			borderless: true,
			// scroll:"xy",
			elementsConfig: {
				paddingY: 5,
				paddingX: 0,
			},
			elements: [
				// {view:"text", 			label:"ROW ID", 			id:"ADD_ROW_ID",  name:"TUJUAN_ROW_ID",	labelWidth:130,  disabled:true},
				{
					view: "text",
					label: "OPD",
					id: "ADD_OPD",
					name: "ADD_OPD",
					labelWidth: 130,
					disabled: true
				},
				{
					view: "text",
					label: "SUB OPD",
					id: "ADD_SUB_OPD",
					name: "ADD_SUB_OPD",
					labelWidth: 130,
					disabled: true
				},
				{
					view: "textarea",
					label: "SASARAN PD",
					id: "ADD_SASARAN",
					name: "ADD_SASARAN",
					labelWidth: 130
				},
				{
					margin: 5,
					cols: [{
							width: 126
						},
						{
							view: "button",
							label: "SIMPAN",
							type: "form",
							align: "center",
							width: 100,
							click: function() {
								addData();
							}
						},
						{
							view: "button",
							label: "CANCEL",
							align: "center",
							width: 100,
							click: function() {
								$$("WIN_DATA_ADD").hide();
							}
						},
						{}
					]
				}
			]
		};

		var FORM_DATA_EDIT = {
			view: "form",
			id: "FORM_EDIT",
			borderless: true,
			// scroll:"xy",
			elementsConfig: {
				paddingY: 5,
				paddingX: 0,
			},
			elements: [
				// {view:"text", 			label:"ROW ID", 			id:"ADD_ROW_ID",  name:"TUJUAN_ROW_ID",	labelWidth:130,  disabled:true},
				{
					view: "text",
					label: "OPD",
					id: "EDIT_OPD",
					name: "SASARAN_KODE_OPD",
					labelWidth: 130,
					disabled: true
				},
				{
					view: "text",
					label: "SUB OPD",
					id: "EDIT_SUB_OPD",
					name: "SASARAN_KODE_SUBOPD",
					labelWidth: 130,
					disabled: true
				},
				{
					view: "textarea",
					label: "SASARAN PD",
					id: "EDIT_PROGRAM",
					name: "SASARAN_DESKRIPSI",
					labelWidth: 130
				},
				{
					margin: 5,
					cols: [{
							width: 126
						},
						{
							view: "button",
							label: "SIMPAN",
							type: "form",
							align: "center",
							width: 100,
							click: function() {
								editData();
							}
						},
						{
							view: "button",
							label: "CANCEL",
							align: "center",
							width: 100,
							click: function() {
								$$("WIN_DATA_EDIT").hide();
							}
						},
						{}
					]
				}
			]
		};

		var FORM_DATA_DELETE = {
			view: "form",
			id: "FORM_DELETE",
			borderless: true,
			// scroll:"xy",
			elementsConfig: {
				paddingY: 5,
				paddingX: 0,
			},
			elements: [
				// {view:"text", 			label:"ROW ID", 			id:"ADD_ROW_ID",  name:"TUJUAN_ROW_ID",	labelWidth:130,  disabled:true},
				{
					view: "text",
					label: "OPD",
					id: "DELETE_OPD",
					name: "SASARAN_KODE_OPD",
					labelWidth: 130,
					disabled: true
				},
				{
					view: "text",
					label: "SUB OPD",
					id: "DELETE_SUB_OPD",
					name: "SASARAN_KODE_SUBOPD",
					labelWidth: 130,
					disabled: true
				},
				{
					view: "textarea",
					label: "SASARAN PD",
					id: "DELETE_PROGRAM",
					name: "SASARAN_DESKRIPSI",
					labelWidth: 130,
					disabled: true
				},
				{
					margin: 5,
					cols: [{
							width: 126
						},
						{
							view: "button",
							label: "DELETE",
							type: "form",
							align: "center",
							width: 100,
							click: function() {
								deleteData();
							}
						},
						{
							view: "button",
							label: "CANCEL",
							align: "center",
							width: 100,
							click: function() {
								$$("WIN_DATA_DELETE").hide();
							}
						},
						{}
					]
				}
			]
		};


		function showWindow(winId, node) {
			$$(winId).getBody().clear();
			$$(winId).show(node);
			$$(winId).getBody().focus();
		}


		// tambah
		function addData() {
			var param1 = $$('FORM_ADD').getValues();
			// console.log(param1);

			webix.ajax().post("perencanaan_crud_tujuan_sasaran_pd.php?lvl=sasaran&action=add", {
				param1: param1
			}, function(text, data) {
				if (data.json().status == "success") {
					webix.message({
						type: "form",
						text: "<div style='background-color:#24c066; color:#fff; margin:-6px -11px -6px -11px;'><span class='webix_icon fa-check-square-o'></span>Data Berhasil Ditambahkan.</div>"
					});
					// console.log("add program");
					// console.log(data.json().action);
					// console.log(data.json().sqltes);
					$$("WIN_DATA_ADD").hide();
					$$("DT_SASARAN").clearAll();
					$$("DT_SASARAN").refresh();
					$$("DT_SASARAN").load("perencanaan_data_sasaran_opd.php");
					// getData();
					// var id_terakhir = $$('DT_PROG').getSelectedId().id;
				} else if (data.json().status == "bermasalah") {
					window.top.location.href = "index.php";
				} else {
					webix.alert({
						type: "alert-error",
						title: "INFORMATION",
						text: "Data Tidak Berhasil Ditambahkan!! " + data.json().status,
						ok: "OK",
						callback: function() {}
					});
				}
			});
		}

		// edit
		// var temp_FORM_PROGRAM_DELETE1 = {};
		// function deleteData1(){
		// 	showWindow("WIN_DATA1_DELETE");
		// 	if ($$("FORM_PROGRAM_DELETE1").getValues().ROW_ID > 0) {
		// 		temp_FORM_PROGRAM_DELETE1 = $$("FORM_PROGRAM_DELETE1").getValues();
		// 	} else{
		// 		$$("FORM_PROGRAM_DELETE1").setValues(temp_FORM_PROGRAM_DELETE1);
		// 	}
		// }

		// edit
		var temp_FORM_EDIT = {};

		function showEditData() {
			showWindow("WIN_DATA_EDIT");
			// console.log($$("FORM_EDIT").getValues());
			if ($$("FORM_EDIT").getValues().SASARAN_ROW_ID > 0) {
				temp_FORM_EDIT = $$("FORM_EDIT").getValues();
			} else {
				$$("FORM_EDIT").setValues(temp_FORM_EDIT);
			}
		}

		function editData() {
			var param1 = $$('FORM_EDIT').getValues();
			// console.log(param1);

			webix.ajax().post("perencanaan_crud_tujuan_sasaran_pd.php?lvl=sasaran&action=edit", {
				param1: param1
			}, function(text, data) {
				if (data.json().status == "success") {
					webix.message({
						type: "form",
						text: "<div style='background-color:#24c066; color:#fff; margin:-6px -11px -6px -11px;'><span class='webix_icon fa-check-square-o'></span>Data Berhasil Diedit.</div>"
					});
					// console.log("add program");
					// console.log(data.json().action);
					// console.log(data.json().sqltes);
					// var id_terakhir = $$('DT_PROG').getSelectedId().id;
					$$("WIN_DATA_EDIT").hide();
					$$("DT_SASARAN").clearAll();
					$$("DT_SASARAN").refresh();
					$$("DT_SASARAN").load("perencanaan_data_sasaran_opd.php");
				} else if (data.json().status == "bermasalah") {
					window.top.location.href = "index.php";
				} else {
					webix.alert({
						type: "alert-error",
						title: "INFORMATION",
						text: "Data Tidak Berhasil Diedit!! " + data.json().status,
						ok: "OK",
						callback: function() {}
					});
				}
			});
		}

		// delete

		// function showDeleteData(){
		// 	showWindow("WIN_DATA_DELETE");
		// }

		var temp_FORM_DELETE = {};

		function showDeleteData() {
			showWindow("WIN_DATA_DELETE");
			// console.log($$("FORM_EDIT").getValues());
			if ($$("FORM_DELETE").getValues().SASARAN_ROW_ID > 0) {
				temp_FORM_DELETE = $$("FORM_DELETE").getValues();
			} else {
				$$("FORM_DELETE").setValues(temp_FORM_DELETE);
			}
		}

		function deleteData() {
			var param1 = $$('FORM_DELETE').getValues();
			console.log(param1);
			webix.ajax().post("perencanaan_crud_tujuan_sasaran_pd.php?lvl=sasaran&action=delete", {
				param1: param1
			}, function(text, data) {
				if (data.json().status == "success") {
					webix.message({
						type: "form",
						text: "<div style='background-color:#24c066; color:#fff; margin:-6px -11px -6px -11px;'><span class='webix_icon fa-check-square-o'></span>Data Berhasil Dihapus.</div>"
					});
					// console.log("add program");
					// console.log(data.json().action);
					// console.log(data.json().sqltes);
					// var id_terakhir = $$('DT_PROG').getSelectedId().id;
					$$("WIN_DATA_DELETE").hide();
					$$("DT_SASARAN").clearAll();
					$$("DT_SASARAN").refresh();
					$$("DT_SASARAN").load("perencanaan_data_sasaran_opd.php");
				} else if (data.json().status == "bermasalah") {
					window.top.location.href = "index.php";
				} else {
					webix.alert({
						type: "alert-error",
						title: "INFORMATION",
						text: "Data Tidak Berhasil Dihapus!! " + data.json().status,
						ok: "OK",
						callback: function() {}
					});
				}
			});
		}


		function showAddData() {
			showWindow("WIN_DATA_ADD");
		}
	</script>

</body>

</html>