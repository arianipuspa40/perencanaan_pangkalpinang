<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=8" />
	<meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no">
	<link rel="icon" type="image/vnd.microsoft.icon" href="img/logo_36.png" />
	<link rel="shortcut icon" type="image/x-icon" href="img/logo_36.png" />
	<title>:: MONEV - PEMERINTAH KOTA PANGKALPINANG MANTAP ::</title>
	<link rel="stylesheet" href="codebase/skins/compact.css" type="text/css" media="screen" charset="utf-8">
	<link rel="stylesheet" href="css/app.less" type="text/css" media="screen" charset="utf-8">
	<script src="codebase/webix.js" type="text/javascript" charset="utf-8"></script>
</head>

<body>

	<script type="text/javascript">
		webix.ready(function() {
			webix.ui({
				//type:"space",
				rows: [{
					type: "space",
					rows: [{
						view: "iframe",
						padding: 0,
						id: "IFRAME_CONTENT",
						autoheight: true,
						adjust: true,
						scroll: "auto",
						src: "file/RPJMD_PMDN_13.pdf"
					}]
				}]
			});
		});
	</script>

</body>

</html>