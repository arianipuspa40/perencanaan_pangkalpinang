<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=8" />
  <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no">
  <!-- <link rel="icon" type="image/vnd.microsoft.icon" href="img/logo_36.png" />
  <link rel="shortcut icon" type="image/x-icon" href="img/logo_36.png" /> -->
  <title>:: PERENCANAAN - KOTA PANGKALPINANG ::</title>
  <link rel="stylesheet" href="codebase/skins/compact.css" type="text/css" media="screen" charset="utf-8">
  <link rel="stylesheet" href="css/app.less" type="text/css" media="screen" charset="utf-8">
  <link rel="stylesheet" href="fontawesome/css/all.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="codebase/webix.js" type="text/javascript" charset="utf-8"></script>

<body>


  <script type="text/javascript">
    webix.ready(function() {



      webix.ui({
        rows: [
          // {view:"iframe", padding:0, id:"IFRAME_CONTENT", autoheight:true, adjust:true, scroll:"auto", src:"perencanaan_dashboard.php"}
          {
            view: "iframe",
            padding: 0,
            id: "IFRAME_CONTENT",
            autoheight: true,
            adjust: true,
            scroll: "auto",
            src: "perencanaan_renstra_entri.php",
          }
        ]
      })



      webix.ui({
        view: "window",
        id: "win_kertas",
        modal: true,
        height: 250,
        width: 300,
        left: 50,
        top: 50,
        move: true,
        position: "center",
        head: "pilih ukuran kertas",
        body: {
          view: "form",
          borderless: true,
          id: "form_kertas",
          elements: [{
              view: "combo",
              label: "UKURAN KERTAS",
              id: "uk_kertas",
              name: "uk_kertas",
              labelWidth: 180,
              options: ["A4-L", "A3-L", "A2-L"],
            },
            {
              view: "button",
              value: "Confirm",
              align: "center",
              click: function() {
                var param1 = $$('uk_kertas').getValue();
                // webix.ajax().post("output_rpjmd_opd1.php", {
                // return webix.ajax().post("output_rpjmd_opd.php", {
                //     param1: param1
                //   },
                //   function(text, data) {
                //     console.log(data.json());
                webix.send("output_rpjmd_opd_urs.php", {
                  param1: param1
                }, "POST");
                // webix.send("output_rpjmd_opd1.php",);
                // $$("win_kertas").hide();

                // $$("IFRAME_CONTENT").clearAll();
                // $$("IFRAME_CONTENT").load("output_rpjmd_opd.php");
                // })
              }
            }
          ],

        }
      })
      $$("win_kertas").show();
    })
  </script>
</body>

</html>