import lightLogo from "../../assets/light-logo.png"
import facebook from "../../assets/facebook.svg"
import instagram from "../../assets/instagram.svg"
import tiktok from "../../assets/tiktok.svg"
import youtube from "../../assets/youtube.svg"

export default function FooterInfoStatic() {
    return (
        <div className="w-full py-6 lg:px-12 2xl:px-18">
            <div className="max-w-screen-xl grid grid-cols-5 gap-x-10 text-sm text-gray-700">
                <div>
                    <img src={lightLogo} alt={lightLogo} className="w-50 mb-2 m-auto" />
                    <h3 className="font-semibold mb-2">
                        Các phương thức thanh toán
                    </h3>
                    <div className="flex flex-row justify-center gap-x-2">
                        <img src="https://cdn.haitrieu.com/wp-content/uploads/2022/10/Icon-VNPAY-QR.png" alt="" className="w-10" />
                        <img src="https://upload.wikimedia.org/wikipedia/vi/f/fe/MoMo_Logo.png" alt="" className="w-10" />
                        <img src="https://upload.wikimedia.org/wikipedia/commons/a/a4/Paypal_2014_logo.png" alt="" className="w-10" />
                        <img src="https://download.logo.wine/logo/Visa_Inc./Visa_Inc.-Logo.wine.png" alt="" className="w-12" />
                    </div>
                </div>
                <div className="flex flex-col text-start">
                    <h3 className="font-semibold text-lg mb-2">
                        Theo dõi chúng tôi
                    </h3>
                    <ul className="space-y-1 flex flex-col font-normal gap-y-2">
                        <li className="flex flex-row gap-x-2 items-center hover:underline">
                            <a href="">
                                <img src={facebook} alt={facebook} className="w-6" />
                            </a>
                            Facebook
                        </li>
                        <li className="flex flex-row gap-x-2 hover:underline">
                            <a href="">
                                <img src={instagram} alt={instagram} className="w-6" />
                            </a>
                            Instagram
                        </li>
                        <li className="flex flex-row gap-x-2 hover:underline">
                            <a href="">
                                <img src={tiktok} alt={tiktok} className="w-6" />
                            </a>
                            Tiktok
                        </li>
                        <li className="flex flex-row gap-x-2 hover:underline">
                            <a href="">
                                <img src={youtube} alt={youtube} className="w-6" />
                            </a>
                            Youtube
                        </li>
                    </ul>
                </div>
                <div className="flex flex-col text-start">
                    <h3 className="font-semibold text-lg mb-2">
                        Về Roomix
                    </h3>
                    <ul className="space-y-1 flex flex-col font-normal gap-y-2">
                        <li className="hover:underline">
                            <a href="">
                                Liên hệ chúng tôi
                            </a>
                        </li>
                        <li className="hover:underline">
                            <a href="">
                                Trợ giúp
                            </a>
                        </li>
                        <li className="gap-x-2 hover:underline">
                            <a href="">
                                Tuyển dụng
                            </a>
                        </li>
                        <li className="gap-x-2 hover:underline">
                            <a href="">
                                Về chúng tôi
                            </a>
                        </li>
                    </ul>
                </div>
                <div className="flex flex-col text-start">
                    <h3 className="font-semibold text-lg mb-2">
                        Dành cho đối tác
                    </h3>
                    <ul className="space-y-1 flex flex-col font-normal gap-y-2">
                        <li className="hover:underline">
                            <a href="">
                                Liên hệ chúng tôi
                            </a>
                        </li>
                        <li className="hover:underline">
                            <a href="">
                                Trợ giúp
                            </a>
                        </li>
                        <li className="gap-x-2 hover:underline">
                            <a href="">
                                Tuyển dụng
                            </a>
                        </li>
                        <li className="gap-x-2 hover:underline">
                            <a href="">
                                Về chúng tôi
                            </a>
                        </li>
                    </ul>
                </div>
                <div className="flex flex-col text-start">
                    <h3 className="font-semibold text-lg mb-2">
                        Khác
                    </h3>
                    <ul className="space-y-1 flex flex-col font-normal gap-y-2">
                        <li className="hover:underline">
                            <a href="">
                                Chính sách
                            </a>
                        </li>
                        <li className="hover:underline">
                            <a href="">
                                Điều khoản
                            </a>
                        </li>
                        <li className="gap-x-2 hover:underline">
                            <a href="">
                                Bảo mật & Cookie
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    );
}