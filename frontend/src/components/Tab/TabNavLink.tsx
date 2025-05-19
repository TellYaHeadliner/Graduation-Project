import { TabNav } from '@radix-ui/themes';
import { useState } from 'react';

export default function TabNavLink() {

    const [tab, setTab] = useState('/khachsan')

    return (
        <TabNav.Root color="green">
            <TabNav.Link href="/khachsan" active={tab === '/khachsan'} onClick={() => setTab("/khachsan")}>
                <span className="text-white">
                    Khách sạn
                </span>
            </TabNav.Link>
            <TabNav.Link href="/khuyenmai" active={tab === '/khuyenmai'} onClick={() => setTab("/khuyenmai")}>
                <span className="text-white">
                    Khuyến mãi
                </span>
            </TabNav.Link>
            <TabNav.Link href="toptrending" active={tab === '/toptrending'} onClick={() => setTab("/toptrending")}>
                <span className="text-white">
                    Top trending
                </span>
            </TabNav.Link>
            <TabNav.Link href="theomua" active={tab === '/theomua'} onClick={() => setTab("/theomua")}>
                <span className="text-white">
                    Theo mùa
                </span>
            </TabNav.Link>
        </TabNav.Root>
    )
}