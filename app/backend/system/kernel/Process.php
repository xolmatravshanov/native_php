<?php

class Process
{
    //https://riptutorial.com/php/topic/5263/multiprocessing



    private function isWindows()
    {
        return DIRECTORY_SEPARATOR !== '/';
    }
}