<?php
    class EducationAndQualifications{
        private string $eaqid;
        private string $startOfStudy;
        private string $endOfStudy;
        private string $institutionName;
        private string $qualification;
        private string $studies;

        public function __construct(string $eaqid, string $startOfStudy, string $endOfStudy, string $institutionName, string $qualification, string $studies){
            $this->eaqid = $eaqid;
            $this->startOfStudy = $startOfStudy;
            $this->endOfStudy = $endOfStudy;
            $this->institutionName = $institutionName;
            $this->qualification = $qualification;
            $this->studies = $studies;
        }

        public function getEaqid():string{
            return $this->eaqid;
        }
        public function getStartOfStudy():string{
            return $this->startOfStudy;
        }
        public function getEndOfStudy():string{
            return $this->endOfStudy;
        }
        public function getInstitutionName():string{
            return $this->institutionName;
        }
        public function getQualification():string{
            return $this->qualification;
        }
        public function getStudies():string{
            return $this->studies;
        }
    }
?>