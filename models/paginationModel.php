<?php
class PaginationModel
{
    private $totalItems;
    private $itemsPerPage;

    public function __construct($totalItems, $itemsPerPage)
    {
        $this->totalItems = $totalItems;
        $this->itemsPerPage = $itemsPerPage;
    }

    public function getTotalPages()
    {
        return ceil($this->totalItems / $this->itemsPerPage);
    }

    public function getCurrentPage($currentPage)
    {
        $totalPages = $this->getTotalPages();
        if ($currentPage < 1) {
            $currentPage = 1;
        } elseif ($currentPage > $totalPages) {
            $currentPage = $totalPages;
        }
        return $currentPage;
    }

    public function getOffset($currentPage)
    {
        $currentPage = $this->getCurrentPage($currentPage);
        return ($currentPage - 1) * $this->itemsPerPage;
    }

    public function getItemsPerPage()
    {
        return $this->itemsPerPage;
    }
}
?>
