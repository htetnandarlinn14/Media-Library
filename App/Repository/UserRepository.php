<?php

namespace App\Repository;

use App\Contract\UserInterface;
use App\Repository\BaseRepository;
use PDO;

class UserRepository extends BaseRepository implements UserInterface
{
    public function __construct(PDO $db)
    {
        parent::__construct($db, 'users', 'user_id');
    }

    public function findByUsername(string $username): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE username = :username LIMIT 1');
        $stmt->execute(['username' => $username]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function exists(string $username, string $email): bool
    {
        $sql = 'SELECT 1 FROM users WHERE username = ? OR email = ? LIMIT 1';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$username, $email]);

        return $stmt->fetchColumn() !== false;
    }
}
