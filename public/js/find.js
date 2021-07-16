class Find {
    constructor() {
        this.addEvent();
    }

    addEvent() {
        const navList = document.querySelectorAll(".nav-item");
        navList.forEach(x => {
            x.addEventListener("click", e => {
                navList.forEach(x => { x.querySelector("a").classList.remove("selected"); });
                e.currentTarget.querySelector("a").classList.add("selected");
            });
        });

        window.addEventListener("keydown", e => {
            if (e.keyCode == 13) {
                if (document.location.href.slice(-7) == "#pwFind") document.querySelector("#pwFindBtn").click();
                else document.querySelector("button").click();
            }
        });
        if (document.querySelector("#idFindBtn")) {
            document.querySelector("#idFindBtn").addEventListener("click", () => { this.idFind(); });
            document.querySelector("#pwFindBtn").addEventListener("click", () => { this.pwFind(); });
        } else {
            document.querySelector("#pwChangeBtn").addEventListener("click", () => { this.pwChange(); });
        }
    }

    idFind() {
        const name = document.querySelector("#idfindname");
        const userList = document.querySelector("#list");
        userList.innerHTML = "";
        let list = [];

        if (name.value.trim() === "") {
            window.alertBox("빈 값이 있습니다.");
            return;
        }

        $.ajax({
            url: "/idFind",
            method: "POST",
            data: { "name": name.value },
            success: (e) => {
                log(e);
                list = JSON.parse(e);
                log(list);
            }
        });

        setTimeout(() => {
            list.forEach(x => {
                const div = document.createElement("div");
                div.classList.add("user");
                const id = document.createElement("span");
                id.innerHTML = x.id.substr(0, x.id.length - 2) + "**";
                const name = document.createElement("span");
                name.innerHTML = x.name;
                div.appendChild(id);
                div.appendChild(name);
                userList.appendChild(div);
            });
        }, 100);
    }

    pwFind() {
        const id = document.querySelector("#pwfindid");
        const name = document.querySelector("#pwfindname");

        if (id.value.trim() === "" || name.value.trim() === "") {
            window.alertBox("빈 값이 있습니다.");
            return;
        }

        $.ajax({
            url: "/pwFind",
            method: "POST",
            data: { "id": id.value, "name": name.value },
            success: (e) => {
                if (e == "변경 완료") {
                    window.alertBox("임시 비밀번호(12345678)로 변경되었습니다.", true);
                    setTimeout(() => { location.href = "/login" }, 500);
                } else if ("관리자") {
                    window.alertBox("관리자는 비밀번호 찾기를 할 수 없습니다.");
                } else {
                    window.alertBox("입력하신 아이디 또는 이름이 없습니다.");
                }
            }
        });
    }

    pwChange() {
        const nowPw = document.querySelector("#nowPw");
        const newPw = document.querySelector("#newPw");
        const newPwCheck = document.querySelector("#newPwCheck");

        if (nowPw.value.trim() === "" || newPw.value.trim() === "" || newPwCheck.value.trim() === "") {
            window.alertBox("빈 값이 있습니다.");
            return;
        }

        const pwStr = /(?=.*[A-Za-z])(?=.*\d)(?=.*[!@#$%^&*()])[A-Za-z\d!@#$%^&*()]{3,}/g;
        if (newPw.value.match(pwStr) == null || newPw.value.match(pwStr)[0] != newPw.value) {
            window.alertBox("비밀번호는 영문, 특수문자, 숫자를 모두 포함하여야 합니다.");
            return;
        }

        const arr = { "nowPw": nowPw.value, "newPw": newPw.value, "newPwCheck": newPwCheck.value };
        $.ajax({
            url: "/pwChange",
            method: "POST",
            data: arr,
            success: (e) => {
                if (e == "DB오류") {
                    window.alertBox("현재 비밀번호를 바르게 입력해주세요.");
                } else if (e.trim() == "") {
                    window.alertBox("비밀번호와 확인이 일치하지 않습니다.");
                } else {
                    window.alertBox("비밀번호가 변경되었습니다.", true);
                    setTimeout(() => { location.href = "/" }, 500);
                }
            }
        });
    }
}

window.addEventListener("load", () => {
    let find = new Find();
});