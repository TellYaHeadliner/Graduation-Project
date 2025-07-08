import React from 'react';
import AliceCarousel from 'react-alice-carousel';
import 'react-alice-carousel/lib/alice-carousel.css';
import * as Avatar from '@radix-ui/react-avatar';
import { StarFilledIcon } from '@radix-ui/react-icons';

interface Review {
  user_name: string;
  star: number;
  content: string;
  created_at: string;
  room_type: string;
}

interface CommentItemProps {
  review: Review;
}

const CommentItem: React.FC<CommentItemProps> = ({ review }) => {
  const getInitials = (name: string) => {
    const words = name.trim().split(' ');
    if (words.length === 0) return '';
    return words.map(word => word[0]).join('').toUpperCase();
  };

  return (
    <div className="flex flex-col p-4 bg-white rounded shadow-md max-w-xl h-full">
      <div className="flex items-center gap-2 mb-2">
        <Avatar.Root className="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gray-200">
          <Avatar.Image className="w-full h-full rounded-full" />
          <Avatar.Fallback className="text-sm font-medium text-gray-700">
            {getInitials(review.user_name)}
          </Avatar.Fallback>
        </Avatar.Root>
        <div>
          <div className="font-semibold">{review.user_name}</div>
          <div className="text-xs text-gray-500">{review.room_type}</div>
        </div>
      </div>

      <div className="flex gap-1 text-yellow-500 mb-2">
        {Array.from({ length: 5 }).map((_, i) => (
          <StarFilledIcon
            key={i}
            className={`w-4 h-4 ${i < review.star ? 'text-yellow-500' : 'text-gray-300'
              }`}
          />
        ))}
      </div>

      <div className="text-sm text-gray-700 italic mb-2">"{review.content}"</div>

      <div className="text-xs text-right text-gray-400">{review.created_at}</div>
    </div>
  );
};

interface CarouselCommentProps {
  reviews: Review[];
}

export default function CarouselComment({ reviews }: CarouselCommentProps) {
  const items = reviews.map((review, index) => (
    <CommentItem key={index} review={review} />
  ));

  return (
    <div className="w-full mx-auto">
      <AliceCarousel
        mouseTracking
        items={items}
        disableDotsControls
        responsive={{
          0: { items: 1 },
          640: { items: 2 },
          1024: { items: 3 },
        }}
      />
    </div>
  );
}
