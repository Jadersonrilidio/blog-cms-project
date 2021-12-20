
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

function loadUsersAdminOnline () {
    $.get("/projects/cms/admin/functions/admin_functions.php?onlineusers=result", function (data) {
        $(".users-admin-online").text(data);
    });
}
setInterval(function () {
    loadUsersAdminOnline();
}, 500);

//TODO - Modal Functions

$(document).ready(function() {
    $(".delete-post").on('click', function() {
        let post_id = $(this).attr("pid");
        let user_id = $(this).attr("uid");
        
        let url = `/projects/cms/admin/posts/delete/${post_id}`;
        if (user_id) url = `/projects/cms/admin/posts/${user_id}/delete/${post_id}`;

        $(".modal-delete-post").attr("href", url);
    });
});

$(document).ready(function() {
    $(".delete-comment").on('click', function() {
        let comment_id = $(this).attr("cid");
        let post_id = $(this).attr("pdi") || null;
        let author_id = $(this).attr("adi") || null;
        
        let url = `/projects/cms/admin/comments/delete/${comment_id}`;
        if (post_id) url = `/projects/cms/admin/comments/post/${post_id}/delete/${comment_id}`;
        if (author_id) url = `/projects/cms/admin/comments/author/${author_id}/delete/${comment_id}`;

        $(".modal-delete-comment").attr("href", url);
    });
});

$(document).ready(function() {
    $(".delete-user").on('click', function() {
        let user_id = $(this).attr("rel");
        
        let delete_url = `index.php?page=users&source=user_delete&user_id=${user_id}`;

        $(".modal-delete-user").attr("href", delete_url);
    });
});

$(document).ready(function() {
    $(".delete-category").on('click', function() {
        let cat_id = $(this).attr("rel");
        let delete_url = `/projects/cms/admin/categories/delete/${cat_id}`;
        $(".modal-delete-category").attr("href", delete_url);
    });
});
