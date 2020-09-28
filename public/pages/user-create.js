(function () {
   let userForm = document.querySelector('#user-form')
   let formBtn = userForm.querySelector('button')
    let url = userForm.getAttribute('action')
    userForm.addEventListener('submit', (e) => {
        e.preventDefault()
        formBtn.disabled = true
        formBtn.querySelector('#spinner').style.display = 'inline-block'
        let data = new FormData(userForm)
        post(url, data,  (xhr) => {
            Swal.fire({
                title: 'Utilisateur ajouté',
                text: "Voulez-vous ajouter un nouveau ?",
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#02a499',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ajouter un nouveau',
                cancelButtonText: 'Quitter'
            }).then((result) => {
                if (result.value === undefined) {
                    window.location.href = '/admin/users'
                }
            })
            formBtn.disabled = false
            clearInputsValue(userForm)
        }, (xhr) => {
            if (xhr.status === 500) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                })
                formBtn.disabled = false
                formBtn.querySelector('#spinner').style.display = 'none'
            } else {
                let respone = JSON.parse(xhr.responseText)
                input_errors(userForm, respone.errors)
                formBtn.disabled = false
                formBtn.querySelector('#spinner').style.display = 'none'
            }
        })
    })
})()