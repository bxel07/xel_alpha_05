<?php

    namespace setup\config;

    class RequestHandler {

        /**
         * @return mixed
         */
        public function request (): mixed
        {
            return $this->session_getter();
        }


        /**
         * @return mixed
         */
        private function session_getter(): mixed
        {
            session_start();

            try {
                if(isset($_SESSION['processed_data'])){
                    return $_SESSION['processed_data'];
                } else {
                    throw new \Exception("Forbidden Access");
                }
            }catch (\Exception $exception ) {
                $this->handleError($exception);
            }

            session_write_close();
            return 0;
        }



        protected function handleError(\Exception $e): void
        {
            $errorDetails = "An error occurred while processing your request after process done!!";

            $errorGuide = <<<EOD
                <br><br>
                <strong>Forbidden Access:</strong><br>
               Error caused by direct access to post request or function has been secured by Gemstone Process
            EOD;

            echo $errorDetails . $errorGuide;
            exit;
        }

        public function secure_data(): void
        {
            session_destroy();
        }
    }

