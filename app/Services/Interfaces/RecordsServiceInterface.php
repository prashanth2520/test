<?php
namespace App\Services\Interfaces;

interface RecordsServiceInterface
{
    public function getAllRecords(); 
    public function getRecords(int $rec_id);
    public function getDirection(int $rec_id);
    public function getRouteAssessment(int $rec_id);
    public function saveRecord(array $request);
    public function saveFormRecords(array $request);
    public function getRidType();
    public function getMoveType();
    public function getRigStatus();
    public function getTemperature();
    public function getHazardList();
    public function getMeasurementList();
    

}



?>