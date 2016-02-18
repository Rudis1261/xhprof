<?php

Template::setBaseDir(DOC_ROOT . '/templates');
class Template
{
    private static $baseDir = '';
    private static $defaultTemplateExtension = '.php';

    public static function setBaseDir($dir){
        self::$baseDir = $dir;
    }

    public static function getBaseDir(){
        return self::$baseDir;
    }

    public static function setDefaultTemplateExtension($ext){
        self::$defaultTemplateExtension = $ext;
    }

    public static function getDefaultTemplateExtension(){
        return self::$defaultTemplateExtension;
    }

    public static function load($template, $vars = [], $subDir=''){
        return self::loadTemplate($template, $vars, $subDir);
    }
    public static function loadTemplate($template, $vars = array(), $subDir=''){
        if (empty($baseDir)) {
            $baseDir = self::getBaseDir();
        }

        $subDir = (! empty($subDir)) ? str_replace("/", "", $subDir) . "/" : "";
        $templatePath = $baseDir.'/'.$subDir.$template.self::getDefaultTemplateExtension();
        if(!file_exists($templatePath)) {
            throw new Exception('Could not include template '.$templatePath);
        }

        return self::loadTemplateFile($templatePath, $vars);
    }

    public static function renderTemplate($template, $vars = array(), $baseDir=null){
        echo self::loadTemplate($template, $vars, $baseDir);
    }

    private static function loadTemplateFile($__ct___templatePath__, $__ct___vars__){
        extract($__ct___vars__, EXTR_OVERWRITE);
        $__ct___template_return = '';
        ob_start();
        require $__ct___templatePath__;
        $__ct___template_return = ob_get_contents();
        ob_end_clean();
        return $__ct___template_return;
    }
}
