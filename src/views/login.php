<section id="page" class="position-relative">
    <div id="topVisualImg" class="position-relative">
        <h1 class="m-0"><i><b>Baseball Gallary</b></i></h1>
    </div>
</section>

<section id="loginMainPage" class="lrPage">
    <div id="loginBox" class="lrBox position-relative text-center pt-4">
        <h5 class="mt-5"><b>Member Login</b></h5>
        <div id="loginForm" class="form">
            <input type="text" id="id" class="form-control" placeholder="아이디" required>
            <input type="password" id="password" class="form-control" placeholder="비밀번호" required>
            <button id="loginBtn" class="btn btn-dark m-0">로그인</button>
        </div>

        <div class="bottomBox d-flex justify-content-around align-items-center">
            <span><a href="/password_lost">아이디 비밀번호 찾기</a></span>
            <span><a href="/register">회원가입</a></span>
        </div>
    </div>

    <div class="alertBox"></div>
</section>

<script src="js/login.js"></script>