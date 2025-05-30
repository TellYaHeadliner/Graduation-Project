import { ReactNode, useState } from "react"
import { Theme } from "@radix-ui/themes"

import useTitle from "../hooks/useTitle"

interface Props {
    children: ReactNode
}

export default function LoginLayout(props: Props) {

    const { children } = props
    useTitle("Đăng nhập")

    const [isDark, setIsDark] = useState<boolean>(false);

    return (
        <Theme appearance={isDark === true ? "dark" : "light"}>
            <div className="bg-gray-100 flex items-center justify-center min-h-screen">
                <div className="w-full max-w-wd p-9 space-y-6 bg-white rounded-2xl shadow-lg">
                    <h2 className="text-2xl font-bold text-center text-gray-800">
                        Trang đăng nhập Booker.com
                    </h2>
                    {children}
                </div>
            </div>
        </Theme>
    )     
}