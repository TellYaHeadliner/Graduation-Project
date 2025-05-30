import { ReactNode } from "react"
import { Theme } from "@radix-ui/themes"

import useTitle from "../hooks/useTitle"
import logoLight from "../assets/light-logo.png"

interface Props {
    children: ReactNode
}

export default function LoginLayout(props: Props) {

    const { children } = props
    useTitle("Đăng nhập")
    return (
        <Theme>
            <div className="bg-gray-100 flex items-center justify-center min-h-screen">
                <div className="w-[500px] p-9 space-y-6 bg-secondary rounded-2xl shadow-lg">
                    <img src={logoLight} alt={logoLight} className="w-100 mx-auto"/>
                    {children}
                </div>
            </div>
        </Theme>
    )     
}