<?php


class Notifications {

    //main page constants
    const LOGGED_IN = 'logged-in';
    const LOGGED_OUT = 'logged-out';
    const REGISTERED = 'registered';
    const MAIL_SENT = 'mail-sent';
    const PASSWORD_RESET = 'password-reset';
    const COMMENT_SENT = 'comment-sent';
    const USER_UPDATED = 'user-updated';
    
    //populate_database constants
    const TRUNCATE_SUCCESS = 'truncate-success';
    const POPULATE_SUCCESS = 'populate-success';

    //admin page constants
    const POST_CREATED = 'post-created';
    const POST_DELETED = 'post-deleted';
    const POST_UPDATED = 'post-updated';
    const POST_SELECTION_CLONED = 'post-selection-cloned'; 
    const POST_SELECTION_PUBLISHED = 'post-selection-published';
    const POST_SELECTION_TO_DRAFT = 'post-selection-to-draft';
    const POST_SELECTION_DELETED = 'post-selection-deleted';
    const CAT_CREATED = 'cat-created'; 
    const CAT_UPDATED = 'cat-updated'; 
    const CAT_DELETED = 'cat-deleted'; 
    const COMMENT_DELETED = 'comment-deleted'; 
    const COMMENT_APPROVED = 'comment-approved'; 
    const COMMENT_UNAPPROVED = 'comment-unapproved';
    const COMMENT_SELECTION_DELETED = 'comment-selection-deleted'; 
    const COMMENT_SELECTION_APPROVED = 'comment-selection-approved'; 
    const COMMENT_SELECTION_UNAPPROVED = 'comment-selection-unapproved';
    const USER_ROLE_ADMIN = 'user-role-admin'; 
    const USER_ROLE_SUBSCRIBER = 'user-role-subscriber';
    const USER_SELECTION_ROLE_ADMIN = 'user-selection-role-admin'; 
    const USER_SELECTION_ROLE_SUBSCRIBER = 'user-selection-role-subscriber'; 

    static public function set_toastr_session (string $session_name) {
        $_SESSION[$session_name] = true;
    }

    static public function add_html_span (string $session_name) {
        if(isset($_SESSION[$session_name])) {
            echo "<span id='{$session_name}'> </span>";
            unset($_SESSION[$session_name]);
        } 
    }

    static public function toastr_notifications_call () {
        //main page span tags call
        Self::add_html_span(Self::LOGGED_IN);
        Self::add_html_span(Self::LOGGED_OUT);
        Self::add_html_span(Self::REGISTERED);
        Self::add_html_span(Self::MAIL_SENT);
        Self::add_html_span(Self::PASSWORD_RESET);
        Self::add_html_span(Self::COMMENT_SENT);
        Self::add_html_span(Self::USER_UPDATED);
        
        //populate_database span tags call
        Self::add_html_span(Self::POPULATE_SUCCESS);
        Self::add_html_span(Self::TRUNCATE_SUCCESS);

        //admin page span tags call
        Self::add_html_span(Self::POST_CREATED);
        Self::add_html_span(Self::POST_UPDATED);
        Self::add_html_span(Self::POST_DELETED);
        Self::add_html_span(Self::POST_SELECTION_DELETED);
        Self::add_html_span(Self::POST_SELECTION_CLONED);
        Self::add_html_span(Self::POST_SELECTION_PUBLISHED);
        Self::add_html_span(Self::POST_SELECTION_TO_DRAFT);
        Self::add_html_span(Self::CAT_CREATED);
        Self::add_html_span(Self::CAT_UPDATED);
        Self::add_html_span(Self::CAT_DELETED);
        Self::add_html_span(Self::COMMENT_APPROVED);
        Self::add_html_span(Self::COMMENT_UNAPPROVED);
        Self::add_html_span(Self::COMMENT_DELETED);
        Self::add_html_span(Self::COMMENT_SELECTION_APPROVED);
        Self::add_html_span(Self::COMMENT_SELECTION_UNAPPROVED);
        Self::add_html_span(Self::COMMENT_SELECTION_DELETED);
        Self::add_html_span(Self::USER_ROLE_ADMIN);
        Self::add_html_span(Self::USER_ROLE_SUBSCRIBER);
        Self::add_html_span(Self::USER_SELECTION_ROLE_ADMIN);
        Self::add_html_span(Self::USER_SELECTION_ROLE_SUBSCRIBER);
    }
}


?>