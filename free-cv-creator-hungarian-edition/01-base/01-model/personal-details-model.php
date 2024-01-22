<?php
    class PersonalDetails{
        private string $pdid;
        private string $firstName;
        private string $lastName;
        private string $address;
        private string $phoneNumber;
        private bool $profileImageExists;
        private string $profileImageTitle;
        private string $profileImagePath;

        public function __construct(string $pdid, string $firstName, string $lastName, string $address, string $phoneNumber, bool $profileImageExists, string $profileImageTitle, string $profileImagePath){
            $this->pdid = $pdid;
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->address = $address;
            $this->phoneNumber = $phoneNumber;
            $this->profileImageExists = $profileImageExists;
            $this->profileImageTitle = $profileImageTitle;
            $this->profileImagePath = $profileImagePath;
        }

        public function getPdid():string{
            return $this->pdid;
        }
        public function getFirstName():string{
            return $this->firstName;
        }
        public function getLastName():string{
            return $this->lastName;
        }
        public function getAddress():string{
            return $this->address;
        }
        public function getPhoneNumber():string{
            return $this->phoneNumber;
        }
        public function getProfileImageExists():bool{
            return $this->profileImageExists;
        }
        public function getProfileImageTitle():string{
            return $this->profileImageTitle;
        }
        public function getProfileImagePath():string{
            return $this->profileImagePath;
        }
    }
?>