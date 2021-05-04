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
		{id:"RENSTRA", icon:"book", value:"RENSTRA"},
		{id:"RKPD", icon:"book", value:"RKPD"},
		{id:"RENJA", icon:"book", value:"RENJA"},
		{id:"SASARAN_DAERAH", icon:"book", value:"SASARAN DAERAH"},
		{id:"SASARAN_PERANGKAT_DAERAH", icon:"book", value:"SASARAN PERANGKAT DAERAH"},
		{id:"PENGGUNA", icon:"user", value:"PENGGUNA"},
		{id:"SETTING", icon:"cog", value:"SETTING"},
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
					{view:"button", type:"icon", autowidth:true, css:"app_button", icon:"sign-out", label:"LOGOUT &nbsp;"},
				]},
				{ cols:[
					{ view:"sidebar",
						data:menu_data,
						on:{
							onAfterSelect: function(id){
								webix.message("Selected: "+this.getItem(id).value)
							}
						}
					},
					{ rows:[
						{height:40, id:"title", template:"<div style='margin-top:5px; margin-left:5px;'>DASHBOARD</div>"},
						{view:"iframe", padding:0, id:"IFRAME_CONTENT", autoheight:true, adjust:true, scroll:"auto", src: "http://localhost/"}
					]}
				]}
			]
		});
	$$("$sidebar1").hide();
	});
</script>

</body>
</html>