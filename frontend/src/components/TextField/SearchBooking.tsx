import { Heading } from '@radix-ui/themes'
import DateRangePicker from '../DateRangePicker/DateRangePicker';

export default function SearchBooking(){
    return(
        <div className="search-booking">
            <Heading as="h3" size="4">
                Hãy chọn địa điểm, thời gian bạn muốn
                <div className="container flex flex-row mt-2 ">
                    <DateRangePicker />
                </div>
            </Heading>
        </div>
    )
}