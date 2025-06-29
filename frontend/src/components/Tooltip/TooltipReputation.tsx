import * as Tooltip from "@radix-ui/react-tooltip";
import { BadgeReputaionScore } from "../Badge/BadgeReputation";

interface BadgeReputaionScoreProps {
  reputation: number;
}

export default function TooltipReputation({ reputation }: BadgeReputaionScoreProps) {
  const descriptionGoodHotel = "Đây là khách sạn có phản hồi, dịch vụ tốt";
  const descriptionNormalHotel = "Đây là khách sạn có phản hồi, dịch vụ ở mức trung bình";
  const descriptionBadHotel = "Đây là khách sạn có phản hồi, dịch vụ khá tệ";

  const getDescription = () => {
    if (reputation === 40) return descriptionBadHotel;
    if (reputation >= 70) return descriptionGoodHotel;
    if (reputation >= 50) return descriptionNormalHotel;
    return "";
  };

  return (
    <Tooltip.Provider delayDuration={100}>
      <Tooltip.Root>
        <Tooltip.Trigger asChild>
          <div className="cursor-pointer inline-block">
            <BadgeReputaionScore reputation={reputation} />
          </div>
        </Tooltip.Trigger>
        <Tooltip.Portal>
          <Tooltip.Content
            side="top"
            align="center"
            sideOffset={8}
            className="rounded-md bg-white shadow-md p-2 border border-gray-300 max-w-xs text-sm text-gray-700"
          >
            {getDescription()}
            <Tooltip.Arrow className="fill-white" />
          </Tooltip.Content>
        </Tooltip.Portal>
      </Tooltip.Root>
    </Tooltip.Provider>
  );
}
