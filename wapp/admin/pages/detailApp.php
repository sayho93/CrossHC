<?php
/**
 * Created by PhpStorm.
 * User: sayho
 * Date: 2018. 7. 19.
 * Time: PM 3:54
 */
?>

<? include_once $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php"; ?>
<? include $_SERVER["DOCUMENT_ROOT"] . "/common/classes/AdminMain.php";?>
<?
    $obj = new AdminMain($_REQUEST);
    $item = $obj->appInfo();
?>

<script>
    $(document).ready(function(){
        $(".jAdd").click(function(){
            var params = $("[name=form]").serialize();

            $.ajax({
                url: "/action_front.php?cmd=AdminMain.manageApp",
                async: false,
                cache: false,
                dataType: "json",
                data: params,
                success: function(data){
                    if(data.returnCode === 1){
                        console.log(data.data);
                        location.href = "/admin/pages/appList.php";
                    }
                }
            });
        });

        $(".jCancel").click(function(){
            history.back();
        });
    });
</script>


<!-- Nav -->
<nav id="menu">
    <ul class="links">
        <li><a href="appList.php">Application</a></li>
        <li><a href="recommend.php?appId=<?=$_REQUEST["appId"]?>">Recommendation</a></li>
        <li><a href="accountList.php">Account</a></li>
        <li><a class="jLogout">Logout</a></li>
    </ul>
</nav>


<!-- Highlights -->
<section class="wrapper">
    <div class="inner">

        <h2>앱 등록/수정</h2>
        <h3>앱 제목이 노출됨</h3> <!-- 수정모드일 경우 -->
        <form name="form" method="post" action="#">
            <input type="hidden" name="appId" value="<?=$_REQUEST["appId"]?>" desc="앱 번호" />
            <div class="row gtr-uniform">
                <div class="col-12 col-12-xsmall">
                    <h5>앱 제목</h5>
                    <input type="text" name="appName" id="name" value="<?=$item["appName"]?>" placeholder="앱 제목" />
                </div>
                <div class="col-12 col-12-xsmall">
                    <h5>앱 설명</h5>
                    <input type="text" name="appDesc" id="appDesc" value="<?=$item["appDesc"]?>" placeholder="앱 설명" />
                </div>
                <!-- Break -->
                <div class="col-12">
                    <ul class="actions">
                        <li><input type="button" value="등록/수정" class="primary jAdd" /></li>
                        <li><input type="button" value="취소" class="jCancel" /></li>
                    </ul>
                </div>
            </div>
        </form>

    </div>
</section>

<? include_once $_SERVER['DOCUMENT_ROOT']."/admin/inc/footer.php"; ?>
