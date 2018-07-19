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
            <h2>Application List</h2>
            <p>관리할 앱을 선택하세요.</p>
        </header>
        <div class="highlights">
            <section>
                <div class="content">
                    <header>
                        <h3>앱 타이틀</h3>
                    </header>
                    <p>앱 부가설명이 삽입됩니다.</p>
                    <div class="" appId="0">
                        <a href="#" class="button primary fit jManageS small">스테이지 관리</a>
                        <br/><br/>
                        <a href="#" class="button primary fit jManageR small">추천앱 관리</a>
                        <br/><br/>
                        <a href="#" class="button fit jDelete small">삭제</a>
                    </div>
                </div>
            </section>
            <section>
                <div class="content">
                    <header>
                        <h3>앱 타이틀</h3>
                    </header>
                    <p>앱 부가설명이 삽입됩니다.</p>
                    <div class="" appId="0">
                        <a href="#" class="button primary fit jManageS small">스테이지 관리</a>
                        <br/><br/>
                        <a href="#" class="button primary fit jManageR small">추천앱 관리</a>
                        <br/><br/>
                        <a href="#" class="button fit jDelete small">삭제</a>
                    </div>
                </div>
            </section>
            <section>
                <div class="content">
                    <header>
                        <h3>앱 타이틀</h3>
                    </header>
                    <p>앱 부가설명이 삽입됩니다.</p>
                    <div class="" appId="0">
                        <a href="#" class="button primary fit jManageS small">스테이지 관리</a>
                        <br/><br/>
                        <a href="#" class="button primary fit jManageR small">추천앱 관리</a>
                        <br/><br/>
                        <a href="#" class="button fit jDelete small">삭제</a>
                    </div>
                </div>
            </section>
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