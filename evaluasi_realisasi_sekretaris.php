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

webix.ready(function(){
	webix.ui({
		//type:"space",
		rows:[
			{
				type:"clean",
				view:"toolbar", id:"TOOLBAR_TOP",
				elements:[
					{view:"label", template:
						"<span class='webix_icon fa-home' style='margin-left:6px;'></span> EVALUASI &nbsp;"+
						"<span class='webix_icon fa-angle-double-right'></span>REALISASI &nbsp;"+
						"<span class='webix_icon fa-angle-double-right'></span>PERSETUJUAN SEKRETARIS"
					},
					//{width:1},
					{ view:"segmented", value:"TRIWULAN_1", width:500, 
						options:[
						{id:"TRIWULAN_1", value:"TRIWULAN 1"},
						{id:"TRIWULAN_2", value:"TRIWULAN 2"},
						{id:"TRIWULAN_3", value:"TRIWULAN 3"},
						{id:"TRIWULAN_4", value:"TRIWULAN 4"},
						//{id:"SASARAN PD", value:"SASARAN PD"}
						], click:function(id, e) {
							var id_opt = $$(id).getValue();
							if (id_opt=="TRIWULAN_1") {$$("IFRAME_CONTENT").load("evaluasi_realisasi_sekretaris_t1.php");}
							if (id_opt=="TRIWULAN_2") {$$("IFRAME_CONTENT").load("evaluasi_realisasi_sekretaris_t2.php");}
							if (id_opt=="TRIWULAN_3") {$$("IFRAME_CONTENT").load("evaluasi_realisasi_sekretaris_t3.php");}
							if (id_opt=="TRIWULAN_4") {$$("IFRAME_CONTENT").load("evaluasi_realisasi_sekretaris_t4.php");}
							//if (id_opt=="SASARAN PD") {$$("IFRAME_CONTENT").load("sasaran_perangkat_daerah.php");}
						}
					},
					{},
				],
			},
			{
				//type:"space",
				rows:[
					{view:"iframe", padding:0, id:"IFRAME_CONTENT", autoheight:true, adjust:true, scroll:"auto", src:"evaluasi_realisasi_sekretaris_t1.php"}
				]
			}
		]
	});
});
</script>

</body>
</html>