import { ReactNode } from "react"

interface Props {
    children: ReactNode
}

export default function MainLayout(props: Props) {

    const { children } = props

    return (
        <div className="min-h-screen bg-gray-100 flex flex-col">
            <div className="flex flex-1 lg:flex-row">
                <main className="flex-1 p-4 sm:p-6 lg:p-8">
                { children }
                </main>
            </div>
        </div>
    )     
}