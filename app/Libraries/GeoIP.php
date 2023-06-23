<?php

namespace App\Libraries;

use MaxMind\Db\Reader;

class GeoIP
{
    protected $reader;

    public function __construct()
    {
        $databaseFile = storage_path('/app/geoip/GeoLite2-Country.mmdb');
        $this->reader = new Reader($databaseFile);
    }

    public function get_country_from_ip($ip)
    {
        $record = $this->reader->get($ip);
        if ($record != null){
            $countryCode = $record['country']['iso_code'];
            switch ($countryCode) {
                case 'KR':
                    return 'kr';
                case 'JP':
                    return 'ja';
                case 'CN':
                    return 'zh-CN';
                default:
                    return 'vi';
            }
        } else{
            return 'vi';
        }
    }

    public function getCode($ip)
    {
        $record = $this->reader->get($ip);
        if ($record == null){
            $record = $this->reader->get('183.80.130.4');
        }
        $countryCode = $record['country']['names']['en'];
        return $countryCode;
    }


}
