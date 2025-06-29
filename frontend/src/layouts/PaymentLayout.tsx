import { ReactNode } from "react"

import { Theme } from "@radix-ui/themes"
import HeaderPayment from "../components/Header/HeaderPayment"

interface Props {
    children: ReactNode
}

export default function PaymentLayout(props: Props) {

    const { children } = props

    return (
        <Theme>
            <HeaderPayment />
            <main className="flex-1">
                {children}
            </main>
        </Theme>
    )
} 