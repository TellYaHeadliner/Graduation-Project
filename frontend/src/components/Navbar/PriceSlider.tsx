import { useState, useRef, useEffect } from "react";
import { Currency } from "../../utils/Currency";
import { useFilter } from "../../context/FilterContext";



const MIN = 0
const MAX = 0;

export default function PriceSlider() {

    const minRef = useRef<HTMLInputElement>(null);
    const maxRef = useRef<HTMLInputElement>(null);
    const [ validateError, setValidateError] = useState<string | null>(null);

    const { filter, updatePriceRange } = useFilter();

    useEffect(() => {
        if (minRef.current) minRef.current.value = filter.minPrice.toString();
        if (maxRef.current) maxRef.current.value = filter.maxPrice.toString();
    }, [filter.minPrice, filter.maxPrice])

    const handleValidate = () => {
        const min = Number(minRef.current?.value);
        const max = Number(maxRef.current?.value);

        if (!isNaN(min) && !isNaN(max)){
            if (min > max){
                setValidateError("Giá thấp không được lớn giá cao");
            }
            else {
                setValidateError(null);
                updatePriceRange(min, max);
            }
        }
    }

    const handleReset = () => {
        const defaultMin = MIN;
        const defaultMax = MAX;
        if (minRef.current) minRef.current.value = MIN.toString();
        if (maxRef.current) maxRef.current.value = MAX.toString();
        setValidateError(null);
        updatePriceRange(defaultMin, defaultMax)
    }



    return (
        <div className="p-4 rounded-lg border border-gray-200 text-black shadow-lg">
            <div className="flex justify-between items-start mb-2">
                <div>
                    <span className="block text-sm font-semibold ">Khoảng giá</span>
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
                        placeholder={Currency.formatVND(MIN)}
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
                        placeholder={Currency.formatVND(MAX)}
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
