import lightLogo from "../../assets/light-logo.png"


export default function FooterInfoStatic() {
    return (
        <div className="grid grid-cols-4 gap-x-10 px-8 py-6 text-sm text-gray-700">
            <div>
                <img src={lightLogo} alt={lightLogo} className="w-50 mb-2 "/>
                <h3 className="font-semibold mb-2">
                    Các phương thức thanh toán
                </h3>
                <div className="flex flex-row gap-x-2">
                    <img src="https://cdn.haitrieu.com/wp-content/uploads/2022/10/Icon-VNPAY-QR.png" alt="" className="w-10"/>
                    <img src="https://upload.wikimedia.org/wikipedia/vi/f/fe/MoMo_Logo.png" alt="" className="w-10"/>
                    <img src="https://upload.wikimedia.org/wikipedia/commons/a/a4/Paypal_2014_logo.png" alt="" className="w-10"/>
                    <img src="https://download.logo.wine/logo/Visa_Inc./Visa_Inc.-Logo.wine.png" alt="" className="w-12"/>
                </div>
            </div>
            <div className="flex flex-col text-start">
                <h3 className="font-semibold mb-2">
                    Theo dõi chúng tôi
                </h3>
                <ul className="space-y-1 flex flex-col">
                    <li className="flex flex-row gap-x-2">

                    </li>
                    <li className="flex flex-row gap-x-2">

                    </li>
                    <li className="flex flex-row gap-x-2">
    
                    </li>
                </ul>
            </div>
        </div>
    );
}