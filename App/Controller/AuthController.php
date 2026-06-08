<?php

namespace App\Controller;

use App\Request\LoginRequest;
use App\Request\RegisterUserRequest;
use App\Service\UserService;
use App\Validation\Validator;

class AuthController
{
    private $userService;
    private $Validator;

    public function __construct(
        UserService $userService,
        Validator $validator
    ) {
        $this->userService = $userService;
        $this->Validator = $validator;
    }

    public function login(): void
    {
        $pageTitle = 'Login';
        $section = 'login';
        $hideSearch = true;

        $errors = [];
        $usernameOrEmail = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usernameOrEmail =
                trim($_POST['username_or_email'] ?? '');

            $password =
                $_POST['password'] ?? '';

            $formData = [
                'email' => $usernameOrEmail,
                'password' => $password
            ];

            $errors = $this->validator->validate(
                $formData,
                LoginRequest::rules()
            );

            if (empty($errors)) {
                $user =
                    $this->userService->authenticate(
                        $usernameOrEmail,
                        $password
                    );

                if ($user !== null) {
                    $_SESSION['user'] = $user;

                    header(
                        'Location: '
                        . BASE_URL
                        . '/Public/index.php?page=catalog'
                    );

                    exit;
                }

                $errors['auth'][] =
                    'Invalid login credentials.';
            }
        }

        require BASE_PATH . '/view/login.php';
    }

    public function register(): void
    {
        $pageTitle = 'Register';
        $section = 'register';
        $hideSearch = true;

        $successMessage = null;
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formData = [
                'username' =>
                    trim($_POST['username'] ?? ''),
                'email' =>
                    trim($_POST['email'] ?? ''),
                'password' =>
                    $_POST['password'] ?? '',
                'confirm_password' =>
                    $_POST['confirm_password'] ?? ''
            ];

            $errors =
                $this->validator->validate(
                    $formData,
                    RegisterUserRequest::rules()
                );

            if (empty($errors)) {
                $result =
                    $this->userService->register(
                        $formData
                    );

                if ($result['success']) {
                    $successMessage =
                        'Your account has been created.';
                } else {
                    $errors =
                        array_merge(
                            $errors,
                            $result['errors']
                        );
                }
            }
        }

        require BASE_PATH . '/view/register.php';
    }

    public function logout(): void
    {
        session_unset();
        session_destroy();

        header(
            'Location: '
            . BASE_URL
            . '/Public/index.php?page=login'
        );

        exit;
    }
}
