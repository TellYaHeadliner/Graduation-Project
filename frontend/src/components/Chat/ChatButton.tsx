import React, { useState } from "react";
import { FaComments } from "react-icons/fa";
import ChatBox from "./ChatBox";


interface ChatButtonProps {
  partnerId: number;
  userId: number;
}

export default function ChatButton({ partnerId , userId}: ChatButtonProps) {
  const [isOpen, setIsOpen] = useState(false);

  return (
    <>
      {isOpen && (
        <ChatBox
          partnerId={partnerId}
          userId={userId}
          onClose={() => setIsOpen(false)}
        />
      )}

      <button
        onClick={() => setIsOpen(true)}
        className="fixed bottom-5 right-5 bg-blue-600 text-white p-4 rounded-full shadow-xl hover:bg-blue-700 z-50"
        aria-label="Chat Button"
      >
        <FaComments className="text-xl" />
      </button>
    </>
  );
}

