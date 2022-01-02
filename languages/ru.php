<?php

//header <html lang="en">
const HEAD_TITLE = 'Проект CMS'; 

//navigation bar
const NAV_HOME = 'Главная'; 
const NAV_CONTACT = 'Контакт'; 
const NAV_LOGIN = 'Войти'; 
const NAV_REGISTER = 'Регистрация'; 
const NAV_LOGOUT = 'Выйти'; 
const NAV_PROFILE = 'Профиль'; 
const NAV_ADMIN = 'Администратор';
const NAV_DROPDOWN = 'Войти / Регистрация';
const NAV_CATEGORY = 'Категории';

//sidebar
const SIDEBAR_SEARCH_BOX = 'Поиск'; 
const SIDEBAR_SEARCH_PLACEHOLDER = 'Найди'; 
const SIDEBAR_GREETING_USER_BOX = "Добро Пожаловать! "; 
const SIDEBAR_LOGOUT_BTN = 'Выйти'; 
const SIDEBAR_PROFILE_BTN = 'Профиль'; 
const SIDEBAR_LOGIN_BTN = 'Войти'; 
const SIDEBAR_USERNAME_PLACEHOLDER = 'Имя Пользователя'; 
const SIDEBAR_PASSWORD_PLACEHOLDER = 'Пароль'; 
const SIDEBAR_FORGOT_PASSWORD = 'Забыл пароль?'; 
const SIDEBAR_CATEGORIES_BOX = 'Категории';
const SIDEBAR_WIDGET_BOX = 'Виджеты'; 
const SIDEBAR_USERS_ONLINE = 'Пользователи Онлайн: '; 

//footer
const FOOTER_TEXT = 'Copyright &copy; Jay Website 2021'; 

//index page
const PAGE_HEADER =  'Последние Посты'; 
const PAGE_NO_POSTS = 'Никаких Постов'; 
const PAGE_POST_AUTHOR = 'Автор: '; 
const PAGE_POST_POSTED_ON = 'Опубликовано на '; 
const PAGE_POST_LAST_UPDATE = 'Последнее обновление '; 
const PAGE_READ_MORE_BTN = 'Подробнее'; 

//author page
const PAGE_AUTHOR_TITLE = 'Пост от ';
const PAGE_AUTHOR_NO_POSTS = 'Никаких Постов от этого автора';

//category page
const PAGE_CATEGORY_NO_POSTS = 'Никаких Посты из этой категории';

//search page
const PAGE_SEARCH_TITLE = 'Результаты поиска для ';
const PAGE_SEARCH_NO_POSTS = 'Не найдено результатов для ';

//post page
const COMMENT_TITLE = 'Оставьте комментарий';
const COMMENT_CONTENT_LABEL = 'Комментарий';
const COMMENT_READ_MORE = 'Подробнее';
const PAGE_POST_VIEW_ALL_POSTS = 'Просмотреть все Посты';
const PAGE_POST_EDIT_POST = 'Редактировать Пост';
const COMMENT_BTN = 'Отправить';

//contact page
const PAGE_CONTACT_TITLE = 'Контакт';
const SUBJECT = 'Предмет';
const SUBJECT_INPUT = 'Предмет';
const SEND_BTN = 'Отправить Электронное Письмо';

//login page
const PAGE_LOGIN_TITLE = 'Войти';
const PAGE_LOGIN_REGISTER_LINK = "Я не пользователь! - Страница Регистрации";
const LOGIN_BTN = 'Войти';

//profile page
const PROFILE_TITLE = 'Профиль Пользователя';
const PROFILE_IMAGE = 'Загрузить Изображение';
const PROFILE_SAVE_CHANGES = 'сохранить изменения';
const PROFILE_IMG_PLACEHOLD = 'Профиль+Изображении';
const PROFILE_LANG = 'Язык';
const PROFILE_CHANGE_PSWD = 'Изменить Пароль';
const PROFILE_CURRENT_PSWD = 'текущий Пароль';
const PROFILE_NEW_PSWD = 'Новый Пароль';
const PROFILE_RPT_PSWD = 'Повторите Пароль';
const CHANGE_PASSWORD_BTN = 'Изменить Пароль';

//forgot page
const PAGE_FORGOT_TITLE = 'Забыл пароль?';
const PAGE_FORGOT_SUBTITLE = 'Вы можете запросить новое здесь.';
const PAGE_FORGOT_LOGIN_LINK = 'Я помню свою электронную почту! - Страница Войти';
const PAGE_FORGOT_HOME_LINK = 'Вернуться на главную страницу';

//reset page
const PAGE_RESET_TITLE = 'Изменить пароль?';
const PAGE_RESET_SUBTITLE = 'Вы можете изменить свой пароль здесь.';
const _NEW_PASSWORD = 'Новый Пароль';
const _NEW_PASSWORD_INPUT = 'Новый Пароль';
const _RESET_PASSWORD_BTN = 'Изменить пароль';

//registration page
CONST _REGISTER = 'Регистрация';
CONST _USERNAME = 'Имя пользователя';
CONST _USERNAME_INPUT = 'Введите имя пользователя';
CONST _EMAIL = 'Электронная почта';
CONST _EMAIL_INPUT = 'Введите адрес электронной почты: tvoiprimer@primerii.com';
CONST _PASSWORD = 'Пароль';
CONST _PASSWORD_INPUT = 'Введите пароль';
CONST _RPT_PASSWORD = 'Повторите пароль';
CONST _RPT_PASSWORD_INPUT = 'Повторите пароль';
CONST _LOGINPAGE_BTN = "Я уже пользователь! - Вход к Систему";
CONST _NAV_LANG = 'Язык:';

// Modal login - comment btn
const MODAL_TITLE = 'Войти';
const MODAL_USERNAME = 'Имя пользователя';
const MODAL_PASSWORD = 'Пароль';
CONST MODAL_TEXT_CONTENT = 'Пожалуйста, войдите в систему или зарегистрируйте учетную запись, чтобы оставить комментарий';
const MODAL_REGISTER_LINK = "Зарегистрировать";
const MODAL_LOGIN_LINK = 'Войти';
const MODAL_BTN_LOGIN = 'Войти';
const MODAL_BTN_CANCEL = 'Отменить';


//General Class -> Permissions
const GREETING_ADMIN = "Добро пожаловать, Администратор"; 
const GREETING_USER = "Добро пожаловать, "; 

//General Class -> PagerDisplayer
const PAGER_RETURN = 'Вернуть'; 
const PAGER_PREVIOUS = 'Предыдущий'; 
const PAGER_NEXT = 'Следующий'; 

// General Class -> TextHandler
const READ_MORE = 'Подробнее';





// all constants set (en):
const USERNAME_EXISTS = '* Имя пользователя уже существует';
const NO_USERNAME = '* Вводить имя пользователя';
const NO_EMAIL = '* Вводить электронную почту';
const EMAIL_EXISTS = '* Электронная почта уже существует';
const NO_PASSWORD = '* Вводить пароль';
const PASSWORD_NOT_MATCH = '* Пароли не совпадают';
const NO_RPT_PASSWORD = '* Повторить пароль';
const INVALID_USERNAME_PASSWORD = '* Неверное имя пользователя или пароль';
const NO_SUBJECT = '* Вводить тему';
const NO_MESSAGE = '* Вводить сообщение';
const INVALID_EMAIL = '* Неверный адрес электронной почты';
const CHECK_CORRECTION = ' - проверьте, правильно ли вы его ввели';
const NO_NEW_PASSWORD = '* Вводить новый пароль';
const INVALID_PASSWORD = '* Неверный пароль';

// all admin exclusive constants set (en):
// const NO_TITLE = '* Insert title';
// const NO_AUTHOR = '* Must Choose author';
// const NO_CATEGORY = '* Must choose category';
// const NO_STATUS = '* Must choose status';
// const NO_IMAGE = '* Must upload image';
// const NO_CONTENT = '* Insert content';


?>