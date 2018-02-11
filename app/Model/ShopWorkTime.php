<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ShopWorkTime extends Model
{
    //

        public function getWorkFromFormatAttribute() {
                return $this->formatMinutes($this->work_from);
        }

        public function getWorkToFormatAttribute() {
                return $this->formatMinutes($this->work_to);
        }

        private function formatMinutes($min) {
                $return = '';

                if($min) {
                        $hours = floor($min / 60);
                        $minutes = $min % 60;

                        $return .= ($hours ? $hours : '00').':';
                        $return .= ($minutes ? $minutes : '00');
                }

                return $return;
        }
}
