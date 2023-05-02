<?php

declare(strict_types=1);

namespace OpenXBL\Tests;

use GuzzleHttp\ClientInterface;
use InvalidArgumentException;
use Mockery;
use Mockery\MockInterface;
use OpenXBL\HttpService;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * @covers \OpenXBL\HttpService
 */
final class HttpServiceTest extends TestCase
{
    /** @var MockInterface|ClientInterface  */
    private ClientInterface $client;

    /** @var MockInterface|ResponseInterface  */
    private ResponseInterface $response;

    protected function setUp(): void 
    {
        $this->client = Mockery::mock(ClientInterface::class);
        $this->stream = Mockery::mock(StreamInterface::class);
        $this->response = Mockery::mock(ResponseInterface::class);
    }

    public function testGetRequestSuccess(): void
    {
        $this->client
            ->shouldReceive('request')
            ->andReturn($this->response);

        $this->response->shouldReceive('getBody')
            ->andReturn($this->stream);

        $this->stream->shouldReceive('getContents')
            ->andReturn('success');

        $result = new HttpService($this->client);

        $this->assertEquals('success', $result->get('account'));
    }

    public function testPostRequestSuccess(): void
    {
        $this->client
            ->shouldReceive('request')
            ->andReturn($this->response);

        $this->response->shouldReceive('getBody')
            ->andReturn($this->stream);

        $this->stream->shouldReceive('getContents')
            ->andReturn('success');

        $result = new HttpService($this->client);

        $this->assertEquals('success', $result->post('generate/gamertag', ['unit' => 'test']));
    }

    public function testMissingEndpoint(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $result = new HttpService($this->client);
        $result->get();
    }

}
