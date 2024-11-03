<?php

namespace App\Services;

use App\Repositories\ReportRepository;


class ReportService
{
    protected $reportRepository;

    public function __construct(ReportRepository $reportRepository)
    {
        $this->reportRepository = $reportRepository;
    }

    public function getReportA()
    {
        return $this->reportRepository->queryReportA();
    }

    public function getReportB()
    {
        return $this->reportRepository->queryReportB();
    }

    public function getReportC()
    {
        return $this->reportRepository->queryReportC();
    }

    public function getReportD()
    {
        return $this->reportRepository->queryReportD();
    }
}