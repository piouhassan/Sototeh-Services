(function () {
    let loginForm = document.querySelector('#login-form')
    let formBtn = loginForm.querySelector('button')
    loginForm.addEventListener('submit', function (e) {
        e.preventDefault()
        formBtn.disabled = true;
        formBtn.querySelector('#spinner').style.display = 'inline-block'
        let url = loginForm.getAttribute('action')
        let data = new FormData(loginForm)
        post(url, data, (xhr) => {
            window.location.href = '/admin';
        }, (xhr) => {
            let response = JSON.parse(xhr.responseText)
            document.querySelectorAll('.alert').forEach(alert => alert.remove())
            if(response.msg) {
                loginForm.insertAdjacentHTML('afterbegin', "<div class=\"alert alert-danger\">"+ response.msg +"</div>") 
            } else {
                loginForm.insertAdjacentHTML('afterbegin', "<div class=\"alert alert-danger\">Identifiant ou mot de passe incorrecte</div>")
            }
            formBtn.disabled = false;
            formBtn.querySelector('#spinner').style.display = 'none'
        })
    })
})()