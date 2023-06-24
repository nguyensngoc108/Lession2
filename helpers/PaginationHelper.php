<?php

class PaginationHelper {
    public function generatePaginationLinks($totalCount, $perPage, $currentPage) {
        $totalPages = ceil($totalCount / $perPage);
        $links = '';

        if ($totalPages > 1) {
            $links .= '<ul class="pagination">';

            // Previous page link
            if ($currentPage > 1) {
                $previousPage = $currentPage - 1;
                $links .= '<li><a href="?page=' . $previousPage . '">Previous</a></li>';
            }

            // Page links
            for ($i = 1; $i <= $totalPages; $i++) {
                if ($i == $currentPage) {
                    $links .= '<li class="active"><a href="#">' . $i . '</a></li>';
                } else {
                    $links .= '<li><a href="?page=' . $i . '">' . $i . '</a></li>';
                }
            }

            // Next page link
            if ($currentPage < $totalPages) {
                $nextPage = $currentPage + 1;
                $links .= '<li><a href="?page=' . $nextPage . '">Next</a></li>';
            }

            $links .= '</ul>';
        }

        return $links;
    }
}
