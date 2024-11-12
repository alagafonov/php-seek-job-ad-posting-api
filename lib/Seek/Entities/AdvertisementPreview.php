<?php namespace Seek\Entities;

use DateTime;
use Seek\Enums\AdvertisementState;
use Seek\Enums\AdvertisementType;
use Seek\Enums\PositionStatus;
use Seek\Enums\WorkType;
use Seek\Exceptions\InvalidArgumentException;
use Seek\ValueObjects\Contact;
use Seek\ValueObjects\Recruiter;
use Seek\ValueObjects\Salary;
use Seek\ValueObjects\Video;

/**
 * Advertisement preview entity
 */
class AdvertisementPreview extends Entity
{
    /**
     * The identifier for the HiringOrganization that owns the position opening.
     *
     * @var string
     */
    protected $hirerId;

    /**
     * @var PositionStatus
     */
    protected $positionStatus;

    /**
     * @var AdvertisementType
     */
    protected $advertisementType;

    /**
     * Defines the title of the job role or occupation which is shown to job seekers [limited to 80 characters]. No
     * formatting tags are allowed e.g. < b >Bold< /b >, < br >, etc.
     *
     * @var string
     */
    protected $jobTitle;

    /**
     * The location and area of the job. When area is provided, the area must be within the location.
     *
     * @var string
     */
    protected $location;

    /**
     * The identifier for the AdvertisementBranding to apply to the posted job ad.
     *
     * @var string
     */
    protected $brandingId;

    /**
     * @var string
     */
    protected $subClassification;

    /**
     * @var WorkType
     */
    protected $workType;

    /**
     * Information about the salary for the job.
     *
     * @var Salary
     */
    protected $salary;

    /**
     * Description that is present in search results [limited to 150 characters]. No formatting tags are allowed e.g.
     * < b >Bold< /b >, < br >, etc.
     *
     * @var string
     */
    protected $jobSummary;

    /**
     * Full details of the job [limited to 20000 characters]. Basic formatting tags are allowed e.g. < b >Bold< /b >,
     * < br >, etc.
     *
     * @var string
     */
    protected $advertisementDetails;

    /**
     * @var Contact
     */
    protected $contact = null;

    /**
     * An optional video related to the job and its postition within the advertisement. Provided link must be secure
     * (HTTPS) to be accepted
     *
     * @var Video
     */
    protected $video = null;

    /**
     * The URL of the Job Application Form if not on SEEK [limited to 500 characters].
     *
     * @var string
     */
    protected $applicationFormUrl = null;

    /**
     * @var Recruiter
     */
    protected $recruiter = null;

    /**
     * @var DateTime
     */
    protected $expiryDate = null;

    /**
     * @var AdvertisementState
     */
    protected $state = null;

    /**
     * @var array
     */
    protected $searchBulletPoints = [];

    /**
     * @param string $creationId
     * @param string $hirerId
     * @param PositionStatus $positionStatus
     * @param AdvertisementType $advertisementType
     * @param string $jobTitle
     * @param string $location
     * @param string $subClassification
     * @param WorkType $workType
     * @param Salary $salary
     * @param string $jobSummary
     * @param string $advertisementDetails
     * @param Recruiter $recruiter
     * @throws InvalidArgumentException
     */
    public function __construct(
        $hirerId,
        $jobTitle,
        WorkType $workType,
        AdvertisementType $advertisementType
    ) {
        $this->setHirerId($hirerId);
        $this->setJobTitle($jobTitle);
        $this->setWorkType($workType);
        $this->setAdvertisementType($advertisementType);
    }

    /**
     * @param string $hirerId
     * @throws InvalidArgumentException
     */
    public function setHirerId($hirerId)
    {
        if (!is_string($hirerId)) {
            throw new InvalidArgumentException('Hirer id must be a string');
        }

        if (!$hirerId) {
            throw new InvalidArgumentException('Hirer id cannot be empty');
        }
        $this->hirerId = $hirerId;
    }

    /**
     * @return string
     */
    public function getHirerId()
    {
        return $this->hirerId;
    }

    /**
     * @param PositionStatus $positionStatus
     */
    public function setPositionStatus(PositionStatus $positionStatus)
    {
        $this->positionStatus = $positionStatus;
    }

    /**
     * @return PositionStatus
     */
    public function getPositionStatus()
    {
        return $this->positionStatus;
    }

    /**
     * @param AdvertisementType $advertisementType
     */
    public function setAdvertisementType(AdvertisementType $advertisementType)
    {
        $this->advertisementType = $advertisementType;
    }

    /**
     * @return AdvertisementType
     */
    public function getAdvertisementType()
    {
        return $this->advertisementType;
    }

    /**
     * @param string $location
     * @throws InvalidArgumentException
     */
    public function setLocation($location)
    {
        if (!is_string($location)) {
            throw new InvalidArgumentException('Location must be a string');
        }
        $this->location = $location;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $jobTitle
     * @throws InvalidArgumentException
     */
    public function setJobTitle($jobTitle)
    {
        if (!is_string($jobTitle)) {
            throw new InvalidArgumentException('Job title must be a string');
        }

        if (!$jobTitle) {
            throw new InvalidArgumentException('Job title cannot be empty');
        }

        if (strlen($jobTitle) > 80) {
            throw new InvalidArgumentException('Job title must be no more than 80 characters long');
        }
        $this->jobTitle = $jobTitle;
    }

    /**
     * @return string
     */
    public function getJobTitle()
    {
        return $this->jobTitle;
    }

    /**
     * @param string $jobSummary
     * @throws InvalidArgumentException
     */
    public function setJobSummary($jobSummary)
    {
        if (!is_string($jobSummary)) {
            throw new InvalidArgumentException('Job summary must be a string');
        }

        if (!$jobSummary) {
            throw new InvalidArgumentException('Job summary cannot be empty');
        }

        if (strlen($jobSummary) > 150) {
            throw new InvalidArgumentException('Job summary must be no more than 150 characters long');
        }
        $this->jobSummary = $jobSummary;
    }

    /**
     * @return string
     */
    public function getJobSummary()
    {
        return $this->jobSummary;
    }

    /**
     * @param int $number
     * @param string $searchBulletPoint
     * @throws InvalidArgumentException
     */
    public function setSearchBulletPoint($number, $searchBulletPoint)
    {
        if ($number < 1 || $number > 3) {
            throw new InvalidArgumentException('Bullet point number must be in a range between 1 and 3');
        }

        if (!is_string($searchBulletPoint)) {
            throw new InvalidArgumentException('Search bullet point must be a string');
        }

        if (!$searchBulletPoint) {
            throw new InvalidArgumentException('Search bullet point cannot be empty');
        }

        if (strlen($searchBulletPoint) > 80) {
            throw new InvalidArgumentException('Search bullet point must be no more than 80 characters long');
        }
        $this->searchBulletPoints[$number] = $searchBulletPoint;
    }

    /**
     * @param int $number
     * @return mixed|null
     * @throws InvalidArgumentException
     */
    public function getSearchBulletPoint($number)
    {
        if ($number < 1 || $number > 3) {
            throw new InvalidArgumentException('Bullet point number must be in a range between 1 and 3');
        }
        return isset($this->searchBulletPoints[$number]) ? $this->searchBulletPoints[$number] : null;
    }

    /**
     * @param string $advertisementDetails
     * @throws InvalidArgumentException
     */
    public function setAdvertisementDetails($advertisementDetails)
    {
        if (!is_string($advertisementDetails)) {
            throw new InvalidArgumentException('Advertisement details must be a string');
        }

        if (!$advertisementDetails) {
            throw new InvalidArgumentException('Advertisement details cannot be empty');
        }

        if (strlen($advertisementDetails) > 15000) {
            throw new InvalidArgumentException('Advertisement details must be no more than 20000 characters long');
        }
        $this->advertisementDetails = $advertisementDetails;
    }

    /**
     * @return string
     */
    public function getAdvertisementDetails()
    {
        return $this->advertisementDetails;
    }

    /**
     * @param string $brandingId
     * @throws InvalidArgumentException
     */
    public function setBrandingId($brandingId)
    {
        if (!is_string($brandingId)) {
            throw new InvalidArgumentException('Branding id must be a string');
        }
        $this->brandingId = $brandingId;
    }

    /**
     * @return string
     */
    public function getBrandingId()
    {
        return $this->brandingId;
    }

    /**
     * @param string $subClassification
     * @throws InvalidArgumentException
     */
    public function setSubClassification($subClassification)
    {
        if (!is_string($subClassification)) {
            throw new InvalidArgumentException('Sub-classification must be a string');
        }
        if (!$subClassification) {
            throw new InvalidArgumentException('Sub-classification cannot be empty');
        }
        $this->subClassification = $subClassification;
    }

    /**
     * @return string
     */
    public function getSubClassification()
    {
        return $this->subClassification;
    }

    /**
     * @param WorkType $workType
     */
    public function setWorkType(WorkType $workType)
    {
        $this->workType = $workType;
    }

    /**
     * @return WorkType
     */
    public function getWorkType()
    {
        return $this->workType;
    }

    /**
     * @param Salary $salary
     */
    public function setSalary(Salary $salary)
    {
        $this->salary = $salary;
    }

    /**
     * @return Salary
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * @param Contact $contact
     */
    public function setContact(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * @return Contact
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param Video $video
     */
    public function setVideo(Video $video)
    {
        $this->video = $video;
    }

    /**
     * @return Video
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @param AdvertisementState $advertisementState
     */
    public function setState(AdvertisementState $advertisementState = null)
    {
        $this->state = $advertisementState;
    }

    /**
     * @return AdvertisementState
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param bool $includeOpening
     * @return array[]
     * @throws InvalidArgumentException
     */
    public function getArray($includeOpening = true)
    {
        $positionProfile = [
            'positionTitle'                 => $this->getJobTitle(),
            'positionOrganizations'         => $this->getHirerId(),
            //'jobCategories'                 => [$this->getSubClassification()],
            //'positionLocation'              => [$this->getLocation()],
            //'offeredRemunerationPackage'    => $this->getSalary()->getArray(),
            'postingInstructions'           => [
                'seekAnzAdvertisementType' => $this->getAdvertisementType()->getValue(),
                'brandingId'               => $this->getBrandingId(),
            ],
            /*'positionFormattedDescriptions' => [
                [
                    'descriptionId' => 'SearchSummary',
                    'content'       => $this->getJobSummary(),
                ],
                [
                    'descriptionId' => 'AdvertisementDetails',
                    'content'       => $this->getAdvertisementDetails(),
                ],
            ],*/
            'seekAnzWorkTypeCode'           => $this->getWorkType()->getValue(),
            //'seekBillingReference'          => $this->getBillingReference(),
        ];
        $video = $this->getVideo();
        if ($video !== null) {
            $positionProfile['seekVideo'] = $video->getArray();
        }
        for ($i = 1; $i < 4; $i++) {
            $searchBulletPoint = $this->getSearchBulletPoint($i);
            if ($searchBulletPoint) {
                $positionProfile['positionFormattedDescriptions'][] = [
                    'descriptionId' => 'SearchBulletPoint',
                    'content'       => $searchBulletPoint,
                ];
            }
        }
        return $positionProfile;
    }
}
