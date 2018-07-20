<?php
/**
 * Created by PhpStorm.
 * User: sayho
 * Date: 2018. 7. 19.
 * Time: PM 2:03
 */
?>
<? include_once $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php"; ?>
<? include $_SERVER["DOCUMENT_ROOT"] . "/common/classes/AdminMain.php";?>
<?
    $obj = new AdminMain($_REQUEST);
    $appList = $obj->getAppList();
?>

<script>
    $(document).ready(function(){
        $(".jAdd").click(function(){
            location.href = "/admin/pages/detailApp.php";
        });

        $(".jLogout").click(function(){
            var ajax = new AjaxSender("/action_front.php?cmd=AdminMain.logout", false, "json", new sehoMap());
            ajax.send(function(data){
                if(data.returnCode === 1){
                    location.href = "/admin";
                }
            });
        });

        $(".jManageS").click(function(){
            var appId = $(this).attr("appId");
            location.href = "/admin/pages/detailS.php?appId=" + appId;
        });

        $(".jManageR").click(function(){
            var appId = $(this).attr("appId");
            location.href = "/admin/pages/detailR.php?appId=" + appId;
        });

        $(".jDelete").click(function(){
            var appId = $(this).attr("appId");
            var ajax = new AjaxSender("/action_front.php?cmd=AdminMain.deleteApp", false, "json", new sehoMap().put("appId", appId));
            ajax.send(function(data){
                if(data.returnCode == 1){
                    alert("삭제되었습니다");
                    location.reload();
                }
            });
        });
    });
</script>

<!-- Nav -->
<nav id="menu">
    <ul class="links">
        <li><a href="appList.php">Application</a></li>
        <li><a href="accountList.php">Account</a></li>
        <li><a class="jLogout">Logout</a></li>
    </ul>
</nav>


<!-- Highlights -->
<section class="wrapper">
    <div class="inner">
        <header class="special">
            <h2>Application List</h2>
            <p>관리할 앱을 선택하세요.</p>
        </header>

        <div class="highlights">

            <?foreach($appList as $item){?>
                <section>
                    <div class="content">
                        <header>
                            <h3><?=$item["appName"]?></h3>
                        </header>
                        <p><?=$item["appDesc"]?></p>
                        <div class="" appId="<?=$item["id"]?>">
                            <a href="#" class="button primary fit jManageS small" appId="<?=$item["id"]?>">스테이지 관리</a>
                            <br/><br/>
                            <a href="#" class="button primary fit jManageR small" appId="<?=$item["id"]?>">추천앱 관리</a>
                            <br/><br/>
                            <a href="#" class="button fit jDelete small" appId="<?=$item["id"]?>">삭제</a>
                        </div>
                    </div>
                </section>
            <?}?>

            <section>
                <div class="content jAdd">
                    <header>
                        <a href="#" class="icon fa-plus"><span class="label">Twitter</span></a>
                    </header>
                    <h3>앱 추가하기</h3>

                </div>
            </section>
        </div>
    </div>
</section>

<? include_once $_SERVER['DOCUMENT_ROOT']."/admin/inc/footer.php"; ?>