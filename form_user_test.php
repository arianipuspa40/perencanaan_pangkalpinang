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
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <script src="codebase/webix.js" type="text/javascript" charset="utf-8"></script>
</head>

<body>

    <script type="text/javascript">
        var filter = {
            rows: [{
                id: "form_cek",
                view: "form",
                borderless: true,
                elementsConfig: {
                    paddingY: 0,
                    paddingX: 0
                },
                elements: [{
                        cols: [{
                            label: "USERNAME",
                            view: "text",
                            id: "user",
                            name: "user",
                            disabled: true,
                            width: 450
                        }, {}, ]
                    },
                    {
                        cols: [{
                            label: "OPD",
                            view: "text",
                            id: "deskripsi",
                            name: "deskripsi",
                            disabled: true,
                            width: 450
                        }, {}, ]
                    },
                    {
                        cols: [{
                                label: "PASSWORD",
                                view: "text",
                                id: "password",
                                name: "password",
                                placeholder: "validasi password",
                                disabled: false,
                                width: 450

                            },
                            {
                                width: 10
                            },
                            {
                                view: "button",
                                type: "iconButton",
                                // icon: "trash-o",
                                label: "CEK AKUN",
                                autowidth: true,
                                click: "cekAkun()"
                            },
                            {},
                        ]
                    },
                    // {
                    //     cols: [{
                    //             view: "checkbox",
                    //             label: "SASARAN OPD",
                    //             id: "PROGRAM_CB",
                    //             labelWidth: 140,
                    //             width: 170
                    //         },
                    //         {
                    //             view: "text",
                    //             id: "SASARAN OPD",
                    //             name: "SASARAN_DESKRIPSI",
                    //             width: 450
                    //         }, {}
                    //     ],
                    // },

                ]
            }]
        };

        var nav_user = {
            //type: "clean",
            view: "toolbar",
            css: "highlighted_header header",
            paddingX: 2,
            paddingY: 2,
            height: 35,
            cols: [{
                    template: "<span class='webix_icon fa-table'></span>SASARAN PD",
                    css: "sub_title2",
                    borderless: true
                },
                {
                    view: "button",
                    type: "iconButton",
                    icon: "fas fa-sync",
                    label: "REFRESH",
                    autowidth: true,
                    click: function refreshData() {
                        $$("dt_user").clearAll();
                        $$("dt_user").load("data_user_edit.php");
                    }
                },
                {
                    view: "button",
                    type: "iconButton",
                    icon: "edit",
                    label: "EDIT",
                    autowidth: true,
                    click: "showEditData()"
                },
                // {
                //     view: "button",
                //     type: "iconButton",
                //     icon: "edit",
                //     label: "EDIT",
                //     autowidth: true,
                //     click: "showEditData()"
                // },
            ]
        };
        var dataUser = {
            view: "datatable",
            id: "dt_user",
            select: true,
            resizeColumn: true,
            css: "datatable_column",
            // url: "data_user_edit.php",
            // height: 450,
            columns: [{
                    header: "#",
                    id: "nama",
                    hidden: true
                },
                {
                    header: "No",
                    id: "NO",
                    width: 35,
                    css: {
                        'text-align': 'right'
                    }
                },
                {
                    header: "NAMA DINAS",
                    id: "deskripsi",
                    css: {
                        'text-align': 'left'
                    },
                    width: 580,
                    fillspace: false
                },
                {
                    header: "USERNAME",
                    id: "user",
                    css: {
                        'text-align': 'left'
                    },
                    width: 140,
                    fillspace: false
                },
                {
                    header: "HAK AKSES",
                    id: "hak_akses",
                    css: {
                        'text-align': 'left'
                    },
                    width: 550,
                    fillspace: false
                },
                // {
                //     header: "STATUS",
                //     id: "ss",
                //     css: {
                //         'text-align': 'left'
                //     },
                //     width: 140,
                //     fillspace: false
                // },
                {
                    header: "&nbsp;",
                    id: "EDIT",
                    width: 37,
                    template: "<span style='cursor:pointer;' class='webix_icon fa-pencil'></span>",
                    tooltip: "Edit"
                }
            ],
            on: {
                // onAfterSelect: valuesToForm,
                "onBeforeLoad": function() {
                    this.showOverlay("Loading...");
                },
                "onAfterLoad": function() {
                    this.hideOverlay();
                    // console.log(this.getFirstId());
                    if (this.getFirstId()) {
                        this.select(this.getFirstId());
                    }
                },
                "onItemDblClick": function(id, e, node) {
                    showEditData();
                },
            },
            onClick: {
                "fa-pencil": function(e, id) {
                    showEditData();
                },
                "fa-trash-o": function(e, id) {
                    showDeleteData();
                }
            },
            fixedRowHeight: false,
            scroll: true,
            animate: {
                type: "slide",
                subtype: "together"
            },
            tooltip: true,
            hover: "my_hover",
            datatype: "json",
        };


        var ui = {
            view: "scrollview",
            scroll: "native-y",
            body: {
                type: "space",
                rows: [
                    filter,
                    {
                        rows: [nav_user, dataUser]
                    },
                    {
                        height: 20
                    },
                ],
            }
        };

        webix.ready(function() {
            webix.ui(ui);
            webix.ui({
                view: "window",
                id: "WIN_DATA_ADD",
                width: 410,
                height: 410,
                move: true,
                modal: true,
                position: "center",
                head: {
                    view: "toolbar",
                    margin: -5,
                    cols: [{
                            view: "label",
                            label: "<span class='webix_icon fa-plus-circle'></span>SIMPAN"
                        },
                        {
                            view: "icon",
                            icon: "times-circle",
                            click: "$$('WIN_DATA_ADD').hide();",
                            tooltip: "Close"
                        },
                        {
                            width: 10
                        },
                    ]
                },
                body: webix.copy(FORM_DATA_ADD),
                // on:{
                // 	onShow: function(id){
                // 		var id_subkeg = 1;
                // 		if (id_subkeg > 0){
                // 			$$('FORM_ADD').setValues({
                // 		       ADD_OPD:"tes",
                // 		       ADD_SUB_OPD: "tes2", 			       
                // 		    });			
                // 	    }else{
                // 			webix.alert({
                // 				type:"alert-error",
                // 				title: "INFORMATION",
                // 				text: "OPD TIDAK TERDAFTAR",
                // 				ok:"OK",
                // 				callback:function(){
                // 					$$('WIN_DATA21_ADD').hide();
                // 				}
                // 			});
                // 		}					

                // 	}
                // }
            });

            //edit

            webix.ui({
                view: "window",
                id: "WIN_DATA_EDIT",
                width: 410,
                height: 410,
                move: true,
                modal: true,
                position: "center",
                head: {
                    view: "toolbar",
                    margin: -5,
                    cols: [{
                            view: "label",
                            label: "<span class='webix_icon fa-edit'></span>UBAH PASSWORD"
                        },
                        {
                            view: "icon",
                            icon: "times-circle",
                            click: "$$('WIN_DATA_EDIT').hide();",
                            tooltip: "Close"
                        },
                        {
                            width: 10
                        },
                    ]
                },
                body: webix.copy(FORM_DATA_EDIT)

            });

            // DELETE
            webix.ui({
                view: "window",
                id: "WIN_DATA_DELETE",
                width: 410,
                height: 410,
                move: true,
                modal: true,
                position: "center",
                head: {
                    view: "toolbar",
                    margin: -5,
                    cols: [{
                            view: "label",
                            label: "<span class='webix_icon fa-trash-o'></span>DELETE"
                        },
                        {
                            view: "icon",
                            icon: "times-circle",
                            click: "$$('WIN_DATA_DELETE').hide();",
                            tooltip: "Close"
                        },
                        {
                            width: 10
                        },
                    ]
                },
                body: webix.copy(FORM_DATA_DELETE)
            });

            // $$("dt_user").load("data_user_edit.php");
            $$("dt_user").load("data_user_edit.php");
            $$('form_cek').bind('dt_user');
            $$('FORM_EDIT').bind('dt_user');
            // $$('FORM_DELETE').bind('dt_user');
        });

        var FORM_DATA_ADD = {
            view: "form",
            id: "FORM_ADD",
            borderless: true,
            // scroll:"xy",
            elementsConfig: {
                paddingY: 5,
                paddingX: 0,
            },
            elements: [
                // {view:"text", 			label:"ROW ID", 			id:"ADD_ROW_ID",  name:"TUJUAN_ROW_ID",	labelWidth:130,  disabled:true},
                {
                    view: "text",
                    label: "USERNAME",
                    id: "USER",
                    name: "user",
                    labelWidth: 130,
                    disabled: false
                },
                {
                    view: "text",
                    type: "password",
                    label: "PASSWORD",
                    // id: "PASSWORD",
                    name: "password",
                    labelWidth: 130,
                    disabled: false
                },
                {
                    view: "text",
                    label: "OPD",
                    // id: "DESKRIPSI",
                    name: "deskripsi",
                    labelWidth: 130,
                    disabled: false
                },
                {
                    view: "text",
                    label: "OPD ID",
                    // id: "opd_id",
                    name: "opd_id",
                    labelWidth: 130,
                    disabled: false
                },
                {
                    view: "text",
                    label: "SUB OPD ID",
                    // id: "sub_opd_id",
                    name: "sub_opd_id",
                    labelWidth: 130,
                    disabled: false
                },
                {
                    view: "textarea",
                    label: "HAK AKSES",
                    // id: "HAK_AKSES",
                    name: "hak_akses",
                    labelWidth: 130
                },
                {
                    margin: 5,
                    cols: [{
                            width: 126
                        },
                        {
                            view: "button",
                            label: "SIMPAN",
                            type: "form",
                            align: "center",
                            width: 100,
                            click: function() {
                                addData();
                            }
                        },
                        {
                            view: "button",
                            label: "CANCEL",
                            align: "center",
                            width: 100,
                            click: function() {
                                $$("WIN_DATA_ADD").hide();
                            }
                        },
                        {}
                    ]
                }
            ]
        };

        var FORM_DATA_EDIT = {
            view: "form",
            id: "FORM_EDIT",
            borderless: true,
            // scroll:"xy",
            elementsConfig: {
                paddingY: 5,
                paddingX: 0,
            },
            elements: [
                // {view:"text", 			label:"ROW ID", 			id:"ADD_ROW_ID",  name:"TUJUAN_ROW_ID",	labelWidth:130,  disabled:true},
                {
                    view: "text",
                    label: "PASSWORD",
                    id: "password1",
                    type: "password",
                    name: "password1",
                    labelWidth: 130
                },
                {
                    view: "text",
                    label: "ULANGI PASSWORD",
                    id: "password2",
                    type: "password",
                    name: "password2",
                    labelWidth: 130
                },
                {
                    margin: 5,
                    cols: [{
                            width: 126
                        },
                        {
                            view: "button",
                            label: "SIMPAN",
                            type: "form",
                            align: "center",
                            width: 100,
                            click: function() {
                                editData();
                            }
                        },
                        {
                            view: "button",
                            label: "CANCEL",
                            align: "center",
                            width: 100,
                            click: function() {
                                $$("WIN_DATA_EDIT").hide();
                            }
                        },
                        {}
                    ]
                }
            ]
        };

        var FORM_DATA_DELETE = {
            view: "form",
            id: "FORM_DELETE",
            borderless: true,
            // scroll:"xy",
            elementsConfig: {
                paddingY: 5,
                paddingX: 0,
            },
            elements: [
                // {view:"text", 			label:"ROW ID", 			id:"ADD_ROW_ID",  name:"TUJUAN_ROW_ID",	labelWidth:130,  disabled:true},
                {
                    view: "text",
                    label: "USERNAME",
                    id: "username",
                    name: "user",
                    labelWidth: 130,
                    disabled: true
                },
                {
                    view: "text",
                    label: "OPD",
                    id: "del_deskripsi",
                    name: "deskripsi",
                    labelWidth: 130,
                    disabled: true
                },
                {
                    view: "textarea",
                    label: "HAK AKSES",
                    id: "del_hak_akses",
                    name: "hak_akses",
                    labelWidth: 130,
                    disabled: true
                },
                {
                    margin: 5,
                    cols: [{
                            width: 126
                        },
                        {
                            view: "button",
                            label: "DELETE",
                            type: "form",
                            align: "center",
                            width: 100,
                            click: function() {
                                deleteData();
                            }
                        },
                        {
                            view: "button",
                            label: "CANCEL",
                            align: "center",
                            width: 100,
                            click: function() {
                                $$("WIN_DATA_DELETE").hide();
                            }
                        },
                        {}
                    ]
                }
            ]
        };


        function showWindow(winId, node) {
            $$(winId).getBody().clear();
            $$(winId).show(node);
            $$(winId).getBody().focus();
        }

        var temp_FORM_EDIT = {};

        function showEditData() {
            showWindow("WIN_DATA_EDIT");
            // console.log($$("FORM_EDIT").getValues());
            if ($$("FORM_EDIT").getValues().row_id > 0) {
                temp_FORM_EDIT = $$("FORM_EDIT").getValues();
            } else {
                $$("FORM_EDIT").setValues(temp_FORM_EDIT);
            }
        }

        function editData() {
            var param1 = $$('FORM_EDIT').getValues();
            // console.log(param1);

            console.log(param1)
            webix.ajax().post("crud_user.php?lvl=EDIT_USER&action=editPassword", {
                    param1: param1
                },
                function(text, data) {
                    console.log(data.json().status)
                    if (data.json().status == "success") {
                        webix.message({
                            type: "form",
                            text: "<div style='background-color:#24c066; color:#fff; margin:-6px -11px -6px -11px;'><span class='webix_icon fa-check-square-o'></span>Data Berhasil Diedit.</div>"
                        });
                        // console.log("add program");
                        // console.log(data.json().action);
                        // console.log(data.json().sqltes);
                        // var id_terakhir = $$('DT_PROG').getSelectedId().id;
                        $$("WIN_DATA_EDIT").hide();
                        $$("dt_user").clearAll();
                        $$("dt_user").refresh();
                        $$("dt_user").load("data_user_edit.php");
                    } else if (data.json().status == "bermasalah") {
                        window.top.location.href = "index.php";
                    } else {
                        webix.alert({
                            type: "alert-error",
                            title: "INFORMATION",
                            text: "password tidak sama, ulangi edit password!! " + data.json().status,
                            ok: "OK",
                            callback: function() {}
                        });
                    }
                });
        }


        function cekAkun() {
            var param1 = $$('form_cek').getValues();

            webix.ajax().post("cek_user_auth.php", {
                param1: param1
            }, function(text, data) {
                // console.log(param1)
                if (data.json().status == "valid") {
                    webix.message({
                        type: "form",
                        text: "<div style='background-color:#24c066; color:#fff; margin:-6px -11px -6px -11px;'><span class='webix_icon fa-check-square-o'></span>Password Valid.</div>"
                    });
                    // console.log("add program");
                    // console.log(data.json().action);
                    // console.log(data.json().sqltes);
                    // var id_terakhir = $$('DT_PROG').getSelectedId().id;
                } else if (data.json().status == "invalid") {
                    webix.alert({
                        type: "alert-error",
                        title: "INFORMATION",
                        text: "password tidak cocok!! " + data.json().status,
                        ok: "OK",
                        callback: function() {}
                    });
                } else {
                    webix.alert({
                        type: "alert-error",
                        title: "INFORMATION",
                        text: "data tidak valid " + data.json().status,
                        ok: "OK",
                        callback: function() {}
                    });
                }
            });
        }
    </script>

</body>

</html>