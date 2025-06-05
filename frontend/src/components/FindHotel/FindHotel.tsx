import { useEffect, useRef, useState } from "react";
import { MagnifyingGlassIcon, PersonIcon, ChevronDownIcon } from "@radix-ui/react-icons";
import DatePicker, { registerLocale } from "react-datepicker";
import { vi } from "date-fns/locale/vi";
import "react-datepicker/dist/react-datepicker.css";
import { Provinces } from "../../constants/Provinces";
import { useNavigate } from "react-router-dom";
import useFindHotel from "../../hooks/useFindHotel";

registerLocale("vi", vi);

export default function FindHotel() {
    const [dateRange, setDateRange] = useState<[Date | null, Date | null]>([null, null]);
    const [startDate, endDate] = dateRange;
    const [province, setProvince] = useState("")
    const [isOpen, setIsOpen] = useState(false);
    const [adults, setAdults] = useState(2);
    const [children, setChildren] = useState(0);
    const [rooms, setRooms] = useState(1);
    const [withPets, setWithPets] = useState(false);
    const dropDownRef = useRef<HTMLDivElement | null>(null);

    const toggleOpen = () => setIsOpen((prev) => !prev);
    const navigate = useNavigate(); 

    const { provinceFromQuery, 
            startDateFromQuery, 
            endDateFromQuery, 
            adultsFromQuery, 
            childrenFromQuery, 
            roomsFromQuery, 
            withPetsFromQuery } = useFindHotel();
    useEffect(() => {

        if (provinceFromQuery && startDateFromQuery && endDateFromQuery && adultsFromQuery && childrenFromQuery && roomsFromQuery && withPetsFromQuery){
            setProvince(provinceFromQuery);
            setDateRange([startDateFromQuery, endDateFromQuery])
            setAdults(adultsFromQuery)
            setChildren(childrenFromQuery)
            setRooms(roomsFromQuery)
            setWithPets(withPetsFromQuery)
        }


        const handleClickOutside = (event: MouseEvent) => {
            if (dropDownRef.current && !dropDownRef.current.contains(event.target as Node)) {
                setIsOpen(false);
            }
        };

        document.addEventListener("mousedown", handleClickOutside)
        return () => document.removeEventListener("mousedown", handleClickOutside);
    }, [adultsFromQuery, childrenFromQuery, endDateFromQuery, provinceFromQuery, roomsFromQuery, startDateFromQuery, withPetsFromQuery]);


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
            <form className="flex flex-nowrap items-center mt-4 md:justify" onSubmit={handleSubmit}>
                <div className="flex flex-col gap-1 " dir="ltr">
                    <select
                        onChange={(e) => setProvince(e.target.value)}
                        name="province"
                        id="province"
                        className="w-30 sm:w-30 2xl:w-50 2xl:h-15 px-4 py-2 border-2 border-accent rounded-s-lg 2xk:text-lg shadow-sm focus:outline-none focus:ring-secondary overflow-hidden "
                    >
                        <option value="" disabled hidden>
                            Tỉnh/ Thành phố
                        </option>
                        {Provinces.map((province) => (
                            <option key={province} value={province} defaultValue={province[0]}> 
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
                        onChange={(update: [Date | null, Date | null]) => setDateRange(update)}
                        dateFormat="dd/MM/yyyy"
                        locale="vi"
                        className="px-3 py-2 w-60 sm:w-60 2xl:w-100 2xl:h-15 2xl:text-lg border-2 border-accent"
                        placeholderText="Chọn khoảng thời gian"
                        isClearable
                    />
                </div>
                <div className="relative" ref={dropDownRef}>

                <div className="flex flex-row 2xl:h-15 2xl:w-full lg:h-11">
                    <button type="button" onClick={toggleOpen}
                        className="flex items-center bg-white justify-center gap-2 border-2 border-accent px-4 py-3 transition">
                        <PersonIcon className="text-gray-700 w-10 h-10 lg:w-5 lg:h-5" />
                        <span className="text-lg text-gray-800 whitespace-nowrap overflow-hidden text-ellipsis">
                            {adults} Người lớn · {children} Trẻ em · {rooms} Phòng {withPets ? "· thú cưng" : ""}
                        </span>
                        <ChevronDownIcon className="text-gray-700 w-6 h-6" />
                    </button>
                </div>

                {isOpen && (
                    <div className="absolute z-10 mt-2 w-full bg-white border border-gray-300 rounded-md shadow-lg p-4 space-y-4">
                        {[
                            { label: "Người lớn", value: adults, setValue: setAdults },
                            { label: "Trẻ em", value: children, setValue: setChildren },
                            { label: "Phòng", value: rooms, setValue: setRooms },
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
                                    onChange={() => setWithPets(!withPets)}
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
                        className="bg-secondary text-white p-2 h-[38px] lg:h-[44px] 2xl:h-[60px] 2xl:w-[140px] lg:w-[120px] rounded-s-lg flex items-center gap-2 border-2 border-accent"
                    >
                        <MagnifyingGlassIcon className="text-white w-6 h-6" />
                        <span className="hidden sm:inline text-sm lg:text-md">Tìm kiếm</span>
                    </button>
                </div>
            </form>
        </div>
    );
}
