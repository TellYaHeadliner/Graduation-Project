
    @if($user['role'] === 1)
        {{ 'Hệ thống' }}
    @else
    {{ $user['fullname'] }}
    @endif