<?php
/**
 * Created by PhpStorm.
 * User: sayho
 * Date: 2018. 7. 19.
 * Time: PM 4:12
 */
?>


<? include $_SERVER["DOCUMENT_ROOT"] . "/common/classes/ApiBase.php" ;?>
<?
if(!class_exists("ApiList")){
    class ApiList extends  ApiBase {

        function __construct($req)
        {
            parent::__construct($req);
        }

        function getRecommendList(){
            $appId = $_REQUEST["appId"];

            $sql = "
                SELECT * 
                FROM tblRecommend
                WHERE appId = {$appId} AND exposure = 1
                ORDER BY `order` ASC 
            ";

            $res = $this->getArray($sql);
            return $this->makeResultJson(1, "succ", $res);
        }

        function checkUpdate(){
            $appId = $_REQUEST["appId"];

            $sql = "
                SELECT *
                FROM tblApps
                WHERE id = {$appId}
                LIMIT 1
            ";

            $res = $this->getRow($sql);
            return $this->makeResultJson(1, "succ", $res);
        }

        function makeFileName(){
            srand((double)microtime()*1000000);
            $Rnd = rand(1000000,2000000);
            $Temp = date("Ymdhis");
            return $Temp.$Rnd;
        }

        function getStageInfo(){
            $appId = $_REQUEST["appId"];

            $sql = "
                SELECT * FROM tblStage
                WHERE appId = {$appId}
                ORDER BY `order` ASC
            ";

            $stageList = $this->getArray($sql);

            for($i=0; $i<sizeof($stageList); $i++){
                $stageId = $stageList[$i]["id"];

                $sql = "
                    SELECT * FROM tblQuestion
                    WHERE stageId = {$stageId} 
                    ORDER BY `order` ASC
                ";

                $questionList = $this->getArray($sql);

                for($j=0; $j<sizeof($questionList); $j++){
                    $questionId = $questionList[$j]["id"];

                    $sql = "
                        SELECT * FROM tblAnswer
                        WHERE questionId = {$questionId}
                    ";

                    $answerList = $this->getArray($sql);
                    $questionList[$j]["answers"] = $answerList;
                }

                $stageList[$i]["questions"] = $questionList;
            }

            return $this->makeResultJson(1, "succ", $stageList);
        }

        function dirZip($resource,$dir){
            if(filetype($dir) === 'dir'){
                clearstatcache();

                if($fp = @opendir($dir)) {
                    while(false !== ($ftmp = readdir($fp))){
                        if(($ftmp !== ".") && ($ftmp !== "..") && ($ftmp !== ""))

                        {
                            if(filetype($dir.'/'.$ftmp) === 'dir') {
                                clearstatcache();

                                // 디렉토리이면 생성하기
                                $resource->addEmptyDir($dir.'/'.$ftmp);
                                set_time_limit(0);

                                dirZip($resource,$dir.'/'.$ftmp);
                            } else {

                                // 파일이면 파일 압축하기
                                $resource->addFile($dir.'/'.$ftmp);
                            }
                        }
                    }
                }
                if(is_resource($fp)){
                    closedir($fp);
                }
            }else{
                $resource->addFile($dir);
            }
        }

        function downloadStageInfo(){
            $appId = $_REQUEST["appId"];

            $sql = "
                SELECT * FROM tblStage
                WHERE appId = {$appId}
                ORDER BY `order` ASC
            ";

            $stageList = $this->getArray($sql);

            for($i=0; $i<sizeof($stageList); $i++){
                $stageId = $stageList[$i]["id"];

                $sql = "
                    SELECT * FROM tblQuestion
                    WHERE stageId = {$stageId} 
                    ORDER BY `order` ASC
                ";

                $questionList = $this->getArray($sql);

                for($j=0; $j<sizeof($questionList); $j++){
                    $questionId = $questionList[$j]["id"];

                    $sql = "
                        SELECT * FROM tblAnswer
                        WHERE questionId = {$questionId}
                    ";

                    $answerList = $this->getArray($sql);
                    $questionList[$j]["answers"] = $answerList;
                }
                $stageList[$i]["questions"] = $questionList;
            }

            $fName = $this->makeFileName();

            $target = $this->downFilePath . $fName . ".json";

            $fp = fopen($target, 'w+');
            fwrite($fp, json_encode($stageList));
            fclose($fp);

            $zip = new ZipArchive();
            $res = $zip->open($this->downFilePath . $fName . ".zip", $zip::CREATE);
            if ($res === TRUE){
                $this->dirZip($zip, $target);
                $zip->close();
            } else {
                echo "에러 코드: ".$res;
            }

            return $this->makeResultJson(1, "succ");
        }

    }
}