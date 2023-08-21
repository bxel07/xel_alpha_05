<?php

    namespace devise\Basedata;
    use setup\baseclass\BaseData;
    class users extends BaseData{

        /**
         * @return array Define name off table
         * Define name off table
         */

        public function get_users(): array
        {
            /**
             * Retuning Query $data which selected form table users
             */
            return $this->query->show('users');
        }
    }