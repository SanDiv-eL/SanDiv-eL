<?php

namespace App\Helpers;

class QRISHelper
{
    /**
     * Generate dynamic QRIS from static QRIS data
     * Exactly matching the JavaScript updateQrisString() function
     * 
     * @param string $staticQRIS The static QRIS string
     * @param float $amount Transaction amount
     * @param string $invoiceNumber Invoice/Order number (not used, for compatibility)
     * @return string Dynamic QRIS string
     */
    public static function generateDynamicQRIS($staticQRIS, $amount, $invoiceNumber = null)
    {
        $rootNodes = [];
        $i = 0;
        
        // Parse all tags - STORE BOTH LENGTH AND VALUE (like JavaScript)
        while ($i < strlen($staticQRIS)) {
            $tag = substr($staticQRIS, $i, 2);
            if ($tag === '63') break; // Stop at CRC tag
            
            $length = (int) substr($staticQRIS, $i + 2, 2);
            if ($length === 0 || $length > 99) break; // Invalid length
            
            $value = substr($staticQRIS, $i + 4, $length);
            
            // Store BOTH length and value (critical!)
            $rootNodes[$tag] = ['length' => $length, 'value' => $value];
            
            $i += 4 + $length;
        }
        
        // Change Point of Initiation Method from static to dynamic
        if (isset($rootNodes['01']) && $rootNodes['01']['value'] === '11') {
            $rootNodes['01']['value'] = '12';
        }
        
        // Update amount - EXACT SAME as JavaScript: String(parseFloat(newAmount))
        $amountStr = (string) floatval($amount);
        $rootNodes['54'] = ['length' => strlen($amountStr), 'value' => $amountStr];
        
        // Rebuild string without CRC
        $newStringWithoutCrc = '';
        
        // Sort tags (JavaScript: Object.keys(rootNodes).sort((a,b) => a - b))
        ksort($rootNodes);
        
        foreach ($rootNodes as $tag => $node) {
            $lengthStr = str_pad($node['length'], 2, '0', STR_PAD_LEFT);
            $newStringWithoutCrc .= $tag . $lengthStr . $node['value'];
        }
        
        // Add CRC tag placeholder
        $finalStringWithCrcTag = $newStringWithoutCrc . '6304';
        
        // Calculate CRC16
        $newCrc = self::crc16_ccitt_false($finalStringWithCrcTag);
        $crcHex = strtoupper(str_pad(dechex($newCrc), 4, '0', STR_PAD_LEFT));
        
        return $finalStringWithCrcTag . $crcHex;
    }
    
    /**
     * CRC16-CCITT-FALSE algorithm
     * Exact match with JavaScript crc16_ccitt_false() function
     */
    private static function crc16_ccitt_false($data)
    {
        $crc = 0xFFFF;
        
        for ($i = 0; $i < strlen($data); $i++) {
            $crc ^= ord($data[$i]) << 8;
            
            for ($j = 0; $j < 8; $j++) {
                if ($crc & 0x8000) {
                    $crc = ($crc << 1) ^ 0x1021;
                } else {
                    $crc = $crc << 1;
                }
            }
        }
        
        return $crc & 0xFFFF;
    }
    
    /**
     * Parse QRIS for merchant info extraction
     */
    public static function getMerchantInfo($qris)
    {
        $tags = [];
        $i = 0;
        
        while ($i < strlen($qris)) {
            if ($i + 4 > strlen($qris)) break;
            
            $tag = substr($qris, $i, 2);
            if ($tag === '63') break;
            
            $length = (int) substr($qris, $i + 2, 2);
            if ($length === 0 || $length > 99) break;
            
            $value = substr($qris, $i + 4, $length);
            $tags[$tag] = $value;
            
            $i += 4 + $length;
        }
        
        return [
            'merchant_name' => $tags['59'] ?? 'Unknown Merchant',
            'merchant_city' => $tags['60'] ?? '',
            'postal_code' => $tags['61'] ?? '',
            'currency' => $tags['53'] ?? '360',
        ];
    }
}
