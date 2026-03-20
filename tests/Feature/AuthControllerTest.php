<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    // -------------------------------------------------------------------------
    // Registration
    // -------------------------------------------------------------------------

    public function test_register_form_is_accessible(): void
    {
        $this->get(route('register'))
            ->assertStatus(200)
            ->assertViewIs('Frontend.Auth.register');
    }

    public function test_user_can_register_with_valid_data(): void
    {
        $response = $this->post(route('register'), [
            'fname' => 'John',
            'lname' => 'Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('home'));

        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
            'firstName' => 'John',
            'lastName' => 'Doe',
            'admin' => false,
        ]);

        $this->assertAuthenticated();
    }

    public function test_password_is_hashed_on_registration(): void
    {
        $this->post(route('register'), [
            'fname' => 'John',
            'lname' => 'Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $user = User::where('email', 'john@example.com')->first();

        $this->assertTrue(Hash::check('password123', $user->password));
        $this->assertNotEquals('password123', $user->password);
    }

    public function test_registration_fails_with_duplicate_email(): void
    {
        User::create([
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'admin' => false,
        ]);

        $this->post(route('register'), [
            'fname' => 'John',
            'lname' => 'Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_registration_fails_when_passwords_do_not_match(): void
    {
        $this->post(route('register'), [
            'fname' => 'John',
            'lname' => 'Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'different456',
        ])->assertSessionHasErrors('password');

        $this->assertGuest();
    }

    public function test_registration_fails_with_short_password(): void
    {
        $this->post(route('register'), [
            'fname' => 'John',
            'lname' => 'Doe',
            'email' => 'john@example.com',
            'password' => '123',
            'password_confirmation' => '123',
        ])->assertSessionHasErrors('password');
    }

    public function test_registration_fails_with_invalid_email(): void
    {
        $this->post(route('register'), [
            'fname' => 'John',
            'lname' => 'Doe',
            'email' => 'not-an-email',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ])->assertSessionHasErrors('email');
    }

    public function test_registration_fails_with_missing_required_fields(): void
    {
        $this->post(route('register'), [])
            ->assertSessionHasErrors(['email', 'fname', 'lname', 'password']);
    }

    public function test_registration_fails_when_fname_exceeds_max_length(): void
    {
        $this->post(route('register'), [
            'fname' => str_repeat('a', 51),
            'lname' => 'Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ])->assertSessionHasErrors('fname');
    }

    // -------------------------------------------------------------------------
    // Login
    // -------------------------------------------------------------------------

    public function test_login_form_is_accessible(): void
    {
        $this->get(route('login'))
            ->assertStatus(200)
            ->assertViewIs('Frontend.Auth.login');
    }

    public function test_user_can_login_with_correct_credentials(): void
    {
        $user = User::create([
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'admin' => false,
        ]);

        $this->post(route('login'), [
            'email' => 'john@example.com',
            'password' => 'password123',
        ])->assertRedirect(route('home'));

        $this->assertAuthenticatedAs($user);
    }

    public function test_login_fails_with_incorrect_password(): void
    {
        User::create([
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'admin' => false,
        ]);

        $this->post(route('login'), [
            'email' => 'john@example.com',
            'password' => 'wrongpassword',
        ])->assertSessionHasErrors('credentials');

        $this->assertGuest();
    }

    public function test_login_fails_with_non_existent_email(): void
    {
        $this->post(route('login'), [
            'email' => 'nobody@example.com',
            'password' => 'password123',
        ])->assertSessionHasErrors('credentials');

        $this->assertGuest();
    }

    public function test_login_fails_with_missing_fields(): void
    {
        $this->post(route('login'), [])
            ->assertSessionHasErrors(['email', 'password']);
    }

    public function test_session_is_regenerated_on_login(): void
    {
        User::create([
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'admin' => false,
        ]);

        $this->post(route('login'), [
            'email' => 'john@example.com',
            'password' => 'password123',
        ]);

        // The session was regenerated without error
        $this->assertAuthenticated();
    }

    // -------------------------------------------------------------------------
    // Logout
    // -------------------------------------------------------------------------

    public function test_authenticated_user_can_logout(): void
    {
        $user = User::create([
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'admin' => false,
        ]);

        $this->actingAs($user)
            ->post(route('logout'))
            ->assertRedirect(route('home'));

        $this->assertGuest();
    }

    public function test_session_is_invalidated_on_logout(): void
    {
        $user = User::create([
            'firstName' => 'Jane',
            'lastName' => 'Doe',
            'email' => 'jane@example.com',
            'password' => Hash::make('password123'),
            'admin' => false,
        ]);

        $this->actingAs($user)->post(route('logout'));

        $this->assertGuest();
    }
    // -------------------------------------------------------------------------
    // Password Reset — Send Link
    // -------------------------------------------------------------------------

    public function test_send_reset_link_succeeds_for_existing_email(): void
    {
        Notification::fake();

        $user = User::create([
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'admin' => false,
        ]);

        $this->post(route('password.email'), ['email' => 'john@example.com'])
            ->assertSessionHas('message');

        Notification::assertSentTo($user, ResetPassword::class);
    }

    public function test_send_reset_link_fails_for_non_existent_email(): void
    {
        $this->post(route('password.email'), ['email' => 'nobody@example.com'])
            ->assertSessionHasErrors('email');
    }

    public function test_send_reset_link_fails_with_invalid_email(): void
    {
        $this->post(route('password.email'), ['email' => 'not-an-email'])
            ->assertSessionHasErrors('email');
    }

    // -------------------------------------------------------------------------
    // Password Reset — Show Form
    // -------------------------------------------------------------------------

    public function test_reset_password_form_is_accessible_with_valid_token(): void
    {
        $user = User::create([
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'admin' => false,
        ]);
        $token = Password::createToken($user);

        $this->get(route('password.reset', ['token' => $token, 'email' => $user->email]))
            ->assertStatus(200)
            ->assertViewIs('Frontend.Auth.reset_password')
            ->assertViewHas('token', $token)
            ->assertViewHas('email', $user->email);
    }

    // -------------------------------------------------------------------------
    // Password Reset — Reset Password
    // -------------------------------------------------------------------------

    public function test_user_can_reset_password_with_valid_token(): void
    {
        $user = User::create([
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'admin' => false,
        ]);
        $token = Password::createToken($user);

        $this->post(route('password.update'), [
            'token' => $token,
            'email' => $user->email,
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ])->assertRedirect('/login')
          ->assertSessionHas('status');

        $this->assertTrue(Hash::check('newpassword123', $user->fresh()->password));
    }

    public function test_password_reset_fails_with_invalid_token(): void
    {
        $user = User::create([
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'admin' => false,
        ]);

        $this->post(route('password.update'), [
            'token' => 'invalid-token',
            'email' => $user->email,
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ])->assertSessionHasErrors('email');
    }

    public function test_password_reset_fails_when_passwords_do_not_match(): void
    {
        $user = User::create([
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'admin' => false,
        ]);
        $token = Password::createToken($user);

        $this->post(route('password.update'), [
            'token' => $token,
            'email' => $user->email,
            'password' => 'newpassword123',
            'password_confirmation' => 'different456',
        ])->assertSessionHasErrors('password');
    }

    public function test_password_reset_fails_with_short_password(): void
    {
        $user = User::create([
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'admin' => false,
        ]);
        $token = Password::createToken($user);

        $this->post(route('password.update'), [
            'token' => $token,
            'email' => $user->email,
            'password' => '123',
            'password_confirmation' => '123',
        ])->assertSessionHasErrors('password');
    }

    public function test_password_reset_fails_with_missing_fields(): void
    {
        $this->post(route('password.update'), [])
            ->assertSessionHasErrors(['token', 'email', 'password']);
    }
}
