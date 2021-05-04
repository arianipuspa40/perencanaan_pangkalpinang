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
<form>
	<div id="areaA"></div>
	<div id="areaB"></div>
</form>

<script type="text/javascript">
	var form1 = [
			{ view:"text", label:'Login', name:"login" },
			{ view:"text", label:'Email', name:"email" },
			{ view:"button", value: "Submit", click:function(){
				var form = this.getParentView();
				// console.log(form);
				if (form.validate())					
					webix.message("All is correct");
				else
					webix.message({ type:"error", text:"Form data is invalid" });
			}}
		];


		webix.ui({
			container:"areaA",
			view:"form", scroll:false, width:300, 

			elements: form1,
			rules:{
				$obj:function(){
					var data = this.getValues();
					console.log(data);
					if (!webix.rules.isEmail( data.email )) return false;
					if (data.name == "") return false;
					return true;
				}
			},
			elementsConfig:{
				labelPosition:"top"
			}
		});	

</script>

</body>
</html>

<?php
// connecting to db
require("dbconn.php");
// echo "tes";


?>