<?php
/* cloudeware.core.php
 * 
 * Core module, brings together all the other files in the package and provides 
 * any required utility/helper functions.
 * 
 * Copyright Mattched IT 2012 onwards.
 *  * 18/05/2012 - MC: Created file.
 */

include_once("cloudeware.config.php");
include_once("cloudeware.parts.php");
include_once("cloudeware.api.php");

/* General */

class Cloudeware
{
    public $config;
    
    public function __construct()
    {
        $this->config = new CloudewareConfig();
        session_start();
    }

    function getPreviewKey()
    {
        return (isset($_GET["preview"])?$_GET["preview"]:"");
    }
    
    function getCaptchaHtml()
    {
        $x = rand(1, 10);
        $y = rand(1, 10);
        $z = $x + $y;
        
        $_SESSION["cloudeware_captcha_answer"] = $z;
        
        return sprintf("<div><label for='captcha'>%s + %s = </label><input type='text' name='captcha'/></div>", $x, $y);
    }

    function checkCaptchaResult()
    {
        return ($_POST["captcha"] == $_SESSION["cloudeware_captcha_answer"]);
    }
}
?>
