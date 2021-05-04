<?php
session_start();
$temp_session             = array();

if (isset($_SESSION["USER_SETTING"]["LOGIN"])) {
  $temp_session["SESSION"]     = $_SESSION["USER_SETTING"];
} else {
  header("location:index.php");
}
?>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=8" />
  <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no">
  <link rel="icon" type="image/vnd.microsoft.icon" href="img/<?php echo $temp_session["SESSION"]["LOGO"]; ?>" />
  <link rel="shortcut icon" type="image/x-icon" href="img/<?php echo $temp_session["SESSION"]["LOGO"]; ?>" />
  <title><?= $temp_session["SESSION"]["NAMA_DAERAH"] ?></title>
  <link rel="stylesheet" href="fontawesome/css/all.css">
  <link rel="stylesheet" href="codebase/skins/compact.css" type="text/css" media="screen" charset="utf-8">
  <link rel="stylesheet" href="css/app.less" type="text/css" media="screen" charset="utf-8">
  <script src="codebase/webix.js" type="text/javascript" charset="utf-8"></script>
</head>

<body>
  <h2><?php echo $temp_session["SESSION"]["LOGO"]; ?></h2>
  <img src="img/<?php echo $temp_session["SESSION"]["LOGO"]; ?>" . alt="">
  <script type="text/javascript">
    var namaVariabelJavascript = <?php echo json_encode($temp_session); ?>;
    console.log(namaVariabelJavascript.SESSION["LOGO"]);

    var nav_tblAplikasi = {
      //type:"clean",
      view: "toolbar",
      css: "highlighted_header header",
      paddingX: 2,
      paddingY: 2,
      height: 35,
      cols: [{
          template: "<span class='webix_icon fa-table'></span>PROGRAM",
          css: "sub_title2",
          borderless: true
        },
        {
          view: "button",
          type: "iconButton",
          icon: "fas fa-sync",
          label: "REFRESH",
          autowidth: true,
          click: "refreshData()"
        },
        {
          view: "button",
          type: "iconButton",
          icon: "plus-circle",
          label: "TAMBAH",
          autowidth: true,
          click: "addData()"
        },
        {
          view: "button",
          type: "iconButton",
          icon: "trash-o",
          label: "DELETE",
          autowidth: true,
          click: "deleteData1()"
        },
      ]
    };
    var tabelAplikasi = {
      view: "datatable",
      id: "dt_aplikasi",
      resizeColumn: true,
      navigation: true,
      select: true,
      css: "datatable_column",
      columns: [{
          header: "id",
          id: "row_id",
          // hidden: tru
        },
        {
          header: "aktif",
          id: "is_active",
          width: 50
        },
        {
          header: "nama kota",
          id: "nama_kota",
          width: 450,
          css: {
            'text-align': 'left'
          }
        },
        {
          header: "img_login",
          id: "img_login",
          width: 300
        },
        {
          header: "gambar kecil",
          id: "img_toolbar",
          width: 300,
          css: {
            'text-align': 'right'
          }
        },
      ],
      on: {
        onAfterSelect: function(id) {
          var values = $$("dt_aplikasi").getItem(id);
          $$("setting_app_form").setValues(values);
          $$("IS_ACTIVE").setValue(values.is_active);
          // $$('setting_app_form').bind('dt_aplikasi');

        }
      }
    }
    var filter = {
      rows: [{
        view: "form",
        id: "setting_app_form",
        borderless: true,
        elementsConfig: {
          paddingY: 0,
          paddingX: 0
        },
        elements: [
          // {
          //     cols: [{
          //             view: "label",
          //             label: "Jenis Daerah",
          //             labelWidth: 140,
          //             width: 170,
          //         },
          //         {
          //             view: "text",
          //             width: 450
          //         }, {},
          //     ],
          // },
          {
            cols: [{
                view: "label",
                label: "Nama Daerah",
                labelWidth: 140,
                width: 170,
              },
              {
                view: "text",
                name: "nama_kota",
                width: 450
              }, {},
            ],
          },
          {
            cols: [{
                view: "label",
                label: "Foto kecil",
                labelWidth: 140,
                width: 170,
              },
              {
                view: "text",
                name: "img_login",
                width: 450
              }, {},
            ],
          },

          {
            cols: [{
                view: "label",
                label: "is Active",
                width: 170,
              },
              {
                view: "checkbox",
                id: "IS_ACTIVE",
                name: "is_active",
                labelWidth: 70
              },
            ]
          },
          {
            cols: [{
                view: "label",
                label: "Foto Besar",
                labelWidth: 140,
                width: 170,
              },
              {
                view: "text",
                name: "img_toolbar",
                width: 450
              },

              {
                cols: [{
                  view: "button",
                  id: "my_button",
                  value: "simpan",
                  css: "webix_primary",
                  inputWidth: 100,
                  click: "editDataSet()"

                }],
              }

            ],
          },

        ]
      }]
    };

    var FORM_DATA1_ADD = {
      view: "form",
      borderless: true,
      id: "FORM_PROGRAM_ADD1",
      // scroll:"xy",
      elementsConfig: {
        paddingY: 5,
        paddingX: 0,
      },
      elements: [

        {
          view: "text",
          label: "NAMA DAERAH",
          id: "ADD_DAERAH",
          name: "ADD_DAERAH",
          labelWidth: 180,
        },
        {
          cols: [{
            view: "label",
            label: "Nama Daerah",
            width: 180,
          }, {
            container: "uploader_container",
            view: "form",
            rows: [{
                view: "uploader",
                id: "upl1",
                autosend: false,
                value: 'Upload file',
                link: "mylist",
                upload: "upload.php"
              },
              {
                view: "list",
                id: "mylist",
                type: "uploader",
                autoheight: true,
                borderless: true
              },
              {
                view: "button",
                label: "Save files",
                click: function() {
                  $$("upl1").send(function(response) {
                    if (response)
                      webix.message(response.status);
                  });
                }
              }
            ]
          }]

        },
        {
          margin: 5,
          cols: [{
              width: 126
            },
            {
              view: "button",
              label: "Simpan",
              type: "form",
              align: "center",
              width: 100,
              click: function() {
                $$("uploader1").send(function(response) {
                  if (response)
                    webix.message(response.status);
                });

                dataAddDaerah();
                // $$("WIN_DATA1_ADD").hide();
              }
            },
            {
              view: "button",
              label: "Cancel",
              align: "center",
              width: 100,
              click: function() {
                $$("WIN_DATA1_ADD").hide();
              }
            },
            {}
          ]
        }
      ]
    };
    var ui = {
      rows: [{
          type: "clean",
          view: "toolbar",
          id: "TOOLBAR_TOP",
          elements: [{
            view: "label",
            template: "<span class='webix_icon fa-home' style='margin-left:6px;'></span> PERENCANAAN &nbsp;" +
              "<span class='webix_icon fa-angle-double-right'></span>SETTING &nbsp;" +
              "<span class='webix_icon fa-angle-double-right'></span>SETTING APLIKASI"
          }, ],
        },
        {
          type: "space",
          view: "scrollview",
          scroll: "y",
          body: {
            type: "space",
            rows: [
              filter,
              {
                rows: [nav_tblAplikasi, tabelAplikasi]
              }, {
                height: 20
              },
            ]
          }
        }
      ]
    };

    webix.ready(function() {
      webix.ui(ui);
      $$("dt_aplikasi").load("setting_aplikasi_data.php");

      // add kota(profiel aplikasi)
      webix.ui({
        view: "window",
        id: "WIN_DATA1_ADD",
        width: 500, //height:410,
        move: true,
        modal: true,
        position: "center",
        head: {
          view: "toolbar",
          margin: -5,
          cols: [{
              view: "label",
              label: "<span class='webix_icon fa-plus-circle'></span>TAMBAH"
            },
            {
              view: "icon",
              icon: "times-circle",
              click: "$$('WIN_DATA1_ADD').hide();",
              tooltip: "Close"
            },
            {
              width: 10
            },
          ]
        },
        body: webix.copy(FORM_DATA1_ADD),
        // tambah data program
        // on: {
        // }
      });

    });

    function showWindow(winId, node) {
      $$(winId).getBody().clear();
      $$(winId).show(node);
      $$(winId).getBody().focus();
    }

    function editDataSet() {
      var param1 = $$('setting_app_form').getValues();

      webix.ajax().post("crud_setting_aplikasi.php", {
          param1: param1
        },

        function(text, data) {
          console.log(param1)
          console.log(data.json().status);
          refreshData();

          if (data.json().status == "success") {
            webix.message({
              type: "form",
              text: "<div style='background-color:#24c066; color:#fff; margin:-6px -11px -6px -11px;'><span class='webix_icon fa-check-square-o'></span>Data Berhasil Ditambahkan.</div>"
            });
          } else {
            webix.alert({
              type: "alert-error",
              title: "INFORMATION",
              text: "akses tidak di izinkan !!",
              ok: "OK",
              callback: function() {
                // $$("WIN_DATA11_ADD").hide();
              }
            });
          }
        });
    }

    function addData() {
      showWindow("WIN_DATA1_ADD");
    }

    function dataAddDaerah() {
      // proses tambah program
      // console.log($$('FORM_PROGRAM_ADD1').getValues());

      var param1 = $$('FORM_PROGRAM_ADD1').getValues();
      // console.log(param1)
      // webix.ajax().post("perencanaan_renstra_entri_murni_data_crud_program.php?lvl=program&action=add", {
      webix.ajax().post("perencanaan_renstra_entri_murni_data_crud_program.php?lvl=program&action=add&lane=renstra", {
        param1: param1
      }, function(text, data) {

        // console.log(data.json().status2);
        if (data.json().status == "success") {
          webix.message({
            type: "form",
            text: "<div style='background-color:#24c066; color:#fff; margin:-6px -11px -6px -11px;'><span class='webix_icon fa-check-square-o'></span>Data Berhasil Ditambahkan.</div>"
          });
          // console.log("add program");
          // console.log(data.json().action);
          // console.log(data.json().sqltes);
          $$("WIN_DATA1_ADD").hide();
          getData();
        } else if (data.json().status == "bermasalah") {
          window.top.location.href = "index.php";
        } else {
          webix.alert({
            type: "alert-error",
            title: "INFORMATION",
            text: "Data Tidak Berhasil Ditambahkan !! " + data.json().status,
            ok: "OK",
            callback: function() {}
          });
        }
      });
    }

    function refreshData() {
      $$("dt_aplikasi").clearAll();
      $$("dt_aplikasi").load("setting_aplikasi_data.php");
    }
  </script>

</body>

</html>