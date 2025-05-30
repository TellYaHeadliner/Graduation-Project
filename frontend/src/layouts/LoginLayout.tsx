import { ReactNode } from "react"
import { Theme } from "@radix-ui/themes"

import useTitle from "../hooks/useTitle"
import logoLight from "../assets/light-logo.png"
import background from "../assets/HoChiMinhCity.png"

interface Props {
    children: ReactNode
}

export default function LoginLayout(props: Props) {

    const { children } = props
    useTitle("Đăng nhập")
    return (
        <Theme>
            <div className="bg-gray-100 flex items-center justify-center min-h-screen" style={{ backgroundImage: `url(${background})` }}>
                <div className="w-[600px] p-9 bg-secondary space-y-6 rounded-2xl shadow-lg" style={{ backgroundColor: 'rgba(255, 159, 69, 0.5)' }}>
                    <img src={logoLight} alt={logoLight} className="w-100 mx-auto"/>
                    {children}
                </div>
            </div>
        </Theme>
    )     
}