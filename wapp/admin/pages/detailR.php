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
        <li><a href="appList.php">Application</a></li>
        <li><a href="recommend.php">Recommendation</a></li>
        <li><a href="accountList.php">Account</a></li>
        <li><a class="jLogout">Logout</a></li>
    </ul>
</nav>


<!-- Highlights -->
<section class="wrapper">
    <div class="inner">

        <h2>추천 앱 등록/수정</h2>
        <h3>앱 01 - 추천 앱 01</h3> <!-- 수정모드일 경우 -->
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
                <div class="col-12 col-12-xsmall">
                    <h5>앱 패키지명</h5>
                    <input type="text" name="packageName" id="packageName" value="" placeholder="앱 패키지명" />
                </div>
                <div class="col-12 col-12-xsmall">
                    <h5>썸네일 이미지</h5>
                    <span class="image fit"><img src="/admin/images/onerror.png" alt="" /></span>
                    <input type="text" name="imgPath" id="imgPath" value="" placeholder="썸네일 이미지를 선택하세요" READONLY />
                    <br/>
                    <a href="#" class="button primary fit jFind small">이미지 찾기/등록</a>
                </div>
                <div class="col-6 col-12-small">
                    <input type="checkbox" id="checkbox-alpha" name="checkbox">
                    <label for="checkbox-alpha">앱 리스트 내 노출 여부</label>
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


