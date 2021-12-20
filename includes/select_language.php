
<!-- select language box -->
<form action="" class="navbar-form navbar-right" id="language_form" method="POST">
    <label style='color:red' class="text-center"> <?php echo _NAV_LANG; ?> </label>
    <select class="form-control" name="lang" onchange="changeLanguage()">
        <option <?php LanguageHandler::select_language('en'); ?> value="en"> English </option>
        <option <?php LanguageHandler::select_language('es'); ?> value="es"> Espanõl </option>
        <option <?php LanguageHandler::select_language('pt'); ?> value="pt"> Português </option>
        <option <?php LanguageHandler::select_language('ru'); ?> value="ru"> Русский </option>
    </select> 
</form>