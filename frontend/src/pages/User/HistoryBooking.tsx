import MainLayout from "../../layouts/MainLayout";

import useTitle from "../../hooks/useTitle";
import TableHistory from "../../components/Table/TableHistory";
import {  useSearchParams } from "react-router-dom";
import { useEffect, useState } from "react";
import DialogTransactionComplete from '../../components/Dialog/DialogTransactionComplete';

export default function HistoryBooking() {
    useTitle("Lịch sử booking");

    const [searchParams] = useSearchParams();
    const message = searchParams.get('message');
    const status = searchParams.get('status');
    const [isTransactionComplete, setIsTransactionComplete] = useState(false);

    useEffect(() => {
        if (message === "Thanh toán thành công" && status === "success"){
            setIsTransactionComplete(true);
        }
    }, [message, status])

    return (
        <MainLayout>
            {
                isTransactionComplete && (
                    <DialogTransactionComplete isOpen={isTransactionComplete} onClose={() => setIsTransactionComplete(false)} />
                )
            }
            <div className="flex w-full my-4 mx-16">
                <div className="ml-10">
                    <h1 className="font-bold text-xl mb-2">
                        Tất cả khách sạn đang đặt phòng
                    </h1>
                    <div>
                        <TableHistory />
                    </div>
                </div>
            </div>
            
        </MainLayout>
    )
}