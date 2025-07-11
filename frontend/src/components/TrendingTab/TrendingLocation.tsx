import { format } from 'date-fns';
import HoChiMinh from "../../assets/HoChiMinhCity.png"
import HaNoi from "../../assets/Hanoi.jpg"
import DaNang from "../../assets/DaNang.png"
import DaLat from "../../assets/DaLat.jpg"
import NhaTrang from "../../assets/NhaTrang.png"

const LOCATIONS = [
    { name: "Thành phố Hồ Chí Minh", address: "TP Hồ Chí Minh", image: HoChiMinh },
    { name: "Hà Nội", address: "Hà Nội", image: HaNoi },
    { name: "Đà Nẵng", address: "Đà Nẵng", image: DaNang },
    { name: "Đà Lạt", address: "Đà Lạt", image: DaLat },
    { name: "Nha Trang", address: "Nha Trang", image: NhaTrang },
];

export default function TrendingLocation() {
    const today = new Date();
    const checkin = format(new Date(today.getFullYear(), today.getMonth(), today.getDate() + 1), 'yyyy-MM-dd');
    const checkout = format(new Date(today.getFullYear(), today.getMonth(), today.getDate() + 2), 'yyyy-MM-dd');

    const buildSearchUrl = (address: string) => {
        return `/search?address=${encodeURIComponent(address)}&checkin=${checkin}&checkout=${checkout}&guest=2&children=0`;
    };

    return (
        <div className="lg:mx-18 2xl:mx-20 mt-8">
            <h2 className="text-2xl font-bold mb-1">
                Những địa điểm đang hot
            </h2>
            <p className="text-lg text-gray-600 mb-3">
                Đáng để bạn lựa chọn trong dịp nghỉ hè này
            </p>

            <div className="grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-2 gap-4">
                {LOCATIONS.slice(0, 2).map((loc, index) => (
                    <div key={index} className="relative rounded overflow-hidden shadow-lg h-60 transform transition duration-500 hover:scale-105">
                        <a href={buildSearchUrl(loc.address)}>
                            <img
                                src={loc.image}
                                alt={loc.name}
                                className="w-full h-full object-cover"
                            />
                            <div className="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent text-white p-4">
                                <h3 className="font-bold text-lg flex items-center">{loc.name}</h3>
                            </div>
                        </a>
                    </div>
                ))}
            </div>

            <div className="grid grid-cols-1 2xl:grid-cols-3 lg:grid-cols-3 gap-4 mt-4">
                {LOCATIONS.slice(2).map((loc, index) => (
                    <div key={index} className="relative rounded overflow-hidden shadow-lg h-60 transform transition duration-500 hover:scale-105">
                        <a href={buildSearchUrl(loc.address)}>
                            <img
                                src={loc.image}
                                alt={loc.name}
                                className="w-full h-full object-cover"
                            />
                            <div className="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent text-white p-4">
                                <h3 className="font-bold text-lg flex items-center">{loc.name}</h3>
                            </div>
                        </a>
                    </div>
                ))}
            </div>
        </div>
    );
}
