<?php
namespace App\Interfaces\Services;
interface ServiceRepositoryInterface{
    public function index();
    public function store($request);
    public function update($request);
    public function delete($request);
}