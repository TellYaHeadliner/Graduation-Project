<div class="list-group list-group-flush">
    @foreach($conversations as $item)
        @php $customer = $item->customer; @endphp
        <a href="javascript:void(0);" class="list-group-item list-group-item-action py-3 conversation-item"
            data-conversation-id="{{ $item->id }}" id="conversation-{{ $item->id }}">
            <div class="d-flex align-items-center gap-2">
                <img src="{{ asset($customer->avatar ?? 'images/default-avatar.png') }}" alt="{{ $customer->fullname }}"
                    class="rounded-circle object-fit-cover" width="40" height="40">
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between">
                        <div class="fw-semibold text-truncate mb-2">
                            {{ $customer->fullname }}
                        </div>
                    </div>
                    <div class="text-muted text-truncate small">
                        {{ $item->last_message }} <br>
                        <small class="text-muted">
                            {{ format_date($item->last_message_at, 'd-m-Y H:i') }}
                        </small>
                    </div>
                </div>
            </div>
        </a>
    @endforeach
</div>