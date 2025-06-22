import React, { useState, useRef, useEffect } from 'react';

interface Message {
  id: number;
  sender: 'user' | 'bot';
  text: string;
}

interface ChatBoxProps {
  onClose: () => void;
}

export default function ChatBox({ onClose }: ChatBoxProps) {
  const [messages, setMessages] = useState<Message[]>([]);
  const [input, setInput] = useState('');
  const scrollRef = useRef<HTMLDivElement>(null);

  const sendMessage = () => {
    if (!input.trim()) return;

    const userMsg: Message = {
      id: Date.now(),
      sender: 'user',
      text: input,
    };

    setMessages((prev) => [...prev, userMsg]);
    setInput('');

    setTimeout(() => {
      const botMsg: Message = {
        id: Date.now() + 1,
        sender: 'bot',
        text: 'Cảm ơn bạn đã nhắn! 😊',
      };
      setMessages((prev) => [...prev, botMsg]);
    }, 1000);
  };

  // Auto scroll to bottom
  useEffect(() => {
    scrollRef.current?.scrollTo({
      top: scrollRef.current.scrollHeight,
      behavior: 'smooth',
    });
  }, [messages]);

  return (
    <div className="fixed bottom-20 right-5 w-80 h-96 bg-white rounded-xl shadow-lg border flex flex-col z-50">
      <div className="p-3 font-semibold border-b flex justify-between items-center">
        <span>Tư vấn viên</span>
        <button
          onClick={onClose}
          className="text-gray-500 hover:text-red-500 text-lg font-bold"
        >
          ×
        </button>
      </div>

      <div
        ref={scrollRef}
        className="flex-1 overflow-y-auto p-3 space-y-2 text-sm"
      >
        {messages.map((msg) => (
          <div
            key={msg.id}
            className={`px-3 py-2 rounded-lg max-w-[75%] ${
              msg.sender === 'user'
                ? 'bg-blue-500 text-white self-end ml-auto'
                : 'bg-gray-100 text-gray-800 self-start mr-auto'
            }`}
          >
            {msg.text}
          </div>
        ))}
      </div>

      <div className="border-t p-2 flex gap-2">
        <input
          type="text"
          value={input}
          onChange={(e) => setInput(e.target.value)}
          className="flex-1 border rounded px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
          placeholder="Nhập tin nhắn..."
          onKeyDown={(e) => e.key === 'Enter' && sendMessage()}
        />
        <button
          onClick={sendMessage}
          className="bg-blue-600 text-white px-4 py-1.5 rounded hover:bg-blue-700 text-sm"
        >
          Gửi
        </button>
      </div>
    </div>
  );
}
