import { useState } from "react";
import { MagnifyingGlassIcon } from "@radix-ui/react-icons";
import DatePicker, { registerLocale } from "react-datepicker";
import { vi } from "date-fns/locale/vi";
import "react-datepicker/dist/react-datepicker.css";
import { Provinces } from "../../constants/Provinces";

registerLocale("vi", vi);

export default function FindHotel() {
    const [dateRange, setDateRange] = useState<[Date | null, Date | null]>([null, null]);
    const [startDate, endDate] = dateRange;

    return (
        <div className="search-booking">
            <form className="flex flex-nowrap items-center mt-4 md:justify">
                <div className="flex flex-col gap-1 " dir="ltr">
                    <select
                        name="province"
                        id="province"
                        className="w-30 sm:w-40 2xl:w-50 2xl:h-15 px-4 py-2 border-2 border-accent rounded-s-lg 2xk:text-lg shadow-sm focus:outline-none focus:ring-secondary overflow-hidden "
                    >
                        <option value="" disabled hidden>
                            Tỉnh/ Thành phố
                        </option>
                        {Provinces.map((province) => (
                            <option key={province} value={province}>
                                {province}
                            </option>
                        ))}
                    </select>
                </div>

                {/* Gộp Date Range Picker */}
                <div className="flex flex-col gap-1">
                    <DatePicker
                        selectsRange
                        startDate={startDate}
                        endDate={endDate}
                        onChange={(update: [Date | null, Date | null]) => setDateRange(update)}
                        dateFormat="dd/MM/yyyy"
                        locale="vi"
                        className="px-3 py-2 w-60 sm:w-80 2xl:w-100 2xl:h-15 2xl:text-lg border-2 border-accent"
                        placeholderText="Chọn khoảng thời gian"
                        isClearable
                    />
                </div>

                <div className="flex items-center h-2" dir="rtl">
                    <button
                        type="submit"
                        className="bg-secondary text-white p-2 h-[38px] lg:h-[40px] 2xl:h-[60px] rounded-s-lg flex items-center gap-2 border-2 border-accent"
                    >
                        <MagnifyingGlassIcon width="20" height="20" />
                        <span className="hidden sm:inline text-sm lg:text-lg">Tìm kiếm</span>
                    </button>
                </div>
            </form>
        </div>
    );
}
