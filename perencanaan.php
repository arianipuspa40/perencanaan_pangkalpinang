<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=8" />
  <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no">
  <link rel="icon" type="image/vnd.microsoft.icon" href="img/logo_36.png" />
  <link rel="shortcut icon" type="image/x-icon" href="img/logo_36.png" />
  <title>:: PERENCANAAN - KOTA PANGKALPINANG ::</title>
  <link rel="stylesheet" href="codebase/skins/compact.css" type="text/css" media="screen" charset="utf-8">
  <script src="codebase/webix.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript" src="libs/sidebar/sidebar.js"></script>
  <link rel="stylesheet" type="text/css" href="libs/sidebar/sidebar.css">
</head>

<?php
session_start();
$temp_session             = array();

if (isset($_SESSION["USER_SETTING"]["LOGIN"])) {
  $temp_session["SESSION"]     = $_SESSION["USER_SETTING"];
} else {
  header("location:index.php");
}
?>

<body>

  <script type="text/javascript">
    //TES PARSING PARAMATER PHP TO JAVASCRIPT

    var namaVariabelJavascript = <?php echo json_encode($temp_session); ?>;
    var FORM_KERTAS_OPTION = [{
        view: "select",
        label: "Version",
        options: ["1.0", "1.5", "2.0"]
      },
      {
        view: "select",
        value: 2,
        label: "Branch",
        options: [{
            value: "Master",
            id: 1
          },
          {
            value: "Release",
            id: 2
          }
        ]
      },
      {
        view: "button",
        value: "Confirm",
        align: "center",
        width: 200
      }
    ];
    // console.log(namaVariabelJavascript.SESSION);
    // window.location.reload();
    // if (namaVariabelJavascript.SESSION2.STATUS=="MBAH_DARMO"){		

    // }else{
    // 	location.href = "index.php";
    // }
    //AKHIR TES PARSING PARAMATER PHP TO JAVASCRIPT

    // var menu_data = [
    // 	{id:"DASHBOARD", icon:"home", value:"DASHBOARD"},
    // 	{id:"RPJMD", icon:"book", value:"RPJMD"},
    // 	{id:"RENSTRA", icon:"book", value:"RENSTRA", data:[
    // 		{id:"ENTRI", value:"ENTRI"},
    // 		{id:"PERSETUJUAN_KABID_RENSTRA", value:"VERIFIKASI KABID"},
    // 		{id:"PERSETUJUAN_SEKRETARIS_(KASUBAG_PROGRAM)_RENSTRA", value:"VERIFIKASI SEKRETARIS (KASUBAG PROGRAM)"},
    // 		{id:"PERSETUJUAN_BIDANG_TEKNIS_(BAPPEDA)_RENSTRA", value:"VERIFIKASI BIDANG TEKNIS (BAPPEDA)"},
    // 		{id:"BIDANG_PERENCANAAN_(BAPPEDA)_RENSTRA", value:"BIDANG PERENCANAAN (BAPPEDA)"},
    // 		{id:"CREATE_DATA_RENJA", value:"CREATE DATA RENJA"},
    // 	]},		
    // 	{id:"RKPD", icon:"book", value:"RKPD"},
    // 	{id:"RENJA", icon:"book", value:"RENJA", data:[
    // 		{id:"EDIT_DATA_RENJA", value:"EDIT DATA RENJA"},
    // 		{id:"PERSETUJUAN_KABID_RENJA", value:"VERIFIKASI KABID"},
    // 		{id:"PERSETUJUAN_SEKRETARIS_(KASUBAG_PROGRAM)_RENJA", value:"VERIFIKASI SEKRETARIS (KASUBAG PROGRAM)"},
    // 		{id:"PERSETUJUAN_BIDANG_TEKNIS_(BAPPEDA)_RENJA", value:"VERIFIKASI BIDANG TEKNIS (BAPPEDA)"},
    // 		{id:"BIDANG_PERENCANAAN_(BAPPEDA)_RENJA", value:"BIDANG PERENCANAAN (BAPPEDA)"},
    // 		{id:"CREATE_DATA_DPA", value:"CREATE DATA DPA"},
    // 	]},
    // 	{id:"DPA", icon:"book", value:"DPA", data:[
    // 		{id:"EDIT_DATA_DPA", value:"EDIT DATA DPA"},
    // 		{id:"PERSETUJUAN_KABID_DPA", value:"VERIFIKASI KABID"},
    // 		{id:"PERSETUJUAN_SEKRETARIS_(KASUBAG_PROGRAM)_DPA", value:"VERIFIKASI SEKRETARIS (KASUBAG PROGRAM)"},
    // 		{id:"PERSETUJUAN_BIDANG_TEKNIS_(BAPPEDA)_DPA", value:"VERIFIKASI BIDANG TEKNIS (BAPPEDA)"},
    // 		{id:"BIDANG_PERENCANAAN_(BAPPEDA)_DPA", value:"BIDANG PERENCANAAN (BAPPEDA)"},
    // 		{id:"CREATE_APBD_PERUBAHAN", value:"CREATE DATA AWAL RENJA PERUBAHAN"},
    // 	]},
    // 	{id:"LAPORAN", icon:"book", value:"LAPORAN", data:[
    // 		{id:"LAPORAN_RPJMD_1", value:"LAPORAN RPJMD (PMDN 13)"},
    // 		{id:"LAPORAN_RPJMD_2", value:"LAPORAN RPJMD (PMDN 90)"},
    // 		{id:"LAPORAN_RENSTRA_1", value:"LAPORAN RENSTRA (PMDN 13)"},
    // 		{id:"LAPORAN_RENSTRA_2", value:"LAPORAN RENSTRA (PMDN 90)"},
    // 	]},
    // 	{id:"SETTING", icon:"cog", value:"SETTING", data:[
    // 		{id:"DATA_USER", value:"DATA USER"},
    // 		{id:"DATA_PEGAWAI", value:"DATA PEGAWAI"},
    // 		{id:"URUSAN_PROGRAM_KEGIATAN", value:"DATA URUSAN, PROGRAM, KEGIATAN, SUB KEG"},
    // 		{id:"DATA_OPD_BIDANG", value:"DATA OPD DAN BIDANG OPD"},
    // 		{id:"SETTING_APLIKASI", value:"SETTING APLIKASI"},
    // 	]},
    // 	{id:"LOGOUT", icon:"power-off", value:"LOGOUT"}
    // ];

    // awal hak akses

    var default_menu_utama = ["DASHBOARD", "RPJMD", "RENSTRA", "RKPD", "RENJA", "DPA", "LAPORAN", "SETTING", "LOGOUT"];
    var default_menu_rpjmd = ["RPJMD_READ", "RPJMD_EDIT"];
    var default_menu_renstra = ["RENSTRA_TUJUAN_SASARAN", "RENSTRA_ENTRI", "PERSETUJUAN_KABID_RENSTRA", "PERSETUJUAN_SEKRETARIS_RENSTRA", "PERSETUJUAN_BIDANG_TEKNIS_RENSTRA", "BIDANG_PERENCANAAN_RENSTRA", "CREATE_DATA_RENJA", ];
    var default_menu_renja = ["EDIT_DATA_RENJA", "PERSETUJUAN_KABID_RENJA", "PERSETUJUAN_SEKRETARIS_RENJA", "PERSETUJUAN_BIDANG_TEKNIS_RENJA", "BIDANG_PERENCANAAN_RENJA", "CREATE_DATA_DPA", ];
    var default_menu_dpa = ["EDIT_DATA_DPA", "PERSETUJUAN_KABID_DPA", "PERSETUJUAN_SEKRETARIS_DPA", "PERSETUJUAN_BIDANG_TEKNIS_DPA", "BIDANG_PERENCANAAN_DPA", "CREATE_APBD_PERUBAHAN"];
    var default_menu_laporan = ["LAPORAN_RPJMD_1", "LAPORAN_RPJMD_2", "LAPORAN_RPJMD_3", "LAPORAN_RPJMD_4", "LAPORAN_RENSTRA_1", "LAPORAN_RENSTRA_2"];
    var default_menu_setting = ["DATA_USER", "DATA_PEGAWAI", "URUSAN_PROGRAM_KEGIATAN", "DATA_OPD_BIDANG", "SETTING_APLIKASI"];



    // catatan untuk daftar menu tidak boleh ada spasi
    var admin_menu = "DASHBOARD,RPJMD,RENSTRA,RENSTRA_ENTRI,PERSETUJUAN_KABID_RENSTRA,PERSETUJUAN_SEKRETARIS_RENSTRA,PERSETUJUAN_BIDANG_TEKNIS_RENSTRA,BIDANG_PERENCANAAN_RENSTRA,CREATE_DATA_RENJA,RKPD,RENJA,EDIT_DATA_RENJA,PERSETUJUAN_KABID_RENJA,PERSETUJUAN_SEKRETARIS_RENJA,PERSETUJUAN_BIDANG_TEKNIS_RENJA,BIDANG_PERENCANAAN_RENJA,CREATE_DATA_DPA,DPA,EDIT_DATA_DPA,PERSETUJUAN_KABID_DPA,PERSETUJUAN_SEKRETARIS_DPA,PERSETUJUAN_BIDANG_TEKNIS_DPA,BIDANG_PERENCANAAN_DPA,CREATE_APBD_PERUBAHAN,LAPORAN,LAPORAN_RPJMD_1,LAPORAN_RPJMD_2,LAPORAN_RPJMD_3,LAPORAN_RPJMD_4,LAPORAN_RENSTRA_1,LAPORAN_RENSTRA_2,SETTING,DATA_USER,DATA_PEGAWAI,URUSAN_PROGRAM_KEGIATAN,DATA_OPD_BIDANG, SETTING_APLIKASI,LOGOUT";

    var daftar_menu = "DASHBOARD";

    daftar_menu = namaVariabelJavascript.SESSION["HAK_AKSES"];

    // console.log ()
    var buff_menu = daftar_menu.split(",");
    var array_menu = [];
    buff_menu.forEach(function(x6, i) {
      x6 = x6.trim().toUpperCase();
      array_menu[x6] = 1;
    });

    // console.log(array_menu)
    var menu_user = [];
    var no_urut_menu = 0;
    var no = 0;
    var subMenu = [];
    default_menu_utama.forEach(function(menu_u) {
      if (array_menu[menu_u] == 1) {
        switch (menu_u) {
          case "DASHBOARD":
            menu_user[no_urut_menu] = {
              id: "DASHBOARD",
              icon: "home",
              value: "DASHBOARD"
            };
            no_urut_menu++;
            break;
          case "RPJMD":
            no = 0;
            subMenu = [];
            default_menu_rpjmd.forEach(function(rpjmd_edit) {
              if (array_menu[rpjmd_edit] == 1) {
                // console.log(rpjmd_edit)
                switch (rpjmd_edit) {
                  case "RPJMD_READ":
                    subMenu[no] = {
                      id: "RPJMD_READ",
                      value: "RPJMD READ"
                    };
                    no++;
                    break;
                  case "RPJMD_EDIT":
                    subMenu[no] = {
                      id: "RPJMD_EDIT",
                      value: "RPJMD EDIT"
                    };
                    no++;
                    break;
                }
              }
            });
            menu_user[no_urut_menu] = {
              id: "RPJMD",
              icon: "book",
              value: "RPJMD",
              data: subMenu
            };
            no_urut_menu++;
            break;
          case "RENSTRA":
            no = 0;
            subMenu = [];
            default_menu_renstra.forEach(function(menu_renstra) {
              if (array_menu[menu_renstra] == 1) {
                // console.log(menu_renstra)
                switch (menu_renstra) {
                  case "RENSTRA_TUJUAN_SASARAN":
                    subMenu[no] = {
                      id: "RENSTRA_TUJUAN_SASARAN",
                      value: "ENTRI TUJUAN SASARAN"
                    };
                    no++;
                    break;
                  case "RENSTRA_ENTRI":
                    subMenu[no] = {
                      id: "RENSTRA_ENTRI",
                      value: "ENTRI RENSTRA"
                    };
                    no++;
                    break;
                  case "PERSETUJUAN_KABID_RENSTRA":
                    subMenu[no] = {
                      id: "PERSETUJUAN_KABID_RENSTRA",
                      value: "VERIFIKASI KABID"
                    };
                    no++;
                    break;
                  case "PERSETUJUAN_SEKRETARIS_RENSTRA":
                    subMenu[no] = {
                      id: "PERSETUJUAN_SEKRETARIS_RENSTRA",
                      value: "VERIFIKASI SEKRETARIS (KASUBAG PROGRAM)"
                    };
                    no++;
                    break;
                  case "PERSETUJUAN_BIDANG_TEKNIS_RENSTRA":
                    subMenu[no] = {
                      id: "PERSETUJUAN_BIDANG_TEKNIS_RENSTRA",
                      value: "VERIFIKASI BIDANG TEKNIS (BAPPEDA)"
                    };
                    no++;
                    break;
                  case "BIDANG_PERENCANAAN_RENSTRA":
                    subMenu[no] = {
                      id: "BIDANG_PERENCANAAN_RENSTRA",
                      value: "BIDANG PERENCANAAN (BAPPEDA)"
                    };
                    no++;
                    break;
                  case "CREATE_DATA_RENJA":
                    subMenu[no] = {
                      id: "CREATE_DATA_RENJA",
                      value: "CREATE DATA RENJA"
                    };
                    no++;
                    break;
                }
              }
            });
            menu_user[no_urut_menu] = {
              id: "RENSTRA",
              icon: "book",
              value: "RENSTRA",
              data: subMenu
            };
            no_urut_menu++;
            break;
          case "RKPD":
            menu_user[no_urut_menu] = {
              id: "RKPD",
              icon: "book",
              value: "RKPD"
            };
            no_urut_menu++;
            break;
          case "RENJA":
            no = 0;
            subMenu = [];
            default_menu_renja.forEach(function(buff) {
              if (array_menu[buff] == 1) {
                switch (buff) {
                  case "EDIT_DATA_RENJA":
                    subMenu[no] = {
                      id: "EDIT_DATA_RENJA",
                      value: "EDIT DATA RENJA"
                    };
                    no++;
                    break;
                  case "PERSETUJUAN_KABID_RENJA":
                    subMenu[no] = {
                      id: "PERSETUJUAN_KABID_RENJA",
                      value: "VERIFIKASI KABID"
                    };
                    no++;
                    break;
                  case "PERSETUJUAN_SEKRETARIS_RENJA":
                    subMenu[no] = {
                      id: "PERSETUJUAN_SEKRETARIS_RENJA",
                      value: "VERIFIKASI SEKRETARIS (KASUBAG PROGRAM)"
                    };
                    no++;
                    break;
                  case "PERSETUJUAN_BIDANG_TEKNIS_RENJA":
                    subMenu[no] = {
                      id: "PERSETUJUAN_BIDANG_TEKNIS_RENJA",
                      value: "VERIFIKASI BIDANG TEKNIS (BAPPEDA)"
                    };
                    no++;
                    break;
                  case "BIDANG_PERENCANAAN_RENJA":
                    subMenu[no] = {
                      id: "BIDANG_PERENCANAAN_RENJA",
                      value: "BIDANG PERENCANAAN (BAPPEDA)"
                    };
                    no++;
                    break;
                  case "CREATE_DATA_DPA":
                    subMenu[no] = {
                      id: "CREATE_DATA_DPA",
                      value: "CREATE DATA DPA"
                    };
                    no++;
                    break;
                }
              }
            });
            menu_user[no_urut_menu] = {
              id: "RENJA",
              icon: "book",
              value: "RENJA",
              data: subMenu
            };
            no_urut_menu++;
            break;
          case "DPA":
            no = 0;
            subMenu = [];
            default_menu_dpa.forEach(function(buff) {
              if (array_menu[buff] == 1) {
                switch (buff) {
                  case "EDIT_DATA_DPA":
                    subMenu[no] = {
                      id: "EDIT_DATA_DPA",
                      value: "EDIT DATA DPA"
                    };
                    no++;
                    break;
                  case "PERSETUJUAN_KABID_DPA":
                    subMenu[no] = {
                      id: "PERSETUJUAN_KABID_DPA",
                      value: "VERIFIKASI KABID"
                    };
                    no++;
                    break;
                  case "PERSETUJUAN_SEKRETARIS_DPA":
                    subMenu[no] = {
                      id: "PERSETUJUAN_SEKRETARIS_DPA",
                      value: "VERIFIKASI SEKRETARIS (KASUBAG PROGRAM)"
                    };
                    no++;
                    break;
                  case "PERSETUJUAN_BIDANG_TEKNIS_DPA":
                    subMenu[no] = {
                      id: "PERSETUJUAN_BIDANG_TEKNIS_DPA",
                      value: "VERIFIKASI BIDANG TEKNIS (BAPPEDA)"
                    };
                    no++;
                    break;
                  case "BIDANG_PERENCANAAN_DPA":
                    subMenu[no] = {
                      id: "BIDANG_PERENCANAAN_DPA",
                      value: "BIDANG PERENCANAAN (BAPPEDA)"
                    };
                    no++;
                    break;
                  case "CREATE_APBD_PERUBAHAN":
                    subMenu[no] = {
                      id: "CREATE_APBD_PERUBAHAN",
                      value: "CREATE DATA AWAL RENJA PERUBAHAN"
                    };
                    no++;
                    break;
                }
              }
            });
            menu_user[no_urut_menu] = {
              id: "DPA",
              icon: "book",
              value: "DPA",
              data: subMenu
            };
            no_urut_menu++;
            break;
          case "LAPORAN":
            no = 0;
            subMenu = [];
            default_menu_laporan.forEach(function(buff) {
              if (array_menu[buff] == 1) {
                switch (buff) {
                  case "LAPORAN_RPJMD_1":
                    subMenu[no] = {
                      id: "LAPORAN_RPJMD_1",
                      value: "LAPORAN RPJMD (Diurutkan Berdasarkan Urusan)"
                    };
                    no++;
                    break;
                  case "LAPORAN_RPJMD_2":
                    subMenu[no] = {
                      id: "LAPORAN_RPJMD_2",
                      value: "LAPORAN RPJMD (Diurutkan Berdasarkan OPD)"
                    };
                    no++;
                    break;
                  case "LAPORAN_RPJMD_3":
                    subMenu[no] = {
                      id: "LAPORAN_RPJMD_3",
                      value: "LAPORAN OPD"
                    };
                    no++;
                    break;
                  case "LAPORAN_RPJMD_4":
                    subMenu[no] = {
                      id: "LAPORAN_RPJMD_4",
                      value: "LAPORAN OPD (Menampilkan Urusan)"
                    };
                    no++;
                    break;
                  case "LAPORAN_RENSTRA_1":
                    subMenu[no] = {
                      id: "LAPORAN_RENSTRA_1",
                      value: "LAPORAN RENSTRA (Dengan Tanggal)"
                    };
                    no++;
                    break;
                  case "LAPORAN_RENSTRA_2":
                    subMenu[no] = {
                      id: "LAPORAN_RENSTRA_2",
                      value: "LAPORAN RENSTRA (Tanpa Tanggal)"
                    };
                    no++;
                    break;
                }
              }
            });
            menu_user[no_urut_menu] = {
              id: "LAPORAN",
              icon: "book",
              value: "LAPORAN",
              data: subMenu
            };
            no_urut_menu++;
            break;
          case "SETTING":
            no = 0;
            subMenu = [];
            default_menu_setting.forEach(function(buff) {
              if (array_menu[buff] == 1) {
                switch (buff) {
                  case "DATA_USER":
                    subMenu[no] = {
                      id: "DATA_USER",
                      value: "DATA USER"
                    };
                    no++;
                    break;
                  case "DATA_PEGAWAI":
                    subMenu[no] = {
                      id: "DATA_PEGAWAI",
                      value: "DATA PEGAWAI"
                    };
                    no++;
                    break;
                  case "URUSAN_PROGRAM_KEGIATAN":
                    subMenu[no] = {
                      id: "URUSAN_PROGRAM_KEGIATAN",
                      value: "DATA URUSAN, PROGRAM, KEGIATAN, SUB KEG"
                    };
                    no++;
                    break;
                  case "DATA_OPD_BIDANG":
                    subMenu[no] = {
                      id: "DATA_OPD_BIDANG",
                      value: "DATA OPD DAN BIDANG OPD"
                    };
                    no++;
                    break;
                  case "SETTING_APLIKASI":
                    subMenu[no] = {
                      id: "SETTING_APLIKASI",
                      value: "SETTING APLIKASI"
                    };
                    no++;
                    break;
                }
              }
            });
            menu_user[no_urut_menu] = {
              id: "SETTING",
              icon: "cog",
              value: "SETTING",
              data: subMenu
            };
            no_urut_menu++;
            break;
          case "LOGOUT":
            menu_user[no_urut_menu] = {
              id: "LOGOUT",
              icon: "power-off",
              value: "LOGOUT"
            };
            no_urut_menu++;
            break;
        }

      } else {
        // console.log("kosong "+array_menu[menu_u]+"  "+menu_u);			
      }
    });

    // console.log(menu_user);
    // akhir hak akses

    webix.ready(function() {

      webix.ui({
        rows: [{
            view: "toolbar",
            padding: 3,
            height: 50,
            elements: [{
                view: "button",
                type: "icon",
                icon: "bars",
                width: 40,
                align: "left",
                css: "app_button",
                click: function() {
                  //$$("$sidebar1").toggle()
                  if ($$("$sidebar1").isVisible()) {
                    $$("$sidebar1").hide();
                  } else {
                    $$("$sidebar1").show();
                  }
                }
              },
              {
                view: "label",
                label: "<img class='photo' src='img/logo_36.png' />",
                // autowidth: true,
                width: 50
              },
              {
                view: "label",
                label: "PERENCANAAN - KOTA PANGKALPINANG",
                width: 500
              },
              {
                autowidth: true
              },
              {
                view: "button",
                type: "icon",
                autowidth: true,
                css: "app_button",
                icon: "user",
                label: "USER &nbsp;",
                click: "editUserAction()"
              },
              {
                view: "button",
                type: "icon",
                autowidth: true,
                css: "app_button",
                icon: "sign-out",
                label: "LOGOUT &nbsp;",
                click: "logoutAction()"
              },
            ]
          },
          {
            cols: [{
                view: "sidebar",
                data: menu_user,
                // data:menu_data,
                on: {
                  onAfterSelect: function(id) {
                    //webix.message("Selected:"+this.getItem(id).value)
                    // window.location.href ="perencanaan_login.php";

                    if (id == "DASHBOARD") {
                      $$("IFRAME_CONTENT").load("perencanaan_dashboard.php");
                    } else if (id == "RPJMD_READ") {
                      $$("IFRAME_CONTENT").load("perencanaan_rpjmd.php");
                    } else if (id == "RPJMD_EDIT") {
                      $$("IFRAME_CONTENT").load("perencanaan_rpjmd_edit.php");


                    } else if (id == "RENSTRA_TUJUAN_SASARAN") {
                      $$("IFRAME_CONTENT").load("perencanaan_tujuan_sasaran_opd.php");
                    } else if (id == "RENSTRA_ENTRI") {
                      $$("IFRAME_CONTENT").load("perencanaan_renstra_entri.php");
                    } else if (id == "PERSETUJUAN_KABID_RENSTRA") {
                      $$("IFRAME_CONTENT").load("perencanaan_renstra_kabid.php");
                    } else if (id == "PERSETUJUAN_SEKRETARIS_RENSTRA") {
                      $$("IFRAME_CONTENT").load("perencanaan_renstra_sekretaris.php");
                    } else if (id == "PERSETUJUAN_BIDANG_TEKNIS_RENSTRA") {
                      $$("IFRAME_CONTENT").load("perencanaan_renstra_bidang_teknis.php");
                    } else if (id == "BIDANG_PERENCANAAN_RENSTRA") {
                      $$("IFRAME_CONTENT").load("perencanaan_renstra_bidang_perencanaan.php");
                    } else if (id == "CREATE_DATA_RENJA") {
                      $$("IFRAME_CONTENT").load("perencanaan_renstra_create_renja.php");

                    } else if (id == "RKPD") {
                      $$("IFRAME_CONTENT").load("perencanaan_rkpd.php");

                    } else if (id == "EDIT_DATA_RENJA") {
                      $$("IFRAME_CONTENT").load("perencanaan_renja_edit_renja.php");
                    } else if (id == "PERSETUJUAN_KABID_RENJA") {
                      $$("IFRAME_CONTENT").load("perencanaan_renja_kabid.php");
                    } else if (id == "PERSETUJUAN_SEKRETARIS_RENJA") {
                      $$("IFRAME_CONTENT").load("perencanaan_renja_sekretaris.php");
                    } else if (id == "PERSETUJUAN_BIDANG_TEKNIS_RENJA") {
                      $$("IFRAME_CONTENT").load("perencanaan_renja_bidang_teknis.php");
                    } else if (id == "BIDANG_PERENCANAAN_RENJA") {
                      $$("IFRAME_CONTENT").load("perencanaan_renja_bidang_perencanaan.php");
                    } else if (id == "CREATE_DATA_DPA") {
                      $$("IFRAME_CONTENT").load("perencanaan_renja_create_dpa.php");

                    } else if (id == "EDIT_DATA_DPA") {
                      $$("IFRAME_CONTENT").load("perencanaan_dpa_edit_dpa.php");
                    } else if (id == "PERSETUJUAN_KABID_DPA") {
                      $$("IFRAME_CONTENT").load("perencanaan_dpa_kabid.php");
                    } else if (id == "PERSETUJUAN_SEKRETARIS_DPA") {
                      $$("IFRAME_CONTENT").load("perencanaan_dpa_sekretaris.php");
                    } else if (id == "PERSETUJUAN_BIDANG_TEKNIS_DPA") {
                      $$("IFRAME_CONTENT").load("perencanaan_dpa_bidang_teknis.php");
                    } else if (id == "BIDANG_PERENCANAAN_DPA") {
                      $$("IFRAME_CONTENT").load("perencanaan_dpa_bidang_perencanaan.php");
                    } else if (id == "CREATE_APBD_PERUBAHAN") {
                      $$("IFRAME_CONTENT").load("perencanaan_dpa_create_apbd_perubahan.php");

                    } else if (id == "LAPORAN_RPJMD_1") {
                      $$("IFRAME_CONTENT").load("output_eval_renja1.php");
                    } else if (id == "LAPORAN_RPJMD_2") {
                      $$("IFRAME_CONTENT").load("output_eval_renja_opd.php");
                    } else if (id == "LAPORAN_RPJMD_3") {
                      $$("IFRAME_CONTENT").load("output_rpjmd_opd.php");

                      // $$("IFRAME_CONTENT").load("testEvent.php");
                    } else if (id == "LAPORAN_RPJMD_4") {
                      $$("IFRAME_CONTENT").load("output_rpjmd_opd_urs.php");
                    } else if (id == "LAPORAN_RENSTRA_1") {
                      $$("IFRAME_CONTENT").load("perencanaan_laporan_rpjmd_3.php");
                    } else if (id == "LAPORAN_RENSTRA_2") {
                      $$("IFRAME_CONTENT").load("perencanaan_laporan_rpjmd_4.php");
                    } else if (id == "DATA_USER") {
                      $$("IFRAME_CONTENT").load("user.php");
                    } else if (id == "DATA_PEGAWAI") {
                      $$("IFRAME_CONTENT").load("pegawai.php");
                    } else if (id == "URUSAN_PROGRAM_KEGIATAN") {
                      $$("IFRAME_CONTENT").load("urusan_program_kegiatan.php");
                    } else if (id == "DATA_OPD_BIDANG") {
                      $$("IFRAME_CONTENT").load("perencanaan_opd.php");
                    } else if (id == "SETTING_APLIKASI") {
                      $$("IFRAME_CONTENT").load("setting.php");
                    } else if (id == "LOGOUT") {
                      location.href = 'perencanaan_login.php'
                    }
                    this.hide();
                  }
                }
              },
              {
                rows: [
                  // {view:"iframe", padding:0, id:"IFRAME_CONTENT", autoheight:true, adjust:true, scroll:"auto", src:"perencanaan_dashboard.php"}
                  {
                    view: "iframe",
                    padding: 0,
                    id: "IFRAME_CONTENT",
                    autoheight: true,
                    adjust: true,
                    scroll: "auto",
                    src: "perencanaan_renstra_entri.php"
                  }

                ]
              }
            ]
          }
        ]
      });

      // $$("sidebar1").hideItem("ENTRI");

      // console.log();

      $$("$sidebar1").hide();
      $$("$sidebar1").define("width", 330);
      $$("$sidebar1").resize();
    });

    function logoutAction() {
      // console.log("metu");
      location.href = 'tes2.php';
    }

    function editUserAction() {
      // console.log("edit");
      $$("IFRAME_CONTENT").load("edit_user.php");
      // location.href='tes2.php';
    }


    // new edited  25 april
    // function showWindow(winId, node) {
    //   $$(winId).getBody().clear();
    //   $$(winId).show(node);
    //   $$(winId).getBody().focus();
    //   // console.log(node);
    // }

    // $$("ENTRI").hide(true);
    // $$("RENSTRA").hideItem("ENTRI");
    // $$("sidebar1").getState();
  </script>

</body>

</html>