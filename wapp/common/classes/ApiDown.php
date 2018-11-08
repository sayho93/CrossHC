<?php
/**
 * Created by PhpStorm.
 * User: 전세호
 * Date: 2018-11-08
 * Time: 오후 4:50
 */
?>
<?
if(!class_exists("ApiDown")){
    class ApiDown extends ApiBase{
        function __construct($req)
        {
            parent::__construct($req);
        }
        function makeFileName(){
            srand((double)microtime()*1000000);
            $Rnd = rand(1000000,2000000);
            $Temp = date("Ymdhis");
            return $Temp.$Rnd;
        }

        function downloadStageInfo(){
            $downFilePath = "/home/hosting_users/findpictures/www/uploadFiles/";
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

            $target = $downFilePath . 'app_' . $appId . "_" . $fName ;

            $fp = fopen($target . ".json", 'w+');
            fwrite($fp, json_encode($stageList));
            fclose($fp);


            while(ob_get_level()){
                ob_end_clean();
            }

            $zip = new ZipArchive;
            if ($zip->open($target . ".zip",  ZipArchive::CREATE)){
                $zip->addFile($target . ".json", 'appdata.json');

                foreach($stageList as $listItem){
//                    echo $this->filePath . $listItem["originalPath"] . "<br>";
                    $zip->addFile($this->filePath . $listItem["originalPath"], $listItem["originalPath"]);
                }

                $zip->close();
                header('Content-disposition: attachment; filename=' . 'app_' . $appId . "_" . $fName . '.zip');
                header('Content-type: application/zip');

                readfile($target . ".zip");
                return $this->makeResultJson(1, "succ");
            }else return $this->makeResultJson(-1, "failed");
        }
    }
}

?>


