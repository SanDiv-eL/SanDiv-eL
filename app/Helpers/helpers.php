<?php

if (!function_exists('formatRupiah')) {
    /**
     * Format number as Indonesian Rupiah currency
     */
    function formatRupiah($amount)
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
}
