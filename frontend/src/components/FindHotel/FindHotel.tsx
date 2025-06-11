import { useEffect, useRef, useState } from "react";
import { MagnifyingGlassIcon, PersonIcon, ChevronDownIcon } from "@radix-ui/react-icons";
import DatePicker, { registerLocale } from "react-datepicker";
import "react-datepicker/dist/react-datepicker.css";
import { useNavigate } from "react-router-dom";

import { Provinces } from "../../constants/Provinces";
import useFindHotel from "../../hooks/useFindHotel";
import { vi } from "date-fns/locale/vi";
import { useAppDispatch } from "../../hooks/useAppDispatch";
import { useAppSelector } from "../../hooks/useAppSelector";
import {
    setProvince,
    setDateRange,
    setAdults,
    setChildren,
    setRooms,
    setWithPets,
  } from '../../redux/slices/findHotelSlices';

registerLocale("vi", vi);


export default function FindHotel() {
    const [isOpen, setIsOpen] = useState(false);
    const [isNull, setIsNull] = useState(false);
    const [error, setError] = useState("");
    const dropDownRef = useRef<HTMLDivElement | null>(null);
    const toggleOpen = () => setIsOpen((prev) => !prev);
    const navigate = useNavigate(); 
    const dispatch = useAppDispatch();
    const {
        province,
        dateRange,
        adults,
        children,
        rooms,
        withPets,
    } = useAppSelector((state) => state.findHotel);
    
    const [startDate, endDate] = dateRange;



    const { provinceFromQuery, 
            startDateFromQuery, 
            endDateFromQuery, 
            adultsFromQuery, 
            childrenFromQuery, 
            roomsFromQuery, 
            withPetsFromQuery } = useFindHotel();
    
    useEffect(() => {
        if (provinceFromQuery && startDateFromQuery && endDateFromQuery && adultsFromQuery && childrenFromQuery && roomsFromQuery && withPetsFromQuery){
            dispatch(setProvince(provinceFromQuery));
            dispatch(setDateRange([startDateFromQuery, endDateFromQuery]));
            dispatch(setAdults(adultsFromQuery));
            dispatch(setChildren(childrenFromQuery));
            dispatch(setRooms(roomsFromQuery));
            dispatch(setWithPets(withPetsFromQuery));
        }
        else {
            setIsNull(true);
            setError("Vui lòng nhập đầy đủ địa điểm, thời gian, số lượng người và phòng");
        }

        const handleClickOutside = (event: MouseEvent) => {
            if (dropDownRef.current && !dropDownRef.current.contains(event.target as Node)) {
                setIsOpen(false);
            }
        };

        document.addEventListener("mousedown", handleClickOutside)
        return () => document.removeEventListener("mousedown", handleClickOutside);
    }, [adultsFromQuery, childrenFromQuery, dispatch, endDateFromQuery, provinceFromQuery, roomsFromQuery, startDateFromQuery, withPetsFromQuery]);


    const formatDate = (date: Date | null) =>
        date ? date.toISOString().split("T")[0] : "";

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();

        const queryParams = new URLSearchParams({
            ...(province && { province }),
            ...(startDate && { startDate: formatDate(startDate) }),
            ...(endDate && { endDate: formatDate(endDate) }),
            adults: adults.toString(),
            children: children.toString(),
            rooms: rooms.toString(),
            withPets: withPets ? "true" : "false",
        })

        navigate(`/search?${queryParams.toString()}`)
    }
    return (
        <div className="search-booking">
            <form className="flex flex-nowrap items-center mt-4 md:justify w-full" onSubmit={handleSubmit}>
                <div className="flex flex-col gap-1" dir="ltr">
                    <select
                        onChange={(e) => dispatch(setProvince(e.target.value))}
                        name="province"
                        id="province"
                        className="w-30 sm:w-30 2xl:w-50 2xl:h-15 px-4 py-2 border-2 border-accent rounded-s-lg 2xl:text-lg shadow-sm focus:outline-none focus:ring-secondary overflow-hidden "
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
                        startDate={startDate}
                        endDate={endDate}
                        onChange={(update: [Date | null, Date | null]) => dispatch(setDateRange(update))}
                        dateFormat="dd/MM/yyyy"
                        locale="vi"
                        className="px-3 py-2 w-60 sm:w-60 2xl:w-100 2xl:h-15 2xl:text-lg border-2 border-accent"
                        placeholderText="Chọn khoảng thời gian"
                        isClearable
                        minDate={new Date}
                    />
                </div>
                <div className="relative" ref={dropDownRef}>

                <div className="flex flex-row h-11 2xl:h-15 2xl:w-full lg:h-11">
                    <button type="button" onClick={toggleOpen}
                        className="flex items-center bg-white justify-center gap-2 border-2 border-accent px-4 py-3 transition">
                        <PersonIcon className="text-gray-700 w-5 h-5 " />
                        <span className="text-sm sm:text-base text-gray-800 whitespace-nowrap overflow-hidden text-ellipsis">
                            {adults} Người lớn · {children} Trẻ em · {rooms} Phòng {withPets ? "· thú cưng" : ""}
                        </span>
                        <ChevronDownIcon className="text-gray-700 w-5 h-5" />
                    </button>
                </div>

                {isOpen && (
                    <div className="absolute z-10 mt-2 w-full bg-white border border-gray-300 rounded-md shadow-lg p-4 space-y-4">
                        {[
                            { label: "Người lớn", value: adults, setValue: (v: number) => dispatch(setAdults(v)) },
                            { label: "Trẻ em", value: children, setValue: (v: number) => dispatch(setChildren(v)) },
                            { label: "Phòng", value: rooms, setValue: (v: number) => dispatch(setRooms(v)) },
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

                        {/* Thú cưng */}
                        <div className="flex justify-between items-center">
                            <span>Thú cưng</span>
                            <label className="flex items-center gap-2 cursor-pointer">
                                <input
                                    type="checkbox"
                                    checked={withPets}
                                    onChange={() => dispatch(setWithPets(!withPets))}
                                    className="w-4 h-4"
                                />
                                <span className="text-sm">Mang theo</span>
                            </label>
                        </div>

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
            { isNull && (
                <div className="text-red-700">
                    { error }
                </div>
            )}
        </div>
    );
}
