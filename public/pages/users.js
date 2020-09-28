(function () {
    let table = document.querySelector('#user-table')
    table.addEventListener('click', function (e) {
        e.preventDefault()
        if (e.target.classList.contains('user-unlock')) {
            let url = e.target.getAttribute('data-url')
            Swal.fire({
                title: 'Débloquer',
                text: "Vous êtes sur ?, l'utilisateur sera débloquer",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: "Annuler",
                confirmButtonText: 'Oui, Débloquer'
            }).then((result) => {
                if (result.value) {
                    get(url, function (xhr) {
                        Swal.fire(
                            'Bloquer!',
                            "L'utilisateur a été débloquer",
                            'success'
                        )
                        $('#user-table').load(document.URL + '#body  tr')
                    }, function (xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                        })
                    })
                }
            })
        }
        if (e.target.classList.contains('user-lock')) {
            let url = e.target.getAttribute('data-url')
            Swal.fire({
                title: 'Bloquer',
                text: "Vous êtes sur ?, l'utilisateur sera bloquer",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: "Annuler",
                confirmButtonText: 'Oui, Bloquer'
            }).then((result) => {
                if (result.value) {
                    get(url, function (xhr) {
                        Swal.fire(
                            'Bloquer!',
                            "L'utilisateur a été bloquer",
                            'success'
                        )
                        $('#user-table').load(document.URL + '#body  tr')
                    }, function (xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                        })
                    })
                }
            })
        }
        if (e.target.classList.contains('user-delete')) {
            let url = e.target.getAttribute('data-url')
            Swal.fire({
                title: 'Supprimer',
                text: "Vous êtes sur ?, l'utilisateur sera supprimer définitivement",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, Supprimer le'
            }).then((result) => {
                if (result.value) {
                    get(url, function (xhr) {
                        Swal.fire(
                            'Supprimer!',
                            "L'utilisateur a été supprimer",
                            'success'
                        )
                        let tr = btn.parentNode.parentNode
                        tr.remove()
                    }, function (xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                        })
                    })
                }
            })
        }
    })
})();