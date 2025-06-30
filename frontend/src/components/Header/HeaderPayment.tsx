import logoHeader from "../../assets/light-logo.png"


export default function HeaderPayment(){

    return (
        <header className="bg-secondary flex justify-between items-center lg:px-14  py-4 border-b shadow-sm">
            <a href="/">
                <div className="flex items-center space-x-2">
                    <img src={logoHeader} alt={logoHeader} className='sm:w-40 lg:w-40 2xl:w-50 mr-4 '/>
                </div>
            </a>
        </header>
    )
}