<section id="page" class="position-relative">
    <div id="topVisualImg" class="position-relative">
        <h1 class="m-0"><i><b>Baseball Gallary</b></i></h1>
    </div>
</section>

<section id="viewPage">
    <div>
        <div id="select" class="w-100 d-flex justify-content-end">
            <div class="box">
                <button id="listBtn" class="btn btn-dark">목록</button>
                <button id="modifyBtn" class="btn btn-dark">수정</button>
                <button id="deleteBtn" class="btn btn-dark" onclick="checkDelete();">삭제</button>
            </div>
        </div>
        <div id="writeForm">
            <h4><?= htmlentities($b->title) ?></h4>
            <p>
                <span class="mr-3"><?= htmlentities($b->writerName) ?></span>
                <span class="mr-3"><?= date("y.m.d", strtotime($b->date)) ?></span>
                <span class="mr-3">조회 <?= number_format($b->views) ?></span>
                <span class="mr-3">추천 <?= number_format($b->recom) ?></span>
            </p>
            <div class="border"><?= nl2br($b->content) ?></div>
        </div>

        <?php if (__SESSION) : ?>
            <button id="recomBtn" class="btn"><b><?= $b->recom ?></b><br><span>★ 추천</span></button>
        <?php endif; ?>

        <div id="commentsBox">
            <?php if (__SESSION) : ?>
                <div id="commentForm" class="input-group my-3">
                    <textarea id="comment" class="form-control" rows="2" placeholder="댓글을 입력하세요."></textarea>
                    <div class="input-group-append">
                        <button id="comaddBtn" class="btn btn-dark">등록</button>
                    </div>
                </div>
            <?php endif; ?>
            <p>댓글목록</p>
            <div id="commentList">
                <?php foreach ($comList as $c) : ?>
                    <div class="com w-100 mx-auto d-flex">
                        <b title="<?= htmlentities($c->writerName) ?>"><?= htmlentities($c->writerName) ?></b>
                        <pre><?= htmlentities($c->content) ?></pre>
                        <span><?= $c->date ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="alertBox"></div>
</section>

<script>
    function checkDelete() {
        const c = confirm("정말 삭제하시겠습니까?");
        if (c) location.href = "/delete?id=<?= $b->id ?>";
    }
</script>

<script src="js/board.js"></script>