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
<body background="img/bg1.png">

<script type="text/javascript">
	var pintext="", pinstar="";
	var layout = {
		id: "sign-in",
		css: "sign-in",
		rows:[
			{ view:"toolbar", padding:3, height:40, elements:[
				{},
				{view:"button", type:"icon", autowidth:true, css:"app_button", icon:"home", label:"HOME", click:"location.href='index.php';"},
				{view:"button", type:"icon", autowidth:true, css:"app_button", icon:"book", label:"PERENCANAAN", click:"location.href='perencanaan_publik.php';"},
				{view:"button", type:"icon", autowidth:true, css:"app_button", icon:"book", label:"EVALUASI", click:"location.href='evaluasi_publik.php';"},
				{view:"button", type:"icon", autowidth:true, css:"app_button", icon:"sign-in", label:"LOGIN PERENCANAAN", click:"location.href='perencanaan_login.php';"},
				{},
			]},
			{},
			{
				cols:[
					{},
					{
						css: "sing-in-form",
						rows:[
							{
								template: "<div align='center'><BR /><img class='user-logo' src='img/logo_112.png' /></div>",
								width: 290, height: 150, borderless: true
							},
							{
								view: "form",
								borderless: true,
								elements:[
									{view: "label", label: '<center><b style="font-size:19px">MONEV - EVALUASI</b></center>'},
									{view: "label", label: '<center style="margin-top:-10px"><b style="font-size:15px">PEMERINTAHAN KOTA PANGKALPINANG</b></center>'},
									{height: 1},
									{view: "text", label: '<center style="margin-top:-5px">LOGIN DISINI:</center>', placeholder: 'USERNAME ..', name: "user", id: "user", type:"text"},
									{view: "text", label: '<center style="margin-top:-5px"></center>', placeholder: 'PASSWORD ..', name: "pin", id: "pin", type:"text"},
									{view: "button", label: "LOGIN", height: 35, click: function(){
										if (this.getParentView().validate()){
											location.href = "evaluasi.php";
										} else {
											webix.alert({ type:"alert-error", text:"Form data is Empty !!<br />Isi Username dan Password Anda !!<br />Pastikan Username dan Password Anda Benar!!" });
										}
									}},
									{height: 5},
								],
								rules:{
									"user": webix.rules.isNotEmpty,
									"pin": 	webix.rules.isNotEmpty
								},
								elementsConfig:{
									labelPosition: "top",
								}
							},
						]
					},
					{}
				]
			},
			{},
			{height:50},
		]
	};

	webix.ready(function(){
		webix.ui(layout);
		initUi();
	});
	
	function initUi(){
		$$("user").setValue("");
		$$("pin").setValue("");
	}

</script>

</body>
</html>