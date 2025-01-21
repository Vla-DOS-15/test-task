<?php
namespace app\controllers;

use app\models\ReportFilter;
use Yii;
use yii\web\Controller;
use app\services\ReportService;

class ReportController extends Controller
{
    private $reportService;

    /**
     * Construct
     *
     * @param string $id
     * @param $module
     * @param ReportService $reportService
     * @param array $config
     */
    public function __construct($id, $module, ReportService $reportService, $config = [])
    {
        $this->reportService = $reportService;
        parent::__construct($id, $module, $config);
    }

    /**
     * Table output by filters
     */
    public function actionIndex()
    {
        $searchModel = new ReportFilter();
        $data = [];

        if ($searchModel->load(\Yii::$app->request->queryParams) && $searchModel->validate()) {
            $data = $this->reportService->getReport($searchModel->start_date, $searchModel->end_date);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'data' => $data,
        ]);
    }
}
