<?php

require_once BASE_PATH . '/Service/CatalogService.php';

class CatalogController
{
    private CatalogService $catalogService;

    public function __construct(CatalogService $catalogService)
    {
        $this->catalogService = $catalogService;
    }

    /**
     * Homepage
     */
    public function home(): void
    {
        $pageTitle = 'Personal Media Library';
        $section = 'catalog';

        $random = $this->catalogService->random_catalog_array();

        require BASE_PATH . '/view/home.php';
    }

    /**
     * Catalog page (VERY THIN now)
     */
    public function index(): void
    {
        // Controller only passes request data to service
        $data = $this->catalogService->getCatalogPage($_GET);

        // Extract variables for view (simple MVC style)
        extract($data);

        require BASE_PATH . '/view/catalog.php';
    }
}
