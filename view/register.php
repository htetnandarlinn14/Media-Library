<?php require BASE_PATH . '/view/Layout/header.php'; ?>
<style>
    .auth-page {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 60px 20px;
    }

    .auth-card {
        width: 100%;
        max-width: 420px;
        background: #ffffff;
        padding: 35px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .auth-card h2 {
        text-align: center;
        margin-bottom: 25px;
        color: #333;
        font-size: 28px;
    }

    .auth-card label {
        display: block;
        margin-bottom: 8px;
        margin-top: 15px;
        font-weight: 600;
        color: #444;
    }

    .auth-card input {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 15px;
        box-sizing: border-box;
        transition: border 0.3s ease;
    }

    .auth-card input:focus {
        border-color: #ef7d7d;
        outline: none;
    }

    .auth-card button {
        width: 100%;
        margin-top: 25px;
        padding: 12px;
        background: #ef7d7d;
        border: none;
        border-radius: 8px;
        color: white;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .auth-card button:hover {
        background: #f65b5b;
    }

    .message {
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 20px;
        list-style: none;
    }

    .message.success {
        background: #d4edda;
        color: #155724;
    }

    .message.error {
        background: #f8d7da;
        color: #721c24;
    }

    .auth-link {
        margin-top: 20px;
        text-align: center;
        font-size: 14px;
    }

    .auth-link a {
        color: #fa5f5f;
        text-decoration: none;
    }

    .auth-link a:hover {
        text-decoration: underline;
    }
</style>
<div class="section page">
    <div class="wrapper auth-page">
        <div class="auth-card">
            <h2>Register</h2>

            <?php if (!empty($successMessage)): ?>
                <p class="message success"><?= htmlspecialchars($successMessage) ?></p>
            <?php endif; ?>

            <?php if (!empty($errors)): ?>
                <ul class="message error">
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <form method="post" action="<?= BASE_URL ?>/Public/index.php?page=register">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?= htmlspecialchars($username) ?>" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>

                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>

                <button type="submit">Register</button>
            </form>

            <p class="auth-link">
                Already registered? <a href="<?= BASE_URL ?>/Public/index.php?page=login">Login here</a>.
            </p>
        </div>
    </div>
</div>

<?php require BASE_PATH . '/view/Layout/footer.php'; ?>
