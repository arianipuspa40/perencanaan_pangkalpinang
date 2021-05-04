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
</head>
<body>

<script type="text/javascript">

	webix.ready(function(){
		webix.ui({
			rows:[
				{ view:"toolbar", padding:3, height:50, elements:[
					{view:"label", label:"<img class='photo' src='img/logo_36.png' />", autowidth:true},
					{view:"label", label:"MONEV - PEMERINTAHAN KOTA PANGKALPINANG - EVALUASI", width:500},
					{autowidth:true},
					{view:"button", type:"icon", autowidth:true, css:"app_button", icon:"home", label:"HOME", click:"location.href='index.php';"},
					{view:"button", type:"icon", autowidth:true, css:"app_button", icon:"book", label:"PERENCANAAN", click:"location.href='perencanaan_publik.php';"},
					{view:"button", type:"icon", autowidth:true, css:"app_button", icon:"sign-in", label:"LOGIN", click:"location.href='evaluasi_login.php';"},
				]},
				{ cols:[
					{ rows:[
						{view:"iframe", padding:0, id:"IFRAME_CONTENT", autoheight:true, adjust:true, scroll:"auto", src: "evaluasi_publik_content.php"}
					]}
				]}
			]
		});
	});
</script>

</body>
</html>