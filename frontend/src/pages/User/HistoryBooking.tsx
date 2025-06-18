import MainLayout from "../../layouts/MainLayout";

import useTitle from "../../hooks/useTitle";
import TabBooking from "../../components/Tab/TabBooking";
import TableHistory from "../../components/Table/TableHistory";

export default function HistoryBooking() {
    useTitle("Lịch sử booking");

    return (
        <MainLayout>
            <div className="flex w-full my-4">
                <div>
                    <TabBooking />
                </div>
                <div className="ml-10">
                    <h1 className="font-bold text-xl mb-2">
                        Tất cả khách sạn đang đặt phòng
                    </h1>
                    <TableHistory />
                </div>
            </div>
            
        </MainLayout>
    )
}