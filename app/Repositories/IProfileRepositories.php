<?php

namespace App\Repositories;

interface IProfileRepositories {
	public function get_account_info( $input_details );
	public function insert_education_info( $input_details );
	public function get_idcard_info( $input_details );
	public function insert_experience_info( $input_details );
}