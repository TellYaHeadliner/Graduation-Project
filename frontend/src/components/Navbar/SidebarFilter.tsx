import AccordiionFilterComfortCommon from '../Accordion/AccordionFilterComfortCommon';
import AccordionFilterStar from '../Accordion/AccordionFilterStar';
import AccordionFilterSupport from '../Accordion/AccordionFilterSupport';
import AccordionFilterRate from '../Accordion/AccorditonFilterRate';
import PriceSlider from './PriceSlider';

export default function NavBarFilter(){
    return (
        <nav className="w-64 px-auto rounded space-y-4 py-3 text-sm text-white">
            <PriceSlider numberRoom={1} nightCount={1} />
            <AccordionFilterRate />
            <AccordionFilterStar />
            <AccordiionFilterComfortCommon title="Tiện nghi phổ biến" />
            <AccordionFilterSupport />
            <AccordiionFilterComfortCommon title="Tiện nghi độc đáo" />
            <AccordiionFilterComfortCommon title="Tiện nghi phòng" />
        </nav>
    )
}