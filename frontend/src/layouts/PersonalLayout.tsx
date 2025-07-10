import { ReactNode } from "react"
import { Theme } from "@radix-ui/themes"
import Header from "../components/Header/Header"
interface Props {
    children: ReactNode
}

export default function PersonalLayout(props: Props) {

    const { children } = props

    return (
        <Theme className="min-h-screen flex flex-col overflow-x-hidden">
            <Header />
            <main className="flex-1">
                {children}
            </main>
        </Theme>
    )
}