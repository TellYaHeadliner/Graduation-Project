import { AlertDialog, Button, Flex } from "@radix-ui/themes";
import { useCancelBooking } from "../../react-query/useCancelBooking";

interface DialogCancelBookingProps{
    bookingId: number;
}

export default function DialogCancelBooking({ bookingId } : DialogCancelBookingProps){
    const { mutate, isPending } = useCancelBooking();

    return (
        <AlertDialog.Root>
            <AlertDialog.Trigger>
                <Button color="red">
                    Hủy phòng
                </Button>
            </AlertDialog.Trigger>
            <AlertDialog.Content maxWidth="450px">
                <AlertDialog.Title>
                    Xác nhận hủy phòng
                </AlertDialog.Title>
                <AlertDialog.Description size="2">
                    Bạn có xác nhận hủy phòng ? Một khi đã xác nhận hủy phòng thì bạn đã chấp nhận điều khoản của chúng tôi
                </AlertDialog.Description>
                <Flex gap="3" mt="4" justify="end">
                    <AlertDialog.Cancel>
                        <Button variant="soft" color="gray">
                            Quay lại
                        </Button>
                    </AlertDialog.Cancel>
                    <AlertDialog.Action>
                        <Button variant="solid" color="red" onClick={() => mutate(bookingId) } disabled={isPending}>
                            Hủy phòng
                        </Button>
                    </AlertDialog.Action>
                </Flex>
            </AlertDialog.Content>
        </AlertDialog.Root>
    )
}