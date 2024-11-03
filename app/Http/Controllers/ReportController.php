<?php

namespace App\Http\Controllers;

use App\Generic\Generic;
use App\Services\ReportService;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function reportA()
    {
        try {
            $data = $this->reportService->getReportA();
            return Generic::message(true, "", $data, 200);
        } catch (\Exception $e) {
            return Generic::message(false, "Erro ao obter relatório A: " . $e->getMessage(), "", 500);
        }
    }

    public function reportB()
    {
        try {
            $data = $this->reportService->getReportB();
            return Generic::message(true, "", $data, 200);
        } catch (\Exception $e) {
            return Generic::message(false, "Erro ao obter relatório B: " . $e->getMessage(), "", 500);
        }
    }

    public function reportC()
    {
        try {
            $data = $this->reportService->getReportC();
            return Generic::message(true, "", $data, 200);
        } catch (\Exception $e) {
            return Generic::message(false, "Erro ao obter relatório C: " . $e->getMessage(), "", 500);
        }
    }

    public function reportD()
    {
        try {
            $data = $this->reportService->getReportD();
            return Generic::message(true, "", $data, 200);
        } catch (\Exception $e) {
            return Generic::message(false, "Erro ao obter relatório D: " . $e->getMessage(), "", 500);
        }
    }
}
