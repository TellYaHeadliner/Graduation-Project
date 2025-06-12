<div class="d-flex align-items-center justify-content-center">
    <x-button.modal-delete class="btn-icon" data-route="{{ route('admin.notification.delete', [$notification['id'],$user['id']]) }}">
        <i class="ti ti-trash"></i>
    </x-button.modal-delete> 
</div>