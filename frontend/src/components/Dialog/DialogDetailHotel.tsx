import { Dialog } from "radix-ui";
import { Cross1Icon } from "@radix-ui/react-icons";
import { Amenity } from "../../types/RoomTypes";

interface DialogDetailHotelProps {
    title: string;
    area: number;
    amenities: Amenity[];
}

export default function DialogDetailHotel({ title, area, amenities }: DialogDetailHotelProps) {
    return (
        <Dialog.Root>
            <Dialog.Trigger className="text-blue-600 underline">
                {title}
            </Dialog.Trigger>
            <Dialog.Portal>
                <Dialog.Overlay className="fixed inset-0 bg-black/50 z-40">
                    <Dialog.Content className="fixed top-1/2 left-1/2 w-[90vw] max-w-5xl max-h-[90vh] overflow-y-auto -translate-x-1/2 -translate-y-1/2 bg-white p-6 rounded-xl shadow-lg z-50">
                        {/* Header */}
                        <div className="flex justify-between items-start mb-4">
                            <Dialog.Title className="text-2xl font-bold">{title}</Dialog.Title>
                            <Dialog.Close className="text-gray-500 hover:text-black">
                                <Cross1Icon />
                            </Dialog.Close>
                        </div>

                        {/* Content */}
                        <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            {/* Hình ảnh */}
                            <div className="space-y-2">
                                <div className="bg-gray-300 rounded-md w-full h-64"></div>
                                <div className="flex gap-2 overflow-x-auto">
                                    {[...Array(8)].map((_, i) => (
                                        <div
                                            key={i}
                                            className="w-20 h-16 bg-gray-200 object-cover rounded-md border"
                                        ></div>
                                    ))}
                                </div>
                            </div>

                            {/* Thông tin */}
                            <div className="text-sm space-y-4">
                                <div>
                                    <p>
                                    📏 <strong>Kích thước phòng:</strong> {area} m²
                                    </p>
                                </div>

                                <div>
                                    <h3 className="font-semibold">Tiện nghi:</h3>
                                    <ul className="list-disc list-inside grid grid-cols-2 gap-x-4">
                                       {amenities.map((amenity) => (
                                            <li>
                                                {amenity.name}
                                            </li>
                                       ))}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </Dialog.Content>
                </Dialog.Overlay>
            </Dialog.Portal>
        </Dialog.Root>
    )
}