{{-- {{ $parent['name'] ?? 'Không có' }} --}}
    <x-link 
        :href="route('admin.user.edit', $user['id'])" 
        :title="$user['fullname']" 
    />

