<?php

namespace Eve\Controller;

use Eve\App\DB;
use Eve\Library\Lib;
use Eve\Library\Pagination;

class BoardController extends MasterController
{
    // 보드페이지
    public function index()
    {
        $lg = strtoupper($_GET['league']);

        if ($lg !== "KBO" && $lg !== "MLB" && $lg !== "NPB" && $lg !== "CPBL") {
            echo "<script>location.href='/board?league=kbo';</script>";
            $lg = "KBO";
        }

        $page = 1;

        if (isset($_GET['p']) && is_numeric($_GET['p'])) $page = $_GET['p'] * 1;

        $option = 10;
        if (isset($_GET['option']) && is_numeric($_GET['option'])) $option = $_GET['option'];

        $start = ($page - 1) * $option;
        $sql = "SELECT * FROM boards WHERE league = ? ORDER BY id DESC LIMIT {$start}, {$option}";
        $list = DB::fetchAll($sql, [strtolower($lg)]);

        $cntSql = "SELECT count(*) AS cnt FROM boards WHERE league = ?";
        $cnt = DB::fetch($cntSql, [$lg])->cnt;
        $pg = new Pagination($cnt, $page, $option);

        if ($cnt > 0) {
            if ($page < 1 || $page > ceil($cnt / 10)) echo "<script>history.back();</script>";
        }

        $this->render("board", ['league' => $lg, 'list' => $list, 'pg' => $pg, 'page' => $page, 'total' => $cnt]);
    }

    // 글작성 페이지
    public function writePage()
    {
        $lg = strtoupper($_GET['league']);

        if ($lg !== "KBO" && $lg !== "MLB" && $lg !== "NPB" && $lg !== "CPBL") {
            echo "<script>location.href='/write?league=kbo';</script>";
            $lg = "KBO";
        }

        $this->render("write", ['league' => $lg]);
    }

    // 글작성
    public function writeProcess()
    {
        $title = $_POST['title'];
        $writerId = $_SESSION['user']->id;
        $writerName = $_SESSION['user']->name;
        $content = $_POST['content'];
        $views = 0;
        $recom = 0;
        $league = $_POST['league'];

        $sql = "INSERT INTO boards (title, writerId, writerName, content, date, views, recom, league) VALUES (?, ?, ?, ?, NOW(), ?, ?, ?)";
        $result = DB::execute($sql, [$title, $writerId, $writerName, $content, $views, $recom, $league]);
        $copysql = "INSERT INTO boardsbackup (title, writerId, writerName, content, date, views, recom, league) VALUES (?, ?, ?, ?, NOW(), ?, ?, ?)";
        $copyresult = DB::execute($copysql, [$title, $writerId, $writerName, $content, $views, $recom, $league]);

        if ($result && $copyresult) echo "성공";
        else echo "실패";
    }

    // 글보기 페이지
    public function view()
    {
        if (!isset($_GET['id'])) {
            Lib::msgAndBack("잘못된 주소입니다.");
            exit;
        }

        $lg = strtoupper($_GET['league']);
        if ($lg !== "KBO" && $lg !== "MLB" && $lg !== "NPB" && $lg !== "CPBL") {
            echo "<script>location.href='/board?league=kbo';</script>";
            $lg = "KBO";
        }

        $id = $_GET['id'];
        $sql = "SELECT * FROM boards WHERE id = ?";
        $list = DB::fetch($sql, [$id]);
        $comSql = "SELECT * FROM comments WHERE boardId = ? ORDER BY id DESC";
        $comments = DB::fetchAll($comSql, [$id]);
        if ($list) {
            $views = $list->views + 1;
            $usql = "UPDATE boards SET views = ? WHERE id = ?";
            $result = DB::execute($usql, [$views, $id]);
            $copyusql = "UPDATE boardsbackup SET views = ? WHERE id = ?";
            $copyresult = DB::execute($copyusql, [$views, $id]);
            if ($result && $copyresult) {
                $b = DB::fetch("SELECT * FROM boards WHERE id = ?", [$id]);
                $this->render("view", ['b' => $b, 'league' => $lg, 'comList' => $comments]);
            }
        } else Lib::msgAndBack("잘못된 주소입니다.");
    }

    // 글 추천
    public function recom()
    {
        $id = $_POST['id'];
        $userId = $_SESSION['user']->id;

        $usersql = "SELECT * FROM users WHERE id = ?";
        $user = DB::fetch($usersql, [$userId]);
        if ($user->recomId !== "") $userRecom = json_decode($user->recomId);
        else $userRecom = [];

        foreach($userRecom as $re) {
            if ($re == $id) {
                echo "중복";
                exit;
            }   
        }
        $sql = "SELECT * FROM boards WHERE id = ?";
        $list = DB::fetch($sql, [$id]);
        $recom = $list->recom + 1;

        $userRecom[] = $id;
        $arr = json_encode($userRecom);
        $userRecSql = "UPDATE users SET recomId = ? WHERE id = ?";
        $userRec = DB::execute($userRecSql, [$arr, $userId]);
        $copyuserRecSql = "UPDATE usersbackup SET recomId = ? WHERE id = ?";
        $copyuserRec = DB::execute($copyuserRecSql, [$arr, $userId]);

        $usql = "UPDATE boards SET recom = ? WHERE id = ?";
        $result = DB::execute($usql, [$recom, $id]);
        $copyusql = "UPDATE boardsbackup SET recom = ? WHERE id = ?";
        $copyresult = DB::execute($copyusql, [$recom, $id]);
        if ($result && $userRec && $copyuserRec && $copyresult) echo "성공";
        else echo "실패";
    }

    // 댓글 달기
    public function comAdd()
    {
        $id = $_POST['id'];
        $content = $_POST['content'];
        $writerId = $_SESSION['user']->id;
        $writerName = $_SESSION['user']->name;
        $sql = "INSERT INTO comments (boardId, content, writerId, writerName, date) VALUES (?, ?, ?, ?, NOW())";
        $result = DB::execute($sql, [$id, $content, $writerId, $writerName]);
        $copysql = "INSERT INTO commentsbackup (boardId, content, writerId, writerName, date) VALUES (?, ?, ?, ?, NOW())";
        $copyresult = DB::execute($copysql, [$id, $content, $writerId, $writerName]);
        if ($result && $copyresult) {
            $list = array("id" => $id, "content" => $content, "writerId" => $writerId, "writerName" => $writerName, "date" => date("Y-m-d H:i:s"));
            echo json_encode($list, JSON_UNESCAPED_UNICODE);
        } else echo "실패";
    }

    // 글 삭제
    public function delete()
    {
        if (!isset($_GET['id'])) {
            Lib::msgAndBack("잘못된 주소입니다.");
            exit;
        }

        $id = $_GET['id'];
        $b = DB::fetch("SELECT * FROM boards WHERE id = ?", [$id]);
        $user = $_SESSION['user'];

        if ($user->id !== "admin") {
            if (!$b || $b->writerId !== $user->id || $b->writerName !== $user->name) {
                Lib::msgAndBack("권한이 없습니다.");
                exit;
            }
        }

        $sql = "DELETE FROM boards WHERE id = ?";
        $result = DB::execute($sql, [$id]);
        if ($result) Lib::msgAndGo("삭제되었습니다.", "/board");
        else Lib::msgAndBack("삭제중 오류 발생. 잠시후 다시 시도해주세요.");
    }

    // 글 수정 페이지
    public function modify()
    {
        if (!isset($_GET['id'])) {
            Lib::msgAndBack("잘못된 주소입니다.");
            exit;
        }

        $lg = strtoupper($_GET['league']);
        if ($lg !== "KBO" && $lg !== "MLB" && $lg !== "NPB" && $lg !== "CPBL") {
            echo "<script>location.href='/board?league=kbo';</script>";
            $lg = "KBO";
        }

        $id = $_GET['id'];
        $sql = "SELECT * FROM boards WHERE id = ?";
        $list = DB::fetch($sql, [$id]);
        $user = $_SESSION['user'];

        if ($user->id !== "admin") {
            if (!$list || $list->writerId !== $user->id || $list->writerName !== $user->name) {
                Lib::msgAndBack("권한이 없습니다.");
                exit;
            }
        }

        if ($list) {
            $b = DB::fetch("SELECT * FROM boards WHERE id = ?", [$id]);
            $this->render("modify", ['b' => $b, 'league' => $lg]);
        } else Lib::msgAndBack("잘못된 주소입니다.");
    }

    // 글 수정
    public function modifyProcess()
    {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $user = $_SESSION['user'];

        $sql = "SELECT * FROM boards WHERE id = ?";
        $b = DB::fetch($sql, [$id]);

        if ($user->id !== "admin") {
            if (!$b || $b->writerId !== $user->id || $b->writerName !== $user->name) {
                Lib::msgAndBack("권한이 없습니다.");
                exit;
            }
        }

        $sql = "UPDATE boards SET title = ?, content = ? WHERE id = ?";
        $result = DB::execute($sql, [$title, $content, $id]);
        $copysql = "UPDATE boardsbackup SET title = ?, content = ? WHERE id = ?";
        $copyresult = DB::execute($copysql, [$title, $content, $id]);

        if ($result && $copyresult) echo "성공";
        else echo "실패";
    }
}
