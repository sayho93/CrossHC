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

        <h2>앱 등록/수정</h2>
        <h3>앱 제목이 노출됨</h3> <!-- 수정모드일 경우 -->
        <form method="post" action="#">
            <input type="hidden" name="appId" desc="앱 번호" />
            <div class="row gtr-uniform">
                <div class="col-12 col-12-xsmall">
                    <h5>앱 제목</h5>
                    <input type="text" name="appName" id="name" value="" placeholder="앱 제목" />
                </div>
                <div class="col-12 col-12-xsmall">
                    <h5>앱 설명</h5>
                    <input type="text" name="appDesc" id="appDesc" value="" placeholder="앱 설명" />
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
