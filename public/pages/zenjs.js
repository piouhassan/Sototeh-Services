/**
 * @Author Michel Akpabla
 * @Email michel.akpabla2@gmail.com
 */


/**
 * Permet de faire des requêtes ajax en get
 * @param url
 * @param success
 * @param fail
 */
const get = function (url, success, fail) {
    let xhr = new XMLHttpRequest()
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                success(xhr)
            } else {
                fail(xhr)
            }
        }
    }
    xhr.open('GET', url, true)
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest')
    xhr.send()
}

/**
 * Permet de faire des requêtes ajax en post
 * @param url
 * @param data
 * @param success
 * @param fail
 */
const post = function (url, data,  success, fail) {
    let xhr = new XMLHttpRequest()
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                success(xhr)
            } else {
                fail(xhr)
            }
        }
    }
    xhr.open('POST', url, true)
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest')
    xhr.send(data)
}

let select = function(selector) {
    return document.querySelector(selector)
}
let selects = function(selectors) {
    return document.querySelectorAll(selectors)
}

let input_errors = function(form, errors) {
    let errorElements = form.querySelectorAll('.is-invalid');
    for (let i = 0; i < errorElements.length; i++) {
        errorElements[i].classList.remove('is-invalid');
        let p = errorElements[i].parentNode.querySelector('.text-danger');
        if (p) {
            p.parentNode.removeChild(p);
        }
    }
    let errorsKey = Object.keys(errors);
    for (let i = 0; i < errorsKey.length; i++) {
        let key = errorsKey[i];
        let  error = errors[key]
        let input = form.querySelector(`input[name='${key}']`)
        if(input == null) { input = form.querySelector(`select[name='${key}']`) }
        if(input == null) { input = form.querySelector(`textarea[name='${key}']`) }
        let p = document.createElement('p');
        p.className = 'text-danger';
        p.innerHTML = error;
        input.classList.add('is-invalid');
        input.parentNode.appendChild(p);
    }
}

let clearInputsValue = function(form) {
    form.querySelectorAll('input, textarea').forEach(input => input.value = '');
}