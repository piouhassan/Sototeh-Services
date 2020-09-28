(function () {
    let form = document.querySelector('#js-scategory-form')
    let formBtn = form.querySelector('button')
    form.addEventListener('submit', function (e) {
        e.preventDefault()
        formBtn.disabled = true
        formBtn.querySelector('#spinner').style.display = 'inline-block'
        let data = new FormData(form)
        let url = form.getAttribute('action')
        post(url, data, function (xhr) {
            clearInputsValue(form)
            sucessAlert('La sous catégories à été ajouté avec success')
            formBtn.disabled = false
            formBtn.querySelector('#spinner').style.display = 'none'
            $('#js-table').load(document.URL + '#body  tr')
        }, function (xhr) {
            let response = JSON.parse(xhr.responseText)
            input_errors(form, response)
            formBtn.disabled = false
            formBtn.querySelector('#spinner').style.display = 'none'
        })
    })

})();
(function () {
    let table = document.querySelector('#js-table')
    table.addEventListener('click', function (e) {
        e.preventDefault()
        if (e.target.classList.contains('js-delete')) {
            let url = e.target.getAttribute('data-url')
            warningAalert('Supprimer', 'Etes vous sur ?').then(function (result) {
                if (result.value) {
                    get(url, function (xhr) {
                        sucessAlert('La sous catégories a été supprimée')
                        $('#js-table').load(document.URL + '#body  tr')
                    }, function (xhr) {
                        errorAlert()
                    })
                }
            })
        }
        if (e.target.classList.contains('js-unlock')) {
            let url = e.target.getAttribute('data-url')
            warningAalert('Bloquer', 'La sou satégorie sera bloquer').then(function (result) {
                if (result.value) {
                    get(url, function (xhr) {
                        sucessAlert('La sous catégories a été supprimée')
                        $('#js-table').load(document.URL + '#body  tr')
                    }, function (xhr) {
                        errorAlert('Oops...')
                    })
                }
            })
        }
        if (e.target.classList.contains('js-lock')) {
            let url = e.target.getAttribute('data-url')
            warningAalert('Bloquer', 'La sous catégorie sera bloquer').then(function (result) {
                if (result.value) {
                    get(url, function (xhr) {
                        sucessAlert('La sous catégories a été supprimée')
                        $('#js-table').load(document.URL + '#body  tr')
                    }, function (xhr) {
                        errorAlert('Oops...')
                    })
                }
            })
        }
    })
})();
(function () {
    let forms = document.querySelectorAll('.js-scategory-form')
    forms.forEach(form => {
        let formBtn = form.querySelector('button')
        form.addEventListener('submit', function (e) {
            e.preventDefault()
            formBtn.disabled = true
            formBtn.querySelector('img').style.display = 'inline-block'
            let data = new FormData(form)
            let url = form.getAttribute('action')
            post(url, data, function (xhr) {
                sucessAlert('La sous catégories à été mis à jour avec success')
                formBtn.disabled = false
                formBtn.querySelector('img').style.display = 'none'
                $('#js-table').load(document.URL + '#body  tr')
            }, function (xhr) {
                let response = JSON.parse(xhr.responseText)
                input_errors(form, response)
                formBtn.disabled = false
                formBtn.querySelector('img').style.display = 'none'
            })
        })
    })
})();