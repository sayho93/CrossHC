<?php
/**
 * Created by PhpStorm.
 * User: sayho
 * Date: 2018. 5. 14.
 * Time: PM 7:18
 */
?>
<? include $_SERVER["DOCUMENT_ROOT"] . "/common/classes/Admin.php"; ?>
<? include $_SERVER["DOCUMENT_ROOT"] . "/common/classes/AdminMain.php" ;?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Dashboard</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link rel="stylesheet" href="assets/css/main.css" />

    <script type="text/javascript" src="../modules/ajaxCall/ajaxClass.js"></script>
    <script type="text/javascript" src="../modules/sehoMap/sehoMap.js"></script>
    <script src="assets/js/jquery.min.js"></script>
</head>

<script>
    $(document).ready(function(){
        $(".jLogin").click(function(){
            if($("[name=account]").val() == "" || $("[name=password]").val() == ""){
                alert("계정 정보를 입력하세요.");
                return;
            }
            var params = new sehoMap();
            params.put("account", $("#adminId").val());
            params.put("password", $("#adminPw").val());
            var ajax = new AjaxSender("/action_front.php?cmd=AdminMain.login", false, "json", params);
            ajax.send(function(data){
                if(data.returnCode === 1){
                    location.href = "/admin/pages/appList.php";
                }
                else{
                    alert("로그인 정보를 확인하세요");
                }
            });
        });

        $('input').on("keydown", function(event){
            if (event.keyCode == 13) {
                $(".jLogin").trigger("click");
            }
        });
    });
</script>


<body class="is-preload">

<!-- Header -->
<header id="header">
    <a class="logo" href="index.html">Application Manager</a>
</header>

<!-- Highlights -->
<section class="wrapper">
    <div class="inner">
        <header class="special">
            <h2>Application Manager Login</h2>
        </header>
        <input type="text" name="adminId" id="adminId" value="" placeholder="ID" />
        <br/>
        <input type="password" name="adminPw" id="adminPw" value="" placeholder="Password" />
        <br/>
        <a href="#" class="button primary fit jLogin">Login</a>

    </div>
    <br/>
</section>

<!-- Footer -->
<footer id="footer">
    <div class="inner">
        Powered By &copy;PickleCode
        <div class="copyright">
            &copy; PickleCode.
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>