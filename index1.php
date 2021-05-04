<?
session_start();
if (!isset($_SESSION[SID])) {header("Location: login.php");}
?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=8" />
	<link rel="icon" type="image/vnd.microsoft.icon" href="img/logo_tutwurihandayani.png" /> 
	<link rel="shortcut icon" type="image/x-icon" href="img/logo_tutwurihandayani.png" /> 
	<title>:: APLIKASI BUKU INDUK ::</title>
	<link rel="stylesheet" href="codebase/skins/compact.css" type="text/css" media="screen" charset="utf-8">
	<link rel="stylesheet" href="css/css_oa.css" type="text/css" media="screen" charset="utf-8">
	<link rel="stylesheet" href="css/app.less" type="text/css" media="screen" charset="utf-8">
	<script src="codebase/webix.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>

<script type="text/javascript">

	var mainToolbar = {
		view: "toolbar",
		elements:[
			{view: "label", label: "<a href='index.php'><img class='photo' src='img/logo3.png' /></a>", width: 260},
			{id:"ProfileMenu", height:46, css: "header_person", borderless:true, data: {id:3,name: "<?echo $_SESSION[nama_user]."&nbsp;&nbsp;[".$_SESSION[ket_user]."]"?>"},
				template: function(obj){
					var html = 	"<div style='height:100%;width:100%;' onClick='webix.ui(showMenu).show(this)'>";
					html += "<img class='photo' src='img/user.png' /><span class='name'>"+obj.name+"</span>";
					html += "<span class='webix_icon fa-angle-down'></span></div>";
					return html;
				}
			},
			{},
			{view: "label", label: 'SMP ISLAM HIDAYATULLAH SEMARANG', width: 296},
		]
	};

	var body = {
		rows:[
			{
				view: "iframe", id: "IFRAME_CONTENT",
				autoheight: true, adjust: true,
				src: "background.php",
			}
		]
	};

	var layout = {
		rows:[
			mainToolbar, body
		]
	};


	webix.ready(function(){
		webix.ui(layout);
		initUi();
	});
	
	
	var showMenu = {
		view: "submenu",
		id: "pp_menu",
		width: 180,
		padding:0,
		data: [
			{id: "KTSP 2006", icon: "book", value: "   "+"KTSP 2006", submenu:[
				<? if ($_SESSION[level_user]=="Admin") {?>
				{id: "Sekolah", 				icon: "cog", 	value: "   "+"Sekolah"},
				{id: "Mata Pelajaran", 	icon: "cog", 	value: "   "+"Mata Pelajaran"},
				{id: "Ekstrakurikuler", icon: "cog", 	value: "   "+"Ekstrakurikuler"},
				//{id: "User",					 	icon: "cog", 	value: "   "+"User"},
				{ $template:"Separator" },
				<?}?>
				{id: "KTSP 2016/2017",	icon: "book", value: "   "+"2016/2017"},
				{id: "KTSP 2015/2016", 	icon: "book", value: "   "+"2015/2016"},
				{id: "KTSP 2014/2015", 	icon: "book", value: "   "+"2014/2015"},
				{id: "KTSP 2013/2014", 	icon: "book", value: "   "+"2013/2014"},
				{id: "KTSP 2012/2013", 	icon: "book", value: "   "+"2012/2013"},
				{id: "KTSP 2011/2012", 	icon: "book", value: "   "+"2011/2012"},
				{id: "KTSP 2010/2011", 	icon: "book", value: "   "+"2010/2011"},
				{id: "KTSP 2009/2010", 	icon: "book", value: "   "+"2009/2010"},
				{id: "KTSP 2008/2009", 	icon: "book", value: "   "+"2008/2009"},
				{id: "KTSP 2007/2008", 	icon: "book", value: "   "+"2007/2008"},
				{id: "KTSP 2006/2007", 	icon: "book", value: "   "+"2006/2007"},
			]},
			{id: "K13 2017", icon: "book", value: "   "+"K13 &nbsp; 2017", submenu:[
				{id: "K13 2018/2019", icon: "book", value: "   "+"2018/2019"},
				{id: "K13 2017/2018", icon: "book", value: "   "+"2017/2018"},
			]},
			<? if ($_SESSION[level_user]=="Admin") {?>
			{ $template:"Separator" },
			{id: "User",	 icon: "cog", 		 value: "   "+"User"},
			<?}?>
			{ $template:"Separator" },
			{id: "Logout", icon: "sign-out", value: "   "+"Logout"}
		],
		type:{
			template: function(obj){
				if(obj.type)
					return "<div class='separator'></div>";
				return "<span class='webix_icon alerts fa-"+obj.icon+"'></span><span>"+obj.value+"</span>";
			}
		},
		click:function(id){
			//webix.message("ID: "+id); 
			// alert(id.substring(0,4));
			ln = id.length;
			st = id.substring(0,4);
			if (id=="Sekolah") {
				//webix.message("Sekolah");
				$$("IFRAME_CONTENT").load("ktsp2006/sekolah.php");
			} else if (id=="Mata Pelajaran") {
				//webix.message("Mata Pelajaran");
				$$("IFRAME_CONTENT").load("ktsp2006/mata_pelajaran.php");
			} else if (id=="Ekstrakurikuler") {
				//webix.message("Ekstrakurikuler");
				$$("IFRAME_CONTENT").load("ktsp2006/ekstrakurikuler.php");
			} else if (id=="User") {
				//webix.message("User");
				$$("IFRAME_CONTENT").load("ktsp2006/user.php");
			} else if (st=="KTSP") {
				webix.ajax().post("index_code.php?ta="+id, function(text, data){
					if (data.json().status=="success"){
						//webix.message("success");
						$$("IFRAME_CONTENT").load("ktsp2006/cover.php");
					} else {
						//webix.message("error");
					}
				});
			} else if (st=="K13 ") {
				//webix.message("K13");
			} else if (id=="Logout") {
				//webix.message("Logout");
				location.href = "logout.php";
			} 
			this.hide();
		} 
	}
	
	
</script>

</body>
</html>