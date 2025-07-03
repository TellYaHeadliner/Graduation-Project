import { useRef, useState , useEffect } from "react";
import { MagnifyingGlassIcon, PersonIcon, ChevronDownIcon } from "@radix-ui/react-icons";
import DatePicker, { registerLocale } from "react-datepicker";
import "react-datepicker/dist/react-datepicker.css";

import { vi } from "date-fns/locale/vi";
import { useParams } from "react-router-dom";
import { useFindRoomContext } from "../../context/FindRoomContext";

registerLocale("vi", vi);

interface FindRoomProps {
    onSearch: () => void;
};

export default function FindRoom({ onSearch }: FindRoomProps) {
    const [isOpen, setIsOpen] = useState(false);
    const [, setIsNull] = useState(false);
    const [error,] = useState("");
    const dropdownRef = useRef<HTMLDivElement | null>(null);
    const toggleOpen = () => setIsOpen((prev) => !prev);
    const { state, dispatch } = useFindRoomContext();
    const {
        adults,
        children,
        rooms,
    } = state;

    const [startDate, endDate] = [
        typeof state.dateRange[0] === 'string' ? new Date(state.dateRange[0]) : null,
        typeof state.dateRange[1] === 'string' ? new Date(state.dateRange[1]) : null
    ];

    const { id } = useParams();
    const formatDate = (date: Date | null): string | null =>
        date ? date.toISOString().split('T')[0] : null;

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        setIsNull(true);
        dispatch({ type: "SET_DATE_RANGE", payload: [formatDate(startDate), formatDate(endDate)] });
        dispatch({ type: "SET_ADULTS", payload: adults });
        dispatch({ type: "SET_CHILDREN", payload: children });
        dispatch({ type: "SET_ROOMS", payload: rooms });
        onSearch();
        return { id, startDate, endDate, adults, children, rooms }
    }
    useEffect(() => {
        if (!startDate || !endDate) return;

        const diffTime = endDate.getTime() - startDate.getTime();
        const nights = Math.max(diffTime / (1000 * 60 * 60 * 24), 1); // ít nhất 1 đêm

        localStorage.setItem('numberOfNights', JSON.stringify(nights));
    }, [startDate, endDate]);

    return (
        <div className="search-booking">
            <form className="flex flex-nowrap items-center mt-4 md:justify w-full" onSubmit={handleSubmit}>

                {/* Gộp Date Range Picker */}
                <div className="flex flex-col gap-1">
                    <DatePicker
                        name="day"
                        selectsRange
                        startDate={startDate}
                        endDate={endDate}
                        onChange={([start, end]: [Date | null, Date | null]) => {

                            const formatDate = (date: Date | null) =>
                                date ? date.toLocaleDateString("sv-SE").split('T')[0] : null;

                            const formattedStart = formatDate(start);
                            const formattedEnd = formatDate(end);

                            let numberOfNights = 0;

                            if (start && end) {
                                const startDate = new Date(start.getFullYear(), start.getMonth(), start.getDate());
                                const endDate = new Date(end.getFullYear(), end.getMonth(), end.getDate());
                                const diffTime = endDate.getTime() - startDate.getTime();
                                numberOfNights = diffTime / (1000 * 60 * 60 * 24);
                            }

                            localStorage.setItem('numberOfNights', JSON.stringify(numberOfNights));

                            dispatch({
                                type: 'SET_DATE_RANGE',
                                payload: [formattedStart, formattedEnd],
                            });
                        }}

                        dateFormat="dd/MM/yyyy" // Hiển thị dạng ngày/tháng/năm cho người dùng
                        locale="vi"
                        className="px-3 py-2 w-60 sm:w-60 2xl:w-100 2xl:h-15 2xl:text-lg border-2 border-accent"
                        placeholderText="Chọn khoảng thời gian"
                        isClearable
                        minDate={new Date()}
                    />
                </div>
                <div className="relative" ref={dropdownRef}>

                    <div className="flex flex-row h-11 2xl:h-15 2xl:w-full lg:h-11">
                        <button type="button" onClick={toggleOpen}
                            className="flex items-center bg-white justify-center gap-2 border-2 border-accent px-4 py-3 transition">
                            <PersonIcon className="text-gray-700 w-5 h-5 " />
                            <span className="text-sm sm:text-base text-gray-800 whitespace-nowrap overflow-hidden text-ellipsis">
                                {adults} Người lớn · {children} Trẻ em · {rooms} Phòng
                            </span>
                            <ChevronDownIcon className="text-gray-700 w-5 h-5" />
                        </button>
                    </div>

                    {isOpen && (
                        <div className="absolute z-10 mt-2 w-full bg-white border border-gray-300 rounded-md shadow-lg p-4 space-y-4">
                            {[
                                { label: "Người lớn", value: adults, setValue: (v: number) => dispatch({ type: 'SET_ADULTS', payload: v }) },
                                { label: "Trẻ em", value: children, setValue: (v: number) => dispatch({ type: 'SET_CHILDREN', payload: v }) },
                                { label: "Phòng", value: rooms, setValue: (v: number) => dispatch({ type: 'SET_ROOMS', payload: v }) },
                            ].map(({ label, value, setValue }) => (
                                <div key={label} className="flex justify-between items-center">
                                    <span>{label}</span>
                                    <div className="flex gap-2 items-center">
                                        <button
                                            type="button"
                                            onClick={() => setValue(Math.max(0, value - 1))}
                                            className="px-2 py-1 border rounded"
                                        >
                                            -
                                        </button>
                                        <span>{value}</span>
                                        <button
                                            type="button"
                                            onClick={() => setValue(value + 1)}
                                            className="px-2 py-1 border rounded"
                                        >
                                            +
                                        </button>
                                    </div>
                                </div>
                            ))}

                            <button
                                type="button"
                                onClick={() => setIsOpen(false)}
                                className="mt-2 w-full bg-accent text-white py-2 rounded-md"
                            >
                                Xong
                            </button>
                        </div>
                    )}

                </div>
                <div className="flex items-center flex-nowrap" dir="rtl">
                    <button
                        type="submit"
                        className="bg-secondary text-white px-4 py-1.5 h-11 2xl:h-15 overflow-hidden rounded-s-lg flex items-center gap-2 border-2 border-accent"
                    >
                        <MagnifyingGlassIcon className="text-white w-5 h-5 " />
                        <span className="hidden md:inline text-sm sm:text-sm lg:text-md">Tìm kiếm</span>
                    </button>
                </div>
            </form>
            {error && (
                <div className="text-red-700">
                    {error}
                </div>
            )}
        </div>
    );
}
