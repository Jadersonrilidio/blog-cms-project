
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


function loadUsersOnline () {
    $.get("./includes/admin_functions.php?onlineusers=result", function(data) {
        $(".users-online").text(data);
    });
}
setInterval(function () {
    loadUsersOnline();
}, 500);


$(document).ready(function() {
    $(".delete-post").on('click', function() {
        let post_id = $(this).attr("rel");
        let user_id = $(this).attr("rel2");
        
        let delete_url = `index.php?page=posts&source=delete_post&post_id=${post_id}`;
        if (user_id) delete_url = `index.php?page=posts&source=delete_post&user_id=${user_id}&post_id=${post_id}`;

        $(".modal-delete-post").attr("href", delete_url);
    });
});

$(document).ready(function() {
    $(".delete-comment").on('click', function() {
        let comment_id = $(this).attr("rel");
        let post_id = $(this).attr("rel2");
        
        let delete_url = `index.php?page=comments&source=delete_comment&comment_id=${comment_id}`;
        if (post_id) delete_url = `index.php?page=comments&source=delete_comment&post_id=${post_id}&comment_id=${comment_id}`;

        $(".modal-delete-comment").attr("href", delete_url);
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
        
        let delete_url = `index.php?page=categories&cat_delete=${cat_id}`;

        $(".modal-delete-category").attr("href", delete_url);
    });
});

