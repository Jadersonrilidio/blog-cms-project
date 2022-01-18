const REL_PATH = '/';
const ADMIN_REL_PATH = '/admin/';

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
    $.get((REL_PATH + "classes/General.php?onlineusers=result"), function (data) {
        $(".users-site-online").text(data);
    });
}
setInterval(function () {
    loadSiteUsersOnline();
}, 5000);

function commentReadMore (id, lang) {
    let dots = `comment-dots-${id}`;
    let moreText = `comment-more-${id}`;
    let btnText = `comment-btn-${id}`;

    dots = document.getElementById(dots);
    moreText = document.getElementById(moreText);
    btnText = document.getElementById(btnText);

    if (dots.style.display === "none") {
        dots.style.display = "inline";
        btnText.innerHTML = lang.COMMENT_READ_MORE;
        moreText.style.display = "none";
    } else {
        dots.style.display = "none";
        btnText.innerHTML = lang.COMMENT_READ_LESS;
        moreText.style.display = "inline";
    }
}
