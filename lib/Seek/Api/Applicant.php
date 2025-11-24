<?php namespace Seek\Api;

/**
 * Applicant end point
 */
class Applicant extends ApiAbstract
{
    /**
     * @param string $applicantId
     * @return
     */
    public function retrieve($applicantId)
    {
        return $this->query(
            '
                query ($id: String!) {
                  candidateProfile(id: $id) {
                    profileId {
                      value
                    }
                    createDateTime
                    associatedPositionProfile {
                      profileId {
                        value
                      }
                      seekHirerJobReference
                      positionOrganizations {
                        id {
                          value
                        }
                        seekAnzAdvertiserId
                      }
                    }
                    candidate {
                      documentId {
                        value
                      }
                      person {
                        name {
                          given
                          family
                          formattedName
                        }
                        communication {
                          phone {
                            formattedNumber
                          }
                          email {
                            address
                          }
                          address {
                            city
                            postalCode
                            countryCode
                            countrySubDivisions {
                              type
                              value
                            }
                          }
                        }
                      }
                    }
                    employment {
                      organization {
                        name
                      }
                      positionHistories {
                        start
                        end
                        title
                      }
                    }
                    qualifications {
                      competencyName
                    }
                    education {
                      descriptions
                      educationDegrees {
                        degreeGrantedStatus
                        name
                        date
                      }
                      institution {
                        name
                      }
                    }
                    certifications {
                      descriptions
                      name
                      issued
                      issueDate
                      issuingAuthority {
                        name
                      }
                      effectiveTimePeriod {
                        validTo
                      }
                    }
                    positionPreferences {
                      locations {
                        referenceLocation {
                          city
                          postalCode
                          countryCode
                          countrySubDivisions {
                            type
                            value
                          }
                        }
                      }
                      seekAnzWorkTypeCodes
                      seekSalaryExpectations {
                        amount {
                          currency
                          value
                        }
                        countryCode
                        intervalCode
                      }
                    }
                    attachments {
                      descriptions
                      seekRoleCode
                      url
                    }
                  }
                }
            ',
            [
                'id' => $applicantId,
            ]
        )['data'];
    }

    /**
     * @param string $url
     * @return array
     * @throws \Http\Client\Exception
     */
    public function getDocument($url)
    {
        $this->checkAuthenticationToken();
        $response = $this->client->getHttpClient()->get($url);
        return [
            'fileName' => $this->getFileName($response->getHeaderLine('Content-Disposition')),
            'content'  => $response->getBody()->__toString(),
        ];
    }

    /**
     * @param string $contentDesposition
     * @return mixed|string
     */
    private function getFileName($contentDesposition)
    {
        $matches = [];
        if (preg_match('/.*filename=[\'\"]([^\'\"]+)/', $contentDesposition, $matches)) {
            return $matches[1];
        }
        $matches = [];
        if (preg_match('/.*?filename=([^; ]+)/', $contentDesposition, $matches)) {
            return $matches[1];
        }
        return 'file';
    }
}
