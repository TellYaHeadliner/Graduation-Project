import { ReactNode } from "react"
import { Theme } from "@radix-ui/themes"
import Header from "../components/Header/Header"
import Footer from "../components/Footer/Footer"
import { ToastContainer } from "react-toastify"

interface Props {
    children: ReactNode
}

export default function MainLayout(props: Props) {

    const { children } = props

    return (
        <Theme>
            <Header />
            <main className="flex-1">
                {children}
            </main>
            <Footer />
            <ToastContainer position="top-right" />
        </Theme>
    )
}