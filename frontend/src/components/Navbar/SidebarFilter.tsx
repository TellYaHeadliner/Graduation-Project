import { useFilter } from '../../context/FilterContext';
import { Amentity } from '../../types/AmentityTypes';
import AccordiionFilterComfortCommon from '../Accordion/AccordionFilterComfortCommon';
import AccordionFilterStar from '../Accordion/AccordionFilterStar';
import PriceSlider from './PriceSlider';

interface Props{
    amenties: Amentity[];
}

export default function NavBarFilter({ amenties }: Props){
    const { updateStars } = useFilter();

    return (
        <nav className="w-64 px-auto rounded space-y-4 py-3 text-sm text-white">
            <PriceSlider numberRoom={0} nightCount={0} />
            <AccordionFilterStar onFilterChange={updateStars}/>
            {
                amenties.map((amentity) => (
                    <div>
                        <AccordiionFilterComfortCommon title={amentity.name} children={amentity.children}/>
                    </div>
                ))
            }
        </nav>
    )
}