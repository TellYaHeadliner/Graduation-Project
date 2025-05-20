import { Input, DatePicker, Button } from 'antd'
import { MagnifyingGlassIcon } from '@radix-ui/react-icons'
import { Heading } from '@radix-ui/themes'

const { RangePicker } = DatePicker;


export default function SearchBooking(){
    return(
        <div className="search-booking">
            <Heading as="h3" size="4">
                Hãy chọn địa điểm, thời gian bạn muốn
                <div className="container flex flex-row mt-2 ">
                    <Input size="small" placeholder="Địa điểm" prefix={<MagnifyingGlassIcon />} />
                    <RangePicker />
                    <Button type="primary">
                        Tìm kiếm
                    </Button>
                </div>
            </Heading>
        </div>
    )
}