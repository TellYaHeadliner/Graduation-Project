import { useState  } from "react";

import DatePicker, { registerLocale } from "react-datepicker";
import "react-datepicker/dist/react-datepicker.css";

import { vi } from "date-fns/locale/vi"
registerLocale('vi', vi)


export default function DateRangePicker(){
    const [startDate, setStartDate] = useState<Date | null | undefined>(null)
    const [endDate, setEndDate] = useState<Date | null>(null);

    const handleChange = (date: Date | null) => {
        setStartDate(date)
        if (date && endDate && date > endDate){
            setEndDate(null);
        }
    };

    return (
        <div className="flex flex-row items-center gap-4">
            <div>
                <label className="block text-sm">
                    Ngày bắt đầu:
                </label>
                <DatePicker selected={startDate} onChange={handleChange}
                startDate={startDate}
                endDate={endDate}
                dateFormat="dd/MM/yyyy"
                className="border rounded px-3 py-2 w-34 sm:w-50 text-sm"
                placeholderText="Ngày bắt đầu"
            />
            </div>
            <div>
                <label className="block text-sm ">
                    Ngày kết thúc:
                </label>
                <DatePicker selected={endDate}
                onChange={(date: Date | null) => setEndDate(date)}
                selectsEnd
                startDate={startDate}
                endDate={endDate}
                dateFormat="dd/MM/yyy"
                className="border rounded px-3 py-2 w-34 sm:w-50 text-sm"
                placeholderText="Ngày kết thúc"
                />
            </div>
        </div>
    )
}