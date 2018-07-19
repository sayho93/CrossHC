<?php
/**
 * Created by PhpStorm.
 * User: sayho
 * Date: 2018. 7. 19.
 * Time: PM 4:00
 */
?>


<? include_once $_SERVER['DOCUMENT_ROOT']."/admin/inc/header.php"; ?>
<? include $_SERVER["DOCUMENT_ROOT"] . "/common/classes/AdminMain.php";?>
<?
$obj = new AdminMain($_REQUEST);

?>
<script>
    $(document).ready(function(){

        /**
         * 이미지 위에 점을 표시할 DIV 객체 - Body 최상단에 위치함
         */
        var pointer = $("#pointer");

        /**
         * 이미지 객체
         */
        var imgBox = $("#qImg");

        /**
         * 이미지 클릭 이벤트 및 좌표 처리
         */
        imgBox.click(function(eventObj){
            var offset = $(this).offset();
            var imgWidth = $(this).width();
            var imgHeight = $(this).height();
            var xcoordAbs = eventObj.pageX - offset.left;
            var ycoordAbs = eventObj.pageY - offset.top;
            var xcoordRel = xcoordAbs / imgWidth;
            var ycoordRel = ycoordAbs / imgHeight;
            var sigX = xcoordRel.toFixed(4);
            var sigY = ycoordRel.toFixed(4);

            alert(
                "이미지 사이즈 : 가로(" + imgWidth + ") 세로(" + imgHeight + ")\n" +
                "절대 선택 위치 : 가로(" + xcoordAbs + ") 세로(" + ycoordAbs + ")\n" +
                "상대 선택 위치 : 가로(" + xcoordRel + ") 세로(" + ycoordRel + ")\n" +
                "최종 유효 선택 : 가로(" + sigX + ") 세로(" + sigY + ")"
            );
            // 최종 유효 선택 위치를 DB에 삽입해야 함 - 리스트 표시할 땐 %로 표시

            drawDot(eventObj.pageX, eventObj.pageY, "red");
        });

        $(".jCoord").click(function(){
            in_jCoord($(this));
        });

        $(".jCoord").mouseover(function(){
            in_jCoord($(this));
        });

        $(".jCoord").mouseout(function(){
            pointer.hide();
        });

        function in_jCoord(obj){
            var cx = obj.attr("cx");
            var cy = obj.attr("cy");
            var calculatedX = imgBox.width() * cx + (imgBox.offset().left);
            var calculatedY = imgBox.height() * cy + (imgBox.offset().top);
            drawDot(calculatedX, calculatedY, "yellow");
        }

        function drawDot(x, y, color){
            pointer.animate({
                top : y,
                left : x
            }, 0);
            pointer.css({background:color});
            pointer.show();
        }

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

        <h2>정답 등록/수정</h2> <!-- tblQuestion의 상세페이지 -->
        <h3>앱 01 - 스테이지 01</h3>
        <form method="post" action="#">
            <input type="hidden" name="stageId" value="" />
            <input type="hidden" name="questionId" value="" />
            <!-- 수정이 아닌 등록 시에는 questionId가 없으므로 정답 추가 시
            lastInsertId 사용 요망 -->
            <div class="row gtr-uniform">
                <div class="col-12 col-12-xsmall">
                    <h5>문제 항목 이미지 - 게임화면 하단 표시</h5>
                    <span class="image fit"><img id="qImg" src="images/onerror.png" alt="" /></span>

                    <!-- Break -->
                    <div class="col-12" >
                        <h5>문제 항목 정답 관리 - <b>이미지 클릭으로 항목 추가</b></h5>
                        <!-- 1개 미만인 상태로 등록 시 에러 앨러트 표시 요망 -->
                        <ul class="alt">
                            <li>
                                <div class="col-6 col-12-small">
                                    <input type="checkbox" id="checkbox-alpha" name="checkbox">
                                    <label for="checkbox-alpha">전체</label>
                                    <a href="#" class="button primary small">선택 항목 삭제</a>
                                </div>
                            </li>

                            <li class="jCoord" cx="0.351350" cy="0.351350">
                                <!-- 각 리스트 마우스 오버 시 이미지 위에 어떤 위치인지 표시 요망 -->
                                <div class="col-6 col-12-small">
                                    <input type="checkbox" id="checkbox-alpha" name="checkbox">
                                    <label for="checkbox-alpha">
                                        <b>X좌표(%) : </b> 35.1350% <b>Y좌표(%) : </b> 35.1350%
                                    </label>
                                    <a href="#" class="button small jDelete">삭제</a>
                                </div>
                            </li>
                            <li class="jCoord" cx="0.751350" cy="0.351350">
                                <!-- 각 리스트 마우스 오버 시 이미지 위에 어떤 위치인지 표시 요망 -->
                                <div class="col-6 col-12-small">
                                    <input type="checkbox" id="checkbox-alpha" name="checkbox">
                                    <label for="checkbox-alpha">
                                        <b>X좌표(%) : </b> 75.1350% <b>Y좌표(%) : </b> 35.1350%
                                    </label>
                                    <a href="#" class="button small jDelete">삭제</a>
                                </div>
                            </li>
                            <li class="jCoord" cx="0.351350" cy="0.551350">
                                <!-- 각 리스트 마우스 오버 시 이미지 위에 어떤 위치인지 표시 요망 -->
                                <div class="col-6 col-12-small">
                                    <input type="checkbox" id="checkbox-alpha" name="checkbox">
                                    <label for="checkbox-alpha">
                                        <b>X좌표(%) : </b> 35.1350% <b>Y좌표(%) : </b> 55.1350%
                                    </label>
                                    <a href="#" class="button small jDelete">삭제</a>
                                </div>
                            </li>
                        </ul>

                    </div>
                    <h5>문제 항목 이미지 등록/수정</h5>
                    <input type="text" name="imgPath" id="imgPath" value="" placeholder="문제 항목 이미지를 선택하세요" READONLY />
                    <br/>
                    <a href="#" class="button primary fit jFind small">이미지 찾기/등록</a>
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
