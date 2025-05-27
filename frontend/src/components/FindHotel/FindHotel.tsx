import { Heading } from "@radix-ui/themes"
import DateRangePicker  from '../DateRangePicker/DateRangePicker';
import SelectProvinces from "../Select/SelectProvinces";
import ButtonSearch from "../Button/ButtonSearch";

export default function FindHotel(){
    return (
        <div className="search-booking">
        <Heading as="h3" size="4">
            Hãy chọn địa điểm, thời gian bạn muốn
            <div className="container flex flex-row mt-2 items-center">
                <SelectProvinces />
                <DateRangePicker />
                <ButtonSearch />
            </div>
        </Heading>
    </div>
    )
}