import HoChiMinh from "../../assets/HoChiMinhCity.png"
import HaNoi from "../../assets/Hanoi.jpg"
import DaNang from "../../assets/DaNang.png"
import DaLat from "../../assets/DaLat.jpg"
import NhaTrang from "../../assets/NhaTrang.png"

export default function TrendingLocation() {
    return (
        <div className="lg:mx-18 2xl:mx-20 mt-8">
            <h2 className="text-2xl font-bold mb-1">
                Những địa điểm đang hot
            </h2>
            <p className="text-lg text-gray-600 mb-3">
                Đáng để bạn lựa chọn trong dịp nghỉ hè này
            </p>
            <div className="grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-2 gap-4">
                <div className="relative rounded overflow-hidden shadow-lg h-60">
                    <a href="/HoChiMinh">
                        <img
                            src={HoChiMinh}
                            alt={HoChiMinh}
                            className="w-full h-full object-cover"
                        />
                        <div className="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent text-white p-4">
                            <h3 className="font-bold text-lg flex items-center">
                                Thành phố Hồ Chí Minh
                            </h3>
                        </div>
                    </a>
                </div>
                <div className="relative rounded overflow-hidden shadow-lg h-60">
                    <a href="/HaNoi">
                        <img
                            src={HaNoi}
                            alt={HaNoi}
                            className="w-full h-full object-cover"
                        />
                        <div className="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent text-white p-4">
                            <h3 className="font-bold text-lg flex items-center">
                                Hà Nội
                            </h3>
                        </div>
                    </a>
                </div>
            </div>

            <div className="grid grid-cols-1 2xl:grid-cols-3 lg:grid-cols-3 gap-4 mt-4">
                <div className="relative rounded overflow-hidden shadow-lg h-60">
                    <a href="/DaNang">
                        <img
                            src={DaNang}
                            alt={DaNang}
                            className="w-full h-full object-cover"
                        />
                        <div className="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent text-white p-4">
                            <h3 className="font-bold text-lg flex items-center">
                                Đà Nẵng
                            </h3>
                        </div>
                    </a>
                </div>
                <div className="relative rounded overflow-hidden shadow-lg h-60">
                    <a href="/DaLat">
                        <img
                            src={DaLat}
                            alt={DaLat}
                            className="w-full h-full object-cover"
                        />
                        <div className="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent text-white p-4">
                            <h3 className="font-bold text-lg flex items-center">
                                Đà Lạt
                            </h3>
                        </div>
                    </a>
                </div>
                <div className="relative rounded overflow-hidden shadow-lg h-60">
                    <a href="/NhaTrang">
                        <img
                            src={NhaTrang}
                            alt={NhaTrang}
                            className="w-full h-full object-cover"
                        />
                        <div className="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent text-white p-4">
                            <h3 className="font-bold text-lg flex items-center">
                                Nha Trang
                            </h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    )
}