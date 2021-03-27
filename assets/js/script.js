function showRegister() {
    document.getElementById("register-container").style.display = "block";
    document.getElementById("register-form").style.display = "block";
    document.getElementById("login-container").style.display = "none";
    document.getElementById("login-form").style.display = "none";
}

function showLogin() {
    document.getElementById("login-container").style.display = "block";
    document.getElementById("login-form").style.display = "block";
    document.getElementById("register-container").style.display = "none";
    document.getElementById("register-form").style.display = "none";
}

function showHistory(email) {
    const url = 'https://wt98.fei.stuba.sk/authentication/api/historyApi.php';
    const request = new Request(url, {
        method: 'POST',
        body: JSON.stringify({
            email: email
        }),
        headers: {
            'Content-type': 'application/json; charset=UTF-8'
        }
    });
    fetch(request)
        .then((response) => response.json())
        .then((data) => {
            if (!data.error) {
                console.log(data.status);
                document.getElementById("history-table").style.visibility = "";
                let body = document.getElementById("history-table-body");
                let html = "";
                JSON.parse(data.results).forEach(item => {
                    let innerHTML =
                        "<tr>" +
                        "<td>" +
                        item.email +
                        "</td>" +
                        "<td>" +
                        item.time +
                        "</td>" +
                        "<td>" +
                        item.login_method +
                        "</td>" +
                        "</tr>";

                    html += innerHTML;
                })
                body.innerHTML = html;
            }else{
                console.log(data.status);
            }
        });
}

