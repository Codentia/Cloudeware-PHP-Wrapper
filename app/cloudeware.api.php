<?php
/* cloudeware.api.php
 * 
 * Defines objects required to access and interact with the Cloudeware API(s).
 * 
 * Copyright Mattched IT 2012 onwards.
 *  * 18/05/2012 - MC: Created file.
 */

class CloudewareAPIResult
{
    public $method;
    public $successful;
    public $message;
    public $output;
    public $outputXml;
    
    public function __construct($data)
    {
        $xml = new SimpleXMLElement($data);                
        
        $this->method = $xml->xpath("/cmsapicall/method");
        $this->successful = $xml->xpath("/cmsapicall/result") == "success";
        $this->message = $xml->xpath("/cmsapicall/message");
        $this->output = $xml->xpath("/cmsapicall/output");
        $this->outputXml = new SimpleXMLElement($this->output);
    }
}

class CloudewareAPI
{
    private $api;
    private $core;

    public function __construct($core)
    {
        $this->core = $core;
        $this->api = new SoapClient($core->config->cloudeware_api_wsdl);
    }    
    
    public function AttachThumbnailToPost($sectionIdentifier, $postIdentifier, $thumbnailId)
    {
        $data = $this->api->AttachThumbnailToPost($this->core->config->cloudeware_api_key, 
                Array
                    (
                        "sectionIdentifier" => $sectionIdentifier,
                        "postIdentifier" => $postIdentifier,
                        "thumbnailId" => $thumbnailId
                    ));
        
        return new CloudewareAPIResult($data);
    }

    public function AttachUploadedDocumentToPost($sectionIdentifier, $postIdentifier, $uploadedDocumentId)
    {
        $data = $this->api->AttachThumbnailToPost($this->core->config->cloudeware_api_key, 
                Array
                (
                    "sectionIdentifier" => $sectionIdentifier, 
                    "postIdentifier" => $postIdentifier, 
                    "uploadedDocumentId" =>$uploadedDocumentId
                ));

        return new CloudewareAPIResult($data);
    }

    public function CreateAuthor($name, $url)
    {
        $data = $this->api->CreateAuthor($this->core->config->cloudeware_api_key, 
                Array
                (
                    "name" => $name, 
                    "url" => $url 
                ));

        return new CloudewareAPIResult($data);
    }

    public function CreatePost($sectionIdentifier, $postIdentifier, $shortTitle, $title, $postDate, $categoryId, $authorId, $bodyPreview, 
                                $body, $metaDescription, $metaKeywords, $expiryDate)
    {
        $data = $this->api->CreatePost($this->core->config->cloudeware_api_key, 
                Array
                (
                    "sectionIdentifier" => $sectionIdentifier, 
                    "postIdentifier" => $postIdentifier,
                    "shortTitle" => $shortTitle,
                    "title" => $title,
                    "postDate" => $postDate,
                    "categoryId" => $categoryId,
                    "authorId" => $authorId,
                    "bodyPreview" => $bodyPreview,
                    "body" => $body,
                    "metaDescription" => $metaDescription,
                    "metaKeywords" => $metaKeywords,
                    "expiryDate" => $expiryDate
                 ));

        return new CloudewareAPIResult($data);
    }

    public function CreateThumbnail($filename, $altText, $title, $thumbnailByteArray)
    {
        $data = $this->api->CreateThumbnail($this->core->config->cloudeware_api_key, 
                Array
                (
                    "filename" => $filename, 
                    "altText" => $altText,
                    "title" => $title,
                    "thumbnailByteArray" => $thumbnailByteArray
                 ));

        return new CloudewareAPIResult($data);
    }

    public function CreateUploadedDocument($filename, $title, $documentByteArray, $thumbnailImageId)
    {
        $data = $this->api->CreateUploadedDocument($this->core->config->cloudeware_api_key, 
                Array
                (
                    "filename" => $filename, 
                    "altText" => $altText,
                    "title" => $title,
                    "documentByteArray" => $documentByteArray,
                    "thumbnailImageId" => $thumbnailImageId
                 ));

        return new CloudewareAPIResult($data);
    }
    
    public function CreateUploadedImage($filename, $altText, $title, $imageByteArray, $thumbnailImageId)
    {
        $data = $this->api->CreateUploadedImage($this->core->config->cloudeware_api_key, 
                Array
                (
                    "filename" => $filename, 
                    "altText" => $altText,
                    "title" => $title,
                    "imageByteArray" => $imageByteArray,
                    "thumbnailImageId" => $thumbnailImageId
                 ));

        return new CloudewareAPIResult($data);
    }
    
    public function DeleteUploadedDocument($uploadedDocumentId)
    {
        $data = $this->api->DeleteUploadedDocument($this->core->config->cloudeware_api_key, 
                Array
                (
                    "uploadedDocumentId" => $uploadedDocumentId
                 ));

        return new CloudewareAPIResult($data);
    }

    public function DeleteUploadedImage($uploadedImageId)
    {
        $data = $this->api->DeleteUploadedImage($this->core->config->cloudeware_api_key, 
                Array
                (
                    "uploadedImageId" => $uploadedImageId
                 ));

        return new CloudewareAPIResult($data);
    }

    public function EditPost($sectionIdentifier, $postIdentifier, $shortTitle, $title, $postDate, $categoryId, $authorId, $bodyPreview, 
                                $body, $metaDescription, $metaKeywords, $expiryDate)
    {
        $data = $this->api->EditPost($this->core->config->cloudeware_api_key, 
                Array
                (
                    "sectionIdentifier" => $sectionIdentifier, 
                    "postIdentifier" => $postIdentifier,
                    "shortTitle" => $shortTitle,
                    "title" => $title,
                    "postDate" => $postDate,
                    "categoryId" => $categoryId,
                    "authorId" => $authorId,
                    "bodyPreview" => $bodyPreview,
                    "body" => $body,
                    "metaDescription" => $metaDescription,
                    "metaKeywords" => $metaKeywords,
                    "expiryDate" => $expiryDate
                 ));

        return new CloudewareAPIResult($data);
    }
    
    public function GetAuthors($justActiveAuthors)
    {
        $data = $this->api->GetAuthors($this->core->config->cloudeware_api_key, 
                Array
                (
                    "justActiveAuthors" => ($justActiveAuthors == TRUE ? "true" : "false")
                 ));

        return new CloudewareAPIResult($data);    
    }
        
    public function GetCategories($sectionIdentifier)
    {
        $data = $this->api->GetCategories($this->core->config->cloudeware_api_key, 
                Array
                (
                    "sectionIdentifier" => $sectionIdentifier
                 ));

        return new CloudewareAPIResult($data);    
    }

    public function GetCommentsXml($sectionIdentifier, $postIdentifier)
    {
        $data = $this->api->GetCommentsXml($this->core->config->cloudeware_api_key, 
                Array
                (
                    "sectionIdentifier" => $sectionIdentifier,
                    "postIdentifier" => $postIdentifier
                 ));

        return new CloudewareAPIResult($data);   
    }
    
    public function GetContentSectionXml($identifier, $baseUrl, $previewKey)
    {
        $data = $this->api->GetContentSectionXml($this->core->config->cloudeware_api_key, 
                Array
                (
                    "identifier" => $identifier,
                    "baseUrl" => $baseUrl,
                    "previewKey" => $previewKey
                 ));

        return new CloudewareAPIResult($data);   
    }
    
    public function GetIndexedSectionSummary($identifier, $baseUrl, $filterFrom, $filterTo)
    {
        $data = $this->api->GetIndexedSectionSummary($this->core->config->cloudeware_api_key, 
                Array
                (
                    "identifier" => $identifier,
                    "baseUrl" => $baseUrl,
                    "filterFrom" => $filterFrom,
                    "filterTo" => $filterTo
                 ));

        return new CloudewareAPIResult($data);   
    }

    public function GetLatestPostXml($sectionIdentifier, $baseUrl, $includeComments)
    {
        $data = $this->api->GetLatestPostXml($this->core->config->cloudeware_api_key, 
                Array
                (
                    "sectionIdentifier" => $sectionIdentifier,
                    "baseUrl" => $baseUrl,
                    "includeComments" => $includeComments
                 ));

        return new CloudewareAPIResult($data);   
    }
    
    public function GetLatestPostsXml($sectionIdentifier, $baseUrl, $numberOfPosts, $includeComments)
    {
        $data = $this->api->GetLatestPostsXml($this->core->config->cloudeware_api_key, 
                Array
                (
                    "sectionIdentifier" => $sectionIdentifier,
                    "baseUrl" => $baseUrl,
                    "numberOfPosts" => $numberOfPosts,
                    "includeComments" => $includeComments
                 ));

        return new CloudewareAPIResult($data);   
    }
    
    public function GetMostPopularPostsXml($sectionIdentifier, $baseUrl, $numberOfPosts)
    {
        $data = $this->api->GetMostPopularPostsXml($this->core->config->cloudeware_api_key, 
                Array
                (
                    "sectionIdentifier" => $sectionIdentifier,
                    "baseUrl" => $baseUrl,
                    "numberOfPosts" => $numberOfPosts
                 ));

        return new CloudewareAPIResult($data);   
    }

    public function GetNextNItemsForContentAggregator($systemIdentifier, $numberToReturn)
    {
        $data = $this->api->GetNextNItemsForContentAggregator($this->core->config->cloudeware_api_key, 
                Array
                (
                    "systemIdentifier" => $systemIdentifier,
                    "numberToReturn" => $numberToReturn
                 ));

        return new CloudewareAPIResult($data);   
    }
    
    public function GetPostXml($sectionIdentifier, $postIdentifier, $baseUrl, $includeComments, $previewKey)
    {
        $data = $this->api->GetPostXml($this->core->config->cloudeware_api_key, 
                Array
                (
                    "sectionIdentifier" => $sectionIdentifier,
                    "postIdentifier" => $postIdentifier,
                    "baseUrl" => $baseUrl,
                    "includeComments" => $includeComments,
                    "previewKey" => $previewKey,
                 ));

        return new CloudewareAPIResult($data);   
    }

    public function GetRSSFeedOutput($sectionIdentifier, $useFullText, $baseUrl, $feedUrl)
    {
        $data = $this->api->GetRSSFeedOutput($this->core->config->cloudeware_api_key, 
                Array
                (
                    "sectionIdentifier" => $sectionIdentifier,
                    "useFullText" => $useFullText,
                    "baseUrl" => $baseUrl,
                    "feedUrl" => $feedUrl
                 ));

        return new CloudewareAPIResult($data);   
    }

    public function GetRSSFeedOutputNItems($sectionIdentifier, $useFullText, $baseUrl, $feedUrl, $numberOfItems)
    {
        $data = $this->api->GetRSSFeedOutputNItems($this->core->config->cloudeware_api_key, 
                Array
                (
                    "sectionIdentifier" => $sectionIdentifier,
                    "useFullText" => $useFullText,
                    "baseUrl" => $baseUrl,
                    "feedUrl" => $feedUrl,
                    "numberOfItems" => $numberOfItems
                 ));

        return new CloudewareAPIResult($data);   
    }

    public function InsertComment($sectionIdentifier, $postIdentifier, $name, $email, $url, $twitter, $comment, $sourceIPAddress, $createdAt)
    {
        $data = $this->api->InsertComment($this->core->config->cloudeware_api_key, 
                Array
                (
                    "sectionIdentifier" => $sectionIdentifier,
                    "postIdentifier" => $postIdentifier,
                    "name" => $name,
                    "email" => $email,
                    "url" => $url,
                    "twitter" => $twitter,
                    "comment" => $comment,
                    "sourceIPAddress" => $sourceIPAddress,
                    "createdAt" => $createdAt
                 ));

        return new CloudewareAPIResult($data);   
    }

    public function PublishPost($sectionIdentifier, $postIdentifier, $versionNumber)
    {
        $data = $this->api->PublishPost($this->core->config->cloudeware_api_key, 
                Array
                (
                    "sectionIdentifier" => $sectionIdentifier,
                    "postIdentifier" => $postIdentifier,
                    "versionNumber" => $versionNumber
                 ));

        return new CloudewareAPIResult($data);   
    }
    
    public function RemoveThumbnailFromPost($sectionIdentifier, $postIdentifier)
    {
        $data = $this->api->RemoveThumbnailFromPost($this->core->config->cloudeware_api_key, 
                Array
                (
                    "sectionIdentifier" => $sectionIdentifier,
                    "postIdentifier" => $postIdentifier
                 ));

        return new CloudewareAPIResult($data);   
    }

    public function RemoveUploadedDocumentFromPost($sectionIdentifier, $postIdentifier, $uploadedDocumentId)
    {
        $data = $this->api->RemoveUploadedDocumentFromPost($this->core->config->cloudeware_api_key, 
                Array
                (
                    "sectionIdentifier" => $sectionIdentifier,
                    "postIdentifier" => $postIdentifier,
                    "uploadedDocumentId" => $uploadedDocumentId
                 ));

        return new CloudewareAPIResult($data);   
    }

    public function SearchAllSections($searchText, $searchTypeText, $startRow, $pageSize, $noOfSnippetWords, $combineBodyAndTitle)
    {
        $data = $this->api->SearchAllSections($this->core->config->cloudeware_api_key, 
                Array
                (
                    "searchText" => $searchText,
                    "searchTypeText" => $searchTypeText,
                    "startRow" => $startRow,
                    "pageSize" => $pageSize,
                    "noOfSnippetWords" => $noOfSnippetWords,
                    "combineBodyAndTitle" => ($combineBodyAndTitle == TRUE ? "true" : "false")
                 ));

        return new CloudewareAPIResult($data);   
    }

    public function UnPublishPost($sectionIdentifier, $postIdentifier, $versionNumber)
    {
        $data = $this->api->UnPublishPost($this->core->config->cloudeware_api_key, 
                Array
                (
                    "sectionIdentifier" => $sectionIdentifier,
                    "postIdentifier" => $postIdentifier,
                    "versionNumber" => $versionNumber
                 ));

        return new CloudewareAPIResult($data);   
    }
}
?>
