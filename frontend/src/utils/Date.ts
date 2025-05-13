import { format, formatDistanceToNow as dateFnsFormatDistance } from 'date-fns';
import { vi, Locale } from "date-fns/locale"

export class DateUtils {
    formatDistancetoNow(
        date: Date | number,
        options?: {
            addSuffix: boolean;
            includeSeconds: boolean;
            locale: Locale;
        } 
    ): string {
        return dateFnsFormatDistance(date, {locale: vi, ...options});
    }

    formatDateTime(date: Date | number, options?: { locale?: Locale}) {
        return format(date, "dd/MM/yyyy HH:mm", options)
    }
}