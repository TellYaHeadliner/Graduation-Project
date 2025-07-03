import React, { useState, useEffect, useCallback } from 'react'
import useEmblaCarousel from 'embla-carousel-react'
import { EmblaOptionsType } from 'embla-carousel'

interface CarouselImageProps {
    listGalley: string[]
    options?: EmblaOptionsType;
}

const CarouselImage: React.FC<CarouselImageProps> = ({  listGalley, options }) => {
    const [selectedIndex, setSelectedIndex] = useState(0)
    const [emblaMainRef, emblaMainApi] = useEmblaCarousel(options)
    const [emblaThumbsRef, emblaThumbsApi] = useEmblaCarousel({
        containScroll: 'keepSnaps',
        dragFree: true
    })

    const onThumbClick = useCallback((index: number) => {
        if (!emblaMainApi) return
        emblaMainApi.scrollTo(index)
    }, [emblaMainApi])

    const onSelect = useCallback(() => {
        if (!emblaMainApi || !emblaThumbsApi) return
        const index = emblaMainApi.selectedScrollSnap()
        setSelectedIndex(index)
        emblaThumbsApi.scrollTo(index)
    }, [emblaMainApi, emblaThumbsApi])

    useEffect(() => {
        if (!emblaMainApi) return
        onSelect()
        emblaMainApi.on('select', onSelect)
        emblaMainApi.on('reInit', onSelect)
    }, [emblaMainApi, onSelect])

    return (
        <div className="w-full max-w-5xl mx-auto">
            {/* Carousel chính */}
            <div className="overflow-hidden" ref={emblaMainRef}>
                <div className="flex">
                    {listGalley.map((src, index) => (
                        <div className="min-w-full px-1" key={index}>
                            <img
                                src={`${import.meta.env.VITE_URL}${src}`}
                                alt={`Slide ${index + 1}`}
                                className="w-full h-[400px] object-cover rounded-lg bg-gray-200"
                            />
                        </div>
                    ))}
                </div>
            </div>

            {/* Thumbnails */}
            <div className="mt-4 overflow-hidden" ref={emblaThumbsRef}>
                <div className="flex gap-2 px-1">
                    {listGalley.map((src, index) => (
                        <button
                            key={index}
                            onClick={() => onThumbClick(index)}
                            className={`border rounded-md overflow-hidden transition ring-offset-2 focus:outline-none ${index === selectedIndex ? 'border-blue-500 ring ring-blue-300' : 'border-transparent'
                                }`}
                        >
                            <img
                                src={`${import.meta.env.VITE_URL}${src}`}
                                alt={`Thumb ${index + 1}`}
                                className="w-20 h-14 object-cover"
                            />
                        </button>
                    ))}
                </div>
            </div>
        </div>
    )
}

export default CarouselImage