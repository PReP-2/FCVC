<?php
    class Languages{
        private string $lid;
        private string $language;
        private string $level;

        public function __construct(string $lid, string $language, string $level){
            $this->lid = $lid;
            $this->language = $language;
            $this->level = $level;
        }

        public function getLid():string{
            return $this->lid;
        }
        public function getLanguage():string{
            return $this->language;
        }
        public function getLevel():string{
            return $this->level;
        }
    }
?>