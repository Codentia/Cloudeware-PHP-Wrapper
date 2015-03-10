<?php
/* cloudeware.core.php
 * 
 * Acts as a postback handler for widgets implementing the parts system.
 * 
 * Copyright Mattched IT 2012 onwards.
 *  * 18/05/2012 - MC: Created file.
 */

include("cloudeware.core.php");

$core = new Cloudeware();

switch($_POST["widget"])
{
    case "insert_comment":
        $_SESSION["cloudeware_comment_params"] = Array
                                                (
                                                    "name" => $_POST["name"],
                                                    "email" => $_POST["email"],
                                                    "url" => $_POST["url"],
                                                    "twitter" => $_POST["twitter"],
                                                    "comment" => $_POST["comment"]
                                                );

        if(!$core->checkCaptchaResult())
        {
            $_SESSION["cloudware_captcha_failure"] = true;
            $_SESSION["cloudware_comment_failure"] = false;
        }
        else
        {
            $_SESSION["cloudware_captcha_failure"] = false;
                    
            $api = new CloudewareAPI();                                
            $result = $api->InsertComment($_POST["sectionIdentifier"], $_POST["postIdentifier"], $_POST["name"], $_POST["email"], $_POST["url"], $_POST["twitter"], $_POST["comment"], $_SERVER["REMOTE_ADDR"], date("j/n/Y H:i:s", time()));

            $_SESSION["cloudware_comment_failure"] = !$result->successful;
            $_SESSION["cloudware_comment_message"] = $result->message;
        }
        
        header("Location:".$_POST["source"]);            
        break;
    default:
        die("Invalid widget: " . $_POST["widget"]);
        break;
}
?>
