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
		{id:"RPJMD", icon:"book", value:"RPJMD"},
		{id:"RENSTRA", icon:"book", value:"RENSTRA", data:[
			{id:"ENTRI", value:"ENTRI"},
			{id:"PERSETUJUAN_KABID_RENSTRA", value:"PERSETUJUAN KABID"},
			{id:"PERSETUJUAN_SEKRETARIS_(KASUBAG_PROGRAM)_RENSTRA", value:"PERSETUJUAN SEKRETARIS (KASUBAG PROGRAM)"},
			{id:"PERSETUJUAN_BIDANG_TEKNIS_(BAPPEDA)_RENSTRA", value:"PERSETUJUAN BIDANG TEKNIS (BAPPEDA)"},
			{id:"BIDANG_PERENCANAAN_(BAPPEDA)_RENSTRA", value:"BIDANG PERENCANAAN (BAPPEDA)"},
			{id:"CREATE_DATA_RENJA", value:"CREATE DATA RENJA"},
		]},
		{id:"RKPD", icon:"book", value:"RKPD"},
		{id:"RENJA", icon:"book", value:"RENJA", data:[
			{id:"EDIT_DATA_RENJA", value:"EDIT DATA RENJA"},
			{id:"PERSETUJUAN_KABID_RENJA", value:"PERSETUJUAN KABID"},
			{id:"PERSETUJUAN_SEKRETARIS_(KASUBAG_PROGRAM)_RENJA", value:"PERSETUJUAN SEKRETARIS (KASUBAG PROGRAM)"},
			{id:"PERSETUJUAN_BIDANG_TEKNIS_(BAPPEDA)_RENJA", value:"PERSETUJUAN BIDANG TEKNIS (BAPPEDA)"},
			{id:"BIDANG_PERENCANAAN_(BAPPEDA)_RENJA", value:"BIDANG PERENCANAAN (BAPPEDA)"},
			{id:"CREATE_DATA_DPA", value:"CREATE DATA DPA"},
		]},
		{id:"DPA", icon:"book", value:"DPA", data:[
			{id:"EDIT_DATA_DPA", value:"EDIT DATA DPA"},
			{id:"PERSETUJUAN_KABID_DPA", value:"PERSETUJUAN KABID"},
			{id:"PERSETUJUAN_SEKRETARIS_(KASUBAG_PROGRAM)_DPA", value:"PERSETUJUAN SEKRETARIS (KASUBAG PROGRAM)"},
			{id:"PERSETUJUAN_BIDANG_TEKNIS_(BAPPEDA)_DPA", value:"PERSETUJUAN BIDANG TEKNIS (BAPPEDA)"},
			{id:"BIDANG_PERENCANAAN_(BAPPEDA)_DPA", value:"BIDANG PERENCANAAN (BAPPEDA)"},
			{id:"CREATE_APBD_PERUBAHAN", value:"CREATE APBD PERUBAHAN"},
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
					{view:"button", type:"icon", autowidth:true, css:"app_button", icon:"sign-out", label:"LOGOUT &nbsp;", click:"location.href='perencanaan_login.php'"},
				]},
				{ cols:[
					{ view:"sidebar",
						data:menu_data,
						on:{
							onAfterSelect: function(id){
								//webix.message("Selected: "+this.getItem(id).value)
								if (id=="DASHBOARD") {
									$$("IFRAME_CONTENT").load("perencanaan_dashboard.php");
								} else if (id=="RPJMD") {
									$$("IFRAME_CONTENT").load("perencanaan_rpjmd.php");
								} else if (id=="ENTRI") {
									$$("IFRAME_CONTENT").load("perencanaan_renstra_entri.php");
								} else if (id=="PERSETUJUAN_KABID_RENSTRA") {
									$$("IFRAME_CONTENT").load("perencanaan_renstra_kabid.php");
								} else if (st=="PERSETUJUAN_SEKRETARIS_(KASUBAG_PROGRAM)_RENSTRA") {
									$$("IFRAME_CONTENT").load("perencanaan_renstra_sekretaris.php");
								} else if (st=="PERSETUJUAN_BIDANG_TEKNIS_(BAPPEDA)_RENSTRA") {
									$$("IFRAME_CONTENT").load("perencanaan_renstra_bidang_teknis.php");
								} else if (st=="BIDANG_PERENCANAAN_(BAPPEDA)_RENSTRA") {
									$$("IFRAME_CONTENT").load("perencanaan_renstra_perencanaan.php");
								} else if (st=="CREATE_DATA_RENJA") {
									$$("IFRAME_CONTENT").load("perencanaan_renstra_create_data.php");
								
								} else if (id=="Logout") {
									location.href = "perencanaan_login.php";
								} 
								this.hide();
							}
						}
					},
					{ rows:[
						{view:"iframe", padding:0, id:"IFRAME_CONTENT", autoheight:true, adjust:true, scroll:"auto", src: "perencanaan_dashboard.php"}
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