import { Dialog } from "radix-ui";
import { CheckIcon } from "@radix-ui/react-icons";
import LoadingSpinner from "../Loading/LoadingSpinner";

interface DialogLoadingProps{
    isOpen: boolean;
}

export default function DialogLoading({ isOpen }: DialogLoadingProps) {
    return (
        <Dialog.Root open={isOpen} >
            <Dialog.Portal>
                <Dialog.Overlay className="fixed inset-0 bg-black/50 z-40">
                    <Dialog.Content className="fixed top-1/2 left-1/2 w-[47vw] max-w-5xl max-h-[90vh] overflow-y-auto -translate-x-1/2 -translate-y-1/2 bg-transparent p-6 z-50 flex flex-col items-center">
                    <Dialog.Title className="text-xl font-semibold text-green-600 mb-2">
                        Đang xử lý dữ liệu
                    </Dialog.Title>
                        <div>
                            <LoadingSpinner />
                        </div>
                    </Dialog.Content>
                </Dialog.Overlay>
            </Dialog.Portal>
        </Dialog.Root>
    )
}