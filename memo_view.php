<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "memo_insert.php";

if (array_key_exists("memo_id", $_GET)) {
    $memo_id = $_GET["memo_id"];
    $query =  "select * from memo where memo_id = $memo_id";
    $res = mysqli_query($conn, $query);
    $memo = mysqli_fetch_array($res);
    if(!$memo) {
        msg("메모 정보가 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "memo_modify.php";
}

$memo_manufacturers = array();

/*
$query = "select * from memo_manufacturer";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $memo_manufacturers[$row['CMFR_id']] = $row['CMFR_name'];
}

$mount = array();

$query = "select * from mount";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $mount[$row['mount_id']] = $row['mount_name'];
}
*/
?>

    <div class="container">
        <form name="memo_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="memo_id" value="<?=$memo['memo_id']?>"/>
            <h3>메모 <?=$mode?></h3>
			
            <p>
                <label for="memo_title">제목</label>
                <input type="text" placeholder="제목 입력" id="memo_title" name="memo_title" value="<?=$memo['memo_title']?>"/>
            </p>
            <p>
                <label for="memo_text">내용</label>
                <textarea type="text" placeholder="센서크기 입력 ex) 24 x 36" id="memo_text" name="memo_text"><?=$memo['memo_text']?></textarea>
            </p>
            <p>
                <label for="memo_time">작성시간</label>
                <input readonlytype="text" placeholder="정수로 입력 ex) 2019" id="memo_time" name="memo_time" value="<?=$memo['memo_time']?>" />
            </p>
            <br>

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("CMFR_id").value == "-1") {
                        alert ("제조사를 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("memo_name").value == "") {
                        alert ("모델명을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("memo_text").value == "") {
                        alert ("센서크기를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("resolution").value == "") {
                        alert ("해상도를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("memo_time").value == "") {
                        alert ("출시년도를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("mount_id").value == "-1") {
                        alert ("렌즈 마운트를 선택해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>