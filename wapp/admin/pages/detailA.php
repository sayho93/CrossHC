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

?>
<script>
    $(document).ready(function(){
        $(".jPage").click(function(){
            $("[name=page]").val($(this).attr("page"));
            form.submit();
        });

        $(".jSearch").click(function(){
            $("[name=searchTxt]").val($("#searchTxt").val());
            $("[name=form]").submit();
        });

        $(".jDel").click(function(){
            var id = $(this).attr("no");
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
        <form method="post" action="#">
            <input type="hidden" name="appId" desc="앱 번호" />
            <div class="row gtr-uniform">
                <div class="col-12 col-12-xsmall">
                    <h5>관리자명</h5>
                    <input type="text" name="adminName" id="name" value="" placeholder="관리자명" />
                </div>
                <div class="col-12 col-12-xsmall">
                    <h5>관리자 연락처</h5>
                    <input type="text" name="adminPhone" id="name" value="" placeholder="관리자 연락처" />
                </div>
                <div class="col-12 col-12-xsmall">
                    <h5>ID</h5>
                    <input type="text" name="adminID" id="name" value="" placeholder="ID" />
                </div>
                <div class="col-12 col-12-xsmall">
                    <h5>PASSWORD</h5>
                    <input type="password" name="adminPwd" id="name" value="" placeholder="Password" />
                </div>

                <!-- Break -->
                <div class="col-12">
                    <ul class="actions">
                        <li><input type="button" value="등록/수정" class="primary" /></li>
                        <li><input type="button" value="취소" /></li>
                    </ul>
                </div>
            </div>
        </form>

    </div>
</section>

<? include_once $_SERVER['DOCUMENT_ROOT']."/admin/inc/footer.php"; ?>
