<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=8" />
	<meta name = "viewport" content = "initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no">
	<link rel="icon" type="image/vnd.microsoft.icon" href="img/logo_36.png" /> 
	<link rel="shortcut icon" type="image/x-icon" href="img/logo_36.png" /> 
	<title>:: MONEV - PEMERINTAHAN KOTA PANGKALPINANG ::</title>
	<link rel="stylesheet" href="codebase/skins/compact.css" type="text/css" media="screen" charset="utf-8">
	<script src="codebase/webix.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript" src="libs/sidebar/sidebar.js"></script>
	<link rel="stylesheet" type="text/css" href="libs/sidebar/sidebar.css">
</head>
<body>

<script type="text/javascript">
	var menu_data = [
		{id:"DASHBOARD", icon:"home", value:"DASHBOARD"},
		{id:"REALISASI", icon:"book", value:"REALISASI", data:[
			{id:"ENTRI_REALISASI", value:"ENTRI REALISASI"},
			{id:"PERSETUJUAN_KABID_REALISASI", value:"VERIFIKASI KABID"},
			{id:"PERSETUJUAN_SEKRETARIS_REALISASI", value:"VERIFIKASI SEKRETARIS"},
			{id:"PERSETUJUAN_PIMPINAN_REALISASI", value:"VERIFIKASI PIMPINAN"},
			{id:"PERSETUJUAN_BIDANG_TEKNIS_(BAPPEDA)_REALISASI", value:"VERIFIKASI KASUBID DALEV"},
			{id:"BIDANG_PERENCANAAN_(BAPPEDA)_REALISASI", value:"BIDANG PERENCANAAN (BAPPEDA)"},
		]},
		{id:"LAPORAN", icon:"book", value:"LAPORAN", data:[
			{id:"LAPORAN_EVALUASI_RKPD", value:"LAPORAN EVALUASI RKPD"},
			{id:"LAPORAN_EVALUASI_RENJA", value:"LAPORAN EVALUASI RENJA"},
		]},
		{id:"SETTING", icon:"cog", value:"SETTING", data:[
			{id:"DATA_USER", value:"DATA USER"},
			{id:"DATA_PEGAWAI", value:"DATA PEGAWAI"},
			{id:"URUSAN_PROGRAM_KEGIATAN", value:"DATA URUSAN, PROGRAM, KEGIATAN"},
			{id:"DATA_OPD", value:"DATA OPD"},
			{id:"SETTING_APLIKASI", value:"SETTING APLIKASI"},
		]},
		{id:"LOGOUT", icon:"power-off", value:"LOGOUT"}
	];

	webix.ready(function(){
		webix.ui({
			rows:[
				{ view:"toolbar", padding:3, height:50, elements:[
					{view:"button", type:"icon", icon:"bars",
						width:40, align:"left", css:"app_button", click:function(){
							//$$("$sidebar1").toggle()
							if ($$("$sidebar1").isVisible()) {
								$$("$sidebar1").hide();
							} else {$$("$sidebar1").show();}
						}
					},
					{view:"label", label:"<img class='photo' src='img/logo_36.png' />", autowidth:true},
					{view:"label", label:"MONEV - PEMERINTAHAN KOTA PANGKALPINANG - 2020", width:500},
					{autowidth:true},
					{view:"button", type:"icon", autowidth:true, css:"app_button", icon:"user", label:"ADMIN &nbsp;"},
					{view:"button", type:"icon", autowidth:true, css:"app_button", icon:"sign-out", label:"LOGOUT &nbsp;", click:"location.href='evaluasi_login.php'"},
				]},
				{ cols:[
					{ view:"sidebar",
						data:menu_data,
						on:{
							onAfterSelect: function(id){
								//webix.message("Selected: "+this.getItem(id).value)
								if (id=="DASHBOARD") {
									$$("IFRAME_CONTENT").load("evaluasi_dashboard.php");
									
								} else if (id=="ENTRI_REALISASI") {
									$$("IFRAME_CONTENT").load("evaluasi_realisasi_entri_realisasi.php");
								} else if (id=="PERSETUJUAN_KABID_REALISASI") {
									$$("IFRAME_CONTENT").load("evaluasi_realisasi_kabid.php");
								} else if (id=="PERSETUJUAN_SEKRETARIS_REALISASI") {
									$$("IFRAME_CONTENT").load("evaluasi_realisasi_sekretaris.php");
								} else if (id=="PERSETUJUAN_PIMPINAN_REALISASI") {
									$$("IFRAME_CONTENT").load("evaluasi_realisasi_pimpinan.php");
								} else if (id=="PERSETUJUAN_BIDANG_TEKNIS_(BAPPEDA)_REALISASI") {
									$$("IFRAME_CONTENT").load("evaluasi_realisasi_bidang_teknis.php");
								} else if (id=="BIDANG_PERENCANAAN_(BAPPEDA)_REALISASI") {
									$$("IFRAME_CONTENT").load("evaluasi_realisasi_bidang_perencanaan.php");
									
								} else if (id=="LAPORAN_EVALUASI_RKPD") {
									$$("IFRAME_CONTENT").load("evaluasi_laporan_rkpd.php");
								} else if (id=="LAPORAN_EVALUASI_RENJA") {
									$$("IFRAME_CONTENT").load("evaluasi_laporan_renja.php");
									
								} else if (id=="LOGOUT") {
									location.href = "evaluasi_login.php";
								} 
								this.hide();
							}
						}
					},
					{ rows:[
						{view:"iframe", padding:0, id:"IFRAME_CONTENT", autoheight:true, adjust:true, scroll:"auto", src: "evaluasi_dashboard.php"}
					]}
				]}
			]
		});
		$$("$sidebar1").hide();
		$$("$sidebar1").define("width", 330);
		$$("$sidebar1").resize();
	});
</script>

</body>
</html>