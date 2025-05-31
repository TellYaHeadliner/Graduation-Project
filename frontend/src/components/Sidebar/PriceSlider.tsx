import { Slider } from "radix-ui";
import { useState } from 'react';

interface PriceSliderProps{
    numberRoom: number;
    nightCount: number;
}

export default function PriceSlider({ numberRoom, nightCount }: PriceSliderProps) {
    const [priceRange, setPriceRange] = useState<[number, number]>([0, 24000000]);

    const handleReset = () => {
        setPriceRange([0, 24000000]);
    };

    return (
        <div>
            <div className="flex justify-around items-center font-semibold mb-1">
                <span className="text-white">Khoảng giá</span>
                <button onClick={handleReset} className="text-white bg-primary text-xs px-2 py-1 rounded-md">
                    Đặt lại
                </button>
            </div>
            <p className="text-xs text-white mb-2">{numberRoom} phòng, {nightCount} đêm</p>
            <Slider.Root 
                className="relative flex items-center select-none touch-none w-full h6"
                defaultValue={priceRange}
            >
                
            </Slider.Root>
        </div>
    );
}
