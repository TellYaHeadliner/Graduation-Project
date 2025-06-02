import AccordionFilterStar from '../Accordion/AccordionFilterStar';
import AccordionFilterRate from '../Accordion/AccorditonFilterRate';
import PriceSlider from './PriceSlider';
export default function NavBarFilter(){
    return (
        <nav className="w-64 mx-46 px-auto rounded space-y-4 py-3 text-sm">
            <PriceSlider numberRoom={1} nightCount={1} />
            <AccordionFilterRate />
            <AccordionFilterStar />
        </nav>
    )
}