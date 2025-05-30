import { ReactNode } from "react"
import { Theme } from "@radix-ui/themes"
import Header from "../components/Header/Header"
import Footer from "../components/Footer/Footer"

interface Props {
    children: ReactNode
}

export default function MainLayout(props: Props) {

    const { children } = props

    return (
        <Theme>
            <Header />
            <main className="flex-1 lg:px-8 2xl:px-28">
                {children}
            </main>
            <Footer />
        </Theme>
    )     
}