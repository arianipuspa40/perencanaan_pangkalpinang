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
var serapan_per_bulan = {
	type: "clean",
	rows: [
		{
			template: "<span class='webix_icon fa-tasks'></span>SERAPAN ANGGARAN PER BULAN",
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
				end: 225,
				step: 25,
				template: function(obj) {
					return (obj % 25 ? "" : obj);
				}
			},
			padding: {
				left: 80
			},
			data: [{
					id: "1",
					name: "Januari",
					progress: 120,
					color: "#a693eb"
			}, {
					id: "2",
					name: "Februari",
					progress: 130,
					color: "#a693eb"
			}, {
					id: "3",
					name: "Maret",
					progress: 150,
					color: "#49cd81"
			}, {
					id: "4",
					name: "April",
					progress: 130,
					color: "#a693eb"
			}, {
					id: "5",
					name: "Mei",
					progress: 145,
					color: "#a693eb"
			}, {
					id: "6",
					name: "Juni",
					progress: 200,
					color: "#49cd81"
			}, {
					id: "7",
					name: "Juli",
					progress: 220,
					color: "#49cd81"
			}, {
					id: "8",
					name: "Agustus",
					progress: 190,
					color: "#49cd81"
			}, {
					id: "9",
					name: "September",
					progress: 160,
					color: "#49cd81"
			}, {
					id: "10",
					name: "Oktober",
					progress: 130,
					color: "#a693eb"
			}, {
					id: "11",
					name: "November",
					progress: 100,
					color: "#a693eb"
			}, {
					id: "12",
					name: "Desember",
					progress: 90,
					color: "#f19b60"
			}],
			legend: {
				align: "center",
				layout: "x",
				valign: "bottom",
				template: "#region#",
				values: [{
						text: "Serapan",
						color: "#49cd81"
				}, {
						text: "Belum Diserap",
						color: "#f19b60"
				}, {
						text: "Proses",
						color: "#a693eb"
				}]
			}
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
				view:"toolbar", id:"TOOLBAR_TOP",
				elements:[
					{view:"label", template:
						"<span class='webix_icon fa-home' style='margin-left:6px;'></span> Perencanaan &nbsp;"+
						"<span class='webix_icon fa-angle-double-right'></span>RPJMD"
					},
					//{width:1},
					{ view:"segmented", value:"MURNI", width: 370, options:[
						{id:"MURNI", value:"MURNI"},
						{id:"PERUBAHAN", value:"PERUBAHAN"},
						{id:"SASARAN DAERAH", value:"SASARAN DAERAH"}
					]},
					{},
				],
			},
			{
				type: "space",
				view: "scrollview",
				scroll: "native-y",
				body: {
					type: "space",
					rows: [
						{
							type: "wide",
							minHeight: 250,
							height:300,
							cols: [
								serapan_per_bulan, serapan_langsung
							]
						},
						{
							type: "wide",
							minHeight: 250,
							height:300,
							cols: [
								kegiatan, dokumen
							]
						},
					]
				}
			}
		]
	});
});
</script>

</body>
</html>