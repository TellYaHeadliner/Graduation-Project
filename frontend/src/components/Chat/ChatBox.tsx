import React, { useState, useRef, useEffect, useMemo } from 'react';
import axios from 'axios';
import { createEchoInstance } from '../../api/echoConfig';

interface Message {
  id: number;
  sender_id: number;
  text: string;
}

interface ChatBoxProps {
  onClose: () => void;
  partnerId: number;
  userId: number; 
}

export default function ChatBox({ onClose, partnerId, userId }: ChatBoxProps) {
  const [messages, setMessages] = useState<Message[]>([]);
  const [input, setInput] = useState('');
  const [conversationId, setConversationId] = useState<number | null>(null);
  const scrollRef = useRef<HTMLDivElement>(null);
  const BASE_URL = import.meta.env.VITE_API_URL || 'http://127.0.0.1:8000/api/v1';

  const echo = useMemo(() => createEchoInstance(userId), [userId]);

  useEffect(() => {
    axios
      .get(`${BASE_URL}/chat/with/${partnerId}`, {
        withCredentials: true,
      })
      .then((res) => {
        setConversationId(res.data.id);
        setMessages(res.data.messages || []);
      })
      .catch((err) => {
        console.error('Lỗi khi lấy tin nhắn:', err);
      });
  }, [partnerId]);

  useEffect(() => {
    if (!conversationId) return;

    const channel = echo.private(`conversation.${conversationId}`);
    channel.listen('MessageSent', (e: any) => {
      const newMsg: Message = {
        id: e.id,
        sender_id: e.sender_id,
        text: e.content,
      };
      setMessages((prev) => [...prev, newMsg]);
    });

    return () => {
      echo.leave(`private-conversation.${conversationId}`);
    };
  }, [conversationId, echo]);

  useEffect(() => {
    scrollRef.current?.scrollTo({
      top: scrollRef.current.scrollHeight,
      behavior: 'smooth',
    });
  }, [messages]);

  const sendMessage = async () => {
    if (!input.trim()) return;

    try {
      const res = await axios.post(
        `${BASE_URL}/chat/send-message`,
        {
          partner_id: partnerId,
          conversation_id: conversationId,
          content: input,
        },
        {
          headers: { 'Content-Type': 'application/json' },
          withCredentials: true,
        }
      );

      if (res.data.conversation_id && !conversationId) {
        setConversationId(res.data.conversation_id);
      }

      setInput('');
    } catch (err) {
      console.error('Lỗi gửi tin nhắn:', err);
    }
  };

  return (
    <div className="fixed bottom-20 right-5 w-80 h-96 bg-white rounded-xl shadow-lg border flex flex-col z-50">
      <div className="p-3 font-semibold border-b flex justify-between items-center">
        <span>Trò chuyện</span>
        <button
          onClick={onClose}
          className="text-gray-500 hover:text-red-500 text-lg font-bold"
        >
          ×
        </button>
      </div>

      <div ref={scrollRef} className="flex-1 overflow-y-auto p-3 space-y-2 text-sm">
        {messages.map((msg) => (
          <div
            key={msg.id}
            className={`px-3 py-2 rounded-lg max-w-[75%] ${msg.sender_id === partnerId
                ? 'bg-gray-100 text-gray-800 self-start mr-auto'
                : 'bg-blue-500 text-white self-end ml-auto'
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
