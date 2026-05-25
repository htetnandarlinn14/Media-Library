<?php require BASE_PATH . '/view/Layout/header.php'; ?>

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
