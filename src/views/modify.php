<section id="page" class="position-relative">
    <div id="topVisualImg" class="position-relative">
        <h1 class="m-0"><i><b>Baseball Gallary</b></i></h1>
    </div>
</section>

<section id="writePage">
    <div>
        <div id="select" class="w-100 d-flex justify-content-end">
            <div class="box">
                <button id="modifyBtn" class="btn btn-dark">수정</button>
                <button id="closeBtn" class="btn btn-dark" onclick="history.back();">취소</button>
            </div>
        </div>
        <div id="writeForm">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">제목</span>
                </div>
                <input type="text" id="title" class="form-control" value="<?= $b->title ?>">
            </div>
            <p class="mt-3">
                <span class="mr-3"><?= htmlentities($b->writerName) ?></span>
                <span class="mr-3"><?= date("y.m.d", strtotime($b->date)) ?></span>
                <span class="mr-3">조회 <?= number_format($b->views) ?></span>
                <span class="mr-3">추천 <?= number_format($b->recom) ?></span>
            </p>
            <input type="color" id="color_input" hidden>
            <input type="file" id="form_file" multiple hidden>
            <div class="form-button-box d-flex">
                <button class="bld btn" data-property="bold">B</button>
                <button class="it btn" data-property="Italic">T</button>
                <button class="udl btn" data-property="Underline">U</button>
                <button class="strk btn" data-property="StrikeThrough">S</button>
                <button class="jstfl btn" data-property="justifyleft">
                    <i class="fas fa-align-left"></i>
                </button>
                <button class="jstfc btn" data-property="justifycenter">
                    <i class="fas fa-align-center"></i>
                </button>
                <button class="jstfr btn" data-property="justifyright">
                    <i class="fas fa-align-right"></i>
                </button>
                <button class="clr btn" data-property="foreColor">
                    <i class="fas fa-tint"></i>
                </button>
                <div class="form-image-box">
                    <button class="imgupload btn" id="form-image-add" data-property="image">
                        <i class="fas fa-file-image"></i>
                    </button>
                </div>
            </div>
            <div class="input-group">
            <div class="input-group-prepend">
                    <span class="input-group-text">내용</span>
                </div>
                <div contenteditable="true" id="content" class="form-control" spellcheck="false"><?= nl2br($b->content) ?></div>
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