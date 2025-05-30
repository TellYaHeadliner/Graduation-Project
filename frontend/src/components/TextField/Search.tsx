import { MagnifyingGlassIcon } from '@radix-ui/react-icons';


export default function Search() {
    return (
        <div className="relative w-[450px] mx-auto">
            <span className="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                <MagnifyingGlassIcon className="w-5 h-5" />
            </span>
            <input
                type="text"
                placeholder="Tìm kiếm"
                className="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm outline-none focus:ring-2 focus:ring-blue-500"
            />
        </div>
    );
}