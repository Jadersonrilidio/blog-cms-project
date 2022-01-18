const REL_PATH = '/';
const ADMIN_REL_PATH = '/admin/';


$(document).ready(function() {
    $('#summernote').summernote({
        height: 200
    });
});

$(document).ready(function () {
    $('#selectAllBoxes').click(function (event) {
        if (this.checked) {
            $('.checkBoxes').each(function () {
                this.checked = true;
            });
        } else {
            $('.checkBoxes').each(function () {
                this.checked = false;
            });
        }
    });  
});

$(document).ready(function () {
    $("body").prepend("<div id='load-screen'><div id='loading'></div></div>");
    $('#load-screen').delay(100).fadeOut(300, function() {
        $(this).remove();
    });
});

$(document).ready(function () { 
    $('.my-status-msg-box').delay(1500).fadeOut(1500, function() {
        $(this).remove();
    });
});

function loadSiteUsersOnline () {
    $.get((REL_PATH + "classes/General.php?onlineusers=result"), function (data) {
        $(".users-site-online").text(data);
    });
}
setInterval(function () {
    loadSiteUsersOnline();
}, 5000);

//TODO - Modal Functions

$(document).ready(function() {
    $(".delete-post").on('click', function() {
        let post_id = $(this).attr("pid");
        let user_id = $(this).attr("uid");
        
        let url = `${ADMIN_REL_PATH}/posts/delete/${post_id}`;
        if (user_id) url = `${ADMIN_REL_PATH}posts/${user_id}/delete/${post_id}`;

        $(".modal-delete-post").attr("href", url);
    });
});

$(document).ready(function() {
    $(".delete-comment").on('click', function() {
        let comment_id = $(this).attr("cid");
        let post_id = $(this).attr("pdi") || null;
        let author_id = $(this).attr("adi") || null;
        
        let url = `${ADMIN_REL_PATH}comments/delete/${comment_id}`;
        if (post_id) url = `${ADMIN_REL_PATH}comments/post/${post_id}/delete/${comment_id}`;
        if (author_id) url = `${ADMIN_REL_PATH}comments/author/${author_id}/delete/${comment_id}`;

        $(".modal-delete-comment").attr("href", url);
    });
});

$(document).ready(function() {
    $(".delete-category").on('click', function() {
        let cat_id = $(this).attr("rel");
        let delete_url = `${ADMIN_REL_PATH}categories/delete/${cat_id}`;
        $(".modal-delete-category").attr("href", delete_url);
    });
});
