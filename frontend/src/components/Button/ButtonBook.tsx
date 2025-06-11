export default function ButtonBook(){
    return (
        <div className="hidden md:flex 2xl:flex flex-row items-center gap-1 text-white rounded-sm mr-2 border border-white">
            <button type="submit" className="bg-third text-white px-2 rounded-md flex items-center justify-center w-[40px] h-[40px] gap-2 sm:w-auto sm:px-3 sm:flex sm:flex-row border-secondary hover:bg-accent">
                <span className="hidden sm:inline text-lg">Đặt phòng </span>
            </button>
        </div>
    )
}