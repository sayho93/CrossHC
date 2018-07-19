<?php
/**
 * Created by PhpStorm.
 * User: sayho
 * Date: 2018. 7. 19.
 * Time: PM 3:20
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
        <header class="special">
            <h2>STAGE LIST</h2>
            <h3>상위에서 선택한 앱 정보가 이곳에 표시됩니다.</h3>
            <p>관리할 스테이지를 선택하세요.</p>
        </header>

        <select name="category" id="category">
            <option value="">스테이지 바로가기</option>
            <option value="alpha">스테이지 01</option>
            <option value="alpha">스테이지 02</option>
            <option value="alpha">스테이지 03</option>
        </select>

        <br/>

        <div class="col-6 col-12-small">
            <ul class="alt">
                <li>
                    <div class="col-6 col-12-small">
                        <input type="checkbox" id="checkbox-alpha" name="checkbox">
                        <label for="checkbox-alpha">전체</label>
                        <a href="#" class="button primary small">선택 항목 삭제</a>
                    </div>
                </li>
                <li>
                    <div class="col-6 col-12-small">
                        <input type="checkbox" id="checkbox-alpha" name="checkbox">
                        <label for="checkbox-alpha">스테이지 01</label>
                    </div>
                    <a href="#" class="button primary small">관리</a>&nbsp;
                    <a href="#" class="button small">▲</a>&nbsp;
                    <a href="#" class="button small">▼</a>&nbsp;
                    Updated At <b>2018-07-19 02:35:17</b>
                </li>
                <li>
                    <div class="col-6 col-12-small">
                        <input type="checkbox" id="checkbox-alpha" name="checkbox">
                        <label for="checkbox-alpha">스테이지 02</label>
                    </div>
                    <a href="#" class="button primary small">관리</a>&nbsp;
                    <a href="#" class="button small">▲</a>&nbsp;
                    <a href="#" class="button small">▼</a>&nbsp;
                    Updated At <b>2018-07-19 02:35:17</b>
                </li>
                <li>
                    <div class="col-6 col-12-small">
                        <input type="checkbox" id="checkbox-alpha" name="checkbox">
                        <label for="checkbox-alpha">스테이지 03</label>
                    </div>
                    <a href="#" class="button primary small">관리</a>&nbsp;
                    <a href="#" class="button small">▲</a>&nbsp;
                    <a href="#" class="button small">▼</a>&nbsp;
                    Updated At <b>2018-07-19 02:35:17</b>
                </li>
            </ul>
        </div>

    </div>
</section>

<? include_once $_SERVER['DOCUMENT_ROOT']."/admin/inc/footer.php"; ?>

