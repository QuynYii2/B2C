<?php

namespace App\Services;

interface ApiServiceInterface
{
    public function getAliBaBa($text);
    public function detailAliBaBa($id);
    public function getTaoBao($text);
    public function detailTaoBao($id);
    public function get1688($text);
    public function detail1688($id);
    public function convertCurrency($from, $to, $amount);
}
