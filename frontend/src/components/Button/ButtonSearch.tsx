import { MagnifyingGlassIcon } from "@radix-ui/react-icons";

export default function ButtonSearch(){
    return (
        <div className="flex flex-row items-center gap-1 text-white ml-1 mt-4">
            <button type="submit" className="bg-secondary text-white px-2 rounded-md flex items-center justify-center w-[40px] h-[40px] gap-2 sm:w-auto sm:px-3 sm:flex sm:flex-row">
                <MagnifyingGlassIcon width="20" height="20" className="sm:w-[20px] sm:h-[20px]" />
                <span className="hidden sm:inline text-sm">Tìm kiếm</span>
            </button>
        </div>
    )
}