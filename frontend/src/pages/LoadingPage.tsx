import LoadingSpinner from "../components/Loading/LoadingSpinner";

export default function LoadingPage() {
    return (
      <div className="flex items-center justify-center min-h-screen bg-white">
        <div className="flex flex-col items-center gap-4">
          <LoadingSpinner />
          <p className="text-gray-600 text-sm">Đang tải dữ liệu...</p>
        </div>
      </div>
    );
  }