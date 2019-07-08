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
        <form style=" display: inline" name="memo_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="memo_id" value="<?=$memo['memo_id']?>"/>
            <h3>메모 <?=$mode?></h3>
			
            <p>
				<div class="form-group>
                <label for="memo_title">제목</label>
                <input type="text" class="form-control" placeholder="제목 입력" id="memo_title" name="memo_title" value="<?=$memo['memo_title']?>"/>
				</div>
            </p>
            <p>
				<div class="form-group>
                <label for="memo_text">내용</label>
                <textarea type="text" class="form-control" placeholder="센서크기 입력 ex) 24 x 36" rows="7" id="memo_text" name="memo_text"><?=$memo['memo_text']?></textarea>
				</div>
            </p>
            <p>
				<div class="form-group>
                <label for="memo_time">작성시간</label>
                <input type="text" class="form-control" placeholder="<?echo date("Y-m-d H:i:s")?>" id="memo_time" name="memo_time" value="<?=$memo['memo_time']?>" readonly />
				</div>
            </p>
            <br>

				<button class="btn btn-default" onclick="javascript:return validate();"><?=$mode?></button>

            <script>
                function validate() {
                    if(document.getElementById("memo_title").value == "") {
                        alert ("제목을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("memo_text").value == "") {
                        alert ("내용을 입력해 주십시오"); return false;
                    }
                    return true;
                }
            </script>
        </form>
        <button onclick='javascript:deleteConfirm(<?echo $memo['memo_id']?>)' class='btn btn-danger'>삭제</button>
		<script>
        function deleteConfirm(memo_id) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "memo_delete.php?memo_id=" + memo_id;
            }else{   //취소
                return;
            }
        }
		</script>
    </div>
<? include("footer.php") ?>