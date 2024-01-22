<?php
    class User{
        private string $id;
        private string $emailAddress;
        private string $password;
        private bool $userIsAdmin;
        private bool $publicProfileLinkActive;
        private bool $dataSaveActive;

        public function __construct(string $id, string $emailAddress, string $password, bool $userIsAdmin, $publicProfileLinkActive, $dataSaveActive){
            $this->id = $id;
            $this->emailAddress = $emailAddress;
            $this->password = $password;
            $this->userIsAdmin = $userIsAdmin;
            $this->publicProfileLinkActive = $publicProfileLinkActive;
            $this->dataSaveActive = $dataSaveActive;
        }

        public function getId():string{
            return $this->id;
        }
        public function getEmailAddress():string{
            return $this->emailAddress;
        }
        public function getPassword():string{
            return $this->password;
        }
        public function getUserIsAdmin():bool{
            return $this->userIsAdmin;
        }
        public function getPublicProfileLinkActive():bool{
            return $this->publicProfileLinkActive;
        }
        public function getDataSaveActive():bool{
            return $this->dataSaveActive;
        }
    }
?>