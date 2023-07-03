<?php
namespace App\Repositories\Interfaces;

interface IndividualRepositoryInterface
{
    public function getIndividualsByUser(int $user_id);
    public function hasIndividual(int $indi_id);
    public function updateIndividual(array $request);
    public function viewIndividual(int $indi_id);
    public function getIndividualsLocation();
    public function getJobGroup();
    public function viewIndividualLocationlist(int $indi_id);
}



?>