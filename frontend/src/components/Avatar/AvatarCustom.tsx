import * as Avatar from '@radix-ui/react-avatar';

interface AvatarProps {
    username: string;
    avatar?: string | null;
}

export default function AvatarCustom({ username, avatar }: AvatarProps) {
    const fallbackText = username
        .split(' ')
        .map(word => word.charAt(0).toUpperCase())
        .join('')
        .slice(0, 3); // lấy tối đa 3 chữ cái đầu

    return (
        <Avatar.Root className="inline-flex items-center justify-center w-9 h-9 bg-gray-200 rounded-full overflow-hidden">
            {avatar ? (
                <Avatar.Image
                    src={import.meta.env.VITE_URL + avatar}
                    alt={username}
                    className="w-full h-full object-cover"
                />
            ) : null}
            <Avatar.Fallback className="text-sm font-medium text-gray-600" delayMs={300}>
                {fallbackText}
            </Avatar.Fallback>
        </Avatar.Root>
    );
}
