<?php

namespace Eve\Controller;

use Eve\App\DB;

class MainController extends MasterController
{
    // 메인 페이지
    public function index()
    {
        $sql = "SELECT * FROM boards WHERE league = ? ORDER BY views DESC LIMIT 0, 4";
        $kboList = DB::fetchAll($sql, ["kbo"]);
        $mlbList = DB::fetchAll($sql, ["mlb"]);
        $npbList = DB::fetchAll($sql, ["npb"]);
        $cpblList = DB::fetchAll($sql, ["cpbl"]);

        $this->render("main", ['kboList' => $kboList, 'mlbList' => $mlbList, 'npbList' => $npbList, 'cpblList' => $cpblList]);
    }

    // 로그인 페이지
    public function login()
    {
        $this->render("login");
    }

    // 회원가입 페이지
    public function register()
    {
        $this->render("register");
    }

    // 아이디 찾기, 비밀번호 찾기, 비밀번호 변경 페이지
    public function passwordLost()
    {
        $this->render("idpwlost");
    }

    // 관리자 페이지
    public function adminPage()
    {
        $sql = "SELECT * FROM users";
        $userList = DB::fetchAll($sql);

        $this->render("admin", ['userList' => $userList]);
    }
}
