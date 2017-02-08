<?php
namespace Haridarshan\Instagram\Test;

use Haridarshan\Instagram\Instagram;

class InstagramTest extends \PHPUnit_Framework_TestCase {
	protected $instagram;
	
	protected function setup() {
		$config = array(
			'ClientId' => CLIENT_ID,
			'ClientSecret' => CLIENT_SECRET,
			'Callback' => CLIENT_SECRET
		);
		
		$this->instagram = new Instagram($config);
	}
	
	public function testBuildClient(){
		$this->assertObjectHasAttribute('clientId', $this->instagram);		
		$this->assertObjectHasAttribute('clientSecret', $this->instagram);		
		$this->assertObjectHasAttribute('callbackUrl', $this->instagram);
	}
	
	public function testUrl(){
		$scope = array(
			"basic"
		);
		
		$url = $this->instagram->getLoginUrl(["scope" => $scope]);
		$state = $this->instagram->getState();
		
		$this->assertEquals('https://api.instagram.com/oauth/authorize?client_id='.CLIENT_ID.'&redirect_uri='.urlencode(CALLBACK_URL).'&response_type=code&state='.$state.'&scope=basic', $url);
	}
}
