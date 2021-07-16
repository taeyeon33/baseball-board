class Login {
    constructor() {
        this.id = document.querySelector("#id");
        this.pw = document.querySelector("#password");
        this.loginBtn = document.querySelector("#loginBtn");

        this.addEvent();
    }

    addEvent() {
        window.addEventListener("keydown", e => { if (e.keyCode == 13) { this.login(); } });
        this.loginBtn.addEventListener("click", () => { this.login(); });
    }

    login() {
        const id = this.id.value;
        const pw = this.pw.value;

        if (id.trim() == "" || pw.trim() == "") {
            window.alertBox("빈 값이 있습니다.");
            return;
        }

        const loginData = { "id": id, "password": pw };
        $.ajax({
            url: "/loginCheck",
            method: "POST",
            data: loginData,
            success: (e) => {
                if (e == "정지") {
                    window.alertBox("정지된 아이디 입니다.");
                    return;
                }
                if (e) {
                    window.alertBox("성공적으로 로그인 되었습니다.", true);
                    setTimeout(() => { location.href = "/" }, 500);
                } else window.alertBox("가입하지 않은 아이디이거나, 잘못된 비밀번호입니다.");
            }
        });
    }
}

window.addEventListener("load", () => {
    let login = new Login();
});