
function addClassLogin () {
    $(".awaitLogin").addClass("active");
}

function addClassRegister () {
    $(".awaitRegister").addClass("active");
}

function addClassContact () {
    $(".awaitContact").addClass("active");
}

function changeLanguage () {
    document.getElementById("language_form").submit();
}

function loadSiteUsersOnline () {
    $.get("/projects/cms/classes/General.php?onlineusers=result", function (data) {
        $(".users-site-online").text(data);
    });
}
setInterval(function () {
    loadSiteUsersOnline();
}, 500);


//TODO my function:

function commentReadMore (id) {
    let dots = `comment-dots-${id}`;
    let moreText = `comment-more-${id}`;
    let btnText = `comment-btn-${id}`;

    dots = document.getElementById(dots);
    moreText = document.getElementById(moreText);
    btnText = document.getElementById(btnText);

    if (dots.style.display === "none") {
        dots.style.display = "inline";
        btnText.innerHTML = "Read more";
        moreText.style.display = "none";
    } else {
        dots.style.display = "none";
        btnText.innerHTML = "Read less";
        moreText.style.display = "inline";
    }
}

//TODO my Modals:

// $(document).ready(function() {
//     $(".leave-comment").on('click', function() {

//         let url = `/projects/cms/post/${post_id}`;

//         $(".modal-leave-comment").attr("href", url);
//     });
// });