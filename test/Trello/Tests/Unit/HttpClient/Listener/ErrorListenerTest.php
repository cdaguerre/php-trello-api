<?php
namespace Trello\Tests\HttpClient;

use Trello\HttpClient\Listener\ErrorListener;

class ErrorListenerTest extends \PHPUnit_Framework_TestCase
{
    const RESPONSE_IS_CLIENT_ERROR = true;
    const RESPONSE_IS_NOT_CLIENT_ERROR = false;

    /**
     * @test
     */
    public function shouldPassIfResponseNotHaveErrorStatus()
    {
        $response = $this->getMockBuilder('Guzzle\Http\Message\Response')
            ->disableOriginalConstructor()
            ->getMock();
        $response->expects($this->once())
            ->method('isClientError')
            ->will($this->returnValue(false));
        $listener = new ErrorListener;
        $listener->onRequestError($this->getEventMock($response));
    }

    /**
     * @test
     * @expectedException \Trello\Exception\ApiLimitExceedException
     */
    public function shouldFailWhenApiLimitWasExceed()
    {
        $response = $this->createResponseMock(
            self::RESPONSE_IS_CLIENT_ERROR,
            429
        );

        $listener = new ErrorListener;
        $listener->onRequestError($this->getEventMock($response));
    }

    /**
     * @test
     * @expectedException \Trello\Exception\RuntimeException
     */
    public function shouldNotPassWhenContentWasNotValidJson()
    {
        $response = $this->createResponseMock(
            self::RESPONSE_IS_CLIENT_ERROR,
            400,
            'fail'
        );

        $listener = new ErrorListener;
        $listener->onRequestError($this->getEventMock($response));
    }

    /**
     * @test
     * @expectedException \Trello\Exception\RuntimeException
     */
    public function shouldNotPassWhenContentWasValidJsonButStatusIsNotCovered()
    {
        $response = $this->createResponseMock(
            self::RESPONSE_IS_CLIENT_ERROR,
            404,
            json_encode(array('message' => 'test'))
        );

        $listener = new ErrorListener;
        $listener->onRequestError($this->getEventMock($response));
    }

    /**
     * @test
     * @expectedException \Trello\Exception\ErrorException
     */
    public function shouldNotPassWhen400IsSent()
    {
        $response = $this->createResponseMock(
            self::RESPONSE_IS_CLIENT_ERROR,
            400,
            json_encode(array('message' => 'test'))
        );

        $listener = new ErrorListener;
        $listener->onRequestError($this->getEventMock($response));
    }

    /**
     * @test
     * @dataProvider getErrorCodesProvider
     * @expectedException \Trello\Exception\ValidationFailedException
     */
    public function shouldNotPassWhen422IsSentWithErrorCode($errorCode)
    {
        $content = json_encode(array(
            'message' => 'Validation Failed',
            'errors'  => array(
                array(
                    'code'     => $errorCode,
                    'field'    => 'test',
                    'value'    => 'wrong',
                    'resource' => 'fake'
                )
            )
        ));
        $response = $this->createResponseMock(
            self::RESPONSE_IS_CLIENT_ERROR,
            422,
            $content
        );

        $listener = new ErrorListener;
        $listener->onRequestError($this->getEventMock($response));
    }

    public function getErrorCodesProvider()
    {
        return array(
            array('missing'),
            array('missing_field'),
            array('invalid'),
            array('already_exists'),
        );
    }

    private function getEventMock($response)
    {
        $mock = $this->getMockBuilder('Guzzle\Common\Event')
            ->getMock();
        $request = $this->getMockBuilder('Guzzle\Http\Message\Request')
            ->disableOriginalConstructor()
            ->getMock();
        $request->expects($this->any())
            ->method('getResponse')
            ->will($this->returnValue($response));
        $mock->expects($this->any())
            ->method('offsetGet')
            ->will($this->returnValue($request));
        return $mock;
    }

    private function createResponseMock(
        $isClientError,
        $httpStatusCode,
        $responseBody = ''
    ) {
        $mock = $this->getMockBuilder('Guzzle\Http\Message\Response')
            ->disableOriginalConstructor()
            ->getMock();
        $mock->expects($this->once())
            ->method('isClientError')
            ->will($this->returnValue($isClientError));
        $mock->expects($this->any())
            ->method('getBody')
            ->willReturn($responseBody);
        $mock->expects($this->any())
            ->method('getStatusCode')
            ->willReturn($httpStatusCode);

        return $mock;
    }
}
