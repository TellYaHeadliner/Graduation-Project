export default function FavoriteButton(){
    return (
        <div className="p-6 rounded-xl border shadow-md w-full max-w-2xl">
            <h2 className="text-lg font-semibold mb-2">
                Yêu thích chúng tôi
            </h2>
            <button className="w-full bg-secondary hover:bg:primary text-white font-semibold py-3 px-4 rounded-lg transition duration-300">
                Yêu thích
            </button>
        </div>
    )
}