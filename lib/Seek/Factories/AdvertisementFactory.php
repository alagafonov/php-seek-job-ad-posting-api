<?php namespace Seek\Factories;

use Seek\Entities\Advertisement;
use Seek\Enums\AdvertisementType;
use Seek\Enums\Position;
use Seek\Enums\PositionStatus;
use Seek\Enums\SalaryType;
use Seek\Enums\WorkType;
use Seek\Exceptions\InvalidArgumentException;
use Seek\ValueObjects\Contact;
use Seek\ValueObjects\Recruiter;
use Seek\ValueObjects\Salary;
use Seek\ValueObjects\Video;

/**
 * Advertisement factory
 */
class AdvertisementFactory extends AbstractEntityFactory
{
    /**
     * @var array
     */
    private static $mappings = [
        'applicationEmail'   => [
            'function' => 'setApplicationEmail',
        ],
        'applicationFormUrl' => [
            'function' => 'setApplicationFormUrl',
        ],
        'jobReference'       => [
            'function' => 'setJobReference',
        ],
        'agentJobReference'  => [
            'function' => 'setAgentJobReference',
        ],
        'id'                 => [
            'function' => 'setId',
        ],
        'expiryDate'         => [
            'function' => 'setExpiryDateFromString',
        ],
        'state'              => [
            'function' => 'setState',
            'type'     => '\Seek\Enums\AdvertisementState',
        ],
        'brandingId'  => [
            'function' => 'setBrandingId',
        ],
        'billingReference'  => [
            'function' => 'setBillingReference',
        ],

    ];

    /**
     * @param array $data
     * @return Advertisement
     * @throws InvalidArgumentException
     */
    public static function createFromArray(array $data)
    {
        $advertisement = new Advertisement(
            $data['creationId'],
            $data['hirerId'],
            PositionStatus::get($data['positionStatus']),
            AdvertisementType::get($data['advertisementType']),
            $data['jobTitle'],
            $data['location'],
            $data['subclassificationId'],
            WorkType::get($data['workType']),
            new Salary(
                SalaryType::get($data['salary']['type']),
                $data['salary']['minimum'],
                $data['salary']['maximum'],
                !empty($data['salary']['details']) ? $data['salary']['details'] : ''
            ),
            $data['jobSummary'],
            $data['advertisementDetails'],
            new Recruiter(
                $data['recruiter']['fullName'],
                $data['recruiter']['email'],
                $data['recruiter']['phone'],
                !empty($data['recruiter']['teamName']) ? $data['recruiter']['teamName'] : null
            )
        );
        self::populateEntity($advertisement, $data, self::$mappings);

        if (!empty($data['contact'])) {
            $advertisement->setContact(
                new Contact(
                    $data['contact']['name'],
                    !empty($data['contact']['phone']) ? $data['contact']['phone'] : null,
                    !empty($data['contact']['email']) ? $data['contact']['email'] : null
                )
            );
        }

        if (!empty($data['video'])) {
            $advertisement->setVideo(
                new Video(
                    $data['video']['url'],
                    !empty($data['video']['position']) ? Position::get($data['video']['position']) : null
                )
            );
        }

        if (!empty($data['searchBulletPoint1'])) {
            $advertisement->setSearchBulletPoint(1, $data['searchBulletPoint1']);
        }

        if (!empty($data['searchBulletPoint2'])) {
            $advertisement->setSearchBulletPoint(2, $data['searchBulletPoint2']);
        }

        if (!empty($data['searchBulletPoint3'])) {
            $advertisement->setSearchBulletPoint(3, $data['searchBulletPoint3']);
        }

        return $advertisement;
    }
}
