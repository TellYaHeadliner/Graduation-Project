<input type="text" data-mask="0000000000" placeholder="0000000000" autocomplete="off"
				{{ $attributes->class(['form-control'])->merge([
				        'placeholder' => __('Số điện thoại'),
				        'data-parsley-pattern' => '/((09|03|07|08|05)+([0-9]{8})\b)/g',
				        'data-parsley-pattern-message' => __('Số điện thoại không hợp lệ.'),
				    ])->merge($isRequired()) }}>
