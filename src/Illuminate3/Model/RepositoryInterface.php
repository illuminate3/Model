<?php

namespace Illuminate3\Model;


interface RepositoryInterface
{
	public function find($id);
	public function all();
}