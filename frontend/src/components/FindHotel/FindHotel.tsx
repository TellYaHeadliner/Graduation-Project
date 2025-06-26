import { useEffect, useRef, useState } from "react";
import { MagnifyingGlassIcon, PersonIcon, ChevronDownIcon } from "@radix-ui/react-icons";
import DatePicker, { registerLocale } from "react-datepicker";
import "react-datepicker/dist/react-datepicker.css";
import { useNavigate } from "react-router-dom";

import { Provinces } from "../../constants/Provinces";
import useFindHotel from "../../hooks/useFindHotel";
import { vi } from "date-fns/locale/vi";
import { useFindHotelContext } from "../../context/FindHotelContext";
import { findHotelSchemas } from "../../schemas/findHotelSchemas";

registerLocale("vi", vi);

export default function FindHotel() {
    const [isOpen, setIsOpen] = useState(false);
    const [, setIsNull] = useState(false);
    const [error, setError] = useState("");
    const dropdownRef = useRef<HTMLDivElement | null>(null);
    const toggleOpen = () => setIsOpen((prev) => !prev);
    const navigate = useNavigate();
    const { state, dispatch } = useFindHotelContext();
    const {
        province,
        dateRange,
        adults,
        children,
        rooms,
    } = state;

    const [startDate, endDate] = [
        state.dateRange[0],
        state.dateRange[1]
    ];

    const { provinceFromQuery,
        startDateFromQuery,
        endDateFromQuery,
        adultsFromQuery,
        childrenFromQuery,
        roomsFromQuery } = useFindHotel();

    useEffect(() => {
        if (provinceFromQuery && startDateFromQuery && endDateFromQuery && adultsFromQuery && childrenFromQuery && roomsFromQuery) {
            dispatch({ type: 'SET_PROVINCE', payload: provinceFromQuery });
            dispatch({
                type: 'SET_DATE_RANGE',
                payload: [
                  startDateFromQuery instanceof Date ? startDateFromQuery.toISOString().split('T')[0] : startDateFromQuery,
                  endDateFromQuery instanceof Date ? endDateFromQuery.toISOString().split('T')[0] : endDateFromQuery,
                ]
              });
            dispatch({ type: 'SET_ADULTS', payload: adultsFromQuery });
            dispatch({ type: 'SET_CHILDREN', payload: childrenFromQuery });
            dispatch({ type: 'SET_ROOMS', payload: roomsFromQuery });
        }
        else {
            setIsNull(true);
        }

        const handleClickOutside = (event: MouseEvent) => {
            if (dropdownRef.current && !dropdownRef.current.contains(event.target as Node)) {
                setIsOpen(false);
            }
        };

        document.addEventListener("mousedown", handleClickOutside)
        return () => document.removeEventListener("mousedown", handleClickOutside);
    }, [provinceFromQuery, startDateFromQuery, endDateFromQuery, adultsFromQuery, childrenFromQuery, roomsFromQuery, dispatch]);

    const formatDate = (date: Date | null) =>
        date ? date.toISOString().split("T")[0] : "";

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();

        const result = findHotelSchemas.safeParse({
            province,
            dateRange: startDate && endDate ? `${startDate}-${endDate}` : "",
            adults,
            children,
            rooms,
        })

        if (!result.success) {
            setIsNull(true);
            setError(result.error.errors[0].message)
            return;
        }

        const queryParams = new URLSearchParams({
            ...(province && { province }),
            ...(startDate && { startDate: startDate }),
            ...(endDate && { endDate: endDate }),
            adults: adults.toString(),
            children: children.toString(),
            rooms: rooms.toString()
        })

        navigate(`/search?${queryParams.toString()}`)
    }
    return (
        <div className="search-booking">
            <form className="flex flex-nowrap items-center mt-4 md:justify w-full" onSubmit={handleSubmit}>
                <div className="flex flex-col gap-1" dir="ltr">
                    <select
                        value={state.province || ""}
                        onChange={(e) => dispatch({ type: 'SET_PROVINCE', payload: e.target.value })}
                        name="province"
                        id="province"
                        className="w-30 sm:w-50 2xl:w-60 2xl:h-15 px-4 py-2 border-2 border-accent rounded-s-lg 2xl:text-lg shadow-sm focus:outline-none focus:ring-secondary overflow-hidden "
                    >
                        <option value="" disabled hidden>
                            Tỉnh/ Thành phố
                        </option>
                        {Provinces.map((province) => (
                            <option key={province} value={province} defaultValue="">
                                {province}
                            </option>
                        ))}
                    </select>
                </div>

                {/* Gộp Date Range Picker */}
                <div className="flex flex-col gap-1">
                    <DatePicker
                        name="day"
                        selectsRange
                        startDate={startDate ? new Date(startDate) : null}
                        endDate={endDate ? new Date(endDate) : null}
                        onChange={(update: [Date | null, Date | null]) => {
                            const start = update[0] ? update[0].toISOString().split('T')[0] : null;
                            const end = update[1] ? update[1].toISOString().split('T')[0] : null;
                            dispatch({ type: 'SET_DATE_RANGE', payload: [start, end] });
                        }}
                        dateFormat="dd/MM/yyyy"
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
