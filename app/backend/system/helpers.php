<?php





function autoload($class_name)
{

    $namespace=str_replace("\\","/",__NAMESPACE__);
    $className=str_replace("\\","/",$class_name);

    $base_folders = [
        'system' => 'app/backend/system/',
        'classes' => 'app/backend/classes/',
    ];

    foreach ($base_folders as $key => $base_folder) {
        if (is_file($base_folder . $class_name . '.php'))
            require_once $base_folder . $class_name . '.php';
    }




    $class=CORE_PATH."/classes/".(empty($namespace)?"":$namespace."/")."{$className}.php";
    include_once($class);
}

function normalize(){

}
