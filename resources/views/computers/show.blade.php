@include('subviews/header', ['title' => $page_title])

@php
    // @todo - remove this once backend gets their act together
    $customer_discount = 20;
    $discounted_price = $product_price * ((100 - $customer_discount)/100);
    $discounted_price = number_format($discounted_price, 2, '.','');
@endphp

<ul>
    <li>SKU: {{ $product_sku }}</li>
    <li>Brand: {{ $product_brand }}</li>
    <li>Model: {{ $product_model }}</li>
    <li>Price: ${{ $discounted_price }}</li>
</ul>

@include('subviews/footer')
