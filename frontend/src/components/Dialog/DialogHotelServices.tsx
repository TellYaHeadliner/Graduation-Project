import { DialogContent, DialogTitle } from "@radix-ui/react-dialog";
import { Dialog } from "radix-ui";
import TabService from "../Tab/TabService";
import { Cross1Icon } from "@radix-ui/react-icons";
import ButtonBook from "../Button/ButtonBook";
import { Combo, Service } from "../../types/DetailHotelTypes";

interface DialogDetailHotelServicesProps {
    combos: Combo[];
    services: Service[];
}

export default function DialogHotelServices({ combos, services }: DialogDetailHotelServicesProps) {
    return (
        <Dialog.Root>
            <Dialog.Trigger>
                <ButtonBook />
            </Dialog.Trigger>
            <Dialog.Portal>
                <Dialog.Overlay className="fixed inset-0 bg-black/50 z-40">
                    <DialogTitle className="hidden">Chọn dịch vụ</DialogTitle>
                    <DialogContent className="fixed top-1/2 left-1/2 w-[100vw] max-w-6xl max-h-[90vh] overflow-y-auto -translate-x-1/2 -translate-y-1/2 bg-white p-6 rounded-xl shadow-lg z-50 space-y-4">
                        <div className="flex justify-between items-center">
                            <h2 className="text-xl font-semibold text-gray-800">Chọn dịch vụ</h2>
                            <Dialog.Close className="text-gray-500 hover:text-black">
                                <Cross1Icon />
                            </Dialog.Close>
                        </div>
                        <TabService combos={combos} services={services} />
                    </DialogContent>
                </Dialog.Overlay>
            </Dialog.Portal>
        </Dialog.Root>
    )
}