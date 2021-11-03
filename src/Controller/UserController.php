<?php

namespace Eve\Controller;

use Eve\App\DB;
use Eve\Library\Lib;

class UserController extends MasterController
{
    // 회원가입
    public function registerCheck()
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE id = ? OR name = ?";
        $user = DB::fetch($sql, [$id, "관리자"]);
        if ($user) {
            echo "중복";
            return;
        } else {
            $isql = "INSERT INTO users (id, name, password) VALUES (?, ?, PASSWORD(?))";
            $result = DB::execute($isql, [$id, $name, $password]);
            $copyisql = "INSERT INTO usersbackup (id, name, password) VALUES (?, ?, PASSWORD(?))";
            $copyresult = DB::execute($copyisql, [$id, $name, $password]);
            if ($result && $copyresult) echo true;
            else echo false;
        }
    }

    // 로그인
    public function loginCheck()
    {
        $id = $_POST['id'];
        $password = $_POST['password'];

        if ($id === "admin" && $password === "admin1234") {
            $adminSql = "SELECT * FROM users WHERE id = ?";
            $admin = DB::fetch($adminSql, [$id]);
            if (!$admin) {
                $sql = "INSERT INTO users (id, name, password) VALUES (?, ?, PASSWORD(?))";
                $result = DB::execute($sql, [$id, "관리자", "admin1234"]);
                $copysql = "INSERT INTO usersbackup (id, name, password) VALUES (?, ?, PASSWORD(?))";
                $copyresult = DB::execute($copysql, [$id, "관리자", "admin1234"]);
            }
        }
        
        $sql = "SELECT * FROM users WHERE id = ? AND password = PASSWORD(?)";
        $user = DB::fetch($sql, [$id, $password]);
        if ($user) {
            if ($user->stop === "0000-00-00" || strtotime($user->stop) < strtotime(date("Y-m-d"))) {
                $_SESSION['user'] = $user;
                echo true;
            } else echo "정지";
        } else echo false;
    }

    // 로그아웃
    public function logout()
    {
        unset($_SESSION['user']);
        Lib::msgAndGo("로그아웃 되었습니다.", "/");
    }

    // 유저 정지
    public function userStop()
    {
        $id = $_POST['id'];
        $day = $_POST['day'];
        $timestamp = strtotime("+{$day} days");
        $date = date("Y-m-d", $timestamp);
        $sql = "UPDATE users SET stop = ? WHERE id = ?";
        $result = DB::execute($sql, [$date, $id]);
        $copysql = "UPDATE usersbackup SET stop = ? WHERE id = ?";
        $copyresult = DB::execute($copysql, [$date, $id]);
        if ($result && $copyresult) echo "성공";
        else echo "실패";
    }

    // 유저 삭제
    public function userDel()
    {
        $id = $_POST['id'];
        $sql = "DELETE FROM users WHERE id = ?";
        $result = DB::execute($sql, [$id]);
        if ($result) echo "성공";
        else echo "실패";
    }
}