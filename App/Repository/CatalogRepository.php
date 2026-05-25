<?php

namespace App\Repository;

use App\Contract\CatalogInterface;
use PDO;

/**
 * Handles catalog database operations using PDO
 * and communicates with stored procedures.
 */
class CatalogRepository extends BaseRepository implements CatalogInterface
{
    public function __construct(PDO $db)
    {
        parent::__construct($db, 'Media', 'media_id');
    }

    // Get total catalog item count
    public function count(array $criteria = [])
    {
        return $this->getCatalogCount(
            $criteria['category'] ?? null,
            $criteria['search'] ?? null
        );
    }

    // Get complete catalog list with pagination
    public function getAll(array $criteria = [], $limit = null, $offset = null)
    {
        return $this->getCatalogItems(
            $criteria['search'] ?? null,
            $criteria['category'] ?? null,
            $limit,
            $offset
        );
    }

    // Get random catalog items
    public function getRandomCatalog()
    {
        $result = $this->db->query(' SELECT * FROM view_random ');

        $catalog = $result->fetchAll();

        return $catalog;
    }

    public function read(int $id)
    {
        return $this->fetchItemDetail($id);
    }

    protected function fetchItemDetail(int $id)
    {
        $statement = $this->db->prepare('CALL sp_get_item_full_detail(:media_id)');
        $statement->bindValue(':media_id', $id, PDO::PARAM_INT);
        $statement->execute();

        $details = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->nextRowset();

        $people = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();

        if ($details === false) {
            return null;
        }

        foreach ($people as $person) {
            if (empty($person['fullname']) || empty($person['role'])) {
                continue;
            }

            $role = strtolower($person['role']);
            $details[$role][] = $person['fullname'];
        }

        return $details;
    }

    protected function getCatalogCount($category = null, $search = null)
    {
        $search = !empty($search) ? $search : null;
        $category = !empty($category) ? $category : null;

        $result = $this->db->prepare('CALL sp_search_catalog_count (:search, :category)');

        $result->bindValue(
            ':search',
            $search,
            $search === null ? PDO::PARAM_NULL : PDO::PARAM_STR
        );

        $result->bindValue(
            ':category',
            $category,
            $category === null ? PDO::PARAM_NULL : PDO::PARAM_STR
        );

        $result->execute();

        $count = $result->fetchColumn();

        $result->nextRowset();
        $result->closeCursor();

        return $count;
    }

    protected function getCatalogItems($search = null, $category = null, $limit = null, $offset = 0)
    {
        $search = ($search === '' ? null : $search);
        $category = ($category === '' ? null : $category);

        $result = $this->db->prepare('CALL sp_search_catalog (?, ?, ?, ?)');

        $result->bindValue(
            1,
            $search,
            $search === null ? PDO::PARAM_NULL : PDO::PARAM_STR
        );

        $result->bindValue(
            2,
            $category,
            $category === null ? PDO::PARAM_NULL : PDO::PARAM_STR
        );

        $result->bindValue(3, $limit, PDO::PARAM_INT);
        $result->bindValue(4, $offset, PDO::PARAM_INT);

        $result->execute();

        $catalog = $result->fetchAll();

        $result->nextRowset();
        $result->closeCursor();

        return $catalog;
    }
}
