<?php
namespace App\Repositories\Interfaces;

interface RecordsRepositoryInterface
{
    public function hasRecord(int $rec_id);
    public function hasDirectionByRecId(int $rec_id);
    public function hasRouteAssessmentByRecId(int $rec_id);
    public function getAllRecords();
    public function getRecords(int $rec_id);
    public function getDirection(int $rec_id);
    public function getRouteAssessment(int $rec_id);
    public function getCustomFields(int $rec_id);
    public function getAllRecordsByUser(int $user_id);
    public function updateRecord(int $rec_id, array $request);
    public function updateDirectionForms(int $rec_id, array $request);
    public function updateRouteAssessmentForms(int $rec_id, array $request);
    public function updateCustomFields(array $custom_fields);
    public function getIndividualsByGroup(array $group_ids);
    public function getRouteAssessmentIDByRecId(int $rec_id);
    public function temperatureOptionRemove(array $routeAssessmentId);
    public function hasTemperatureOptionByAssessmentId(array $routeAssessmentId);
    public function getRecordsWithUser(int $rec_id);
    public function getHazardMenuList();
    public function getMeasurementMenuList();

    
}

?>