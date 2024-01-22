<?php
    class UserObjectifier{
        private User $user;

        public function __construct(User $user){
            $this->user = $user;
        }

        public function getUser():User{
            return $this->user;
        }
    }

    class PersonalDetailsObjectifier{
        private PersonalDetails $personalDetails;

        public function __construct(PersonalDetails $personalDetails){
            $this->personalDetails = $personalDetails;
        }

        public function getPersonalDetails():PersonalDetails{
            return $this->personalDetails;
        }
    }

    class EducationAndQualificationsObjectifier{
        private EducationAndQualifications $educationAndQualifications;

        public function __construct(EducationAndQualifications $educationAndQualifications){
            $this->educationAndQualifications = $educationAndQualifications;
        }

        public function getEducationAndQualifications():EducationAndQualifications{
            return $this->educationAndQualifications;
        }
    }

    class WorkExperienceObjectifier{
        private WorkExperience $workExperience;

        public function __construct(WorkExperience $workExperience){
            $this->workExperience = $workExperience;
        }

        public function getWorkExperience():WorkExperience{
            return $this->workExperience;
        }
    }

    class LanguagesObjectifier{
        private Languages $languages;

        public function __construct(Languages $languages){
            $this->languages = $languages;
        }

        public function getLanguages():Languages{
            return $this->languages;
        }
    }

    class SkillsObjectifier{
        private Skills $skills;

        public function __construct(Skills $skills){
            $this->skills = $skills;
        }

        public function getSkills():Skills{
            return $this->skills;
        }
    }
?>