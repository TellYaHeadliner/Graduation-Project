import { useFilter } from '../../context/FilterContext';
import { Amentity } from '../../types/AmentityTypes';
import AccordiionFilterComfortCommon from '../Accordion/AccordionFilterComfortCommon';
import AccordionFilterStar from '../Accordion/AccordionFilterStar';import ButtonApplyFilter from '../Button/ButtonApplyFilter';
;
import PriceSlider from './PriceSlider';

interface Props{
    amenties: Amentity[];
}

export default function NavBarFilter({ amenties }: Props){
    const { updateStars } = useFilter();

    return (
        <nav className="w-64 px-auto rounded space-y-4 py-3 text-sm text-white">
            <div className="my-4">
                <ButtonApplyFilter />
            </div>
            <PriceSlider />
            <AccordionFilterStar onFilterChange={updateStars}/>
            {
                amenties.map((amentity) => (
                    <div key={amentity.id}>
                        <AccordiionFilterComfortCommon title={amentity.name} children={amentity.children}/>
                    </div>
                ))
            }
        </nav>
    )
}