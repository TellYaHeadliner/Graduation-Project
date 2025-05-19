import { TabNav } from '@radix-ui/themes';
import { useEffect, useState } from 'react';

interface TabNavLinkProps{
    tab: string
}

export default function TabNavLink({ tab: string }: TabNavLinkProps) {

    const [tab, setTab] = useState('/khachsan')

    useEffect(() => {
        console.log("Khuyến mãi");
    }, [])

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