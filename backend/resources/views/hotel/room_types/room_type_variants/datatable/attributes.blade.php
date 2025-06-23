<ul class="list-unstyled" style="text-align: left;">
    @foreach($model->attributes as $attribute)
        <li class="mb-2 d-flex">
            @if($attribute->name === 'Miễn phí huỷ trước 24h và thu phí sau đó' || $attribute->name === 'Không hoàn tiền')
                <strong class="me-2" style="min-width: 150px;">{{ __('Chính sách hủy') }}:</strong>
            @else
                <strong class="me-2" style="min-width: 150px;">{{ $attribute->name }}:</strong>
            @endif
            @if($attribute->name === 'Người lớn' || $attribute->name === 'Trẻ em')
                <span>{{ $attribute->pivot->attribute_value ?? 0}} người</span>
            @elseif($attribute->name === 'Bao gồm bữa sáng' || $attribute->name === 'Không hút thuốc')
                <span>{{ $attribute->pivot->attribute_value ? __('Có') : __('Không') }}</span>
            @elseif($attribute->name === 'Miễn phí huỷ trước 24h và thu phí sau đó' || $attribute->name === 'Không hoàn tiền')
                <span>
                    {{ $attribute->name }}
                    @if($fee_type === 0)
                      <span>{{ $attribute->pivot->attribute_value !== 0 ? "( " . format_price($attribute->pivot->attribute_value) . ' )' : '' }}</span>
                    @elseif($fee_type === 1)
                      <span>{{ $attribute->pivot->attribute_value !== 0 ? "( " . $attribute->pivot->attribute_value . ' % )' : '' }}</span>
                    @endif
                </span>

            @else
                <span>{{ $attribute->pivot->attribute_value }}</span>
            @endif
        </li>
    @endforeach
</ul>