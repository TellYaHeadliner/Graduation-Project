@if($discount_type === \App\Enums\Voucher\VoucherDiscountType::FixedAmount->value)
<span class="promotion-price">{{ format_price($discount_value) }}</span>
@else
<span class="promotion-price">{{ $discount_value }} %</span>
@endif
