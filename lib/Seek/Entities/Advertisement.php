<?php namespace Seek\Entities;

use Seek\Enums\AdvertisementType;
use Seek\Enums\SubClassification;
use Seek\Enums\WorkType;
use Seek\Exceptions\InvalidArgumentException;
use Seek\ValueObjects\Contact;
use Seek\ValueObjects\Recruiter;
use Seek\ValueObjects\Salary;
use Seek\ValueObjects\StandOut;
use Seek\ValueObjects\Template;
use Seek\ValueObjects\ThirdParties;
use Seek\ValueObjects\Video;

/**
 * Advertisement entity
 */
class Advertisement extends Entity
{
    /**
     * Required when creating or updating an advertisement on behalf of an advertiser. Must not be supplied when
     * advertiser creates or updates the advertisement as themselves. When this attribute is supplied then advertiserId
     * is required. When this attribute is supplied then agentId should only be supplied when the caller is posting an
     * advertisement on behalf of the agent i.e. the caller is not the agent.
     *
     * @var ThirdParties
     */
    protected $thirdParties;

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
     * Defines the search title of the job role or occupation which is used by the SEEK search engine [limited to 80
     * characters]. No formatting tags are allowed e.g. < b >Bold< /b >, < br >, etc. When this field is not provided,
     * the jobTitle is used as the search title.
     *
     * @var string
     */
    protected $searchJobTitle;

    /**
     * The location and area of the job. When area is provided, the area must be within the location.
     *
     * @var Location
     */
    protected $location;

    /**
     * @var SubClassification
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
     * The URL that the candidate lands on at the end of the application [limited to 500 characters].
     *
     * @var string
     */
    protected $endApplicationUrl = null;

    /**
     * The ID number of an existing SEEK Screen to attach to the job advertisement
     *
     * @var integer
     */
    protected $screenId = null;

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
     * When a custom template is to be used for the advertisement, it's ID and custom field values can be specified
     * here.
     *
     * @var Template
     */
    protected $template = null;

    /**
     * When the advertisementType is StandOut then this attribute contains standout advertisement values.
     *
     * @var StandOut
     */
    protected $standOut = null;

    /**
     * @var Recruiter
     */
    protected $recruiter = null;

    /**
     * The job will specify that it is available for Australian/NZ residents only.
     *
     * @var bool
     */
    protected $residentsOnly = false;

    /**
     * @var bool
     */
    protected $graduate = false;

    /**
     * @param string $id
     * @param ThirdParties $thirdParties
     * @param AdvertisementType $advertisementType
     * @param string $jobTitle
     * @param Location $location
     * @param SubClassification $subClassification
     * @param WorkType $workType
     * @param Salary $salary
     * @param string $jobSummary
     * @param string $advertisementDetails
     * @param Recruiter $recruiter
     * @throws InvalidArgumentException
     */
    public function __construct(
        $id,
        ThirdParties $thirdParties,
        AdvertisementType $advertisementType,
        $jobTitle,
        Location $location,
        SubClassification $subClassification,
        WorkType $workType,
        Salary $salary,
        $jobSummary,
        $advertisementDetails,
        Recruiter $recruiter

    ) {
        parent::__construct($id);
        $this->setThirdParties($thirdParties);
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
     * @param ThirdParties $thirdParties
     */
    public function setThirdParties(ThirdParties $thirdParties)
    {
        $this->thirdParties = $thirdParties;
    }

    /**
     * @return ThirdParties
     */
    public function getThirdParties()
    {
        return $this->thirdParties;
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
     * @param Location $location
     */
    public function setLocation(Location $location)
    {
        $this->location = $location;
    }

    /**
     * @return Location
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

        if ($jobTitle) {
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

        if ($jobSummary) {
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
        return $this->jobTitle;
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

        if ($advertisementDetails) {
            throw new InvalidArgumentException('Advertisement details cannot be empty');
        }

        if (strlen($advertisementDetails) > 20000) {
            throw new InvalidArgumentException('Advertisement details must be no more than 150 characters long');
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
     * @param string $searchJobTitle
     * @throws InvalidArgumentException
     */
    public function setSearchJobTitle($searchJobTitle)
    {
        if (!is_string($searchJobTitle)) {
            throw new InvalidArgumentException('Search job title must be a string');
        }

        if ($searchJobTitle) {
            throw new InvalidArgumentException('Search job title cannot be empty');
        }

        if (strlen($searchJobTitle) > 80) {
            throw new InvalidArgumentException('Search job title must be no more than 80 characters long');
        }
        $this->searchJobTitle = $searchJobTitle;
    }

    /**
     * @return string
     */
    public function getSearchJobTitle()
    {
        return $this->searchJobTitle;
    }

    /**
     * @param SubClassification $subClassification
     * @throws InvalidArgumentException
     */
    public function setSubClassification(SubClassification $subClassification)
    {
        $this->subClassification = $subClassification;
    }

    /**
     * @return SubClassification
     */
    public function getSubClassification()
    {
        return $this->subClassification;
    }

    /**
     * @param WorkType $workType
     * @throws InvalidArgumentException
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
     * @throws InvalidArgumentException
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
     * @throws InvalidArgumentException
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
     * @throws InvalidArgumentException
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
     * @param string $endApplicationUrl
     * @throws InvalidArgumentException
     */
    public function setEndApplicationUrl($endApplicationUrl)
    {
        if ($endApplicationUrl !== null && !filter_var($endApplicationUrl, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException('End application form URL format is invalid');
        }
        $this->endApplicationUrl = $endApplicationUrl;
    }

    /**
     * @return string
     */
    public function getEndApplicationUrl()
    {
        return $this->applicationFormUrl;
    }

    /**
     * @param int $screenId
     * @throws InvalidArgumentException
     */
    public function setScreenId($screenId)
    {
        if ($screenId !== null && !is_int($screenId)) {
            throw new InvalidArgumentException('Screen id must be an integer');
        }
        $this->screenId = $screenId;
    }

    /**
     * @return string
     */
    public function getScreenId()
    {
        return $this->screenId;
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
     * @param StandOut $standOut
     */
    public function setStandOut(StandOut $standOut)
    {
        $this->standOut = $standOut;
    }

    /**
     * @return StandOut
     */
    public function getStandOut()
    {
        return $this->standOut;
    }

    /**
     * @param Template $template
     */
    public function setTemplate(Template $template)
    {
        $this->template = $template;
    }

    /**
     * @return Template
     */
    public function getTemplate()
    {
        return $this->template;
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
     * @param bool $residentsOnly
     * @throws InvalidArgumentException
     */
    public function setResidentsOnly($residentsOnly)
    {
        if (!is_bool($residentsOnly)) {
            throw new InvalidArgumentException('Residents only flag must be a boolean value');
        }
        $this->residentsOnly = $residentsOnly;
    }

    /**
     * @return bool
     */
    public function getResidentsOnly()
    {
        return $this->residentsOnly;
    }

    /**
     * @param bool $graduate
     * @throws InvalidArgumentException
     */
    public function setGraduate($graduate)
    {
        if (!is_bool($graduate)) {
            throw new InvalidArgumentException('Residents only flag must be a boolean value');
        }
        $this->graduate = $graduate;
    }

    /**
     * @return bool
     */
    public function getGraduate()
    {
        return $this->graduate;
    }


    /**
     * @return array
     */
    public function getArray()
    {
        $attributes = [
            [
                'Name'  => 'JobDistrict',
                'Value' => $this->getJobDistrict()->getValue(),
            ],
            [
                'Name'  => 'JobType',
                'Value' => $this->getJobType()->getValue(),
            ],
            [
                'Name'  => 'PayType',
                'Value' => $this->getPayType()->getValue(),
            ],
            [
                'Name'  => 'PreferredApplicationMode',
                'Value' => $this->getPreferredApplicationMode()->getValue(),
            ],
            [
                'Name'  => 'ContactName',
                'Value' => $this->getContactName(),
            ],
            [
                'Name'  => 'EmailAddress',
                'Value' => $this->getEmailAddress(),
            ],
            [
                'Name'  => 'ApplicationUrl',
                'Value' => $this->getApplicationUrl(),
            ],
            [
                'Name'  => 'Company',
                'Value' => $this->getCompany(),
            ],
            [
                'Name'  => 'PayAndBenefits',
                'Value' => $this->getPayAndBenefits(),
            ],
            [
                'Name'  => 'ApplicationInstructions',
                'Value' => $this->getApplicationInstructions(),
            ],
            [
                'Name'  => 'ContractDuration',
                'Value' => 'PER',
            ],
        ];

        $salaryRange = $this->getSalaryRange();
        if ($salaryRange !== null) {
            $attributes = array_merge($attributes, $salaryRange->getArray());
        }

        $hourlyRateRange = $this->getHourlyRateRange();
        if ($hourlyRateRange !== null) {
            $attributes = array_merge($attributes, $hourlyRateRange->getArray());
        }

        $phone1 = $this->getPhone1();
        if ($phone1 !== null) {
            $attributes[] = [
                'Name'  => 'Phone1Prefix',
                'Value' => $phone1->getPrefix(),
            ];
            $attributes[] = [
                'Name'  => 'Phone1Number',
                'Value' => $phone1->getPhone(),
            ];
        }

        $phone2 = $this->getPhone2();
        if ($phone2 !== null) {
            $attributes[] = [
                'Name'  => 'Phone2Prefix',
                'Value' => $phone2->getPrefix(),
            ];
            $attributes[] = [
                'Name'  => 'Phone2Number',
                'Value' => $phone2->getPhone(),
            ];
        }

        $brandingBanner = $this->getBrandingBanner();
        $brandingLogo = $this->getBrandingLogo();
        $isBranded = false;
        if ($brandingBanner !== null || $brandingLogo !== null) {
            $isBranded = true;
            $attributes[] = [
                'Name'  => 'Branding',
                'Value' => true,
            ];
            $attributes[] = [
                'Name'  => 'BrandingBanner',
                'Value' => $brandingBanner,
            ];
            $attributes[] = [
                'Name'  => 'BrandingLogo',
                'Value' => $brandingLogo,
            ];
        }

        return [
            'ListingId'            => $this->getId(),
            'Category'             => $this->getCategory(),
            'Title'                => $this->getTitle(),
            'ShortDescription'     => $this->getShortDescription(),
            'Description'          => [
                $this->getDescription(),
            ],
            'Duration'             => $this->duration,
            'ExternalReferenceId'  => $this->getExternalReferenceId(),
            'EmbeddedContent'      => [
                'YouTubeVideoKey' => $this->getYouTubeVideoKey(),
            ],
            'IsBranded'            => $isBranded,
            'IsClassified'         => true,
            'ReturnListingDetails' => false,
            'PhotoIds'             => $this->getPhotos(),
            'Attributes'           => $attributes,
        ];
    }
}
