(function () {
    let form = document.querySelector('#js-form-profile')
    let formBtn = form.querySelector('button')
    form.addEventListener('submit', (e)=> {
        e.preventDefault()
        formBtn.disabled = true
        formBtn.querySelector('#spinner').style.display = 'inline-block'
        let data = new FormData(form)

        let url = form.getAttribute('action')
        post(url, data, (xhr) => {
            Swal.fire({
                icon: 'success',
                title: 'Profile mis à jour',
            })
            formBtn.disabled = false
            formBtn.querySelector('#spinner').style.display = 'none'
        }, (xhr) => {
            let response = JSON.parse(xhr.responseText)
            input_errors(form, response.errors)
            formBtn.disabled = false
            formBtn.querySelector('#spinner').style.display = 'none'
        })
    })
})();

(function () {
    let form = document.querySelector('#js-form-password')
    let formBtn = form.querySelector('button')
    form.addEventListener('submit', (e)=> {
        e.preventDefault()
        formBtn.disabled = true
        formBtn.querySelector('#spinner').style.display = 'inline-block'
        let data = new FormData(form)
        let url = form.getAttribute('action')
        post(url, data, (xhr) => {
            Swal.fire({
                icon: 'success',
                title: 'Mot de passe modifié',
            })
            formBtn.disabled = false
            formBtn.querySelector('#spinner').style.display = 'none'
            clearInputsValue(form)
        }, (xhr) => {
            let response = JSON.parse(xhr.responseText)
            console.log(response)
            input_errors(form, response.errors)
            formBtn.disabled = false
            formBtn.querySelector('#spinner').style.display = 'none'
            clearInputsValue(form)
        })
    })
})();

(function () {
    let picture = document.querySelector('#photo')
    let form = document.querySelector('#js-form-picture')
    let img = document.querySelector('#js-profile-picture')
    picture.addEventListener('change', function (e) {
        e.preventDefault()
        let url = form.getAttribute('action')
        let data = new FormData(form)
        let photo = data.get('photo')
        let p = document.querySelector('#photo').files[0]
        let reader = new FileReader()
        reader.onloadend = function() {
        	img.src = reader.result
        }
        if (p) {
        	reader.readAsDataURL(p)
        }
        post(url, data, function (xhr) {
            let response = JSON.parse(xhr.responseText)
            img.src = response.photo
        }, function (xhr) {
            let response = JSON.parse(xhr.responseText)
            if (response.error) {
                Swal.fire({
                    icon: 'error',
                    title: response.error,
                })
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops..',
                })
            }

        })
    })
})();