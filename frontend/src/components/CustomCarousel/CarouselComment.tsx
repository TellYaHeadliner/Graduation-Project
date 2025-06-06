import React from 'react';
import AliceCarousel from 'react-alice-carousel';
import 'react-alice-carousel/lib/alice-carousel.css';
import * as Avatar from '@radix-ui/react-avatar';
import { StarFilledIcon } from '@radix-ui/react-icons';

const CommentItem: React.FC = () => {
  return (
    <div className="flex flex-col p-4 bg-white rounded shadow-md max-w-xl">
      <div className="flex items-center gap-2 mb-2">
        <Avatar.Root className="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gray-200">
          <Avatar.Image className="w-full h-full rounded-full" />
          <Avatar.Fallback className="text-sm font-medium text-gray-700">
            JD
          </Avatar.Fallback>
        </Avatar.Root>
        <span className="font-semibold">Nguyễn Văn A</span>
      </div>
      <div className="flex gap-1 text-yellow-500 mb-2">
        {Array.from({ length: 5 }).map((_, i) => (
          <StarFilledIcon key={i} className="w-5 h-5" />
        ))}
      </div>
      <div className="text-xs text-gray-700">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce et
        egestas mi, et egestas tellus. Aliquam dictum, nibh id bibendum
        venenatis, quam eros feugiat felis, a ultrices risus tortor a risus.
        Praesent condimentum, odio at pretium viverra,
      </div>
    </div>
  );
};

const items = Array.from({ length: 5 }).map((_, index) => (
  <CommentItem key={index} />
));

export default function CarouselComment() {
  return (
    <div className="w-full mx-auto">
        <AliceCarousel
            infinite
            mouseTracking
            items={items}
            disableDotsControls
        />
    </div>

  );
}
