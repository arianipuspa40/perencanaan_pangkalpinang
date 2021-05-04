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
var tabel = {
	type: "clean",
	rows: [
		{
			template: "<span></span>",
			css: "sub_title",
			height: 30
		}, 
		{
			type:"clean",
			rows:[
				{
					view:"datatable",
					columns:[
					{id:"NO", header:"<center>No</center>", width:50, fillspace:false}, 
					{id:"NAMA_PERANGKAT_DAERAH", header:"<center>Nama Perangkat Daerah</center>", width:300, fillspace:true}, 
					{id:"RATA_RATA_CAPAIAN_INDIKATOR_PROGRAM", header:"<center>Rata-Rata Capaian Indikator Program (Outcome)</center>", width:300, fillspace:false}, 
					{id:"KETERANGAN", header:"<center>Keterangan</center>", width:300, fillspace:false}, 
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
		type: "clean",
		view: "scrollview",
		scroll: "native-y",
		body: {
			rows: [
				{
					type: "space",
					rows: [
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