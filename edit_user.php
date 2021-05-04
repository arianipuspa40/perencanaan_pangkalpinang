<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=8" />
    <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no">
    <link rel="icon" type="image/vnd.microsoft.icon" href="img/logo_36.png" />
    <link rel="shortcut icon" type="image/x-icon" href="img/logo_36.png" />
    <title>:: PERENCANAAN - KOTA PANGKALPINANG ::</title>
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
                        type: "clean",
                        view: "toolbar",
                        id: "TOOLBAR_TOP",
                        elements: [{
                                view: "label",
                                template: "<span class='webix_icon fa-home' style='margin-left:6px;'></span> EDIT &nbsp;" +
                                    "<span class='webix_icon fa-angle-double-right'></span>USER &nbsp;" +
                                    "<span class='webix_icon fa-angle-double-right'></span> PROFILE"
                            },
                            //{width:1},
                            {
                                view: "segmented",
                                value: "EDIT",
                                width: 300,
                                options: [{
                                        id: "edit_user",
                                        value: "EDIT USER"
                                    },
                                    {
                                        id: "test_user",
                                        value: "TEST USER"
                                    },
                                    //{id:"SASARAN PD", value:"SASARAN PD"}
                                ],
                                click: function(id, e) {
                                    var id_opt = $$(id).getValue();
                                    if (id_opt == "edit_user") {
                                        $$("IFRAME_CONTENT").load("form_user_edit.php");
                                    }
                                    if (id_opt == "test_user") {
                                        $$("IFRAME_CONTENT").load("form_user_test.php");
                                    }
                                    //if (id_opt=="SASARAN PD") {$$("IFRAME_CONTENT").load("sasaran_perangkat_daerah.php");}
                                }
                            },
                            {},
                        ],
                    },
                    {
                        //type:"space",
                        rows: [{
                            view: "iframe",
                            padding: 0,
                            id: "IFRAME_CONTENT",
                            autoheight: true,
                            adjust: true,
                            scroll: "auto",
                            src: "form_user_edit.php"
                        }]
                    }
                ]
            });
        });
    </script>

</body>

</html>