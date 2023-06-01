<?php

namespace Tests\Unit\Domains\Authentication\Actions;

use App\Domains\Authentication\Actions\CreateUser;
use App\Domains\Authentication\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;
use Mockery;
use PHPUnit\Framework\TestCase;

class CreateUserTest extends TestCase
{

    /**
     * @throws Exception
     */
    public function test_it_creates_a_user_and_returns_it()
    {
        // Arrange
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'user_type' => 'company',
        ];

        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        $user = Mockery::mock(User::class)->makePartial()->shouldAllowMockingProtectedMethods();
        $user->expects('save')->andReturnTrue();
        $user->expects('assignRole')->with($data['user_type'])->andReturns($user);

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $hashedPassword;

        $createUser = new CreateUser($user);

        // Act
        $createdUser = $createUser->execute($data);

        // Assert
        $this->assertInstanceOf(User::class, $createdUser);
        $this->assertEquals($data['name'], $createdUser->name);
        $this->assertEquals($data['email'], $createdUser->email);
        $this->assertTrue(password_verify($data['password'], $createdUser->password));
    }

    public function test_it_logs_an_error_and_throws_exception_when_user_creation_fails(): void
    {
        // Arrange
        Log::shouldReceive('error')->once();

        $exceptionMessage = 'Error creating user';
        $data = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'user_type' => 'admin'
        ];

        // Create a mock User and simulate an exception when the save method is called
        $user = Mockery::mock(User::class)->makePartial()->shouldAllowMockingProtectedMethods();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
        $user->allows('assignRole')->with($data['user_type']);
        $user->allows('save')->andThrow(new Exception($exceptionMessage));

        // We expect our method to throw an exception when the save method fails
        $this->expectException(Exception::class);
        $this->expectExceptionMessage($exceptionMessage);

        $createUser = new CreateUser($user);

        // Act
        $createUser->execute($data);
    }

    public function tearDown(): void
    {
        Mockery::close();
    }
}
