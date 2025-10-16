import DiscountItem from './DiscountItem';
import { Voucher } from '../../types/DetailHotelTypes';
import AliceCarousel from 'react-alice-carousel';
import 'react-alice-carousel/lib/alice-carousel.css';

interface DiscountBarProps {
  discountList: Voucher[];
  total: number;
  onApplyVoucher: (code: string) => void;
}

export default function DiscountBar({ discountList, total, onApplyVoucher }: DiscountBarProps) {
  const items = discountList.map((discount) => (
    <div key={discount.id} className="px-2">
      <DiscountItem
        discountCode={discount.code}
        discountType={discount.discount.type}
        discountValue={discount.discount.value}
        minDiscountValue={discount.min_order_value}
        maxDiscountValue={discount.discount.max}
        startDate={discount.start_date}
        endDate={discount.end_date}
        total={total}
        onApplyVoucher={onApplyVoucher}
      />
    </div>
  ));

  return (
    <div className="border-2 border-orange-400 bg-white rounded-lg p-4">
      <p className="text-sm font-medium text-black mb-2">Mã ưu đãi:</p>
      <AliceCarousel
        mouseTracking
        items={items}
        responsive={{
          0: { items: 1 },
          768: { items: 2 },
          1024: { items: 3 },
        }}
        controlsStrategy="responsive"
        disableDotsControls
        renderPrevButton={() => <span className="text-xl px-2">‹</span>}
        renderNextButton={() => <span className="text-xl px-2">›</span>}
      />
    </div>
  );
}
