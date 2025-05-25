export default function ButtonRegister(){
    return (
        <div className="hidden md:flex 2xl:flex flex-row items-center gap-1 text-white rounded-sm">
            <a href="/dang-ki-tai-khoan-khach-san">
                <button type="submit" className="bg-secondary text-white px-2 rounded-md flex items-center justify-center w-[40px] h-[40px] gap-2 sm:w-auto sm:px-3 sm:flex sm:flex-row">
                    <span className="hidden sm:inline text-sm">Đăng kí tài khoản khách sạn </span>
                </button>
            </a>
        </div>
    )
}