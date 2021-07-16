<section id="page" class="position-relative">
    <div id="topVisualImg" class="position-relative">
        <h1 class="m-0"><i><b>Baseball Gallary</b></i></h1>
    </div>
</section>

<section id="writePage">
    <div id="table">
        <h2><?= $league ?> 게시판 글쓰기</h2>
        <div id="select" class="w-100 d-flex justify-content-end">
            <div class="box">
                <button id="listBtn" class="btn btn-dark">목록</button>
                <button id="writeBtn" class="btn btn-dark">작성</button>
            </div>
        </div>
        <div id="writeForm">
            <input type="text" id="title" class="form-control mb-3" placeholder="제목을 입력하세요.">
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
                    <button class="imgupload btn" id="form-image-add" data-property="image" disabled>
                        <i class="fas fa-file-image"></i>
                    </button>
                </div>
            </div>
            <div contenteditable="true" id="content" class="form-control mb-3" spellcheck="false"></div>
        </div>
    </div>

    <div class="alertBox"></div>
</section>

<script src="js/board.js"></script>