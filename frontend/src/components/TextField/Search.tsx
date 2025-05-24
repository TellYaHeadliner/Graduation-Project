import { TextField } from '@radix-ui/themes';
import { MagnifyingGlassIcon } from '@radix-ui/react-icons';

export default function Search() {
    return (
        <TextField.Root placeholder="Bạn muốn tìm kiếm điều gì ?" size="3" className="w-68 sm:w-100 ">
            <TextField.Slot>
                <MagnifyingGlassIcon height="16" width="16" />
            </TextField.Slot>
        </TextField.Root>
    );
}