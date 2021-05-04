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
			// scroll: "xy",
			elementsConfig: {
				paddingY: 10, paddingX: 0
			},
			elements: [
				{view: "datepicker", label: "Tanggal", 			id: "TANGGAL_ADD", 	labelWidth: 119, value: new Date(), format: "%d-%m-%Y", width: 350},
				{view: "text", label: "No Kode", 						id: "NO_KODE_ADD", 	labelWidth: 119, },
				{view: "text", label: "No Bukti", 					id: "NO_BUKTI_ADD", labelWidth: 119, },
				{view: "text", label: "Uraian", 						id: "URAIAN_ADD", 	labelWidth: 119, },
				{view: "richselect", label: "Jenis (D/K)", 	id: "DK_ADD", 			labelWidth: 119, },
				{view: "text", label: "Jumlah", 						id: "JUMLAH_ADD", 	labelWidth: 119, },
				{
					margin: 10,
					cols:[
						{},
						{view: "button", label: "Simpan", type: "form", align: "center", width: 110, click: function(){
							dataAdd();
						}},
						{view: "button", label: "Cancel", align: "center", width: 110, click: function(){
							webix.$$("WIN_DATA_ADD").hide();
						}}
					]
				}
			]
		}
	]
};

var serapan_langsung = {
	type: "clean",
	rows: [
		{
			template: "<span class='webix_icon fa-pie-chart'></span>SERAPAN ANGGARAN BELANJA LANGSUNG",
			css: "sub_title",
			height: 30
		}, 
		{
			view: "chart",
			type: "pie3D",
			color: "#color#",
			shadow: false,
			tooltip: {
					template: "#value#%"
			},
			minHeight: 200,
			padding: {
					left: 15,
					right: 15,
					bottom: 10,
					top: 10
			},
			legend: {
					layout: "y",
					width: 200,
					align: "right",
					valign: "middle",
					template: "#region#"
			},
			data: [{
					color: "#27ae60",
					region: "Serapan",
					value: 40
			}, {
					color: "#f19b60",
					region: "Belum Diserap",
					value: 60
			}]
		}
	]
};

var kegiatan = {
	type: "clean",
	rows: [
		{
			template: "<span class='webix_icon fa-tasks'></span>KEGIATAN APBD, RKPD, RENSTRA",
			css: "sub_title",
			height: 30
		}, 
		{
			view: "chart",
			type: "barH",
			value: "#progress#",
			minHeight: 230,
			color: "#color#",
			barWidth: 30,
			radius: 2,
			tooltip: {
				template: "#progress# %"
			},
			yAxis: {
				template: "#name#"
			},
			xAxis: {
				start: 0,
				end: 4500,
				step: 500,
				template: function(obj) {
					return (obj % 500 ? "" : obj);
				}
			},
			padding: {
				left: 80
			},
			data: [{
					id: "1",
					name: "APBD",
					progress: 3400,
					color: "#a693eb"
			}, {
					id: "2",
					name: "RKPD",
					progress:3200,
					color: "#f19b60"
			}, {
					id: "3",
					name: "RENSTRA",
					progress: 3800,
					color: "#49cd81"
			}],
		}
	]
};

var dokumen = {
	type: "clean",
	rows: [
		{
			view: "datatable",
			columns: [{
					id: "DOKUMEN",
					header: "DOKUMEN",
					sort: "string",
					fillspace: true
			}, {
					id: "PROGRAM",
					header: "PROGRAM",
					sort: "string",
					fillspace: true
			}, {
					id: "KEGIATAN",
					header: "KEGIATAN",
					sort: "string",
					fillspace: true
			}, {
					id: "INDIKATOR",
					header: "INDIKATOR",
					sort: "string",
					fillspace: true
			}],
			data:[{
					"DOKUMEN": "APBD",
					"PROGRAM": "266",
					"KEGIATAN": "3311",
					"INDIKATOR": "-",
		    }, {
					"DOKUMEN": "RKPD",
					"PROGRAM": "266",
					"KEGIATAN": "3265",
					"INDIKATOR": "-",
		    }, {
					"DOKUMEN": "RENSTRA",
					"PROGRAM": "274",
					"KEGIATAN": "-",
					"INDIKATOR": "-",
		  }]
		}
	]
};



webix.ready(function(){
	webix.ui({
		type: "space",
		rows: [
			{
				type: "wide",
				fillspace:true,
				minHeight: 250,
				height:300,
				cols: [
					data_filter,kegiatan
				]
			},
			{
				type: "wide",
				minHeight: 250,
				height:300,
				cols: [
					data_filter,data_filter
				]
			},
		]
	});
});
</script>

</body>
</html>