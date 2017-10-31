<?php
namespace MyLittleBiz\Rest;

use MyLittleBiz\Client;

/**
 * Campaign
 */

class Campaign
{

    protected $Client;

    public function __construct(Client $Client)
    {
        $this->Client = $Client;
    }

    /**
     * List your campaigns
     * To list all the campaigns, you must specify their type ( email or sms ), 
     * If you don't specify 'from' and 'to' parameters, you will get the campaigns of the current month.
     *
     * @param {string} $type    Campaigns type
     * @param {string} [$from]  From date
     * @param {string} [$to]    To date
     * @return {json}
     */
    public function fetch($type, $from = null, $to = null)
    {
        return $this->Client->request('GET', 'campaigns/{$type}', ['from' => $from, 'to' => $to]);
    }

    /**
     * Launch a campaign to a list of Groups
     * To launch an email campaign, you must specify its id, the contact group you want to push, 
     * and choose between “launch now” or “scheduled”.
     * 
     * @param {int}    $modelId        The identifier of the template to send
     * @param {string} $name           Campaign name
     * @param {string} $groups         Recipient groups identifiers Ex: 5433,5434,...
     * @param {string} $out_of_offers  send, blacklist or cancel
     *
     * @return {json}
     */
    public function launchSmsToGroups($modelId, $name, array $groups, $out_of_offers)
    {
        return $this->Client->request('POST', 'campaigns/sms/{$modelId}', [],
            [
                'groups' => implode(',', $groups),
                'out_of_offers' => $out_of_offers,
                'send_now' => 1
            ]);
    }

    /**
     * Launch a campaign to a list of msisdn
     * To launch an email campaign, you must specify its id, the contact group you want to push, 
     * and choose between “launch now” or “scheduled”.
     * 
     * @param {int}    $modelId        The identifier of the template to send
     * @param {string} $name           Campaign name
     * @param {string} $numbers        Recipient phone numbers Ex: +33699491277,+33654781600,...
     * @param {string} $out_of_offers  send, blacklist or cancel
     *
     * @return {json}
     */
    public function launchSmsToNumbers($modelId, $name, array $numbers, $out_of_offers)
    {
        return $this->Client->request('POST', 'campaigns/sms/{$modelId}', [],
            [
                'numbers' => implode(',', $numbers),
                'out_of_offers' => $out_of_offers,
                'send_now' => 1
            ]);
    }

    /**
     * Schedule a campaign to a list of msisdn
     * To schedule an email campaign, you must specify its id, the contact group you want to push, 
     * and choose between “launch now” or “scheduled”.
     * 
     * @param {int}    $modelId        The identifier of the template to send
     * @param {string} $name           Campaign name
     * @param {string} $groups         Recipient groups identifiers Ex: 5433,5434,...
     * @param {string} $out_of_offers  send, blacklist or cancel
     * @param {string} $send_date      The send date Ex: "2016-02-22 12:00:00"
     *
     * @return {json}
     */
    public function scheduleSmsToGroups($modelId, $name, array $groups, $out_of_offers, $send_date)
    {
        return $this->Client->request('POST', 'campaigns/sms/{$modelId}', [],
            [
                'groups' => implode(',', $groups),
                'out_of_offers' => $out_of_offers,
                'send_date' => $send_date
            ]);
    }

    /**
     * Schedule a campaign to a list of msisdn
     * To schedule an email campaign, you must specify its id, the contact group you want to push, 
     * and choose between “launch now” or “scheduled”.
     * 
     * @param {int}    $modelId        The identifier of the template to send
     * @param {string} $name           Campaign name
     * @param {string} $numbers        Recipient phone numbers Ex: +33699491277,+33654781600,...
     * @param {string} $out_of_offers  send, blacklist or cancel
     * @param {string} $send_date      The send date Ex: "2016-02-22 12:00:00"
     *
     * @return {json}
     */
    public function scheduleSmsToNumbers($modelId, $name, array $numbers, $out_of_offers, $send_date)
    {
        return $this->Client->request('POST', 'campaigns/sms/{$modelId}', [],
            [
                'numbers' => implode(',', $numbers),
                'out_of_offers' => $out_of_offers,
                'send_date' => $send_date
            ]);
    }

    /**
     * Schedule a campaign to a list of emails
     * To schedule an email campaign, you must specify its id, the contact group you want to push, 
     * and choose between “launch now” or “scheduled”.
     * 
     * @param {int}     $modelId        The identifier of the template to send
     * @param {string}  $name           Campaign name
     * @param {string}  $groups         Recipient groups identifiers Ex: 5433,5434,...
     * @param {string}  $out_of_offers  send, blacklist or cancel
     * @param {string}  $send_date      The send date Ex: "2016-02-22 12:00:00"
     * @param {Boolean} $track_clics    1 if track links, otherwise 0
     * @param {Array}   $attachments X  Attachments URLs Ex: url1,url2,...

     *
     * @return {json}
     */
    public function scheduleEmailToGroups($modelId, $name, array $groups, $out_of_offers, $send_date, $track_clics = 0, array $attachments = [])
    {
        return $this->Client->request('POST', 'campaigns/email/{$modelId}', [],
            [
                'groups' => implode(',', $groups),
                'out_of_offers' => $out_of_offers,
                'send_date' => $send_date,
                'track_clics' => $track_clics,
                'attachments' => $attachments,
            ]);
    }

    /**
     * Campaign Statistics
     * To retrieve the statistics for an email campaign, you must specify its id.
     *
     * @param  {int} $id Campaign identifier
     * @return {json}
     */
    public function statistics($id)
    {
        return $this->Client->request('GET', 'campaigns/{$id}');
    }

    /**
     * Delete a campaign
     * To delete a scheduled campaign, you must specify its id.
     *
     * @param  {int} $id Campaign identifier
     * @return {json}
     */
    public function delete($id)
    {
        return $this->Client->request('DELETE', 'campaigns/{$id}');
    }

}
