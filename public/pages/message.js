(function () {
    let links = document.querySelectorAll('.js-delete')
    links.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault()
            let url = e.target.getAttribute('data-url')
            warningAalert('Supprimer', 'Etes vous sur ?').then(function (result) {
                if (result.value) {
                    get(url, function (xhr) {
                        sucessAlert('Le message a été supprimée')
                        window.location.href = document.URL
                    }, function (xhr) {
                        errorAlert()
                    })
                }
            })
        })
    })
})();