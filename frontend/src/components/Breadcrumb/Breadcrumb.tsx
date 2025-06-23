import { ChevronRightIcon } from "@radix-ui/react-icons"

interface BreadcrumbItem{
    label: string;
    href?: string;
    active?: boolean;
}

interface BreadcrumbProps{
    items: BreadcrumbItem[];
}

export default function Breadcrumb({ items }: BreadcrumbProps) {
    return (
      <nav className="flex text-sm text-gray-600" aria-label="Breadcrumb">
        <ol className="inline-flex items-center space-x-1 md:space-x-3">
          {items.map((item, index) => (
            <li key={index} className="inline-flex items-center">
              {index !== 0 && (
                <ChevronRightIcon className="w-4 h-4 mx-1 text-gray-400" />
              )}
              {item.href && !item.active ? (
                <a
                  href={item.href}
                  className="inline-flex items-center hover:text-blue-600 transition"
                >
                  {item.label}
                </a>
              ) : (
                <span className="inline-flex items-center font-medium text-gray-500">
                  {item.label}
                </span>
              )}
            </li>
          ))}
        </ol>
      </nav>
    );
  }