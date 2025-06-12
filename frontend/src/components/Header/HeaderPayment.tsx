import logoHeader from "../../assets/light-logo.png"
import React from "react";

const steps = [
    { label: "Điền thông tin", active: true},
    { label: "Xem lại thông tin", active: false},
    { label: "Thanh toán", active: false},
    { label: "Xử lý", active: false},
    { label: "Gửi phiếu thanh toán", active: false}
];

export default function HeaderPayment(){
    return (
        <header className="bg-secondary flex justify-between items-center lg:px-14  py-4 border-b shadow-sm">
            <div className="flex items-center space-x-2">
                <img src={logoHeader} alt={logoHeader} className='sm:w-40 lg:w-40 2xl:w-50 mr-4 '/>
            </div>

            <div className="flex items-center space-x-2 text-sm text-gray-600">
                {steps.map((step, index) => (
                    <React.Fragment key={index}>
                        <div className="flex items-center space-x-1">
                            <div className={`w-5 h-5 flex items-center justify-center rounded-full text-white text-xs font-bold ${step.active ? 'bg-third' : 'bg-gray-400'} `}>
                                {index + 1}
                            </div>
                            <span className={step.active ? 'text-blue-600 font-medium' : ''}>   
                                {step.label}
                            </span>
                        </div>
                        {index < steps.length - 1 && <span>-</span>}
                    </React.Fragment>
                ))}
            </div>
        </header>
    )
}