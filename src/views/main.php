<section id="visualPage">
    <div id="visualImg" class="position-relative">
        <img src="images/main.jpg" alt="visualImg">
    </div>
</section>

<section id="mainPage">
    <div class="img">
        <img src="images/bg.png">
    </div>
    <div id="center" class="mx-auto">
        <div class="centertextBox">
            <p class="text-center"><b>야구 갤러리</b></p>
            <h2><span class="txtred">WHAT</span> WE DO</h2>
        </div>
        <div class="w-100 mainBox d-flex justify-content-between">
            <div class="imgBox">
                <img src="images/mainimg.jpg">
            </div>
            <div class="boardBox">
                <div class="boardBlock kbo">
                    <h5>국내리그 <span>|</span> <span>KBO</span></h5>
                    <ul class="mt-4">
                        <?php foreach ($kboList as $b) : ?>
                            <li title="<?= $b->title ?>"><a href="/view?league=kbo&id=<?= $b->id ?>"><?= $b->title ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="moreBtn"><a href="/board?league=kbo">MORE VIEW</a></div>
                </div>
                <div class="boardBlock mlb">
                    <h5>미국리그 <span>|</span> <span>MLB</span></h5>
                    <ul class="mt-4">
                        <?php foreach ($mlbList as $b) : ?>
                            <li title="<?= $b->title ?>"><a href="/view?league=mlb&id=<?= $b->id ?>"><?= $b->title ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="moreBtn"><a href="/board?league=mlb">MORE VIEW</a></div>
                </div>
                <div class="boardBlock npb">
                    <h5>일본리그 <span>|</span> <span>NPB</span></h5>
                    <ul class="mt-4">
                        <?php foreach ($npbList as $b) : ?>
                            <li title="<?= $b->title ?>"><a href="/view?league=npb&id=<?= $b->id ?>"><?= $b->title ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="moreBtn"><a href="/board?league=npb">MORE VIEW</a></div>
                </div>
                <div class="boardBlock cpbl">
                    <h5>대만리그 <span>|</span> <span>CPBL</span></h5>
                    <ul class="mt-4">
                        <?php foreach ($cpblList as $b) : ?>
                            <li title="<?= $b->title ?>"><a href="/view?league=cpbl&id=<?= $b->id ?>"><?= $b->title ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="moreBtn"><a href="/board?league=cpbl">MORE VIEW</a></div>
                </div>
            </div>
        </div>
    </div>
</section>