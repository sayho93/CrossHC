<?php
/**
 * Created by PhpStorm.
 * User: sayho
 * Date: 2018. 7. 19.
 * Time: PM 3:07
 */
?>

<? include_once $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php"; ?>
<? include $_SERVER["DOCUMENT_ROOT"] . "/common/classes/AdminMain.php";?>
<?
    $obj = new AdminMain($_REQUEST);
    $info = $obj->appInfo();
    $item = $obj->stageDetail();
?>
<script>
    $(document).ready(function(){
        $(".jAdd").click(function(){
            location.href = "/admin/pages/answer.php?appId=<?=$info["id"]?>&stageId=<?=$_REQUEST["id"]?>";
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

        <h2>스테이지 등록/수정</h2>
        <h3>앱 <?=$info["appName"]?> - 스테이지 <?=$item["stageDesc"]?></h3>
        <form method="post" action="#">
            <input type="hidden" name="appId" value="" />
            <div class="row gtr-uniform">
                <div class="col-12 col-12-xsmall">
                    <h5>스테이지명 - 관리용</h5>
                    <input type="text" name="stageDesc" id="stageDesc" value="<?=$item["stageDesc"]?>" placeholder="스테이지명 - 관리용" />
                </div>
                <div class="col-12 col-12-xsmall">
                    <h5>원본 이미지 - 게임화면 상단 표시</h5>
                    <span class="image fit"><img src="images/onerror.png" alt="" /></span>
                    <input type="text" name="originalPath" id="originalPath" value="" placeholder="이미지를 선택하세요" READONLY />
                    <br/>
                    <a href="#" class="button primary fit jFind small">이미지 찾기/등록</a>
                </div>
                <!-- Break -->
                <div class="col-12" >
                    <h5>스테이지 정답 관리</h5>
                    <div class="col-6 col-12-small">
                        <input type="checkbox" id="checkbox-alpha" name="checkbox">
                        <label for="checkbox-alpha">전체</label>
                        <a href="#" class="button primary small jAdd">항목 추가</a>
                        <a href="#" class="button small">선택 항목 삭제</a>
                    </div>
                    <div class="highlights">
                        <section>
                            <div class="content">
                                <div class="col-6 col-12-small">
                                    <input type="checkbox" id="checkbox-alpha" name="checkbox">
                                    <label for="checkbox-alpha">선택</label>
                                </div>
                                <br/>
                                <span class="image fit"><img src="images/onerror.png" alt="" /></span>
                                <div class="" appId="0">
                                    <a href="#" class="button primary small">관리</a>&nbsp;
                                    <a href="#" class="button small">삭제</a>&nbsp; <!-- 이를 부모로 가진 tblAnswer 튜플도 삭제되어야 함 -->
                                    <br/><br/>Updated At <b>2018-07-19 02:35:17</b>
                                </div>
                            </div>
                        </section>
                        <section>
                            <div class="content">
                                <div class="col-6 col-12-small">
                                    <input type="checkbox" id="checkbox-alpha" name="checkbox">
                                    <label for="checkbox-alpha">선택</label>
                                </div>
                                <br/>
                                <span class="image fit"><img src="images/onerror.png" alt="" /></span>
                                <div class="" appId="0">
                                    <a href="#" class="button primary small">관리</a>&nbsp;
                                    <a href="#" class="button small">삭제</a>&nbsp; <!-- 이를 부모로 가진 tblAnswer 튜플도 삭제되어야 함 -->
                                    <br/><br/>Updated At <b>2018-07-19 02:35:17</b>
                                </div>
                            </div>
                        </section>
                        <section>
                            <div class="content">
                                <div class="col-6 col-12-small">
                                    <input type="checkbox" id="checkbox-alpha" name="checkbox">
                                    <label for="checkbox-alpha">선택</label>
                                </div>
                                <br/>
                                <span class="image fit"><img src="images/onerror.png" alt="" /></span>
                                <div class="" appId="0">
                                    <a href="#" class="button primary small">관리</a>&nbsp;
                                    <a href="#" class="button small">삭제</a>&nbsp; <!-- 이를 부모로 가진 tblAnswer 튜플도 삭제되어야 함 -->
                                    <br/><br/>Updated At <b>2018-07-19 02:35:17</b>
                                </div>
                            </div>
                        </section>
                    </div>

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
