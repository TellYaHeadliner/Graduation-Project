    
    @if($user['role'] === 1)
        {{ 'Hệ thống' }}
    @else
    <x-link 
        :href="route('admin.user.edit', $user['id'])" 
        :title="$user['fullname']" 
    />
    @endif