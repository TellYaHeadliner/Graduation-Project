interface ComboSelection {
    name: string;
    quantity: number;
}

interface ServiceSelection {
    name: string;
    quantity: number;
}

interface DataListServicesPaymentProps {
    comboSelection?: ComboSelection[];
    serviceSelection?: ServiceSelection[];
}

export default function DataListServicesPayment({ comboSelection, serviceSelection }: DataListServicesPaymentProps) {
    return (
        <div className="bg-gray-100 rounded-xl p-4 text-sm font-medium space-y-1 mb-6">
            <div className="flex justify-between">
                <span>Dịch vụ và combo</span>
                <span>Số lượng</span>
            </div>

            <div className="space-y-1 max-h-40 overflow-y-auto pr-1">
                {comboSelection?.map((combo, index) => (
                    <div key={`combo-${index}`} className="flex justify-between font-normal">
                        <span>{combo.name}</span>
                        <span>{combo.quantity}</span>
                    </div>
                ))}
                {serviceSelection?.map((service, index) => (
                    <div key={`service-${index}`} className="flex justify-between font-normal">
                        <span>{service.name}</span>
                        <span>{service.quantity}</span>
                    </div>
                ))}
            </div>
        </div>
    )
}