import DiscountItem from './DiscountItem';
import { Voucher } from '../../types/HotelsTypes';

interface DiscountBarProps {
  discountList: Voucher[];
}

export default function DiscountBar({ discountList }: DiscountBarProps) {

  return (
    <div className="border-2 border-orange-400 bg-white rounded-lg p-4 max-w-md">
      <p className="text-sm font-medium text-black mb-2">Mã ưu đãi:</p>
      {discountList?.map((discount) => (
        <DiscountItem
          key={discount.id} 
          discountCode={discount.code}
          discountType={discount.discount_type}
          discountValue={discount.discount_value}
          minDiscountValue={discount.min_order_value}
          maxDiscountValue={discount.max_discount_value}
          startDate={discount.start_date}
          endDate={discount.end_date}
        />
      ))}
    </div>
  );
}
