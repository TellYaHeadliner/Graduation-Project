import { useState } from 'react';

interface DiscountItemProps {
  discountType: number;
  discountCode: string;
  discountValue: number;
  minDiscountValue: number;
  maxDiscountValue: number;
  startDate: string;
  endDate: string;
}

export default function DiscountItem({
  discountCode,
  startDate,
  endDate}: DiscountItemProps) {
  const [copied, setCopied] = useState(false);

  const handleCopy = async () => {
    try {
      await navigator.clipboard.writeText(discountCode);
      setCopied(true);
      setTimeout(() => setCopied(false), 2000);
    } catch (err) {
      console.error('Lỗi khi copy:', err);
    }
  };

  const formatDate = (dateString: string) => {
    const [year, month, day] = dateString.split("-")
    return `${Number(day)}/${Number(month)}/${year}`;
  }

  return (
    <div className="rounded-lg border border-gray-300 p-3 shadow-sm bg-white space-y-2">
      <div className="flex items-center gap-2 text-sm text-gray-600">
        <span>Nhập mã:</span>
        <button
          onClick={handleCopy}
          className="px-2 py-0.5 bg-blue-100 text-blue-600 font-semibold rounded hover:bg-blue-200 text-xs"
        >
          {copied ? '✅ Đã copy' : discountCode}
        </button>
      </div>

      <div className="text-xs text-gray-400">
        Hạn sử dụng: {formatDate(startDate)} - {formatDate(endDate)}
      </div>
    </div>
  );
}
