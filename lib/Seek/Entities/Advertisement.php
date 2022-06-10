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
 * Advertisement entity
 */
class Advertisement extends Entity
{
    /**
     * SEEK internal ad id
     *
     * @var string
     */
    protected $id;

    /**
     * Client reference id
     *
     * @var string
     */
    protected $creationId;

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
     * Email applications directed to.
     *
     * @var string
     */
    protected $applicationEmail = null;

    /**
     * The URL of the Job Application Form if not on SEEK [limited to 500 characters].
     *
     * @var string
     */
    protected $applicationFormUrl = null;

    /**
     * A quotable reference code used by the advertiser to identify the job advertisement [limited to 50 characters].
     * No formatting tags are allowed e.g. < b >Bold< /b >, < br >, etc. JOB1234
     *
     * @var string
     */
    protected $jobReference = null;

    /**
     * An additional reference code used by the agent to identify the job advertisement [limited to 50 characters].
     * No formatting tags are allowed e.g. < b >Bold< /b >, < br >, etc. AGENTJOB1234
     *
     * @var string
     */
    protected $agentJobReference = null;

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
     * @var string
     */
    protected $billingReference;

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
        $creationId,
        $hirerId,
        PositionStatus $positionStatus,
        AdvertisementType $advertisementType,
        $jobTitle,
        $location,
        $subClassification,
        WorkType $workType,
        Salary $salary,
        $jobSummary,
        $advertisementDetails,
        Recruiter $recruiter
    ) {
        $this->setCreationId($creationId);
        $this->setHirerId($hirerId);
        $this->setPositionStatus($positionStatus);
        $this->setAdvertisementType($advertisementType);
        $this->setJobTitle($jobTitle);
        $this->setLocation($location);
        $this->setSubClassification($subClassification);
        $this->setWorkType($workType);
        $this->setSalary($salary);
        $this->setJobSummary($jobSummary);
        $this->setAdvertisementDetails($advertisementDetails);
        $this->setRecruiter($recruiter);
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
     * @param string $billingReference
     * @throws InvalidArgumentException
     */
    public function setBillingReference($billingReference)
    {
        if (!is_string($billingReference)) {
            throw new InvalidArgumentException('Billing Reference must be a string');
        }
        $this->billingReference = $billingReference;
    }

    /**
     * @return string
     */
    public function getBillingReference()
    {
        return $this->billingReference;
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
     * @param string $applicationEmail
     * @throws InvalidArgumentException
     */
    public function setApplicationEmail($applicationEmail)
    {
        if ($applicationEmail !== null && !filter_var($applicationEmail, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Application email format is invalid');
        }
        $this->applicationEmail = $applicationEmail;
    }

    /**
     * @return string
     */
    public function getApplicationEmail()
    {
        return $this->applicationEmail;
    }

    /**
     * @param string $applicationFormUrl
     * @throws InvalidArgumentException
     */
    public function setApplicationFormUrl($applicationFormUrl)
    {
        if ($applicationFormUrl !== null && !filter_var($applicationFormUrl, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException('Application form URL format is invalid');
        }
        $this->applicationFormUrl = $applicationFormUrl;
    }

    /**
     * @return string
     */
    public function getApplicationFormUrl()
    {
        return $this->applicationFormUrl;
    }

    /**
     * @param string $jobReference
     * @throws InvalidArgumentException
     */
    public function setJobReference($jobReference)
    {
        if ($jobReference !== null && !is_string($jobReference)) {
            throw new InvalidArgumentException('Job reference must be a string');
        }
        $this->jobReference = $jobReference;
    }

    /**
     * @return string
     */
    public function getJobReference()
    {
        return $this->jobReference;
    }

    /**
     * @param string $agentJobReference
     * @throws InvalidArgumentException
     */
    public function setAgentJobReference($agentJobReference)
    {
        if ($agentJobReference !== null && !is_string($agentJobReference)) {
            throw new InvalidArgumentException('Agent job reference must be a string');
        }
        $this->agentJobReference = $agentJobReference;
    }

    /**
     * @return string
     */
    public function getAgentJobReference()
    {
        return $this->agentJobReference;
    }

    /**
     * @param Recruiter $recruiter
     */
    public function setRecruiter(Recruiter $recruiter)
    {
        $this->recruiter = $recruiter;
    }

    /**
     * @return Recruiter
     */
    public function getRecruiter()
    {
        return $this->recruiter;
    }

    /**
     * @param string $creationId
     * @throws InvalidArgumentException
     */
    public function setCreationId($creationId)
    {
        if ($creationId !== null && !is_string($creationId)) {
            throw new InvalidArgumentException('Creation id must be a string');
        }

        $this->creationId = $creationId;
    }

    /**
     * @return string
     */
    public function getCreationId()
    {
        return $this->creationId;
    }

    /**
     * @param string $id
     * @throws InvalidArgumentException
     */
    public function setId($id)
    {
        if ($id !== null && !is_string($id)) {
            throw new InvalidArgumentException('Id must be a string');
        }
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param DateTime $expiryDate
     */
    public function setExpiryDate(DateTime $expiryDate = null)
    {
        $this->expiryDate = $expiryDate;
    }

    /**
     * @param string $expiryDate
     * @throws InvalidArgumentException
     */
    public function setExpiryDateFromString($expiryDate)
    {
        if (!is_string($expiryDate)) {
            throw new InvalidArgumentException('Expiry date must be a string');
        }

        $this->setExpiryDate(new DateTime($expiryDate));
    }

    /**
     * @return DateTime
     */
    public function getExpiryDate()
    {
        return $this->expiryDate;
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
        $positionOpening = [
            'postingRequester' => [
                'id'             => $this->getHirerId(),
                'personContacts' => [$this->getRecruiter()->getArray()],
                'roleCode'       => 'Company',
            ],
            'statusCode'       => $this->getPositionStatus()->getValue(),
        ];
        $positionProfile = [
            'jobCategories'                 => [$this->getSubClassification()],
            'offeredRemunerationPackage'    => $this->getSalary()->getArray(),
            'positionFormattedDescriptions' => [
                [
                    'descriptionId' => 'SearchSummary',
                    'content'       => $this->getJobSummary(),
                ],
                [
                    'descriptionId' => 'AdvertisementDetails',
                    'content'       => $this->getAdvertisementDetails(),
                ],
            ],
            'positionLocation'              => [$this->getLocation()],
            'positionOrganizations'         => [$this->getHirerId()],
            'positionTitle'                 => $this->getJobTitle(),
            'postingInstructions'           => [
                'seekAnzAdvertisementType' => $this->getAdvertisementType()->getValue(),
                /*'applicationMethods'       => [
                    'applicationUri' => ['url' => $this->getApplicationFormUrl()],
                ],*/
                'brandingId'               => $this->getBrandingId(),
            ],
            'seekAnzWorkTypeCode'           => $this->getWorkType()->getValue(),
            'seekBillingReference'          => $this->getBillingReference(),
        ];
        $profileId = $this->getId();
        if ($profileId) {
            $positionProfile['profileId'] = $profileId;
        } else {
            $positionProfile['postingInstructions']['idempotencyId'] = $this->getCreationId();
        }
        $brandingId = $this->getBrandingId();
        if ($brandingId) {
            $positionProfile['postingInstructions']['brandingId'] = $brandingId;
        }
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
        $result = ['positionProfile' => $positionProfile];
        if ($includeOpening) {
            $result['positionOpening'] = $positionOpening;
        }
        return $result;
    }
}
