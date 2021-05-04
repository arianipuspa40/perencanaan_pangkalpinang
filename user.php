<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=8" />
	<meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no">
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
			rows: [{
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
								id: "OPD_CB",
								labelWidth: 140,
								width: 170,
								click: "filterData()"
							},
							{
								view: "text",
								id: "OPD_TXT",
								width: 450
							}, {},
						],
					},
					{
						cols: [{
								view: "checkbox",
								label: "BIDANG",
								id: "BIDANG_CB",
								labelWidth: 140,
								width: 170,
								click: "filterData()"
							},
							{
								view: "text",
								id: "BIDANG_TXT",
								width: 450
							}, {}
						],
					},
					{
						cols: [{
								view: "checkbox",
								label: "USER",
								id: "USER_CB",
								labelWidth: 140,
								width: 170,
								click: "filterData()"
							},
							{
								view: "text",
								id: "USER_TXT",
								width: 450
							}, {}
						],
					},
					{
						cols: [{
								view: "checkbox",
								label: "PEGAWAI",
								id: "PEGAWAI_CB",
								labelWidth: 140,
								width: 170,
								click: "filterData()"
							},
							{
								view: "text",
								id: "PEGAWAI_TXT",
								width: 450
							}, {}
						],
					},
				]
			}]
		};

		var nav_opd = {
			//type:"clean",
			view: "toolbar",
			css: "highlighted_header header",
			paddingX: 2,
			paddingY: 2,
			height: 35,
			cols: [{
					template: "<span class='webix_icon fa-table'></span>USER",
					css: "sub_title2",
					borderless: true,
				},
				{},
				{
					view: "button",
					type: "iconButton",
					icon: "plus-circle",
					label: "TAMBAH",
					autowidth: true,
					click: "addOpd()"
				},
				{
					view: "button",
					type: "iconButton",
					icon: "edit",
					label: "EDIT",
					autowidth: true,
					click: "editOpd()"
				},
				{
					view: "button",
					type: "iconButton",
					icon: "trash-o",
					label: "DELETE",
					autowidth: true,
					click: "deleteOpd()"
				},
			]
		};
		var opd = {
			view: "datatable",
			id: "DATATABLE_OPD",
			leftSplit: 2,
			rightSplit: 2,
			select: true,
			css: "datatable_column",
			height: 300,
			columns: [{
					header: "#",
					id: "ROW_ID",
					hidden: true
				},

				{
					header: "NO",
					id: "NO",
					width: 35,
					css: {
						'text-align': 'right'
					}
				},
				{
					header: "USER",
					id: "URUSAN_1",
					width: 200,
					css: {
						'text-align': 'left'
					},
					fillspace: true
				},
				{
					header: "PEGAWAI",
					id: "BIDANG_URUSAN_1",
					width: 200,
					css: {
						'text-align': 'left'
					},
					fillspace: true
				},
				{
					header: "JENIS AKUN",
					id: "URUSAN_2",
					width: 200,
					css: {
						'text-align': 'left'
					},
					fillspace: true
				},
				{
					header: "HAK AKSES",
					id: "BIDANG_URUSAN_2",
					width: 200,
					css: {
						'text-align': 'left'
					},
					fillspace: true
				},
				{
					header: "OPD",
					id: "URUSAN_3",
					width: 200,
					css: {
						'text-align': 'left'
					},
					fillspace: true
				},
				{
					header: "SUB OPD",
					id: "BIDANG_URUSAN_3",
					width: 200,
					css: {
						'text-align': 'left'
					},
					fillspace: true
				},
				{
					header: "BIDANG",
					id: "URUTAN_OPD",
					width: 100,
					css: {
						'text-align': 'left'
					},
					fillspace: true
				},

				{
					header: "&nbsp;",
					id: "EDIT",
					width: 37,
					template: "<span style='cursor:pointer;' class='webix_icon fa-edit'></span>",
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
				},
				"onItemClick": function(id, e, node) {
					var item = $$("DATATABLE_OPD").getItem(id);
					$$('KODE_OPD_TXT').setValue(item.KODE_OPD_LENGKAP);
					$$('DESKRIPSI_TXT').setValue(item.DESKRIPSI_OPD);
					$$('BIDANG_TEKNIS_TXT').setValue(item.BIDANG_TEKNIS_BAPPEDA);
					$$('PIMPINAN_TXT').setValue(item.PIMPINAN);
				},
				"onItemDblClick": function(id, e, node) {
					id_opd = id;
					editOpd();
				},
			},
			onClick: {
				"fa-edit": function(e, id) {
					id_opd = id;
					editOpd();
				},
				"fa-trash-o": function(e, id) {
					id_opd = id;
					deleteOpd();
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
			//url:"perencanaan_opd_data.php",
		};
		var paging_opd = {
			//type:"clean",
			view: "toolbar",
			css: "highlighted_header header",
			paddingX: 2,
			paddingY: 2,
			height: 35,
			cols: [{
					view: "pager",
					id: "PAGER_OPD",
					master: false,
					borderless: true,
					size: 30,
					group: 5,
					count: 90,
					template: "{common.first()}{common.prev()}{common.pages()}{common.next()}{common.last()} <text style='color:white;'> {common.page()} / #limit# Halaman </text>",
					on: {
						onItemClick: function(id, e, node) {
							//webix.message("ID: "+id);
							if (id == "first") {
								from = 0;
								getData();
							} else if (id == "prev") {
								var pfrom = from - perp;
								if (pfrom >= 0) {
									from = pfrom;
									getData();
								}
							} else if (id == "next") {
								var nfrom = from + perp;
								var lfrom = (page - 1) * perp;
								if (nfrom <= lfrom) {
									from = nfrom;
									getData();
								}
							} else if (id == "last") {
								from = (page - 1) * perp;
								getData();
							} else {
								from = id * perp;
								getData();
							}
						}
					},
				},
				{
					view: "label",
					id: "PAGER_INFO",
					label: "<text style='font-size:13px; float:right;'>1.000 - 30.000 / 100.000 Data </text>",
					width: 250
				},
			]
		};

		var ui = {
			rows: [{
					type: "clean",
					view: "toolbar",
					id: "TOOLBAR_TOP",
					elements: [{
						view: "label",
						template: "<span class='webix_icon fa-home' style='margin-left:6px;'></span> PERENCANAAN &nbsp;" +
							"<span class='webix_icon fa-angle-double-right'></span>SETTING &nbsp;" +
							"<span class='webix_icon fa-angle-double-right'></span>USER"
					}, ],
				},
				{
					type: "space",
					view: "scrollview",
					scroll: "y",
					body: {
						type: "space",
						rows: [
							filter,
							{
								rows: [nav_opd, opd, paging_opd]
							},
							//{rows:[nav_indikator_opd, indikator_opd]},
							{
								height: 20
							},
						]
					}
				}
			]
		};

		webix.ready(function() {
			webix.ui(ui);
			//getData();
		});

		// init public var
		var id_opd = 0;
		var from = 0;
		var numr = 0;
		var page = 0;
		var perp = 0;
		var numA = 0;
		var numB = 0;

		function showWindow(winId, node) {
			$$(winId).getBody().clear();
			$$(winId).show(node);
			$$(winId).getBody().focus();
		}


		//GET DATA 
		function filterData() {
			from = 0;
			$$('PAGER_OPD').select(0);
			getData();
		}

		//GET DATA 
		function getData() {
			var KODE_OPD_TXT = $$("KODE_OPD_TXT").getValue();
			var DESKRIPSI_TXT = $$("DESKRIPSI_TXT").getValue();
			var BIDANG_TEKNIS_TXT = $$("BIDANG_TEKNIS_TXT").getValue();
			var PIMPINAN_TXT = $$("PIMPINAN_TXT").getValue();

			if ($$("KODE_OPD_CB").getValue() == 0) {
				KODE_OPD_TXT = "";
			}
			if ($$("DESKRIPSI_CB").getValue() == 0) {
				DESKRIPSI_TXT = "";
			}
			if ($$("BIDANG_TEKNIS_CB").getValue() == 0) {
				BIDANG_TEKNIS_TXT = "";
			}
			if ($$("PIMPINAN_CB").getValue() == 0) {
				PIMPINAN_TXT = "";
			}

			var param = "?";
			param += "KODE_OPD_TXT=" + KODE_OPD_TXT;
			param += "&";
			param += "DESKRIPSI_TXT=" + DESKRIPSI_TXT;
			param += "&";
			param += "BIDANG_TEKNIS_TXT=" + BIDANG_TEKNIS_TXT;
			param += "&";
			param += "PIMPINAN_TXT=" + PIMPINAN_TXT;
			param += "&";
			param += "from=" + from;
			param += "&";

			// webix.alert({
			// type: "alert-info",
			// text: param,
			// ok: "OK",
			// callback: function(){}
			// });

			webix.ajax().post("perencanaan_opd_data.php" + param + "mode=paging", function(text, data) {
				if (data.json().status == "success") {
					numr = data.json().numr;
					page = data.json().page;
					perp = data.json().perp;
					//webix.message(numr);
					if (numr == 0) {
						$$("DATATABLE_OPD").clearAll();
						$$("DATATABLE_OPD").refresh();
						$$('PAGER_OPD').hide();
						$$('PAGER_OPD').refresh();
						$$('PAGER_INFO').define("label", "<text style='font-size:13px; float:left;'>0 - 0 / 0 Data </text>");
						$$('PAGER_INFO').refresh();
					} else {
						$$("DATATABLE_OPD").clearAll();
						$$("DATATABLE_OPD").refresh();
						$$("DATATABLE_OPD").load("perencanaan_opd_data.php" + param);
						$$('PAGER_OPD').show();
						$$('PAGER_OPD').define("count", numr);
						$$('PAGER_OPD').define("template", "{common.first()}{common.prev()}{common.pages()}{common.next()}{common.last()} <text style='color:white;'> {common.page()} / #limit# Halaman </text>");
						$$('PAGER_OPD').refresh();
						numA = from + 1;
						numB = from + perp;
						if (numB > numr) {
							numB = from + (numr - from);
						}
						$$('PAGER_INFO').define("label", "<text style='font-size:13px; float:right;'>" + numA + " - " + numB + " / " + numr + " Data </text>");
						$$('PAGER_INFO').refresh();
					}
				} else {
					webix.alert({
						type: "alert-error",
						title: "INFORMATION",
						text: "Error get data !!",
						ok: "OK",
						callback: function() {}
					});
				}
			});
		}

		// ADD DATA 
		webix.ready(function() {
			webix.ui({
				view: "window",
				id: "WIN_OPD_ADD",
				width: 500, //height:410,
				move: true,
				modal: true,
				position: "center",
				head: {
					view: "toolbar",
					margin: -5,
					cols: [{
							view: "label",
							label: "<span class='webix_icon fa-plus-circle'></span>TAMBAH USER"
						},
						{
							view: "icon",
							icon: "times-circle",
							click: "$$('WIN_OPD_ADD').hide();",
							tooltip: "Close"
						},
						{
							width: 10
						},
					]
				},
				body: webix.copy(FORM_OPD_ADD)
			});
		});

		function addOpd() {
			showWindow("WIN_OPD_ADD");
		}
		var FORM_OPD_ADD = {
			view: "form",
			borderless: true,
			// scroll:"xy",
			elementsConfig: {
				paddingY: 5,
				paddingX: 0,
			},
			elements: [{
					view: "text",
					label: "USER",
					id: "OPD_ADD_KODE_OPD_LENGKAP",
					labelWidth: 180
				},
				{
					view: "text",
					label: "PASSWORD",
					id: "OPD_ADD_DESKRIPSI_OPD",
					labelWidth: 180
				},
				{
					view: "combo",
					label: "PEGAWAI",
					id: "OPD_ADD_URUSAN_1",
					labelWidth: 180,
					options: [{
						id: "",
						value: ""
					}, ]
				},
				{
					view: "combo",
					label: "JENIS AKUN",
					id: "OPD_ADD_BIDANG_URUSAN_1",
					labelWidth: 180,
					options: [{
						id: "",
						value: ""
					}, ]
				},
				{
					view: "combo",
					label: "HAK AKSES",
					id: "OPD_ADD_URUSAN_2",
					labelWidth: 180,
					options: [{
						id: "",
						value: ""
					}, ]
				},
				{
					view: "combo",
					label: "OPD",
					id: "OPD_ADD_BIDANG_URUSAN_2",
					labelWidth: 180,
					options: [{
						id: "",
						value: ""
					}, ]
				},
				{
					view: "combo",
					label: "SUB OPD",
					id: "OPD_ADD_URUSAN_3",
					labelWidth: 180,
					options: [{
						id: "",
						value: ""
					}, ]
				},
				{
					view: "combo",
					label: "BIDANG",
					id: "OPD_ADD_BIDANG_URUSAN_3",
					labelWidth: 180,
					options: [{
						id: "",
						value: ""
					}, ]
				},
				{
					margin: 5,
					cols: [{},
						{
							view: "button",
							label: "SIMPAN",
							type: "form",
							align: "center",
							width: 100,
							click: function() {
								opdAdd();
							}
						},
						{
							view: "button",
							label: "CANCEL",
							align: "center",
							width: 100,
							click: function() {
								$$("WIN_OPD_ADD").hide();
							}
						},
						{}
					]
				}
			]
		};

		function opdAdd() {
			var OPD_ADD_URUSAN_1 = $$("OPD_ADD_URUSAN_1").getValue();
			var OPD_ADD_BIDANG_URUSAN_1 = $$("OPD_ADD_BIDANG_URUSAN_1").getValue();
			var OPD_ADD_URUSAN_2 = $$("OPD_ADD_URUSAN_2").getValue();
			var OPD_ADD_BIDANG_URUSAN_2 = $$("OPD_ADD_BIDANG_URUSAN_2").getValue();
			var OPD_ADD_URUSAN_3 = $$("OPD_ADD_URUSAN_3").getValue();
			var OPD_ADD_BIDANG_URUSAN_3 = $$("OPD_ADD_BIDANG_URUSAN_3").getValue();
			var OPD_ADD_URUTAN_OPD = $$("OPD_ADD_URUTAN_OPD").getValue();
			var OPD_ADD_KODE_OPD_LENGKAP = $$("OPD_ADD_KODE_OPD_LENGKAP").getValue();
			var OPD_ADD_DESKRIPSI_OPD = $$("OPD_ADD_DESKRIPSI_OPD").getValue();
			var OPD_ADD_KODE_OPD_LAMA = $$("OPD_ADD_KODE_OPD_LAMA").getValue();
			var OPD_ADD_DESKRIPSI_OPD_LAMA = $$("OPD_ADD_DESKRIPSI_OPD_LAMA").getValue();
			var OPD_ADD_PIMPINAN = $$("OPD_ADD_PIMPINAN").getValue();
			var OPD_ADD_SEKRETARIS = $$("OPD_ADD_SEKRETARIS").getValue();
			var OPD_ADD_BIDANG_TEKNIS_BAPPEDA = $$("OPD_ADD_BIDANG_TEKNIS_BAPPEDA").getValue();

			var param = "?";
			param += "OPD_ADD_URUSAN_1=" + OPD_ADD_URUSAN_1;
			param += "&";
			param += "OPD_ADD_BIDANG_URUSAN_1=" + OPD_ADD_BIDANG_URUSAN_1;
			param += "&";
			param += "OPD_ADD_URUSAN_2=" + OPD_ADD_URUSAN_2;
			param += "&";
			param += "OPD_ADD_BIDANG_URUSAN_2=" + OPD_ADD_BIDANG_URUSAN_2;
			param += "&";
			param += "OPD_ADD_URUSAN_3=" + OPD_ADD_URUSAN_3;
			param += "&";
			param += "OPD_ADD_BIDANG_URUSAN_3=" + OPD_ADD_BIDANG_URUSAN_3;
			param += "&";
			param += "OPD_ADD_URUTAN_OPD=" + OPD_ADD_URUTAN_OPD;
			param += "&";
			param += "OPD_ADD_KODE_OPD_LENGKAP=" + OPD_ADD_KODE_OPD_LENGKAP;
			param += "&";
			param += "OPD_ADD_DESKRIPSI_OPD=" + OPD_ADD_DESKRIPSI_OPD;
			param += "&";
			param += "OPD_ADD_KODE_OPD_LAMA=" + OPD_ADD_KODE_OPD_LAMA;
			param += "&";
			param += "OPD_ADD_DESKRIPSI_OPD_LAMA=" + OPD_ADD_DESKRIPSI_OPD_LAMA;
			param += "&";
			param += "OPD_ADD_PIMPINAN=" + OPD_ADD_PIMPINAN;
			param += "&";
			param += "OPD_ADD_SEKRETARIS=" + OPD_ADD_SEKRETARIS;
			param += "&";
			param += "OPD_ADD_BIDANG_TEKNIS_BAPPEDA=" + OPD_ADD_BIDANG_TEKNIS_BAPPEDA; //param += "&";

			// webix.alert({
			// type: "alert-info",
			// text: param,
			// ok: "OK",
			// callback: function(){}
			// });

			webix.ajax().post("perencanaan_opd_data_add.php" + param, function(text, data) {
				if (data.json().status == "success") {
					webix.message({
						type: "form",
						text: "<div style='background-color:#24c066; color:#fff; margin:-6px -11px -6px -11px;'><span class='webix_icon fa-check-square-o'></span>Data Berhasil Disimpan.</div>"
					});
					$$("WIN_OPD_ADD").hide();
					getData();
				} else {
					webix.alert({
						type: "alert-error",
						title: "INFORMATION",
						text: "Data Tidak Berhasil Disimpan !!",
						ok: "OK",
						callback: function() {}
					});
				}
			});
		}


		//EDIT DATA 
		webix.ready(function() {
			webix.ui({
				view: "window",
				id: "WIN_OPD_EDIT",
				width: 500, //height:410,
				move: true,
				modal: true,
				position: "center",
				head: {
					view: "toolbar",
					margin: -5,
					cols: [{
							view: "label",
							label: "<span class='webix_icon fa-edit'></span>EDIT USER"
						},
						{
							view: "icon",
							icon: "times-circle",
							click: "$$('WIN_OPD_EDIT').hide();",
							tooltip: "Close"
						},
						{
							width: 10
						},
					]
				},
				body: webix.copy(FORM_OPD_EDIT),
				on: {
					onShow: function(id) {
						var item = $$("DATATABLE_OPD").getItem(id_opd);

						$$('OPD_EDIT_URUSAN_1').setValue(item.URUSAN_1);
						$$('OPD_EDIT_BIDANG_URUSAN_1').setValue(item.BIDANG_URUSAN_1);
						$$('OPD_EDIT_URUSAN_2').setValue(item.URUSAN_2);
						$$('OPD_EDIT_BIDANG_URUSAN_2').setValue(item.BIDANG_URUSAN_2);
						$$('OPD_EDIT_URUSAN_3').setValue(item.URUSAN_3);
						$$('OPD_EDIT_BIDANG_URUSAN_3').setValue(item.BIDANG_URUSAN_3);
						$$('OPD_EDIT_URUTAN_OPD').setValue(item.URUTAN_OPD);
						$$('OPD_EDIT_KODE_OPD_LENGKAP').setValue(item.KODE_OPD_LENGKAP);
						$$('OPD_EDIT_DESKRIPSI_OPD').setValue(item.DESKRIPSI_OPD);
						$$('OPD_EDIT_KODE_OPD_LAMA').setValue(item.KODE_OPD_LAMA);
						$$('OPD_EDIT_DESKRIPSI_OPD_LAMA').setValue(item.DESKRIPSI_OPD_LAMA);
						$$('OPD_EDIT_PIMPINAN').setValue(item.PIMPINAN);
						$$('OPD_EDIT_SEKRETARIS').setValue(item.SEKRETARIS);
						$$('OPD_EDIT_BIDANG_TEKNIS_BAPPEDA').setValue(item.BIDANG_TEKNIS_BAPPEDA);
					}
				}
			});
		});

		function editOpd() {
			showWindow("WIN_OPD_EDIT");
		}
		var FORM_OPD_EDIT = {
			view: "form",
			borderless: true,
			// scroll:"xy",
			elementsConfig: {
				paddingY: 5,
				paddingX: 0,
			},
			elements: [{
					view: "text",
					label: "USER",
					id: "OPD_EDIT_KODE_OPD_LENGKAP",
					labelWidth: 180
				},
				{
					view: "text",
					label: "PASSWORD",
					id: "OPD_EDIT_DESKRIPSI_OPD",
					labelWidth: 180
				},
				{
					view: "combo",
					label: "PEGAWAI",
					id: "OPD_EDIT_URUSAN_1",
					labelWidth: 180,
					options: [{
						id: "",
						value: ""
					}, ]
				},
				{
					view: "combo",
					label: "JENIS AKUN",
					id: "OPD_EDIT_BIDANG_URUSAN_1",
					labelWidth: 180,
					options: [{
						id: "",
						value: ""
					}, ]
				},
				{
					view: "combo",
					label: "HAK AKSES",
					id: "OPD_EDIT_URUSAN_2",
					labelWidth: 180,
					options: [{
						id: "",
						value: ""
					}, ]
				},
				{
					view: "combo",
					label: "OPD",
					id: "OPD_EDIT_BIDANG_URUSAN_2",
					labelWidth: 180,
					options: [{
						id: "",
						value: ""
					}, ]
				},
				{
					view: "combo",
					label: "SUB OPD",
					id: "OPD_EDIT_URUSAN_3",
					labelWidth: 180,
					options: [{
						id: "",
						value: ""
					}, ]
				},
				{
					view: "combo",
					label: "BIDANG",
					id: "OPD_EDIT_BIDANG_URUSAN_3",
					labelWidth: 180,
					options: [{
						id: "",
						value: ""
					}, ]
				},
				{
					margin: 5,
					cols: [{},
						{
							view: "button",
							label: "SIMPAN",
							type: "form",
							align: "center",
							width: 100,
							click: function() {
								opdEdit();
							}
						},
						{
							view: "button",
							label: "CANCEL",
							align: "center",
							width: 100,
							click: function() {
								$$("WIN_OPD_EDIT").hide();
							}
						},
						{}
					]
				}
			]
		};

		function opdEdit() {
			var OPD_EDIT_URUSAN_1 = $$("OPD_EDIT_URUSAN_1").getValue();
			var OPD_EDIT_BIDANG_URUSAN_1 = $$("OPD_EDIT_BIDANG_URUSAN_1").getValue();
			var OPD_EDIT_URUSAN_2 = $$("OPD_EDIT_URUSAN_2").getValue();
			var OPD_EDIT_BIDANG_URUSAN_2 = $$("OPD_EDIT_BIDANG_URUSAN_2").getValue();
			var OPD_EDIT_URUSAN_3 = $$("OPD_EDIT_URUSAN_3").getValue();
			var OPD_EDIT_BIDANG_URUSAN_3 = $$("OPD_EDIT_BIDANG_URUSAN_3").getValue();
			var OPD_EDIT_URUTAN_OPD = $$("OPD_EDIT_URUTAN_OPD").getValue();
			var OPD_EDIT_KODE_OPD_LENGKAP = $$("OPD_EDIT_KODE_OPD_LENGKAP").getValue();
			var OPD_EDIT_DESKRIPSI_OPD = $$("OPD_EDIT_DESKRIPSI_OPD").getValue();
			var OPD_EDIT_KODE_OPD_LAMA = $$("OPD_EDIT_KODE_OPD_LAMA").getValue();
			var OPD_EDIT_DESKRIPSI_OPD_LAMA = $$("OPD_EDIT_DESKRIPSI_OPD_LAMA").getValue();
			var OPD_EDIT_PIMPINAN = $$("OPD_EDIT_PIMPINAN").getValue();
			var OPD_EDIT_SEKRETARIS = $$("OPD_EDIT_SEKRETARIS").getValue();
			var OPD_EDIT_BIDANG_TEKNIS_BAPPEDA = $$("OPD_EDIT_BIDANG_TEKNIS_BAPPEDA").getValue();

			var item = $$("DATATABLE_OPD").getItem(id_opd);

			var param = "?";
			param += "ROW_ID=" + item.ROW_ID;
			param += "&";
			param += "OPD_EDIT_URUSAN_1=" + OPD_EDIT_URUSAN_1;
			param += "&";
			param += "OPD_EDIT_BIDANG_URUSAN_1=" + OPD_EDIT_BIDANG_URUSAN_1;
			param += "&";
			param += "OPD_EDIT_URUSAN_2=" + OPD_EDIT_URUSAN_2;
			param += "&";
			param += "OPD_EDIT_BIDANG_URUSAN_2=" + OPD_EDIT_BIDANG_URUSAN_2;
			param += "&";
			param += "OPD_EDIT_URUSAN_3=" + OPD_EDIT_URUSAN_3;
			param += "&";
			param += "OPD_EDIT_BIDANG_URUSAN_3=" + OPD_EDIT_BIDANG_URUSAN_3;
			param += "&";
			param += "OPD_EDIT_URUTAN_OPD=" + OPD_EDIT_URUTAN_OPD;
			param += "&";
			param += "OPD_EDIT_KODE_OPD_LENGKAP=" + OPD_EDIT_KODE_OPD_LENGKAP;
			param += "&";
			param += "OPD_EDIT_DESKRIPSI_OPD=" + OPD_EDIT_DESKRIPSI_OPD;
			param += "&";
			param += "OPD_EDIT_KODE_OPD_LAMA=" + OPD_EDIT_KODE_OPD_LAMA;
			param += "&";
			param += "OPD_EDIT_DESKRIPSI_OPD_LAMA=" + OPD_EDIT_DESKRIPSI_OPD_LAMA;
			param += "&";
			param += "OPD_EDIT_PIMPINAN=" + OPD_EDIT_PIMPINAN;
			param += "&";
			param += "OPD_EDIT_SEKRETARIS=" + OPD_EDIT_SEKRETARIS;
			param += "&";
			param += "OPD_EDIT_BIDANG_TEKNIS_BAPPEDA=" + OPD_EDIT_BIDANG_TEKNIS_BAPPEDA; //param += "&";

			// webix.alert({
			// type: "alert-info",
			// text: param,
			// ok: "OK",
			// callback: function(){}
			// });

			webix.ajax().post("perencanaan_opd_data_edit.php" + param, function(text, data) {
				if (data.json().status == "success") {
					webix.message({
						type: "form",
						text: "<div style='background-color:#24c066; color:#fff; margin:-6px -11px -6px -11px;'><span class='webix_icon fa-check-square-o'></span>Data Berhasil Disimpan.</div>"
					});
					$$("WIN_OPD_EDIT").hide();
					getData();
				} else {
					webix.alert({
						type: "alert-error",
						title: "INFORMATION",
						text: "Data Tidak Berhasil Disimpan !!",
						ok: "OK",
						callback: function() {}
					});
				}
			});
		}


		//DELETE DATA OPD
		webix.ready(function() {
			webix.ui({
				view: "window",
				id: "WIN_OPD_DELETE",
				width: 500, //height:410,
				move: true,
				modal: true,
				position: "center",
				head: {
					view: "toolbar",
					margin: -5,
					cols: [{
							view: "label",
							label: "<span class='webix_icon fa-trash-o'></span>HAPUS USER"
						},
						{
							view: "icon",
							icon: "times-circle",
							click: "$$('WIN_OPD_DELETE').hide();",
							tooltip: "Close"
						},
						{
							width: 10
						},
					]
				},
				body: webix.copy(FORM_OPD_DELETE),
				on: {
					onShow: function(id) {
						var item = $$("DATATABLE_OPD").getItem(id_opd);

						$$('OPD_DELETE_URUSAN_1').setValue(item.URUSAN_1);
						$$('OPD_DELETE_BIDANG_URUSAN_1').setValue(item.BIDANG_URUSAN_1);
						$$('OPD_DELETE_URUSAN_2').setValue(item.URUSAN_2);
						$$('OPD_DELETE_BIDANG_URUSAN_2').setValue(item.BIDANG_URUSAN_2);
						$$('OPD_DELETE_URUSAN_3').setValue(item.URUSAN_3);
						$$('OPD_DELETE_BIDANG_URUSAN_3').setValue(item.BIDANG_URUSAN_3);
						$$('OPD_DELETE_URUTAN_OPD').setValue(item.URUTAN_OPD);
						$$('OPD_DELETE_KODE_OPD_LENGKAP').setValue(item.KODE_OPD_LENGKAP);
						$$('OPD_DELETE_DESKRIPSI_OPD').setValue(item.DESKRIPSI_OPD);
						$$('OPD_DELETE_KODE_OPD_LAMA').setValue(item.KODE_OPD_LAMA);
						$$('OPD_DELETE_DESKRIPSI_OPD_LAMA').setValue(item.DESKRIPSI_OPD_LAMA);
						$$('OPD_DELETE_PIMPINAN').setValue(item.PIMPINAN);
						$$('OPD_DELETE_SEKRETARIS').setValue(item.SEKRETARIS);
						$$('OPD_DELETE_BIDANG_TEKNIS_BAPPEDA').setValue(item.BIDANG_TEKNIS_BAPPEDA);
					}
				}
			});
		});

		function deleteOpd() {
			showWindow("WIN_OPD_DELETE");
		}
		var FORM_OPD_DELETE = {
			view: "form",
			borderless: true,
			// scroll:"xy",
			elementsConfig: {
				paddingY: 5,
				paddingX: 0,
			},
			elements: [{
					view: "text",
					label: "USER",
					id: "OPD_DELETE_KODE_OPD_LENGKAP",
					labelWidth: 180
				},
				{
					view: "text",
					label: "PASSWORD",
					id: "OPD_DELETE_DESKRIPSI_OPD",
					labelWidth: 180
				},
				{
					view: "combo",
					label: "PEGAWAI",
					id: "OPD_DELETE_URUSAN_1",
					labelWidth: 180,
					options: [{
						id: "",
						value: ""
					}, ]
				},
				{
					view: "combo",
					label: "JENIS AKUN",
					id: "OPD_DELETE_BIDANG_URUSAN_1",
					labelWidth: 180,
					options: [{
						id: "",
						value: ""
					}, ]
				},
				{
					view: "combo",
					label: "HAK AKSES",
					id: "OPD_DELETE_URUSAN_2",
					labelWidth: 180,
					options: [{
						id: "",
						value: ""
					}, ]
				},
				{
					view: "combo",
					label: "OPD",
					id: "OPD_DELETE_BIDANG_URUSAN_2",
					labelWidth: 180,
					options: [{
						id: "",
						value: ""
					}, ]
				},
				{
					view: "combo",
					label: "SUB OPD",
					id: "OPD_DELETE_URUSAN_3",
					labelWidth: 180,
					options: [{
						id: "",
						value: ""
					}, ]
				},
				{
					view: "combo",
					label: "BIDANG",
					id: "OPD_DELETE_BIDANG_URUSAN_3",
					labelWidth: 180,
					options: [{
						id: "",
						value: ""
					}, ]
				},
				{
					margin: 5,
					cols: [{},
						{
							view: "button",
							label: "HAPUS",
							type: "form",
							align: "center",
							width: 100,
							click: function() {
								opdDelete();
							}
						},
						{
							view: "button",
							label: "CANCEL",
							align: "center",
							width: 100,
							click: function() {
								$$("WIN_OPD_DELETE").hide();
							}
						},
						{}
					]
				}
			]
		};

		function opdDelete() {
			var item = $$("DATATABLE_OPD").getItem(id_opd);

			var param = "?";
			param += "ROW_ID=" + item.ROW_ID;

			// webix.alert({
			// type: "alert-info",
			// text: param,
			// ok: "OK",
			// callback: function(){}
			// });

			webix.ajax().post("perencanaan_opd_data_delete.php" + param, function(text, data) {
				if (data.json().status == "success") {
					webix.message({
						type: "form",
						text: "<div style='background-color:#24c066; color:#fff; margin:-6px -11px -6px -11px;'><span class='webix_icon fa-check-square-o'></span>Data Berhasil Dihapus.</div>"
					});
					$$("WIN_OPD_DELETE").hide();
					getData();
				} else {
					webix.alert({
						type: "alert-error",
						title: "INFORMATION",
						text: "Data Tidak Berhasil Dihapus !!",
						ok: "OK",
						callback: function() {}
					});
				}
			});
		}
	</script>

</body>

</html>