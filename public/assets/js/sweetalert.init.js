let sucessAlert =  function(title) {
    Swal.fire({
        icon: 'success',
        title: title,
    })
}

let errorAlert =  function(title) {
    Swal.fire({
        icon: 'error',
        title: title,
    })
}

let warningAalert = function (title, text) {
    return Swal.fire({
        title: title,
        text: text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: "Annuler",
        confirmButtonText: 'Oui, '+ title
    })
}