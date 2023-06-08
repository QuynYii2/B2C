<?php

namespace App\Services;

interface ApiServiceInterface
{
    public function getAliBaBa($text);
    public function detailAliBaBa($id);
    public function getTaoBao($text);
    public function detailTaoBao($id);
}
