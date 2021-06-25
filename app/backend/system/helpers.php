<?php


function autoload($class_name)
{
    $extentions = ['.php', '.class.php', '.inc.php'];

    $namespace = str_replace("\\", "/", __NAMESPACE__);
    $className = str_replace("\\", "/", $class_name);

    $base_folders = [
        'system' => 'app/backend/system/',
        'classes' => 'app/backend/classes/',
    ];

    foreach ($base_folders as $key => $base_folder) {
        if (is_file($base_folder . $class_name . '.php'))
            require_once $base_folder . $class_name . '.php';
    }

    $class = CORE_PATH . "/classes/" . (empty($namespace) ? "" : $namespace . "/") . "{$className}.php";
    include_once($class);
}

function autoloadNamespace($className){
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strripos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    require $fileName;
}

function normalize()
{

}
