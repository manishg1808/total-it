<?php
declare(strict_types=1);

if (!function_exists('getPrinterCatalog')) {
    /**
     * @return array<int, array<string, mixed>>
     */
    function getPrinterCatalog(): array
    {
        static $catalog = null;

        if (is_array($catalog)) {
            return $catalog;
        }

        $catalog = [];

        $brands = ['HP', 'Canon', 'Brother', 'Epson'];
        $series = ['OfficeJet', 'PIXMA', 'LaserJet', 'EcoTank', 'WorkForce', 'imageCLASS', 'MFC', 'DeskJet', 'MAXIFY'];
        $types = ['Inkjet', 'Laser', 'All-in-One', 'Wireless'];
        $usageModes = ['Home', 'Office', 'Photo', 'High Volume'];
        $badges = ['Best Seller', 'Hot Deal', 'Top Rated', 'Value Pick', 'Office Pick'];

        for ($i = 1; $i <= 36; $i++) {
            $brand = $brands[$i % count($brands)];
            $model = $series[$i % count($series)] . ' ' . (1000 + ($i * 7));
            $name = $brand . ' ' . $model;
            $type = $types[$i % count($types)];
            $usage = $usageModes[$i % count($usageModes)];
            $price = 129 + ($i * 7);
            $oldPrice = $price + 40;
            $rating = number_format(4.1 + (($i % 8) * 0.1), 1);
            $printSpeed = (string) (18 + ($i % 10)) . ' ppm';
            $dutyCycle = number_format(6000 + ($i * 200)) . ' pages/month';

            $catalog[] = [
                'id' => $i,
                'brand' => $brand,
                'name' => $name,
                'usage' => $usage,
                'price_value' => $price,
                'price' => '$' . number_format($price, 2),
                'old_price' => '$' . number_format($oldPrice, 2),
                'rating' => $rating,
                'badge' => $badges[$i % count($badges)],
                'type' => $type,
                'description' => $name . ' offers reliable output quality, stable connectivity, and smooth operation for home and office printing tasks.',
                'highlights' => [
                    'Sharp text output and consistent color performance',
                    'Easy wireless setup with multi-device support',
                    'Energy efficient design for daily workloads',
                ],
                'specs' => [
                    'Printer Type' => $type,
                    'Print Speed' => $printSpeed,
                    'Connectivity' => 'Wi-Fi, USB, Ethernet',
                    'Duty Cycle' => $dutyCycle,
                    'Best For' => 'Home & Office',
                    'Warranty' => '1 Year Brand Warranty',
                ],
            ];
        }

        return $catalog;
    }
}

if (!function_exists('getPrinterById')) {
    /**
     * @return array<string, mixed>|null
     */
    function getPrinterById(int $id): ?array
    {
        foreach (getPrinterCatalog() as $product) {
            if ((int) $product['id'] === $id) {
                return $product;
            }
        }

        return null;
    }
}
