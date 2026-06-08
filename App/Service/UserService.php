<?php

namespace App\Service;

use App\Contract\UserInterface;
use App\Models\User;
use App\Service\Validator;

class UserService
{
    private UserInterface $repo;
    private Validator $validator;

    public function __construct(?UserInterface $repo = null)
    {
        $this->repo = $repo;
        $this->validator = new Validator();
    }

    public function authenticate(string $usernameOrEmail, string $password): ?array
    {
        $user = $this->repo->findByUsername($usernameOrEmail);

        if ($user === false || $user === null) {
            $user = $this->repo->findByEmail($usernameOrEmail);
        }

        if (empty($user)) {
            return null;
        }

        if (!password_verify($password, $user['password'] ?? '')) {
            return null;
        }

        unset($user['password']);

        return $user;
    }

    public function register(array $data): array
    {
        $username = trim($data['username']);
        $email = trim($data['email']);
        $password = $data['password'];

        if (!$this->validator->validate($data, User::rules())) {
            return [
                'success' => false,
                'errors' => $this->validator->errors()
            ];
        }

        if (!empty($this->repo->findByUsername($username))) {
            $errors[] = 'Username is already taken.';
        }

        if (!empty($this->repo->findByEmail($email))) {
            $errors[] = 'Email is already registered.';
        }

        if (!empty($errors)) {
            return [
                'success' => false,
                'errors' => $errors
            ];
        }

        $this->repo->create([
            'username' => $username,
            'email' => $email,
            'password' => password_hash(
                $password,
                PASSWORD_DEFAULT
            )
        ]);

        return [
            'success' => true,
            'errors' => []
        ];
    }
}
