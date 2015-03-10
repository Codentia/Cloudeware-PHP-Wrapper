<?php
/* cloudeware.core.php
 * 
 * Providers interface objects and methods to include parts in other pages, 
 * called by the snippets generated via my.cloudeware.com.
 * 
 * Copyright Mattched IT 2012 onwards.
 *  * 18/05/2012 - MC: Created file.
 */

global $core;
$core = new Cloudeware();

/* HTMLSection */
function parts_get_htmlsection($sectionIdentifier)
{
    return parts_get_htmlsection_withkey("", $sectionIdentifier, "");
}

function parts_print_htmlsection($sectionIdentifier)
{
    parts_print_htmlsection_withkey("", $sectionIdentifier);
}

function parts_print_htmlsection_withkey($partsKey, $sectionIdentifier, $previewKey)
{
    echo(parts_get_htmlsection_withkey($partsKey, $sectionIdentifier, $previewKey));
}

function parts_get_htmlsection_withkey($partsKey, $sectionIdentifier, $previewKey)
{
    global $core;
    $config = $core->config;
    $partsKey = $partsKey==""?$config->cloudeware_parts_key:$partsKey;
    $previewKey = $previewKey==""?$core->getPreviewKey():$previewKey;

    $partsUrl = sprintf("http://%s/CMS/HTMLSection.ashx?key=%s&id=%s&preview=%s", $config->cloudeware_parts_url, $partsKey, $sectionIdentifier, $previewKey);
    $result = "";

    $result = @file_get_contents($partsUrl) or $result = "Unable to retrieve data from Cloudeware.";
    
    return $result;
}

/* File download link */
function parts_get_filedownloadlink($sectionIdentifier)
{
    return parts_get_filedownloadlink_withkey("", $sectionIdentifier, "");
}

function parts_print_filedownloadlink($sectionIdentifier)
{
    parts_print_filedownloadlink_withkey("", $sectionIdentifier, "");
}

function parts_print_filedownloadlink_withkey($partsKey, $sectionIdentifier, $previewKey)
{
    echo(parts_get_filedownloadlink_withkey($partsKey, $sectionIdentifier, $previewKey));
}

function parts_get_filedownloadlink_withkey($partsKey, $sectionIdentifier, $previewKey)
{
    global $core;
    $config = $core->config;
    $partsKey = $partsKey==""?$config->cloudeware_parts_key:$partsKey;
    $previewKey = $previewKey==""?$core->getPreviewKey():$previewKey;

    $partsUrl = sprintf("http://%s/CMS/FileDownloadLink.ashx?key=%s&id=%s&preview=%s", $config->cloudeware_parts_url, $partsKey, $sectionIdentifier, $previewKey);
    $result = "";

    $result = @file_get_contents($partsUrl) or $result = "Unable to retrieve data from Cloudeware.";
    
    return $result;
}

/* Indexed Section */

function parts_get_indexedsection_withmode($sectionIdentifier, $mode, $postIdentifier, $baseUrl)
{
    global $core;
    $config = $core->config;

    $partsUrl = sprintf("http://%s/CMS/IndexedSection.ashx?key=%s&id=%s&preview=%s&mode=%s&post=%s&baseurl=%s", $config->cloudeware_parts_url, $config->cloudeware_parts_key, $sectionIdentifier, $core->getPreviewKey(), $mode, $postIdentifier, $baseUrl);
    $result = "";

    $result = @file_get_contents($partsUrl) or $result = "Unable to retrieve data from Cloudeware.";
    
    return $result;
}

/* Posts */

function parts_get_indexedsection_post($sectionIdentifier, $postIdentifier, $baseUrl)
{
    return parts_get_indexedsection_withmode($sectionIdentifier, "content", $postIdentifier, $baseUrl);
}

function parts_get_indexedsection_post_latest($sectionIdentifier, $baseUrl)
{
    return parts_get_indexedsection_withmode($sectionIdentifier, "latest_content", "", $baseUrl);
}

function parts_print_indexedsection_post($sectionIdentifier, $postIdentifier, $baseUrl)
{
    echo(parts_get_indexedsection_withmode($sectionIdentifier, "content", $postIdentifier, $baseUrl));
}

function parts_print_indexedsection_post_latest($sectionIdentifier, $baseUrl)
{
    echo(parts_get_indexedsection_withmode($sectionIdentifier, "latest_content", "", $baseUrl));
}

function parts_print_indexedsection_post_or_latest($sectionIdentifier, $baseUrl)
{
  $post = "";
  
  if(strlen($_REQUEST["id"]) > 0)
  {
    $post = parts_get_indexedsection_post($sectionIdentifier, $_REQUEST["id"], $baseUrl);        
  }
  
  if(strlen($post) == 0 || $post == "Unable to retrieve data from Cloudeware.")
  {
    $post = parts_get_indexedsection_post_latest($sectionIdentifier, $baseUrl);        
  }
  
  echo($post);
}

/* Comments */

function parts_get_indexedsection_comments($sectionIdentifier, $postIdentifier, $baseUrl)
{
    return parts_get_indexedsection_withmode($sectionIdentifier, "comments", $postIdentifier, $baseUrl);
}

function parts_get_indexedsection_comments_latest($sectionIdentifier, $baseUrl)
{
    return parts_get_indexedsection_withmode($sectionIdentifier, "latest_comments", "", $baseUrl);
}

function parts_print_indexedsection_comments($sectionIdentifier, $postIdentifier, $baseUrl)
{
    echo(parts_get_indexedsection_withmode($sectionIdentifier, "comments", $postIdentifier, $baseUrl));
}

function parts_print_indexedsection_comments_latest($sectionIdentifier, $baseUrl)
{
    echo(parts_get_indexedsection_withmode($sectionIdentifier, "latest_comments", "", $baseUrl));
}

function parts_print_indexedsection_comments_or_latest($sectionIdentifier, $baseUrl)
{
  $post = "";
  
  if(strlen($_REQUEST["id"]) > 0)
  {
    $post = parts_get_indexedsection_comments($sectionIdentifier, $_REQUEST["id"], $baseUrl);        
  }
  
  if(strlen($post) == 0 || $post == "Unable to retrieve data from Cloudeware.")
  {
    $post = parts_get_indexedsection_comments_latest($sectionIdentifier, $baseUrl);        
  }
  
  echo($post);
}

/* IxS with Comments */

function parts_get_indexedsection_postandcomments($sectionIdentifier, $postIdentifier, $baseUrl)
{
    return parts_get_indexedsection_withmode($sectionIdentifier, "contents_comments", $postIdentifier, $baseUrl);
}

function parts_get_indexedsection_postandcomments_latest($sectionIdentifier, $baseUrl)
{
    return parts_get_indexedsection_withmode($sectionIdentifier, "latest_contents_comments", "", $baseUrl);
}

function parts_print_indexedsection_postandcomments($sectionIdentifier, $postIdentifier, $baseUrl)
{
    echo(parts_get_indexedsection_withmode($sectionIdentifier, "contents_comments", $postIdentifier, $baseUrl));
}

function parts_print_indexedsection_postandcomments_latest($sectionIdentifier, $baseUrl)
{
    echo(parts_get_indexedsection_withmode($sectionIdentifier, "latest_contents_comments", "", $baseUrl));
}

function parts_print_indexedsection_postandcomments_or_latest($sectionIdentifier, $baseUrl)
{
  $post = "";
  
  if(strlen($_REQUEST["id"]) > 0)
  {
    $post = parts_get_indexedsection_postandcomments($sectionIdentifier, $_REQUEST["id"], $baseUrl);        
  }
  
  if(strlen($post) == 0 || $post == "Unable to retrieve data from Cloudeware.")
  {
    $post = parts_get_indexedsection_postandcomments_latest($sectionIdentifier, $baseUrl);        
  }
  
  echo($post);
}

/* IxS history view */

function parts_get_indexedsection_summary_range($sectionIdentifier, $postIdentifier, $baseUrl, $filterFrom, $filterTo)
{
    global $core;
    $config = $core->config;
    $mode = "post_summary";    
    
    $filterFrom = date("j n Y", strtotime($filterFrom, time()));
    $filterTo = date("j n Y", strtotime($filterFrom, time()));
    
    $partsUrl = sprintf("http://%s/CMS/IndexedSection.ashx?key=%s&id=%s&preview=%s&mode=%s&post=%s&baseurl=%s&filterfrom=%s&filterto=%s", $config->cloudeware_parts_url, $config->cloudeware_parts_key, $sectionIdentifier, $core->getPreviewKey(), $mode, $postIdentifier, $baseUrl, $filterFrom, $filterTo);
    $result = "";

    $result = @file_get_contents($partsUrl) or $result = "Unable to retrieve data from Cloudeware.";
    
    return $result;    
}

function parts_get_indexedsection_summary_from($sectionIdentifier, $postIdentifier, $baseUrl, $filterFrom)
{
    return parts_get_indexedsection_summary_range($sectionIdentifier, $postIdentifier, $baseUrl, $filterFrom, "today");
}

function parts_get_indexedsection_summary($sectionIdentifier, $postIdentifier, $baseUrl)
{
    return parts_get_indexedsection_summary_range($sectionIdentifier, $postIdentifier, $baseUrl, "1 year ago", "today");
}

/* Comment Form */

function parts_print_indexedsection_commentform($sectionIdentifier, $postIdentifier, $baseUrl)
{
    global $core;

    $message = "";
    $success = true;
    
    if($_SESSION["cloudware_captcha_failure"])
    {
        $message = "Please check your answer to the 'captcha' and try again.";
        $success = false;
    }
    
    if($_SESSION["cloudware_comment_failure"])
    {
        $message = $_SESSION["cloudware_comment_message"];    
        $success = false;
    }
    
    // get the basic html
    if(!$success)
    {
        $html = parts_get_indexedsection_withmode($sectionIdentifier, "comment_form", $postIdentifier, $baseUrl);

        // add the captcha
        $html = str_replace("<captcha />", $core->getCaptchaHtml(), $html);

        // replace placeholders
        if(isset($_SESSION["cloudeware_comment_params"]))
        {
            $html = str_replace("[NAME]", $_SESSION["cloudeware_comment_params"]["name"], $html);
            $html = str_replace("[EMAIL]", $_SESSION["cloudeware_comment_params"]["email"], $html);
            $html = str_replace("[URL]", $_SESSION["cloudeware_comment_params"]["url"], $html);
            $html = str_replace("[TWITTER]", $_SESSION["cloudeware_comment_params"]["twitter"], $html);
            $html = str_replace("[COMMENT]", $_SESSION["cloudeware_comment_params"]["comment"], $html);
        }
        else        
        {
            $html = str_replace("[NAME]", "", $html);
            $html = str_replace("[EMAIL]", "", $html);
            $html = str_replace("[URL]", "", $html);
            $html = str_replace("[TWITTER]", "", $html);
            $html = str_replace("[COMMENT]", "", $html);
        }

        // add the form tags
        $html = "<form action='" . dirname(__FILE__) . "/cloudeware.handler.php' method='post'><input type='hidden' name='widget' value='insert_comment'/><input type='hidden' name='source' value='" . $_SERVER['PHP_SELF'] . "'/>" . $html . "</form>";
        $html .= "<p class='comment_failure'>" . $message . "</p>";
    }
    else
    {
        $html = "<p class='comment_success'>Your comment has been submitted and will appear once it has been moderated.</p>";
    }
    
    echo($html);
}

function parts_print_rssfeed($sectionIdentifier, $useFullText, $baseUrl, $feedUrl)
{
    //  OutputRssFeed(apiKey, blogSectionId, false, "http://www.mattchedit.com/", "http://www.mattchedit.com/external/BlogRSS.aspx");
    $api = new CloudewareAPI($core);
    $result = $api->GetRSSFeedOutput($sectionIdentifier, $useFullText, $baseUrl, $feedUrl);
    
    echo($result->output);
}
?>
