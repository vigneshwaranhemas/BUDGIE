<?php

namespace App\Repositories;


interface IITInfraRepository{
  public function get_candidate_email_info($data);
  public function update_itInfra_EmailStatus($data);
}
