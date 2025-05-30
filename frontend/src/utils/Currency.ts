export class Currency{
    static formatVND(price: number | null): string {
        if (price === null || price === 0 || isNaN(0)){
            return ""
        }
        const newFormatVND = new Intl.NumberFormat("vi-VN", {style: "currency", currency: "VND"}).format(price)
        return newFormatVND;
    }
}