<?php namespace Seek\Api;

/**
 * GraphQL location
 */
class ApplyWithSeek extends ApiAbstract
{
    /**
     * @param string $schemeId
     * @param string $text
     * @param string $hirerId
     * @param string $usageTypeCode
     * @param int $first
     * @return mixed
     */
    public function getButton($redirectUri, $hirerId, $applicationUri, $seekHirerJobReference, $token = '')
    {
        $input = [
            'redirectUri' => $redirectUri,
            'hirerId' => $hirerId,
            'applicationUri' => $applicationUri,
            'seekHirerJobReference' => $seekHirerJobReference,
        ];
        if ($token) {
            $input['token'] = $token;
        }
        $result = $this->query(
            '
                query ($input: ApplyWithSeekButtonInput!) {
                  applyWithSeekButton(input: $input) {
                    buttonLabel
                    images {
                      accent
                    }
                    url
                  }
                }
            ',
            [
                'input' => $input,
            ]
        )['data'];

        return $result;
    }

    /**
     * @param string $schemeId
     * @param string $text
     * @param string $hirerId
     * @param string $usageTypeCode
     * @param int $first
     * @return mixed
     */
    public function sendSignal($typeCode, $token)
    {
        $result = $this->query(
            '
                mutation ($input: SendSignalInput!) {
                  sendSignal(input: $input)
                }
            ',
            [
                'input' => [
                    'typeCode' => $typeCode,
                    'token' => $token,
                ],
            ]
        )['data'];
        return $result;
    }
}
