<?php
    class WorkExperience{
        private string $weid;
        private string $startOfEmployment;
        private string $endOfEmployment;
        private string $workplaceName;
        private string $position;
        private string $jobDescription;

        public function __construct(string $weid, string $startOfEmployment, string $endOfEmployment, string $workplaceName, string $position, string $jobDescription){
            $this->weid = $weid;
            $this->startOfEmployment = $startOfEmployment;
            $this->endOfEmployment = $endOfEmployment;
            $this->workplaceName = $workplaceName;
            $this->position = $position;
            $this->jobDescription = $jobDescription;
        }

        public function getWeid():string{
            return $this->weid;
        }
        public function getStartOfEmployment():string{
            return $this->startOfEmployment;
        }
        public function getEndOfEmployment():string{
            return $this->endOfEmployment;
        }
        public function getWorkplaceName():string{
            return $this->workplaceName;
        }
        public function getPosition():string{
            return $this->position;
        }
        public function getJobDescription():string{
            return $this->jobDescription;
        }
    }
?>