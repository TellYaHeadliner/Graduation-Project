import { MagnifyingGlassIcon } from '@radix-ui/react-icons';
import { useState } from 'react';
import { useNavigate } from 'react-router-dom';


export default function Search() {
    const [searchHotel, setSearchHotel] = useState<string>("");
    const navigate = useNavigate();

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();

        if (searchHotel.trim() !== ""){
            const encoded = encodeURIComponent(searchHotel.trim())
            navigate(`/search?query=${encoded}`)
        }
    }

    return (
        <form onSubmit={handleSubmit}>
            <div className="relative w-[450px] mx-auto">
                <span className="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                    <MagnifyingGlassIcon className="w-5 h-5" />
                </span>
                <input
                    value={searchHotel}
                    onChange={(e) => setSearchHotel(e.target.value)}
                    name="query"
                    type="search"
                    placeholder="Tìm kiếm"
                    className="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm outline-none focus:ring-2 focus:ring-blue-500"
                />
            </div>
        </form>

    );
}