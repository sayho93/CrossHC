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
    $appInfo = $obj->appInfo();
    $stageInfo = $obj->stageDetail();
    $item = $obj->questionDetail();
    $answerList = $obj->answerList();

    $largest = $answerList[sizeof($answerList)-1]["id"];
    $largest++;
?>
<script>
    $(document).ready(function(){
        var startIndex = "<?=$largest?>";
        var coordArr = new Array();
        var delIdArr = new Array();

        var coordObject = function(id, x, y){
            this.id = id;
            this.x = x;
            this.y = y;
        };

        addExistingCoords();


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

            // alert(
            //     "이미지 사이즈 : 가로(" + imgWidth + ") 세로(" + imgHeight + ")\n" +
            //     "절대 선택 위치 : 가로(" + xcoordAbs + ") 세로(" + ycoordAbs + ")\n" +
            //     "상대 선택 위치 : 가로(" + xcoordRel + ") 세로(" + ycoordRel + ")\n" +
            //     "최종 유효 선택 : 가로(" + sigX + ") 세로(" + sigY + ")"
            // );

            console.log((sigX * 100).toFixed(2) + "::::" + (sigY * 100).toFixed(2));
            // 최종 유효 선택 위치를 DB에 삽입해야 함 - 리스트 표시할 땐 %로 표시

            drawDot(eventObj.pageX, eventObj.pageY, "red");

            addDot(sigX, sigY, 0.1);
        });

        $(document).on("click", ".jCoord", function(){
            in_jCoord($(this));
        });

        $(document).on("mouseover", ".jCoord", function(){
            in_jCoord($(this));
        });

        $(document).on("mouseout", ".jCoord", function(){
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

        function addDot(x, y, threshold){
            var template = $("#template").html();
            template = template.replace(/#{id}/gi, startIndex);
            template = template.replace("#{coordX}", x);
            template = template.replace("#{coordY}", y);
            template = template.replace("#{coordX_show}", (x * 100).toFixed(2));
            template = template.replace("#{coordY_show}", (y * 100).toFixed(2));
            $(".target").append(template);

            var obj = new coordObject(startIndex, x, y);
            coordArr.push(obj);
            startIndex++;
            console.log(JSON.stringify(coordArr));

            //var map = new sehoMap().put("x", x).put("y", y).put("id", '<?//=$_REQUEST["id"]?>//').put("threshold", threshold);
            //var ajax = new AjaxSender("/action_front.php?cmd=AdminMain.addAnswer", false, "json", map);
            //ajax.send(function(data){
            //    console.log(data);
            //});
        }

        /**
         * 최초에 한 번만 실행하는 함수로, 데이터베이스의 좌표값을 javscript array에 저장
         */
        function addExistingCoords(){
            var coords = '<?=json_encode($answerList)?>';
            coords = JSON.parse(coords);
            for(var i=0; i<coords.length; i++){
                var tmpObj = new coordObject(coords[i].id, coords[i].coordX, coords[i].coordY);
                coordArr.push(tmpObj);
            }
            console.log(JSON.stringify(coordArr));
        }

        /**
         * 좌표 삭제시 필요한 함수로, coordArr에서 일치하는 인덱스를 반환
         * @param x
         * @param y
         */
        function searchArrByCoord(x, y){
            for(var i=0; i<coordArr.length; i++){
                if(coordArr[0].x == x && coordArr[0].y == y) console.log("true");
            }
        }

        $(".jDel").click(function(){
            var noArr = new Array();
            var noCount = $(".jAnswer:checked").length;
            if(noCount == 0){
                alert("삭제할 항목을 하나 이상 선택해주세요.");
                return false;
            }
            if(confirm("삭제하시겠습니까?")){
                for(var i = 0; i < noCount; i++ ) noArr[i] = $(".jAnswer:checked:eq(" + i + ")").val();
                deleteAnswer(noArr);
            }
        });

        $(document).on("click", ".jDelete", function(){
            var noArr = new Array();
            var id = $(this).attr("id");
            noArr[0] = id;
            deleteAnswer(noArr);
        });

        //TODO
        function deleteAnswer(noArr){
            for(var i=0; i<noArr.length; i++){
                var index = arrayObjectIndexOf(coordArr, noArr[i], "id");
                console.log(":::" + index)
                if(index != -1){
                    coordArr.splice(index, 1);
                    $(".jCoord[id=" + noArr[i] + "]").remove();
                }
                console.log(JSON.stringify(coordArr));
            }
        }


        function arrayObjectIndexOf(myArray, searchTerm, property){
            for(var i = 0, len = myArray.length; i < len; i++)
                if (myArray[i][property] === searchTerm) return i;
            return -1;
        }

        //일반 스크립트
        $("#jCheckAll").change(function(){
            if($(this).is(":checked")) $(".jAnswer").prop("checked", true);
            else $(".jAnswer").prop("checked", false);
        });

        $("[name=imgFile]").change(function(){
            readURL(this);
            $("#imgPath").val("");
        });

        function readURL(input){
            if (input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function(e){
                    $(".jImg").attr("src", e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(".jCancel").click(function(){
            history.back();
        });

        $(".jSave").click(function(){
            $("[name=data]").val(JSON.stringify(coordArr));

            var ajax = new AjaxSubmit("/action_front.php?cmd=AdminMain.manageAnswer", "post", true, "json", "#form");
            ajax.send(function(data){
                if(data.returnCode === 1)
                    location.href = "/admin/pages/detailS.php?appId=<?=$appInfo["id"]?>&stageId=<?=$stageInfo["id"]?>";
                else alert("이미지 저장 실패");
            });
        });

    });
</script>

<div id="pointer" style="border-radius:10px;border:solid 1px black;display:none;width:10px;height:10px;background:red;position:absolute;top:50px;left:100px;z-index:9999;"></div>

<div id="menuTemplate" style="display:none;">
    <li>
        <div class="col-6 col-12-small">
            <input type="checkbox" id="jCheckAll">
            <label for="jCheckAll">전체</label>
            <a class="button primary small jDel">선택 항목 삭제</a>
        </div>
    </li>
</div>

<div id="template" style="display: none;">
    <li class="jCoord" id="#{id}" cx="#{coordX}" cy="#{coordY}">
        <div class="col-6 col-12-small">
            <input type="checkbox" class="jAnswer" id="checkbox-alpha#{id}" value="#{id}">
            <label for="checkbox-alpha#{id}">
                <b>X좌표(%) : </b> #{coordX_show}% <b>Y좌표(%) : </b> #{coordY_show}%
            </label>
            <a class="button small jDelete" id="#{id}">삭제</a>
        </div>
    </li>
</div>

<!-- Nav -->
<nav id="menu">
    <ul class="links">
        <li><a href="appList.php?appId=<?=$_REQUEST["appId"]?>">Application</a></li>
        <li><a href="recommend.php?appId=<?=$_REQUEST["appId"]?>">Recommendation</a></li>
        <li><a href="accountList.php">Account</a></li>
        <li><a class="jLogout">Logout</a></li>
    </ul>
</nav>


<!-- Highlights -->
<section class="wrapper">
    <div class="inner">

        <h2>정답 등록/수정</h2> <!-- tblQuestion의 상세페이지 -->
        <h3>앱 <?=$appInfo["appName"]?> - 스테이지 <?=$stageInfo["stageDesc"]?></h3>
        <form method="post" id="form" action="#" enctype="multipart/form-data">
            <input type="hidden" name="data" />
            <input type="hidden" name="stageId" value="<?=$_REQUEST["stageId"]?>" />
            <input type="hidden" name="questionId" value="<?=$_REQUEST["id"]?>" />
            <!-- 수정이 아닌 등록 시에는 questionId가 없으므로 정답 추가 시
            lastInsertId 사용 요망 -->
            <div class="row gtr-uniform">
                <div class="col-12 col-12-xsmall">
                    <h5>문제 항목 이미지 - 게임화면 하단 표시</h5>
                    <span class="image fit"><img id="qImg" class="jImg" src="<?=$obj->fileShowPath . $item["imgPath"]?>" alt="" /></span>

                    <!-- Break -->
                    <div class="col-12" >
                        <h5>문제 항목 정답 관리 - <b>이미지 클릭으로 항목 추가</b></h5>
                        <!-- TODO 1개 미만인 상태로 등록 시 에러 앨러트 표시 요망 -->
                        <ul class="alt target">
                            <li>
                                <div class="col-6 col-12-small">
                                    <input type="checkbox" id="jCheckAll">
                                    <label for="jCheckAll">전체</label>
                                    <a class="button primary small jDel">선택 항목 삭제</a>
                                </div>
                            </li>

                            <?foreach($answerList as $answerItem){?>
                                <li class="jCoord" id="<?=$answerItem["id"]?>" cx="<?=$answerItem["coordX"]?>" cy="<?=$answerItem["coordY"]?>">
                                    <!-- 각 리스트 마우스 오버 시 이미지 위에 어떤 위치인지 표시 요망 -->
                                    <div class="col-6 col-12-small">
                                        <input type="checkbox" class="jAnswer" id="checkbox-alpha<?=$answerItem["id"]?>" value="<?=$answerItem["id"]?>">
                                        <label for="checkbox-alpha<?=$answerItem["id"]?>">
                                            <b>X좌표(%) : </b> <?=$answerItem["coordX"] * 100?>% <b>Y좌표(%) : </b> <?=$answerItem["coordY"] * 100?>%
                                        </label>
                                        <a class="button small jDelete" id="<?=$answerItem["id"]?>">삭제</a>
                                    </div>
                                </li>
                            <?}?>
                        </ul>

                    </div>
                    <h5>문제 항목 이미지 등록/수정</h5>
                    <input type="text" name="imgPath" id="imgPath" value="<?=$item["imgPath"]?>" placeholder="문제 항목 이미지를 선택하세요" READONLY />
                    <br/>

                    <a class="button primary fit jFind small">
                        이미지 찾기/등록
                        <input type="file" class="" name="imgFile" style="opacity:0; position: absolute; left:0px; width:100%; " placeholder="이미지 찾기/등록"/>
                    </a>
                </div>

                <!-- Break -->
                <div class="col-12">
                    <ul class="actions">
                        <li><input type="button" value="등록/수정" class="primary jSave" /></li>
                        <li><input type="button" value="취소" class="jCancel" /></li>
                    </ul>
                </div>
            </div>
        </form>

    </div>
</section>

<? include_once $_SERVER['DOCUMENT_ROOT']."/admin/inc/footer.php"; ?>
