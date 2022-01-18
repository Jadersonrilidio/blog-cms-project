toastr.options.positionClass = "toast-top-right";
toastr.options.showMethod = "show";
toastr.options.hideMethod = "hide";

function mainNotificationsCall (lang) {
    if (document.getElementById('logged-in')) toastr.success(lang.LOGGED_IN);
    if (document.getElementById('logged-out')) toastr.error(lang.LOGGED_OUT);
    if (document.getElementById('registered')) toastr.success(lang.REGISTERED);
    if (document.getElementById('mail-sent')) toastr.success(lang.MAIL_SENT);
    if (document.getElementById('password-reset')) toastr.success(lang.PASSWORD_RESET);
    if (document.getElementById('comment-sent')) toastr.success(lang.COMMENT_SENT);
    if (document.getElementById('user-updated')) toastr.success(lang.USER_UPDATED);
    
    if (document.getElementById('populate-success')) toastr.success('Database populate done!');
    if (document.getElementById('truncate-success')) toastr.success('Truncate tables done!');
}

function adminNotificationsCall (lang) {
    //admin page notifications call
    if (document.getElementById('logged-in')) toastr.success(lang.LOGGED_IN);
    if (document.getElementById('logged-out')) toastr.error(lang.LOGGED_OUT);
    if (document.getElementById('post-created')) toastr.success(lang.POST_CREATED);
    if (document.getElementById('post-deleted')) toastr.success(lang.POST_DELETED);
    if (document.getElementById('post-updated')) toastr.success(lang.POST_UPDATED);
    if (document.getElementById('post-selection-published')) toastr.success(lang.POST_SELECTION_PUBLISHED);
    if (document.getElementById('post-selection-to-draft')) toastr.success(lang.POST_SELECTION_TO_DRAFT);
    if (document.getElementById('post-selection-cloned')) toastr.success(lang.POST_SELECTION_CLONED);
    if (document.getElementById('post-selection-deleted')) toastr.success(lang.POST_SELECTION_DELETED);
    if (document.getElementById('cat-created')) toastr.success(lang.CAT_CREATED);
    if (document.getElementById('cat-updated')) toastr.success(lang.CAT_UPDATED);
    if (document.getElementById('cat-deleted')) toastr.success(lang.CAT_DELETED);
    if (document.getElementById('comment-deleted')) toastr.success(lang.COMMENT_DELETED);
    if (document.getElementById('comment-approved')) toastr.success(lang.COMMENT_APPROVED);
    if (document.getElementById('comment-unapproved')) toastr.success(lang.COMMENT_UNAPPROVED);
    if (document.getElementById('comment-selection-deleted')) toastr.success(lang.COMMENT_SELECTION_DELETED);
    if (document.getElementById('comment-selection-approved')) toastr.success(lang.COMMENT_SELECTION_APPROVED);
    if (document.getElementById('comment-selection-unapproved')) toastr.success(lang.COMMENT_SELECTION_UNAPPROVED);
    if (document.getElementById('user-role-admin')) toastr.success(lang.USER_ROLE_ADMIN);
    if (document.getElementById('user-role-subscriber')) toastr.success(lang.USER_ROLE_SUBSCRIBER);
    if (document.getElementById('user-selection-role-admin')) toastr.success(lang.USER_SELECTION_ROLE_ADMIN);
    if (document.getElementById('user-selection-role-subscriber')) toastr.success(lang.USER_SELECTION_ROLE_SUBSCRIBER);
}
