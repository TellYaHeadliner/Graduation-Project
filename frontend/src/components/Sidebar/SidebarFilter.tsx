import PriceSlider from './PriceSlider';
export default function SideBarFilter(){
    return (
        <aside className="w-64 mx-18 px-auto bg-secondary shadow rounded space-y-6 text-sm">
            <PriceSlider numberRoom={1} nightCount={1} />

        </aside>
    )
}