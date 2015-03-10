<?php
/* cloudeware.config.php
 * 
 * Configuration related functionality.
 * 
 * Copyright Mattched IT 2012 onwards.
 *  * 18/05/2012 - MC: Created file.
 */

class CloudewareConfig
{
    const cloudeware_core_version = 1.0;

    public $cloudeware_parts_url;
    public $cloudeware_api_wsdl;
    public $cloudeware_api_url;

    public $cloudeware_parts_key = "8F1BEFCD-5272-4C23-A1AD-4FC2F5846CAB";
    public $cloudeware_api_key = "xxx";
    
    public function __construct()
    {
        $this->cloudeware_parts_url = self::GetPartsUrl();
        $this->cloudeware_api_wsdl = self::GetAPIUrl(true);
        $this->cloudeware_api_url = self::GetAPIUrl(false);
    }
    
    private function GetPartsUrl()
    {
        $partsUrl = "";

        switch(gethostname())
        {
            case "MIDEV01":
                $partsUrl = "localhost:52530";
                break;
        }

        return $partsUrl;
    }
    
    private function GetAPIUrl($isWSDL)
    {
        $apiUrl = "";

        switch(gethostname())
        {
            case "MIDEV01":
                $apiUrl = "localhost/api.mattchedit.com/CMS/v111/Service.asmx";
                break;
        }
        
        if($isWSDL)
        {
            $apiUrl .= "?wsdl";
        }
        
        return $apiUrl;
    }
}
?>
