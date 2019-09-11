@component('mail::message')
# Introduction

An custom order has been made - details can be seen at {{ env('APP_URL') }}/orders/{{ $orderid }}

@component('mail::button', ['url' => env('APP_URL') . '/orders/' . $orderid])
View order
@endcomponent

@endcomponent
