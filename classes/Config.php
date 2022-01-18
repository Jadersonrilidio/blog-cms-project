<?php

abstract class Config {
    
    // smpt configuration variables
    const SMPT_HOST = 'localhost';                      
    const SMTP_USER = 'email@example.com';                     
    const SMTP_PASSWORD = '**********';          
    const SMPT_PORT = '80';
    
    // Path constants
    const REL_PATH = '/';
    const ADMIN_REL_PATH = '/admin/';
}

?>
