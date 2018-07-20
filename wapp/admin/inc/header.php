<?php
/**
 * Created by PhpStorm.
 * User: sayho
 * Date: 2018. 7. 19.
 * Time: PM 1:26
 */
?>
<? include $_SERVER["DOCUMENT_ROOT"] . "/common/classes/Admin.php"; ?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Dashboard</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link rel="stylesheet" href="../assets/css/main.css" />


    <script src="../vendors/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="/modules/ajaxCall/ajaxClass.js"></script>
    <script type="text/javascript" src="/modules/sehoMap/sehoMap.js"></script>

</head>

<?
    $obj = new Admin($_REQUEST);
    $userInfo = $obj->admUser;

    if($userInfo->adminNo < 0 || $userInfo->adminNo == ""){
        echo "<script>alert(\"로그인 후 이용이 가능합니다\");</script>";
        echo "<script>location.href='/admin';</script>";
    }
?>

<body class="is-preload">

<!-- Header -->
<header id="header">
    <a class="logo" href="/admin/pages/appList.php">Application Manager</a>
    <nav>
        <a href="#menu"><?=$userInfo->adminName?> 님</a>
    </nav>
</header>

<script>
    $(document).ready(function(){
        $(".jLogout").click(function(){
            var ajax = new AjaxSender("/action_front.php?cmd=AdminMain.logout", false, "json", new sehoMap());
            ajax.send(function(data){
                if(data.returnCode === 1){
                    location.href = "/admin";
                }
            });
        });
    });
</script>

