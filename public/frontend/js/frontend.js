$('#addmailtonewsletters').on('click', function (e) {
    e.preventDefault()
    let email = $('#newslettermail').val()
    if (email.length == 0){
        launch_toast('Veuillez renseigner votre email')
    } else{
        $.ajax({
            url: '/newsletter/add',
            data:{
                email : email,
            },
            type:"post",
            success:function(msg){
                document.getElementById("newslettermail").value = ""
                    launch_toast(msg)
            }
        })
    }
})

function launch_toast(message) {
    var x = document.getElementById("toast")
    setTimeout(function(){$('#desc').html(message)}, 500);
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", "");}, 5000);
}

$('#submitcontact').on("click", function (e) {
    e.preventDefault()
    if ($('#username').val() == ""){
      launch_toast("veuillez saisir votre nom complet")
    }
    else if ($('#email').val() == ""){
  launch_toast("veuillez saisir votre email")
    }
    else if ($('#sujet').val() == ""){
        launch_toast("veuillez saisir votre sujet")
    }
    else if ($('#message').val() == ""){
       launch_toast("veuillez saisir message")
    }
   else{
        $('.contactloader').show()
        $.ajax({
            url: '/contact/add',
            data:{
                username : $('#username').val(),
                email : $('#email').val(),
                sujet : $('#sujet').val(),
                message : $('#message').val(),
            },
            type:"post",
            success:function(msg){
                    $('.contactloader').hide()
                    launch_toast(msg)
                    document.getElementById("username").value = ""
                    document.getElementById("email").value = ""
                    document.getElementById("sujet").value = ""
                    document.getElementById("message").value = ""

            }
        })
    }


})

$(".mega").hover(function (e) {
    e.preventDefault()
    $(".sservice").hide()
    $(".sproduit").hide()
    $(".mega-menu").show()
})

$(".mega-menu").mouseleave(function (e) {
    e.preventDefault()
    $(".mega-menu").hide()
})




$(".produit").hover(function (e) {
    e.preventDefault()
    $(".sproduit").show()
    $(".mega-menu").hide()
    $(".sservice").hide()
})

$(".sproduit").mouseleave(function (e) {
    e.preventDefault()
    $(".sproduit").hide()
})




$(".service").hover(function (e) {
    e.preventDefault()
    $(".sproduit").hide()
    $(".mega-menu").hide()
    $(".sservice").show()
})

$(".sservice").mouseleave(function (e) {
    e.preventDefault()
    $(".sservice").hide()
})

$(".sservice").mouseleave(function (e) {
    e.preventDefault()
    $(".sservice").hide()
})


