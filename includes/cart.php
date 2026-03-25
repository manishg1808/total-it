<?php
declare(strict_types=1);

require_once __DIR__ . '/printer-products.php';

if (!function_exists('cartBootstrap')) {
    function cartBootstrap(): void
    {
        if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }
}

if (!function_exists('cartSetNotice')) {
    function cartSetNotice(string $message): void
    {
        $_SESSION['cart_notice'] = $message;
    }
}

if (!function_exists('cartPullNotice')) {
    function cartPullNotice(): ?string
    {
        if (!isset($_SESSION['cart_notice'])) {
            return null;
        }

        $message = (string) $_SESSION['cart_notice'];
        unset($_SESSION['cart_notice']);
        return $message;
    }
}

if (!function_exists('cartGet')) {
    /**
     * @return array<int, int>
     */
    function cartGet(): array
    {
        cartBootstrap();

        $cart = [];
        foreach ($_SESSION['cart'] as $id => $qty) {
            $productId = (int) $id;
            $quantity = (int) $qty;
            if ($productId > 0 && $quantity > 0) {
                $cart[$productId] = $quantity;
            }
        }

        $_SESSION['cart'] = $cart;
        return $cart;
    }
}

if (!function_exists('cartGetCount')) {
    function cartGetCount(): int
    {
        return array_sum(cartGet());
    }
}

if (!function_exists('cartAddItem')) {
    function cartAddItem(int $productId, int $qty = 1): bool
    {
        $product = getPrinterById($productId);
        if ($product === null) {
            return false;
        }

        $quantity = max(1, $qty);
        $cart = cartGet();
        $cart[$productId] = ($cart[$productId] ?? 0) + $quantity;
        $_SESSION['cart'] = $cart;
        return true;
    }
}

if (!function_exists('cartUpdateItem')) {
    function cartUpdateItem(int $productId, int $qty): void
    {
        $cart = cartGet();

        if ($qty <= 0) {
            unset($cart[$productId]);
        } elseif (isset($cart[$productId])) {
            $cart[$productId] = $qty;
        }

        $_SESSION['cart'] = $cart;
    }
}

if (!function_exists('cartRemoveItem')) {
    function cartRemoveItem(int $productId): void
    {
        $cart = cartGet();
        unset($cart[$productId]);
        $_SESSION['cart'] = $cart;
    }
}

if (!function_exists('cartClear')) {
    function cartClear(): void
    {
        $_SESSION['cart'] = [];
    }
}

if (!function_exists('cartGetItems')) {
    /**
     * @return array<int, array<string, mixed>>
     */
    function cartGetItems(): array
    {
        $items = [];
        foreach (cartGet() as $productId => $qty) {
            $product = getPrinterById($productId);
            if ($product === null) {
                continue;
            }

            $lineTotal = ((int) $product['price_value']) * $qty;
            $items[] = [
                'product' => $product,
                'qty' => $qty,
                'line_total_value' => $lineTotal,
                'line_total' => '$' . number_format((float) $lineTotal, 2),
            ];
        }

        return $items;
    }
}

if (!function_exists('cartGetSubtotalValue')) {
    function cartGetSubtotalValue(): int
    {
        $subtotal = 0;
        foreach (cartGetItems() as $item) {
            $subtotal += (int) $item['line_total_value'];
        }
        return $subtotal;
    }
}

if (!function_exists('cartGetSubtotal')) {
    function cartGetSubtotal(): string
    {
        return '$' . number_format((float) cartGetSubtotalValue(), 2);
    }
}
