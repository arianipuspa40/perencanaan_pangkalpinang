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
        id: "form_user",
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
                label: "HAK AKSES",
                view: "textarea",
                id: "hak_akses",
                name: "hak_akses",
                disabled: true,
                width: 450,
                height: 70

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
          icon: "plus-circle",
          label: "TAMBAH",
          autowidth: true,
          click: "showAddData()"
        },
        {
          view: "button",
          type: "iconButton",
          icon: "edit",
          label: "EDIT",
          autowidth: true,
          click: "showEditData()"
        },
        {
          view: "button",
          type: "iconButton",
          icon: "trash-o",
          label: "DELETE",
          autowidth: true,
          click: "showDeleteData()"
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
          width: 590,
          fillspace: false
        },
        {
          header: "PEGAWAI ID",
          id: "pegawai_id",
          css: {
            'text-align': 'left'
          },
          width: 90,
          fillspace: false
        },
        {
          header: "JENIS AKUN",
          id: "jenis_akun",
          css: {
            'text-align': 'left'
          },
          width: 100,
          fillspace: false
        },
        {
          header: "OPD ID",
          id: "opd_id",
          css: {
            'text-align': 'left'
          },
          width: 100,
          fillspace: false
        },
        {
          header: "SUB OPD ID",
          id: "sub_opd_id",
          css: {
            'text-align': 'left'
          },
          width: 110,
          fillspace: false
        },
        {
          header: "BIDANG ID",
          id: "bidang_id",
          css: {
            'text-align': 'left'
          },
          width: 90,
          fillspace: false
        },
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
              label: "<span class='webix_icon fa-edit'></span>EDIT"
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
      $$('form_user').bind('dt_user');
      $$('FORM_EDIT').bind('dt_user');
      $$('FORM_DELETE').bind('dt_user');
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
          label: "USERNAME",
          id: "user",
          name: "user",
          labelWidth: 130
        },
        {
          view: "text",
          label: "OPD",
          id: "deskripsi",
          name: "deskripsi",
          labelWidth: 130
        },
        {
          view: "textarea",
          label: "HAK AKSES",
          id: "hak_akses",
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


    // tambah
    function addData() {
      var param1 = $$('FORM_ADD').getValues();
      // var xxxx = 1;
      // console.log(param1);

      webix.ajax().post("crud_user.php?lvl=EDIT_USER&action=add", {
        param1: param1
      }, function(text, data) {
        // console.log(param1);
        // if (data.json().status == "success") {
        if (data.json().status == "success") {
          webix.message({
            type: "form",
            text: "<div style='background-color:#24c066; color:#fff; margin:-6px -11px -6px -11px;'><span class='webix_icon fa-check-square-o'></span>Data Berhasil Ditambahkan.</div>"
          });
          // console.log(data.json());
          // console.log(data.json().sqltes);

          $$("WIN_DATA_ADD").hide();
          $$("dt_user").clearAll();
          $$("dt_user").refresh();
          $$("dt_user").load("data_user_edit.php");
          // getData();
          // var id_terakhir = $$('DT_PROG').getSelectedId().id;
        } else if (data.json().status == "bermasalah") {
          window.top.location.href = "index.php";
        } else {
          webix.alert({
            type: "alert-error",
            title: "INFORMATION",
            text: "Data Tidak Berhasil Ditambahkan!! " + data.json().status,
            ok: "OK",
            callback: function() {}
          });
        }
      });
    }

    // edit
    // var temp_FORM_PROGRAM_DELETE1 = {};
    // function deleteData1(){
    // 	showWindow("WIN_DATA1_DELETE");
    // 	if ($$("FORM_PROGRAM_DELETE1").getValues().ROW_ID > 0) {
    // 		temp_FORM_PROGRAM_DELETE1 = $$("FORM_PROGRAM_DELETE1").getValues();
    // 	} else{
    // 		$$("FORM_PROGRAM_DELETE1").setValues(temp_FORM_PROGRAM_DELETE1);
    // 	}
    // }

    // edit
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
      console.log(param1);

      webix.ajax().post("crud_user.php?lvl=EDIT_USER&action=edit", {
          param1: param1
        },
        function(text, data) {
          // console.log(data.json().status)
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
              text: "Data Tidak Berhasil Diedit!! " + data.json().status,
              ok: "OK",
              callback: function() {}
            });
          }
        });
    }

    // delete

    // function showDeleteData(){
    // 	showWindow("WIN_DATA_DELETE");
    // }

    var temp_FORM_DELETE = {};

    function showDeleteData() {
      showWindow("WIN_DATA_DELETE");
      // console.log($$("FORM_EDIT").getValues());
      if ($$("FORM_DELETE").getValues().row_id > 0) {
        temp_FORM_DELETE = $$("FORM_DELETE").getValues();
      } else {
        $$("FORM_DELETE").setValues(temp_FORM_DELETE);
      }
    }

    function deleteData() {
      var param1 = $$('FORM_DELETE').getValues();
      // console.log(param1);
      webix.ajax().post("crud_user.php?lvl=EDIT_USER&action=delete", {
        param1: param1
      }, function(text, data) {
        // console.log(data.json().status);
        if (data.json().status == "success") {
          webix.message({
            type: "form",
            text: "<div style='background-color:#24c066; color:#fff; margin:-6px -11px -6px -11px;'><span class='webix_icon fa-check-square-o'></span>Data Berhasil Dihapus.</div>"
          });
          // console.log("add program");
          // console.log(data.json().action);
          // console.log(data.json().sqltes);
          // var id_terakhir = $$('DT_PROG').getSelectedId().id;
          $$("WIN_DATA_DELETE").hide();
          $$("dt_user").clearAll();
          $$("dt_user").refresh();
          $$("dt_user").load("data_user_edit.php");
        } else if (data.json().status == "bermasalah") {
          window.top.location.href = "index.php";
        } else {
          webix.alert({
            type: "alert-error",
            title: "INFORMATION",
            text: "Data Tidak Berhasil Dihapus!! " + data.json().status,
            ok: "OK",
            callback: function() {}
          });
        }
      });
    }

    function valuesToForm(id) {
      var values = $$("dt_user").getItem(id);
      $$("form_user").setValues(values)
    };


    function showAddData() {
      showWindow("WIN_DATA_ADD");
    }
  </script>

</body>

</html>