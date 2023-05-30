<?php

namespace Tests\Unit\Domains\Authentication\Actions;

use Illuminate\Support\Facades\Log;
use App\Domains\Authentication\Actions\LoginUser;
use App\Domains\Authentication\Models\User;
use Exception;
use Mockery;
use PHPUnit\Framework\TestCase;

class LoginUserTest extends TestCase
{
    /**
     * A basic unit test example.
     * @throws Exception
     */
    public function test_it_returns_the_user_and_a_token(): void
    {
        // Arrange
        $expectedToken = 'token123';
        $tokenName = 'authToken';
        $user = Mockery::mock(User::class);
        $user->expects('createToken')
            ->with($tokenName)
            ->andReturns((object)['plainTextToken' => $expectedToken]);

        $loginUser = new LoginUser();

        // Act
        $result = $loginUser->execute($user, $tokenName);

        // Assert
        $this->assertArrayHasKey('user', $result);
        $this->assertArrayHasKey('token', $result);
        $this->assertEquals($user, $result['user']);
        $this->assertEquals($expectedToken, $result['token']);
    }

    public function test_it_throws_exception_when_token_creation_fails(): void
    {
        // Arrange
        Log::shouldReceive('error')->once();

        $tokenName = 'authToken';
        $exceptionMessage = 'Error creating token for user';
        $user = Mockery::mock(User::class);
        $user->expects('createToken')
            ->with($tokenName)
            ->andThrow(new Exception($exceptionMessage));

        $loginUser = new LoginUser();

        // Assert
        $this->expectException(Exception::class);
        $this->expectExceptionMessage($exceptionMessage);

        // Act
        $loginUser->execute($user, $tokenName);
    }

    public function tearDown(): void
    {
        Mockery::close();
    }
}
