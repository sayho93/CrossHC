<?php
/**
 * Created by PhpStorm.
 * User: sayho
 * Date: 2018. 7. 19.
 * Time: PM 2:37
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
        <li><a href="accountList.php">Account</a></li>
        <li><a href="../index.php">Logout</a></li>
    </ul>
</nav>


<!-- Highlights -->
<section class="wrapper">
    <div class="inner">
        <header class="special">
            <h2>ACCOUNT LIST</h2>
            <p>관리할 관리자 계정를 선택하세요.</p>
        </header>

        <br/>

        <div class="col-6 col-12-small">
            <ul class="alt">
                <li>
                    <div class="col-6 col-12-small">
                        <input type="checkbox" id="checkbox-alpha" name="checkbox">
                        <label for="checkbox-alpha">전체</label>
                        <a href="#" class="button primary small">선택 항목 삭제</a>
                        <!-- 전체 삭제되면 로그인이 불가하므로 고려 요망 -->
                    </div>
                </li>
                <li>
                    <div class="col-6 col-12-small">
                        <input type="checkbox" id="checkbox-alpha" name="checkbox">
                        <label for="checkbox-alpha">관리자 계정 01</label>
                    </div>
                    <a href="#" class="button primary small">관리</a>&nbsp;
                    등록일자 <b>2018-07-19 02:35:17</b> / 등록일자 <b>2018-07-19 02:35:17</b>
                </li>
                <li>
                    <div class="col-6 col-12-small">
                        <input type="checkbox" id="checkbox-alpha" name="checkbox">
                        <label for="checkbox-alpha">관리자 계정 02</label>
                    </div>
                    <a href="#" class="button primary small">관리</a>&nbsp;
                    등록일자 <b>2018-07-19 02:35:17</b> / 등록일자 <b>2018-07-19 02:35:17</b>
                </li>
                <li>
                    <div class="col-6 col-12-small">
                        <input type="checkbox" id="checkbox-alpha" name="checkbox">
                        <label for="checkbox-alpha">관리자 계정 03</label>
                    </div>
                    <a href="#" class="button primary small">관리</a>&nbsp;
                    등록일자 <b>2018-07-19 02:35:17</b> / 등록일자 <b>2018-07-19 02:35:17</b>
                </li>
            </ul>
        </div>

    </div>
</section>

<? include_once $_SERVER['DOCUMENT_ROOT']."/admin/inc/footer.php"; ?>
