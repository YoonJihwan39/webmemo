<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$memo_id = $_GET['memo_id'];

//for transaction
mysqli_query($conn, "set autocommit = 0");	// autocommit 해제
mysqli_query($conn, "set transation isolation level serializable");	// isolation level 설정
mysqli_query($conn, "begin");	// begins a transaction

$ret = mysqli_query($conn, "delete from memo where memo_id = $memo_id");

if(!$ret)
{
	mysqli_query($conn, "rollback"); // memo 삭제 query 수행 실패, 수행 전으로 rollback
    msg('Query Error : '.mysqli_error($conn));
}
else
{
	mysqli_query($conn, "commit"); // memo 삭제 query 성공. 수행 내역 commit
    s_msg ('성공적으로 삭제 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=index.php'>";
}

?>

