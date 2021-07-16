<section id="page" class="position-relative">
    <div id="topVisualImg" class="position-relative">
        <h1 class="m-0"><i><b>Baseball Gallary</b></i></h1>
    </div>
</section>

<section id="adminPage">
    <div id="userList" class="w-100 ml-5">
        <h4 class="ml-2">유저 정보</h4>
        <div class="card">
            <ul class="list-group list-group-flush">
                <?php foreach ($userList as $b) : ?>
                    <?php if ($b->id !== "admin") : ?>
                        <li class="list-group-item w-100 d-flex">
                            <span class="userId w-50 h-100"><?= htmlentities($b->id) ?></span>
                            <span class="userName w-25 h-100"><?= htmlentities($b->name) ?></span>
                            <div class="input-group w-25">
                                <input type="number" class="form-control" min="1" value="1">
                                <div class="input-group-append">
                                    <button id="userStopBtn" class="btn btn-dark">정지</button>
                                    <button id="userDelBtn" class="ml-3 btn btn-dark">삭제</button>
                                </div>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <div class="alertBox"></div>
</section>

<script src="js/admin.js"></script>