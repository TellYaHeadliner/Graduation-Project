import { Dialog } from "radix-ui";
import { CheckIcon } from "@radix-ui/react-icons";
import { useEffect } from "react";

interface DialogTransactionCompleteProps{
    isOpen: boolean;
    onClose: () => void;
}

export default function DialogTransactionComplete({ isOpen, onClose }: DialogTransactionCompleteProps) {
    useEffect(() => {
        if (isOpen){
            const timer = setTimeout(() => {
                onClose();
            }, 3000)
            return () => clearTimeout(timer);
        }

    }, [isOpen, onClose])
    return (
        <Dialog.Root open={isOpen} >
            <Dialog.Portal>
                <Dialog.Overlay className="fixed inset-0 bg-black/50 z-40">
                    <Dialog.Content className="fixed top-1/2 left-1/2 w-[47vw] max-w-5xl max-h-[90vh] overflow-y-auto -translate-x-1/2 -translate-y-1/2 bg-white p-6 rounded-xl shadow-lg z-50 flex flex-col items-center">
                    <Dialog.Title className="text-xl font-semibold text-green-600 mb-2">
                        Thanh toán thành công
                    </Dialog.Title>
                        <div>
                            <CheckIcon className="w-30 h-30 text-green-500 text-center animate-bounce"/> 
                        </div>
                        <span className="text-lg text-black">
                            Thanh toán của bạn đã được xử lý thành công
                        </span>
                    </Dialog.Content>
                </Dialog.Overlay>
            </Dialog.Portal>
        </Dialog.Root>
    )
}