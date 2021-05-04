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
var vimis_txt = "<div style='margin-left:8px; font-size:15px;'><b>Visi: Mewujudkan Pangkalpinang sebagai Kota SENYUM (Sejahtera Nyaman Unggul Makmur)</b><br /><br />"+
								//"<b>Mewujudkan Pangkalpinang sebagai Kota SENYUM (Sejahtera Nyaman Unggul Makmur)</b><br /><br />"+
								"<b>Misi:</b><br />"+
								"1. Meningkatkan Pemanfaatan Potensi Ekonomi dan Penanggulangan Kemiskinan.<br />"+
								"2. Meningkatkan kualitas keamanan ketertiban, perlindungan masyarakat dan peningkatan <br />&nbsp;&nbsp;&nbsp; kesiapsiagaan dalam menghadapi bencana.<br />"+
								"3. Meningkatkan tata kelola pemerintahan yang baik, menuju tercapainya Good Governance.<br />"+
								"4. Meningkatkan kualitas pembangunan sumberdaya manusia yang berkeadilan.<br />"+
								"5. Meningkatkan kualitas infrastruktur dan pengelolaan lingkungan hidup.<br /></div>";
var vimis = {
	type: "clean",
	rows: [
		{
			template: "<span class='webix_icon fa-tasks'></span>VISI MISI",
			css: "sub_title",
			height: 30
		}, 
		{
			template: vimis_txt
		}
	]
};

var jumlah_txt = "<div style='margin-left:8px; font-size:15px;'><b>Tujuan: 5</b><br />"+
								"<b>Indikator Tujuan: 4</b><br />"+
								"<b>Sasaran: 16</b><br />"+
								"<b>Indikator Sasaran/Daerah: 23</b><br /></div>";
var jumlah = {
	type: "clean",
	rows: [
		{
			template: "<span></span>",
			css: "sub_title",
			height: 30
		}, 
		{
			template: jumlah_txt
		}
	]
};

var multiple_dataset = [
	{txt:"Tujuan: 5", valtxt:5},
	{txt:"Indikator Tujuan: <br />4", valtxt:4},
	{txt:"Sasaran: 16", valtxt:16},
	{txt:"Indikator Sasaran/Daerah: 23", valtxt:23}
];
	
var jumlah_chart = {
	type: "clean",
	rows: [
		{
			template: "<span></span>",
			css: "sub_title",
			height: 30
		}, 
		{
			view:"chart",
			type:"stackedBarH",
			barWidth:35,
			xAxis:{},
			yAxis:{lines:true, template:""},
			series:[
				{
					label:"#txt#",
					value:"#valtxt#",
					color: "#58dccd",
				},
			],
			data:multiple_dataset
		}
	]
};


var tabel = {
	type: "clean",
	rows: [
		{
			template: "<span class='webix_icon fa-tasks'></span>KETERKAITAN VISI MISI, TUJUAN DAN SASARAN PERUBAHAN RPJMD KOTA PANGKALPINANG 2018-2020",
			css: "sub_title",
			height: 30
		}, 
		{
			type:"clean",
			rows:[
				{
					view:"datatable",
					columns:[
					{id:"TUJUAN", header:"<center>Tujuan</center>", width:150, fillspace:false}, 
					{id:"INDIKATOR_TUJUAN", header:"<center>Indikator Tujuan</center>", width:150, fillspace:false}, 
					{id:"SASARAN", header:"<center>Sasaran</center>", width:200, fillspace:false}, 
					{id:"INDIKATOR_SASARAN_DAERAH", header:"<center>Indikator Sasaran/Daerah</center>", width:200, fillspace:false}, 
					{id:"SATUAN", header:"<center>Satuan</center>", width:100, fillspace:true}, 
					{id:"REALISASI", header:"<center>Realisasi 2019</center>", width:100, fillspace:false}, 
					{id:"TARGET1", header:[{text:"<center>Target</center>", colspan:4}, "<center>2020</center>"], width:100, fillspace:false}, 
					{id:"TARGET2", header:[null, "<center>2021</center>"], width:100, fillspace:false}, 
					{id:"TARGET3", header:[null, "<center>2022</center>"], width:100, fillspace:false}, 
					{id:"TARGET4", header:[null, "<center>2023</center>"], width:100, fillspace:false},
					],
					data:[{
							"DOKUMEN":"APBD",
							"PROGRAM":"266",
							"KEGIATAN":"3311",
							"INDIKATOR":"-",
				    }, {
							"DOKUMEN":"RKPD",
							"PROGRAM":"266",
							"KEGIATAN":"3265",
							"INDIKATOR":"-",
				    }, {
							"DOKUMEN":"RENSTRA",
							"PROGRAM":"274",
							"KEGIATAN":"-",
							"INDIKATOR":"-",
				  }]
				}
			]
		}
	]
};


webix.ready(function(){
	webix.ui({
		view: "scrollview",
		type: "clean",
		scroll: "native-y",
		body: {
			rows: [
				{
					type: "space",
					rows: [
						{
							type: "wide",
							minHeight: 250,
							height:300,
							cols: [
								vimis, jumlah_chart
							]
						},
						tabel
					]
				}
			]
		}
	});
});
</script>

</body>
</html>