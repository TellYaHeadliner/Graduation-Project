export class Currency{
    static formatVND(price: number | null): string {
        if (price === 0){
            return "0 VNĐ"
        }
        if (price === null || isNaN(0)){
            return ""
        }
        const newFormatVND = new Intl.NumberFormat("vi-VN").format(price);
        return `${newFormatVND} VNĐ`;
    }

    static percent(price: number, priceDiscount: number): string {
        return `${Math.round(((price - priceDiscount) / price) * 100)} %`;
    }
}