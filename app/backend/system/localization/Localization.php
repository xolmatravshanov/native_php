<?php



/*
//https://riptutorial.com/php/topic/2963/localization
 * extension=php_gettext.dll #Windows
   extension=gettext.so #Linux
 * */
class Localization
{
    public function __construct()
    {
        // Set language to French
        putenv('LC_ALL=    fr_FR');

        setlocale(LC_ALL, 'fr_FR');

        // Specify location of translation tables for 'myPHPApp' domain
        bindtextdomain("myPHPApp", "./locale");

    }



}
