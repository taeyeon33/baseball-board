class Admin {
    constructor() {
        this.addEvent();
    }

    addEvent() {
        document.querySelectorAll("#userStopBtn").forEach(x => {
            x.addEventListener("click", e => {
                const c = confirm("정말 정지시키겠습니까?");
                if (!c) return;
                const userId = this.getId(e);
                const day = e.currentTarget.parentNode.parentNode.querySelector("input").value;
                if (day * 1 < 1 || !Number.isInteger(day * 1)) {
                    window.alertBox("1보다 큰 정수만 입력 가능합니다.");
                    return;
                }
                $.ajax({
                    url: "/userStop",
                    method: "POST",
                    data: { "id": userId, "day": day * 1 },
                    success: (e) => {
                        if (e == "성공") window.alertBox(`${userId}님의 사용을 ${day}일 정지 하였습니다.`);
                        else window.alertBox("DB오류 발생. 잠시후 다시 시도해주세요.");
                    }
                });
            });
        });

        document.querySelectorAll("#userDelBtn").forEach(x => {
            x.addEventListener("click", e => {
                const c = confirm("정말 삭제하시겠습니까?");
                if (!c) return;
                const userId = this.getId(e);
                $.ajax({
                    url: "/userDel",
                    method: "POST",
                    data: { "id": userId },
                    success: (e) => {
                        if (e == "성공") {
                            window.alertBox("삭제되었습니다.", true);
                            location.reload();
                        } else window.alertBox("DB오류 발생. 잠시후 다시 시도해주세요.");
                    }
                });
            });
        });
    }

    getId(e) {
        return e.currentTarget.parentNode.parentNode.parentNode.querySelector(".userId").innerText;
    }
}

window.addEventListener("load", () => {
    let admin = new Admin();
});