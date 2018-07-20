<?php
/**
 * Created by PhpStorm.
 * User: sayho
 * Date: 2018. 7. 19.
 * Time: PM 3:05
 */
?>

<? include_once $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php"; ?>
<? include $_SERVER["DOCUMENT_ROOT"] . "/common/classes/AdminMain.php";?>
<?
    $obj = new AdminMain($_REQUEST);
    $item = $obj->adminInfo();
?>
<script>
    $(document).ready(function(){
        $(".jAdd").click(function(){
            var params = $("[name=form]").serialize();
            alert(params);

            $.ajax({
                url: "/action_front.php?cmd=WebUser.manageAdminAccount",
                async: false,
                cache: false,
                dataType: "json",
                data: params,
                success: function(data){
                    if(data.returnCode === 1){
                        console.log(data.data);
                        location.href = "/admin/pages/accountList.php";
                    }
                }
            });
        });

        $(".jBack").click(function(){

        });
    });
</script>

<!-- Nav -->
<nav id="menu">
    <ul class="links">
        <li><a href="appList.html">Application</a></li>
        <li><a href="recommend.html">Recommendation</a></li>
        <li><a href="accountList.html">Account</a></li>
        <li><a href="index.html">Logout</a></li>
    </ul>
</nav>


<!-- Highlights -->
<section class="wrapper">
    <div class="inner">

        <h2>관리자 계정 등록/수정</h2>
        <form name="form" method="post" action="#">
            <input type="hidden" name="id" value="<?=$item["adminNo"]?>"/>
            <div class="row gtr-uniform">
                <div class="col-12 col-12-xsmall">
                    <h5>관리자명</h5>
                    <input type="text" name="adminName" id="name" value="<?=$item["adminName"]?>" placeholder="관리자명" />
                </div>
                <div class="col-12 col-12-xsmall">
                    <h5>관리자 연락처</h5>
                    <input type="text" name="adminPhone" id="phone" value="<?=$item["adminPhone"]?>" placeholder="관리자 연락처" />
                </div>
                <div class="col-12 col-12-xsmall">
                    <h5>ID</h5>
                    <input type="text" name="adminID" id="id" value="<?=$item["adminID"]?>" placeholder="ID" />
                </div>
                <div class="col-12 col-12-xsmall">
                    <h5>PASSWORD</h5>
                    <input type="password" name="adminPwd" id="pwd" value="" placeholder="비밀번호 변경 희망시 입력" />
                </div>

                <!-- Break -->
                <div class="col-12">
                    <ul class="actions">
                        <li><input type="button" value="등록/수정" class="primary jAdd" /></li>
                        <li><input type="button" value="취소" class="jBack" /></li>
                    </ul>
                </div>
            </div>
        </form>

    </div>
</section>

<? include_once $_SERVER['DOCUMENT_ROOT']."/admin/inc/footer.php"; ?>
