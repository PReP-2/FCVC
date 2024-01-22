<?php
    class Skills{
        private string $sid;
        private string $skills;

        public function __construct(string $sid, string $skills){
            $this->sid = $sid;
            $this->skills = $skills;
        }

        public function getSid():string{
            return $this->sid;
        }
        public function getSkills():string{
            return $this->skills;
        }
    }
?>