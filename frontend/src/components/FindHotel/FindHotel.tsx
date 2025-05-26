import { useState } from "react";
import { MagnifyingGlassIcon } from "@radix-ui/react-icons";
import DatePicker, { registerLocale } from "react-datepicker";
import { vi } from "date-fns/locale/vi";
import "react-datepicker/dist/react-datepicker.css";
import { Provinces } from "../../constants/Provinces";
import { Heading } from "@radix-ui/themes"

registerLocale("vi", vi);

export default function FindHotel() {
    const [startDate, setStartDate] = useState<Date | null | undefined>(null);
    const [endDate, setEndDate] = useState<Date | null>(null);

    const handleStartDateChange = (date: Date | null) => {
        setStartDate(date);
        if (date && endDate && date > endDate) {
            setEndDate(null);
        }
    };

    return (
        <div className="search-booking lg:px-22 2xl:px-34">
            <Heading as="h3" size="6">Hãy chọn địa điểm, thời gian bạn muốn</Heading>
            <form className="flex flex-nowrap items-center mt-4 md:justify-center">
                <div className="flex flex-col gap-1 " dir="ltr">
                    <select
                        name="province"
                        id="province"
                        className="w-30 sm:w-40 2xl:w-50 2xl:h-10 px-4 py-2 border-2 border-accent rounded-s-lg  text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-secondary overflow-hidden "
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

                {/* Date Range Picker */}
                <div className="flex flex-col gap-1">
                    <DatePicker
                        selected={startDate}
                        onChange={handleStartDateChange}
                        startDate={startDate}
                        endDate={endDate}
                        dateFormat="dd/MM/yyyy"
                        locale="vi"
                        className="px-3 py-2 w-30 sm:w-40 2xl:w-50 2xl:h-10 text-sm border-2 border-accent"
                        placeholderText="Ngày ở "
                    />
                </div>

                <div className="flex flex-col gap-1">
                    <DatePicker
                        selected={endDate}
                        onChange={(date: Date | null) => setEndDate(date)}
                        selectsEnd
                        startDate={startDate}
                        endDate={endDate}
                        dateFormat="dd/MM/yyyy"
                        locale="vi"
                        className=" px-3 py-2 w-32 sm:w-40 2xl:w-50 2xl:h-10 text-sm border-2 border-accent"
                        placeholderText="Ngày trả phòng"
                    />
                </div>

                <div className="flex items-center h-2" dir="rtl">
                    <button
                        type="submit"
                        className="bg-secondary text-white p-2 h-[38px] lg:h-[40px] 2xl:h-[40px] rounded-s-lg flex items-center gap-2 border-2 border-accent"
                    >
                        <MagnifyingGlassIcon width="20" height="20" />
                        <span className="hidden sm:inline text-sm lg:text-lg">Tìm kiếm</span>
                    </button>
                </div>
            </form>
        </div>
    );
}
