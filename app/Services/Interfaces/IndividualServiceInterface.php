<?php
namespace App\Services\Interfaces;

interface IndividualServiceInterface
{
    public function index();
    public function saveIndividual(array $request);
    public function viewIndividual(int $indi_id);
    public function viewIndividualLocationlist($indi_id);
    

    
}

?>