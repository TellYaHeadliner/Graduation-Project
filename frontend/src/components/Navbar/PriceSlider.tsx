import { useState, useRef } from "react";
import { Currency } from "../../utils/Currency";

interface PriceSliderProps {
    numberRoom: number;
    nightCount: number;
}

const MIN = Currency.formatVND(0);
const MAX = Currency.formatVND(24000000);

export default function PriceSlider({ numberRoom, nightCount }: PriceSliderProps) {

    const minRef = useRef<HTMLInputElement>(null);
    const maxRef = useRef<HTMLInputElement>(null);
    const [ validateError, setValidateError] = useState<string | null>(null);

    const handleValidate = () => {
        const min = Number(minRef.current?.value);
        const max = Number(maxRef.current?.value);

        if (!isNaN(min) && !isNaN(max)){
            if (min > max){
                setValidateError("Giá thấp không được lớn giá cao");
            }
            else {
                setValidateError(null);
            }
        }
    }

    const handleReset = () => {
        if (minRef.current) minRef.current.value = MIN.toString();
        if (maxRef.current) maxRef.current.value = MAX.toString();
        setValidateError(null);
    }


    return (
        <div className="p-4 rounded-lg border border-gray-200 text-black shadow-lg">
            <div className="flex justify-between items-start mb-2">
                <div>
                    <span className="block text-sm font-semibold ">Khoảng giá</span>
                    <span className="block text-sm ">{numberRoom} phòng, {nightCount} đêm</span>
                </div>
                <span className="text-sm text-blue-500 cursor-pointer hover:text-underline" onClick={handleReset}>Đặt lại</span>
            </div>

            <div className="grid grid-cols-2 gap-4">
                <label htmlFor="min" className="block">
                    <span className="block text-sm text-black mb-1">Giá thấp</span>
                    <input
                        type="number"
                        name="min"
                        id="min"
                        placeholder={MIN.toString()}
                        className="w-full rounded px-2 py-1 text-sm"
                        onChange={handleValidate}
                        ref={minRef}
                    />
                </label>
                <label htmlFor="max" className="block">
                    <span className="block text-sm text-black mb-1">Giá cao</span>
                    <input
                        type="number"
                        name="max"
                        id="max"
                        placeholder={MAX.toString()}
                        className="w-full rounded px-2 py-1 text-sm"
                        onChange={handleValidate}
                        ref={maxRef}
                    />
                </label>
            </div>
            { validateError && (
                <p className="text-red-500 text-sm">
                    {validateError}
                </p>
            )}
        </div>
    )
}
