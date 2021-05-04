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
						"<span class='webix_icon fa-home' style='margin-left:6px;'></span> PERENCANAAN &nbsp;"+
						"<span class='webix_icon fa-angle-double-right'></span>RKPD"
					},
					//{width:1},
					{ view:"segmented", value:"MURNI", width:300, 
						options:[
						{id:"MURNI", value:"MURNI"},
						{id:"PERUBAHAN", value:"PERUBAHAN"},
						//{id:"SASARAN PD", value:"SASARAN PD"}
						], click:function(id, e) {
							var id_opt = $$(id).getValue();
							if (id_opt=="MURNI") {$$("IFRAME_CONTENT").load("perencanaan_rkpd_murni.php");}
							if (id_opt=="PERUBAHAN") {$$("IFRAME_CONTENT").load("perencanaan_rkpd_perubahan.php");}
							//if (id_opt=="SASARAN PD") {$$("IFRAME_CONTENT").load("sasaran_perangkat_daerah.php");}
						}
					},
					{},
				],
			},
			{
				//type:"space",
				rows:[
					{view:"iframe", padding:0, id:"IFRAME_CONTENT", autoheight:true, adjust:true, scroll:"auto", src:"perencanaan_rkpd_murni.php"}
				]
			}
		]
	});
});
</script>

</body>
</html>