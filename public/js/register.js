class Register {
    constructor() {
        this.id = document.querySelector("#id");
        this.name = document.querySelector("#name");
        this.pw = document.querySelector("#password");
        this.pwc = document.querySelector("#passwordc");
        this.regBtn = document.querySelector("#registerBtn");

        this.addEvent();
    }

    addEvent() {
        window.addEventListener("keydown", e => { if (e.keyCode == 13) { this.register(); } });
        this.regBtn.addEventListener("click", () => { this.register(); });
    }

    register() {
        const id = this.id.value;
        const name = this.name.value;
        const pw = this.pw.value;
        const pwc = this.pwc.value;

        if (!this.check(id, name, pw, pwc)) return;

        const regData = { "id": id, "name": name, "password": pw, "passwordc": pwc };
        $.ajax({
            url: "/registerCheck",
            method: "POST",
            data: regData,
            success: (e) => {
                if (e == "중복") {
                    window.alertBox("아이디가 중복됩니다.");
                } else if (e) {
                    window.alertBox("회원가입 되었습니다.", true);
                    setTimeout(() => { location.href = "/login" }, 500);
                } else {
                    window.alertBox("DB 오류 발생. 잠시후 다시 시도해주세요.");
                }
            }
        });
    }

    check(id, name, pw, pwc) {
        if (id.trim() == "" || name.trim() == "" || pw.trim() == "" || pwc.trim() == "") {
            window.alertBox("빈 값이 있습니다.");
            return false;
        }
        if (id == pw) {
            window.alertBox("아이디와 비밀번호를 다르게 입력해주세요.");
            return false;
        }
        const idStr = /[A-Za-z0-9]{8,12}/g;
        const pwStr = /(?=.*[A-Za-z])(?=.*\d)(?=.*[!@#$%^&*()])[A-Za-z\d!@#$%^&*()]{3,}/g;
        if (id.match(idStr) == null || id.match(idStr)[0] != id) {
            window.alertBox("아이디는 영문과 숫자를 사용하여 8~12글자여야 합니다.");
            return;
        }
        if (pw.match(pwStr) == null || pw.match(pwStr)[0] != pw) {
            window.alertBox("비밀번호는 영문, 특수문자, 숫자를 모두 포함하여야 합니다.");
        }
        if (pw !== pwc) {
            window.alertBox("비밀번호와 확인이 일치하지 않습니다.");
            return false;
        }

        return true;
    }
}

window.addEventListener("load", () => {
    let register = new Register();
});