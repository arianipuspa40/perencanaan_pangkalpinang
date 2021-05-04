<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=8" />
	<meta name = "viewport" content = "initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no">
	<link rel="icon" type="image/vnd.microsoft.icon" href="img/logo_36.png" /> 
	<link rel="shortcut icon" type="image/x-icon" href="img/logo_36.png" /> 
	<title>:: MONEV - PEMERINTAHAN KOTA PANGKALPINANG ::</title>
	<link rel="stylesheet" href="codebase/skins/compact.css" type="text/css" media="screen" charset="utf-8">
	<link rel="stylesheet" href="codebase/css/app.less" type="text/css" media="screen" charset="utf-8">
	<script src="codebase/webix.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>

<script type="text/javascript">
var tasks = {
	type: "clean",
	rows: [
		{
			template: "<span class='webix_icon fa-pie-chart'></span>Pie chart",
			css: "sub_title",
			height: 30
		}, 
		{
			view: "chart",
			type: "barH",
			value: "#progress#",
			minHeight: 230,
			color: "#color#",
			barWidth: 30,
			radius: 2,
			tooltip: {
				template: "#progress# %"
			},
			yAxis: {
				template: "#name#"
			},
			xAxis: {
				start: 0,
				end: 100,
				step: 10,
				template: function(obj) {
					return (obj % 20 ? "" : obj);
				}
			},
			padding: {
				left: 120
			},
			data: [{
					id: "1",
					name: "Report",
					progress: 55,
					color: "#49cd81"
			}, {
					id: "2",
					name: "Strategy  meeting",
					progress: 20,
					color: "#a693eb"
			}, {
					id: "3",
					name: "Partners meeting",
					progress: 70,
					color: "#49cd81"
			}, {
					id: "4",
					name: "Research analysis",
					progress: 30,
					color: "#a693eb"
			}, {
					id: "5",
					name: "Presentation",
					progress: 60,
					color: "#f19b60"
			}],
			legend: {
				align: "center",
				layout: "x",
				valign: "bottom",
				template: "#region#",
				values: [{
						text: "Company",
						color: "#49cd81"
				}, {
						text: "Inner tasks",
						color: "#f19b60"
				}, {
						text: "Projects",
						color: "#a693eb"
				}]
			}
		}
	]
};

var diffchart = {
	type: "clean",
	rows: [
		{
			template: "<span class='webix_icon fa-pie-chart'></span>Pie chart",
			css: "sub_title",
			height: 30
		}, 
		{
			view: "chart",
			type: "pie3D",
			color: "#color#",
			shadow: false,
			tooltip: {
					template: "#value#%"
			},
			minHeight: 200,
			padding: {
					left: 15,
					right: 15,
					bottom: 10,
					top: 10
			},
			legend: {
					layout: "y",
					width: 100,
					align: "right",
					valign: "middle",
					template: "#region#"
			},
			data: [{
					color: "#61b5ee",
					region: "Asia",
					value: 35
			}, {
					color: "#27ae60",
					region: "Europe",
					value: 30
			}, {
					color: "#9e89eb",
					region: "USA",
					value: 25
			}, {
					color: "#f19b60",
					region: "Australia",
					value: 10
			}]
		}
	]
};

webix.ready(function(){
	webix.ui({
		type: "clean",
		rows: [
			{
				type: "space",
				rows: [
					{
						type: "wide",
						minHeight: 250,
						height:300,
						cols: [
							tasks, diffchart
						]
					},
					{
						type: "wide",
						minHeight: 250,
						height:300,
						cols: [
							tasks, diffchart
						]
					}
				]
			}
		]
	});
});
</script>

</body>
</html>