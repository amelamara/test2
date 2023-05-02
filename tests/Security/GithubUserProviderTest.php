<?php
namespace App\Tests\Security;
use App\Entity\User;
use App\Security\GithubUserProvider;
use PHPUnit\Framework\TestCase;
class GithubUserProviderTest extends TestCase{
	public function testLoadUserByUsernameReturningAUser(){
		$client = $this->getMockBuilder('GuzzleHttp\Client')
            			->disableOriginalConstructor()
            			->setMethods(['get'])
            			->getMock();
        $serializer = $this->getMockBuilder('JMS\Serializer\SerializerInterface')
            				->disableOriginalConstructor()
            				->setMethods(['deserialize'])
            				->getMock();
        $githubUserProvider = new GithubUserProvider($client, $serializer);
        $response = $this->getMockBuilder('Psr\Http\Message\ResponseInterface')
						->setMethods(['getBody'])
            			->getMock();
        $client->expects($this->once()) // Nous nous attendons à ce que la méthode get soit appelée une fois
            	->method('get')
            	->willReturn($response);
        $streamedResponse = $this->getMockBuilder('Psr\Http\Message\StreamInterface')
								->setMethods(['getContents'])
            					->getMock();
        $response->expects($this->once()) // Nous nous attendons à ce que la méthode getBody soit appelée une fois
            	->method('getBody')
            	->willReturn($streamedResponse);
        $streamedResponse->expects($this->once())
                		->method('getContents')
                		->willReturn('foo');
        $userData = ['login' => 'a login', 'name' => 'user name', 'email' => 'adress@mail.com', 'avatar_url' => 'url to the avatar', 'html_url' => 'url to profile'];
        $serializer->expects($this->once()) // Nous nous attendons à ce que la méthode deserialize soit appelée une fois
            		->method('deserialize')
            		->willReturn($userData);
        
        $user = $githubUserProvider->loadUserByUsername('an-access-token');
        $expectedUser = new User($userData['login'], $userData['name'], $userData['email'], $userData['avatar_url'], $userData['html_url']);
        $this->assertEquals($expectedUser, $user);
        $this->assertEquals('App\Entity\User', get_class($user));
    }
}
?>