import { Provinces } from "../../constants/Provinces";

export default function SelectProvinces() {
    return (
        <div className="flex flex-col gap-1 mr-1">
            <label htmlFor="province" className="block text-sm lg:text-lg">
                Chọn tỉnh thành:
            </label>
            <select name="province" id="province" className="w-32 2xl:w-50 2xl:h-10 px-4 py-2 sm:w-40 border rounded text-sm  border-gray-300 text-gray-700 bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
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
    );
}
