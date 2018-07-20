<?php
/**
 * Created by PhpStorm.
 * User: sayho
 * Date: 2018. 7. 19.
 * Time: PM 3:19
 */
?>

<? include_once $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php"; ?>
<? include $_SERVER["DOCUMENT_ROOT"] . "/common/classes/AdminMain.php";?>
<?
    $obj = new AdminMain($_REQUEST);
    $list = $obj->recommendList();
?>
<script>
    $(document).ready(function(){
        $(".jManage").click(function(){
            location.href = "/admin/pages/detailR.php";
        });

        //추첩앱 바로가기 기능
        $("#category").change(function(){

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
        <header class="special">
            <h2>RECOMMENDATION LIST</h2>
            <h3>상위에서 선택한 앱 정보가 이곳에 표시됩니다.</h3>
            <p>관리할 추천 앱를 선택하세요.</p>
        </header>

        <select name="category" id="category">
            <option value="">추천 앱 바로가기</option>
            <?foreach($list as $item){?>
                <option value="<?=$item["id"]?>"><?=$item["appName"]?></option>
            <?}?>
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

                <?foreach($list as $item){?>
                    <li>
                        <div class="col-6 col-12-small">
                            <input type="checkbox" id="checkbox-alpha" name="checkbox">
                            <label for="checkbox-alpha"><?=$item["appName"]?></label>
                        </div>
                        <a href="#" class="button primary small jManage" id="<?=$item["id"]?>">관리</a>&nbsp;
                        <a href="#" class="button small" id="<?=$item["id"]?>">▲</a>&nbsp;
                        <a href="#" class="button small" id="<?=$item["id"]?>">▼</a>&nbsp;
                        Updated At <b><?=$item["uptDate"]?></b>
                    </li>
                <?}?>

<!--                <li>-->
<!--                    <div class="col-6 col-12-small">-->
<!--                        <input type="checkbox" id="checkbox-alpha" name="checkbox">-->
<!--                        <label for="checkbox-alpha">추천 앱 02</label>-->
<!--                    </div>-->
<!--                    <a href="#" class="button primary small">관리</a>&nbsp;-->
<!--                    <a href="#" class="button small">▲</a>&nbsp;-->
<!--                    <a href="#" class="button small">▼</a>&nbsp;-->
<!--                    Updated At <b>2018-07-19 02:35:17</b>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <div class="col-6 col-12-small">-->
<!--                        <input type="checkbox" id="checkbox-alpha" name="checkbox">-->
<!--                        <label for="checkbox-alpha">추천 앱 03</label>-->
<!--                    </div>-->
<!--                    <a href="#" class="button primary small">관리</a>&nbsp;-->
<!--                    <a href="#" class="button small">▲</a>&nbsp;-->
<!--                    <a href="#" class="button small">▼</a>&nbsp;-->
<!--                    Updated At <b>2018-07-19 02:35:17</b>-->
<!--                </li>-->
            </ul>
        </div>

    </div>
</section>

<? include_once $_SERVER['DOCUMENT_ROOT']."/admin/inc/footer.php"; ?>
