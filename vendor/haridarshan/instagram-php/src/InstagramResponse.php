<?php
namespace Haridarshan\Instagram;

use GuzzleHttp\Psr7\Response;
use Haridarshan\Instagram\Exceptions\InstagramResponseException;

class InstagramResponse
{
    /** @var int $status_code */
    private $statusCode;
	
    /** @var string $protocol */
    private $protocol = '1.1';
	
    /** @var array $headers */
    private $headers = [];
	
    /** @var bool */
    private $isPagination = false;
	
    /** @var object */
    private $pagination;
    
    /** @var bool */
    private $isMetaData = false;
	
    /** @var object */
    private $metaData;
	
    /** @var object */
    private $data;
	
    /** @var object $body */
    private $body;
	
    /*
	 * @param Response $response
	 * @throws InstagramResponseException
	 */
    public function __construct(Response $response)
    {
        if (!$response instanceof Response) {
            throw new InstagramResponseException('Bad Request: Response is not valid instance of GuzzleHttp\Psr7\Response', 404); 
        }
        $this->setParams($response);
    }
    
    /* 
	 * Set Values to the class members
	 * @param Response $response
	 * @return void
	 */
    private function setParams(Response $response)
    {
        $this->protocol = $response->getProtocolVersion();
        $this->statusCode = (int) $response->getStatusCode();
        $this->headers = $response->getHeaders();
        $this->body = json_decode($response->getBody()->getContents());
        $this->extractBodyParts();
    }
	
    private function extractBodyParts()
    {
        if (isset($this->body->pagination)) {
            $this->isPagination = true;
            $this->pagination = $this->body->pagination;
        }
		
        if (isset($this->body->meta)) {
            $this->isMetaData = true;
            $this->metaData = $this->body->meta;
        }
			
        $this->data = $this->body->data;	
    }
    
    /*
	 * Get response
	 * @return object|string 
	 */
    public function getBody()
    {
        return $this->body;
    }
    
    /*
	 * Get Status Code
	 * @return int
	 */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
    
    /*
	 * Get specific header
	 * @param string $header
	 * @retrun string 
	 */
    public function getHeader($header)
    {
        return isset($this->headers[$header]) ? $this->headers[$header] : [];
    }
	
    /*
	 * Get all headers
	 * @retrun array 
	 */
    public function getHeaders()
    {
        return $this->headers;
    }
	
    /*
	 * Get data from body
	 * @return object
	 */
    public function getData()
    {
        return $this->data;
    }
	
    /*
	 * Get Meta data
	 * @return object
	 */
    public function getMetaData()
    {
        return $this->metaData;
    }
	
    /*
	 * Get Meta data
	 * @return object
	 */
    public function getPagination()
    {
        return $this->pagination;
    }
	
    /*
	 * Is Meta Data Present
	 * @return bool
	 */
    public function isMetaDataSet()
    {
        return $this->isMetaData;
    }
	
    /*
	 * Is Pagination present
	 * @return bool
	 */
    public function isPaginationSet()
    {
        return $this->isPagination;
    }
	
    /*
	 * Get Protocol version
	 * @return string
	 */
    public function getProtocol()
    {
        return $this->protocol;
    }
}
