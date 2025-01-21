<?php
namespace app\services;

use app\models\Ticket;

class ReportService
{
    /**
     * Get report on resolved tickets.
     *
     * @param string $startDate
     * @param string $endDate
     * @return array
     */
    public function getReport($startDate, $endDate)
    {
        $query = Ticket::find()
            ->select([
                'agent_name' => 'a.name',
                'disconnect_count' => 'COUNT(CASE WHEN c.name = "Відключення" THEN 1 END)',
                'verification_count' => 'COUNT(CASE WHEN c.name = "Перевірка/здешевлення" THEN 1 END)',
                'technical_count' => 'COUNT(CASE WHEN c.name = "Технічне питання" THEN 1 END)',
                'other_count' => 'COUNT(CASE WHEN c.name = "Інше" THEN 1 END)',
                'total_count' => 'COUNT(t.id)'
            ])
            ->alias('t')
            ->innerJoinWith(['agent a'])
            ->innerJoinWith(['category c'])
            ->where(['t.status' => 'Вирішена']);

        if (!empty($startDate) && !empty($endDate)) {
            $query->andWhere(['between', 't.resolved_at', $startDate, $endDate]);
        }

        $query->groupBy('t.agent_id')
            ->orderBy(['a.name' => SORT_ASC]);

        return $query->asArray()->all();
    }

}