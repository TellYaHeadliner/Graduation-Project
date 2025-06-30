import { Badge } from "@radix-ui/themes"

interface BadgeReputaionScoreProps {
    reputation: number;
}

export const BadgeReputaionScore = ({ reputation }: BadgeReputaionScoreProps) => (
    <Badge
        color={ reputation === 40 ? "red" : reputation >= 60 ? "green" : reputation >= 55 ? "blue": "gray" }
    >
        {reputation}
    </Badge>
)


