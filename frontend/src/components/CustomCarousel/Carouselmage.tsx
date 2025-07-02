import React from "react";
import AliceCarousel from "react-alice-carousel";
import "react-alice-carousel/lib/alice-carousel.css";

interface CarouselImageProps {
    listGalley: string[]; 
}

const CarouselImage: React.FC<CarouselImageProps> = ({ listGalley }) => {
    if (!listGalley || listGalley.length === 0) return null;

    const items = listGalley.map((url, index) => (
        <img
            key={index}
            src={`${import.meta.env.VITE_URL}${url}`}
            alt={`Gallery ${index + 1}`}
            className="w-full h-[400px] object-cover rounded-lg bg-gray-300"
        />
    ));

    return (
        <div className="w-full max-w-5xl mx-auto my-4">
            <AliceCarousel
                mouseTracking
                items={items}
                infinite
                disableButtonsControls={false}
                disableDotsControls={false}
            />
        </div>
    );
};

export default CarouselImage;
