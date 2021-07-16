<section id="page" class="position-relative">
    <div id="topVisualImg" class="position-relative">
        <h1 class="m-0"><i><b>Baseball Gallary</b></i></h1>
    </div>
</section>

<section id="findPage">
    <ul id="findPageMenu" class="mb-0" class="find nav nav-pills">
        <?php if (__SESSION) : ?>
            <li class="nav-item">
                <a class="nav-link selected" href="#pwChange">비밀번호 변경</a>
            </li>
        <?php else : ?>
            <li class="nav-item">
                <a class="nav-link selected" href="#idFind">아이디 찾기</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#pwFind">비밀번호 찾기</a>
            </li>
        <?php endif; ?>
    </ul>
    <div class="find">
        <?php if (__SESSION) : ?>
            <div id="pwChange">
                <div class="form-group w-50 mx-auto">
                    <input type="password" id="nowPw" class="form-control mb-3" placeholder="현재 비밀번호">
                    <input type="password" id="newPw" class="form-control mb-3" placeholder="새 비밀번호">
                    <input type="password" id="newPwCheck" class="form-control mb-3" placeholder="새 비밀번호 확인">
                    <button id="pwChangeBtn" class="btn btn-dark float-right">확인</button>
                </div>
            </div>
        <?php else : ?>
            <div id="idFind">
                <div class="form-group w-50 mx-auto">
                    <input type="text" id="idfindname" class="form-control" placeholder="이름을 입력하세요.">
                    <button id="idFindBtn" class="mt-3 btn btn-dark float-right">확인</button>
                </div>
                <div id="list" class="w-50 mx-auto"></div>
            </div>
            <div id="pwFind">
                <div class="form-group w-50 mx-auto">
                    <input type="text" id="pwfindid" class="form-control mb-3" placeholder="아이디를 입력하세요.">
                    <input type="text" id="pwfindname" class="form-control" placeholder="이름을 입력하세요.">
                    <button id="pwFindBtn" class="mt-3 btn btn-dark float-right">확인</button>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="alertBox"></div>
</section>

<script src="js/find.js"></script>