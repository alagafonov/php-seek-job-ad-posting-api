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
                        }
                        communication {
                          phone {
                            formattedNumber
                          }
                          email {
                            address
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
                    attachments {
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
