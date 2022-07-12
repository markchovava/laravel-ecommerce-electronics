@php
    $usd_price = intval($product->price);
    $discount = ($product->discounts->discount_percent / 100) * $usd_price;
    $discount_usd_price = $usd_price - $discount;
    $price = $discount_usd_price / 100;
@endphp


<div class="mb-4 pricing">
    <div class="d-flex align-items-baseline">
        <del class="font-size-18 mr-2 text-gray-2">
            @php
            $usd_price = $product->price;
            $price = $usd_price / 100;
            @endphp
            ${{ number_format((float)$price, 2, '.', '') }}
        </del>
        <ins class="font-size-36 text-decoration-none">
            @php
                $discount = ($product->discounts->discount_percent / 100) * $usd_price;
                $discount_usd_price = $usd_price - $discount;
                $price = $discount_usd_price / 100;
            @endphp
            <span class="price__number">
                ${{ number_format((float)$price, 2, '.', '') }}
            </span>
        </ins>
        <input type="hidden" name="discounted_usd_priceCents" value="{{ $discount_usd_price }}">
    </div>
    <div class="d-flex align-items-baseline">
        <del class="font-size-18 mr-2 text-gray-2">
            @php
            $zwl_priceCents = ($product->price * $currency->value);
            $zwl_price = $zwl_priceCents / 100;
            @endphp
            ZWL${{ number_format((float)$zwl_price, 2, '.', '') }}
        </del>
        <ins class="font-size-36 text-decoration-none">
            @php
                $discount = ($product->discounts->discount_percent / 100) * $zwl_priceCents;
                $discount_price = $zwl_priceCents - $discount;
                $zwl_price = $discount_price / 100;
            @endphp
            <span class="price__number">
                ZWL${{ number_format((float)$zwl_price, 2, '.', '') }}
            </span>
        </ins>
        <input type="hidden" name="discounted_zwl_price" value="{{ $discount_price }}">
    </div>
</div>