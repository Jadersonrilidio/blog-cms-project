
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
    $.get("/projects/blog-cms/classes/General.php?onlineusers=result", function (data) {
        $(".users-site-online").text(data);
    });
}
setInterval(function () {
    loadSiteUsersOnline();
}, 500);



const en = {
    COMMENT_READ_MORE: 'Read more',
    COMMENT_READ_LESS: 'Read less'
}
const es = {
    COMMENT_READ_MORE: 'Lea más',
    COMMENT_READ_LESS: 'Lea menos'
}
const pt = {
    COMMENT_READ_MORE: 'Leia mais',
    COMMENT_READ_LESS: 'Leia menos'
}
const ru = {
    COMMENT_READ_MORE: 'Подробнее',
    COMMENT_READ_LESS: 'Меньше'
}

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
