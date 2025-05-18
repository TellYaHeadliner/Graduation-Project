import { ReactNode } from "react"
import { Theme } from "@radix-ui/themes"
import Header from "../components/Header/Header"

interface Props {
    children: ReactNode
}

export default function MainLayout(props: Props) {

    const { children } = props

    return (
        <Theme>
            <Header />
            <div className="flex flex-col min-h-screen bg-gray-100">

                <div className="flex flex-1 lg:flex-row">
                    <main className="flex-1 p-4 sm:p-6 lg:p-8">
                        {children}
                    </main>
                </div>
            </div>
        </Theme>
    )     
}