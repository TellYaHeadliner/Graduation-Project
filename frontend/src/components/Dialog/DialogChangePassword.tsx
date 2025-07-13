import { AlertDialog, Button, Flex, Dialog, Text, TextField } from "@radix-ui/themes";
import { useState } from "react";
import { useForm } from "react-hook-form";
import { changePasswordSchemas, ChangePasswordSchemas } from '../../schemas/changePasswordSchemas';
import { zodResolver } from "@hookform/resolvers/zod";
import { useUserInfoQuery } from "../../react-query/useUserInfoQuery";
import { PayloadChangePassword } from "../../types/UserTypes";
import { useChangePassword } from '../../react-query/useChangePassword';
import { toast } from "react-toastify";
import { ErrorUtils } from '../../utils/Error';
import LoadingSpinner from "../Loading/LoadingSpinner";

export default function DialogChangePassword() {
    const [openForm, setOpenForm] = useState(false);

    const { register, handleSubmit, formState: { errors } } = useForm<ChangePasswordSchemas>({
        resolver: zodResolver(changePasswordSchemas)
    })
    const getUserInfo = useUserInfoQuery();
    const changePassword = useChangePassword();

    const onSubmit = (data: ChangePasswordSchemas) => {
        
        const payloadData: PayloadChangePassword = {
            fullname: getUserInfo.data?.data.user.fullname ?? '',
            email: getUserInfo.data?.data.user.email ?? '',
            gender: getUserInfo.data?.data.user.gender ?? 0,
            password_new: data.password
        }
        setOpenForm(false);
        changePassword.mutate(payloadData, {
            onSuccess: () => {
                toast.success("Mật khẩu thay đổi thành công")
            },
            onError: (error) => {
                const errorUtils = new ErrorUtils();
                errorUtils.handleError(error);
            }
        });
    } 

    return (
        <>
            <AlertDialog.Root>
                <AlertDialog.Trigger>
                    <Button color="red" disabled={changePassword.isPending}>
                        Thay đổi mật khẩu
                    </Button>
                </AlertDialog.Trigger>
                <AlertDialog.Content maxWidth="450px">
                    <AlertDialog.Title>
                        Xác nhận thay đổi mật khẩu
                    </AlertDialog.Title>
                    <AlertDialog.Description size="2">
                        Bạn có chắc thay đổi mật khẩu không ?
                    </AlertDialog.Description>

                    <Flex gap="3" mt="4" justify="end">
                        <AlertDialog.Cancel>
                            <Button color="gray">
                                Hủy
                            </Button>
                        </AlertDialog.Cancel>
                        <AlertDialog.Action>
                            <Button color="blue" onClick={() => setOpenForm(true)}>
                                Thay đổi mật khẩu
                            </Button>
                        </AlertDialog.Action>
                    </Flex>
                </AlertDialog.Content>
            </AlertDialog.Root>

            <Dialog.Root open={openForm} onOpenChange={setOpenForm}>
                <Dialog.Content maxWidth="500px">
                    <Dialog.Title>
                        Nhập mật khẩu mới
                    </Dialog.Title>
                    <Dialog.Description size="2">
                        Vui lòng nhập mật khẩu mới bên dưới.
                    </Dialog.Description>
                    <form onSubmit={handleSubmit(onSubmit)}>
                        <Flex direction="column" gap="3" mt="4">
                            <label>
                                <Text as="div" size="2" mb="1" weight="bold">
                                    Mật khẩu mới
                                </Text>
                                <TextField.Root type="password" placeholder="Nhập mật khẩu mới"  {...register("password")} />
                                {errors.password && (
                                    <Text color="red" size="2">{errors.password.message}</Text>
                                )}
                            </label>
                            <label>
                                <Text as="div" size="2" mb="1" weight="bold">
                                    Xác nhận mật khẩu mới
                                </Text>
                                <TextField.Root type="password" placeholder="Xác nhận mật khẩu mới" {...register("confirmPassword")} />
                                {errors.confirmPassword && (
                                    <Text color="red" size="2">{errors.confirmPassword.message}</Text>
                                )}
                            </label>
                        </Flex>
                        <Flex gap="3" mt="4" justify="end">
                            <Button color="gray" onClick={() => setOpenForm(false)}>
                                Hủy
                            </Button>
                            <Button color="green">
                                Lưu mật khẩu
                            </Button>
                        </Flex>
                    </form>
                </Dialog.Content>
            </Dialog.Root>
        </>
    )
}